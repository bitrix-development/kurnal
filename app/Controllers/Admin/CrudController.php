<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Services\AuthService;
use App\Services\ImageService;
use App\Core\Database;

/**
 * Base CRUD controller for admin entities.
 * Subclasses define $model, $table, $entity, $viewPrefix, $fields.
 */
abstract class CrudController extends Controller
{
    protected string $model = '';
    protected string $entity = '';          // e.g. 'news'
    protected string $viewPrefix = '';      // e.g. 'admin/news'
    protected string $routePrefix = '';     // e.g. '/admin/news'
    protected array  $translatableFields = ['title', 'excerpt', 'body', 'name', 'description', 'features'];
    protected array  $simpleFields = ['slug', 'status', 'image', 'sort_order', 'price_from', 'price', 'category_id', 'published_at', 'event_date', 'auction_date'];
    protected string $orderBy = 'id DESC';

    protected function getTable(): string
    {
        return $this->entity;
    }

    public function index(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $page  = max(1, (int)$request->get('page', 1));
        $per   = 20;
        $table = $this->getTable();
        $total = Database::fetchValue("SELECT COUNT(*) FROM {$table}");
        $offset = ($page - 1) * $per;
        $items = Database::fetchAll("SELECT * FROM {$table} ORDER BY {$this->orderBy} LIMIT {$per} OFFSET {$offset}");
        return $this->renderAdmin($this->viewPrefix . '/index', [
            'items'       => $items,
            'total'       => $total,
            'currentPage' => $page,
            'lastPage'    => (int)ceil($total / $per),
            'routePrefix' => $this->routePrefix,
            'entity'      => $this->entity,
        ]);
    }

    public function create(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        return $this->renderAdmin($this->viewPrefix . '/form', [
            'item'        => null,
            'errors'      => [],
            'routePrefix' => $this->routePrefix,
            'entity'      => $this->entity,
        ]);
    }

    public function store(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $data   = $this->buildData($request);
        $errors = $this->validate($data);

        if ($errors) {
            return $this->renderAdmin($this->viewPrefix . '/form', [
                'item'        => $data,
                'errors'      => $errors,
                'routePrefix' => $this->routePrefix,
                'entity'      => $this->entity,
            ]);
        }

        // Handle image upload
        $imageFile = $request->file('image');
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            try {
                $imgSvc = new ImageService();
                $data['image'] = $imgSvc->upload($imageFile, $this->entity);
            } catch (\Exception $e) {
                $errors['image'] = $e->getMessage();
            }
        }

        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
        $id = Database::insert($this->getTable(), $data);

        // Handle SEO override
        $this->saveSeoOverride($request, $this->entity, $id);

        return $this->redirect($this->routePrefix . '?saved=1');
    }

    public function edit(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $id   = (int)($vars['id'] ?? 0);
        $item = Database::fetchOne("SELECT * FROM {$this->getTable()} WHERE id = ?", [$id]);
        if (!$item) return $this->notFound();

        $seoOverride = $this->getSeoOverride($this->entity, $id);

        return $this->renderAdmin($this->viewPrefix . '/form', [
            'item'        => array_merge($item, ['seo' => $seoOverride]),
            'errors'      => [],
            'routePrefix' => $this->routePrefix,
            'entity'      => $this->entity,
        ]);
    }

    public function update(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $id   = (int)($vars['id'] ?? 0);
        $item = Database::fetchOne("SELECT * FROM {$this->getTable()} WHERE id = ?", [$id]);
        if (!$item) return $this->notFound();

        $data   = $this->buildData($request);
        $errors = $this->validate($data);

        // Handle image upload
        $imageFile = $request->file('image');
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            try {
                $imgSvc = new ImageService();
                if (!empty($item['image'])) {
                    $imgSvc->delete($item['image']);
                }
                $data['image'] = $imgSvc->upload($imageFile, $this->entity);
            } catch (\Exception $e) {
                $errors['image'] = $e->getMessage();
            }
        }

        if ($errors) {
            return $this->renderAdmin($this->viewPrefix . '/form', [
                'item'        => array_merge($item, $data, ['id' => $id]),
                'errors'      => $errors,
                'routePrefix' => $this->routePrefix,
                'entity'      => $this->entity,
            ]);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update($this->getTable(), $data, 'id = ?', [$id]);

        // Handle SEO override
        $this->saveSeoOverride($request, $this->entity, $id);

        return $this->redirect($this->routePrefix . '?saved=1');
    }

    public function delete(Request $request, array $vars = []): Response
    {
        AuthService::requireAuth();
        $id   = (int)($vars['id'] ?? 0);
        $item = Database::fetchOne("SELECT * FROM {$this->getTable()} WHERE id = ?", [$id]);
        if ($item && !empty($item['image'])) {
            (new ImageService())->delete($item['image']);
        }
        Database::delete($this->getTable(), 'id = ?', [$id]);
        // Also delete SEO overrides
        try {
            Database::delete('seo_overrides', 'entity_type = ? AND entity_id = ?', [$this->entity, $id]);
        } catch (\Exception) {}
        return $this->redirect($this->routePrefix . '?deleted=1');
    }

    protected function buildData(Request $request): array
    {
        $data = [];
        $locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');

        foreach ($this->translatableFields as $field) {
            foreach ($locales as $locale) {
                $key = $field . '_' . $locale;
                $val = $request->post($key);
                if ($val !== null) {
                    $data[$key] = $field === 'body' ? $this->purifyHtml((string)$val) : trim((string)$val);
                }
            }
        }

        foreach ($this->simpleFields as $field) {
            $val = $request->post($field);
            if ($val !== null) {
                $data[$field] = trim((string)$val);
            }
        }

        // Auto-generate slug
        if (empty($data['slug'])) {
            $title = $data['title_ru'] ?? $data['name_ru'] ?? '';
            $data['slug'] = $this->slugify($title);
        }

        return $data;
    }

    protected function validate(array $data): array
    {
        $errors = [];
        $hasTitle = false;
        $locales  = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');

        foreach ($locales as $locale) {
            if (!empty($data['title_' . $locale]) || !empty($data['name_' . $locale])) {
                $hasTitle = true;
                break;
            }
        }

        if (!$hasTitle) {
            $errors['title'] = 'Укажите заголовок хотя бы на одном языке';
        }

        return $errors;
    }

    protected function slugify(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = strtr($text, [
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh',
            'з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
            'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'ts',
            'ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
        ]);
        $text = preg_replace('/[^a-z0-9\-_]/', '-', $text) ?? $text;
        $text = preg_replace('/-+/', '-', $text) ?? $text;
        return trim($text, '-') ?: uniqid('item-');
    }

    protected function purifyHtml(string $html): string
    {
        static $purifier = null;
        if ($purifier === null) {
            $config = \HTMLPurifier_Config::createDefault();
            $config->set('HTML.Allowed', 'p,br,strong,em,u,s,h2,h3,h4,ul,ol,li,a[href|target],img[src|alt|width|height],table,thead,tbody,tr,th,td,blockquote,pre,code,span,div');
            $config->set('HTML.SafeIframe', true);
            $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/)%');
            $config->set('Cache.SerializerPath', ROOT . '/storage/cache_html');
            if (!is_dir(ROOT . '/storage/cache_html')) {
                mkdir(ROOT . '/storage/cache_html', 0775, true);
            }
            $purifier = new \HTMLPurifier($config);
        }
        return $purifier->purify($html);
    }

    protected function saveSeoOverride(Request $request, string $entityType, int $entityId): void
    {
        $locales = explode(',', $_ENV['APP_LOCALES'] ?? 'ru,en');
        foreach ($locales as $locale) {
            $seoTitle = $request->post("seo_title_{$locale}");
            $seoDesc  = $request->post("seo_description_{$locale}");
            $seoRobots = $request->post("seo_robots_{$locale}", 'index, follow');
            $seoOgImage = $request->post("seo_og_image_{$locale}");

            if ($seoTitle === null && $seoDesc === null) continue;

            try {
                $existing = Database::fetchOne(
                    'SELECT id FROM seo_overrides WHERE entity_type = ? AND entity_id = ? AND locale = ?',
                    [$entityType, $entityId, $locale]
                );
                $data = [
                    'entity_type' => $entityType,
                    'entity_id'   => $entityId,
                    'locale'      => $locale,
                    'title'       => $seoTitle ?? '',
                    'description' => $seoDesc ?? '',
                    'robots'      => $seoRobots ?? 'index, follow',
                    'og_image'    => $seoOgImage ?? '',
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
                if ($existing) {
                    Database::update('seo_overrides', $data, 'id = ?', [$existing['id']]);
                } else {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    Database::insert('seo_overrides', $data);
                }
            } catch (\Exception) {}
        }
    }

    protected function getSeoOverride(string $entityType, int $entityId): array
    {
        try {
            $rows   = Database::fetchAll(
                'SELECT * FROM seo_overrides WHERE entity_type = ? AND entity_id = ?',
                [$entityType, $entityId]
            );
            $result = [];
            foreach ($rows as $row) {
                $result[$row['locale']] = $row;
            }
            return $result;
        } catch (\Exception) {
            return [];
        }
    }
}
