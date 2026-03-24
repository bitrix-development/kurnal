<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;
use App\Core\Database;

class Room extends Model
{
    protected static string $table = 'rooms';

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetchOne('SELECT * FROM rooms WHERE slug = ? AND status = "active"', [$slug]);
    }

    public static function active(int $page = 1, int $perPage = 12, ?int $categoryId = null): array
    {
        $cond   = 'status = ?';
        $params = ['active'];
        if ($categoryId) {
            $cond   .= ' AND category_id = ?';
            $params[] = $categoryId;
        }
        return static::paginate($page, $perPage, $cond, $params, 'sort_order ASC, id ASC');
    }

    public static function getName(array $row, string $locale = 'ru'): string
    {
        return $row['name_' . $locale] ?: $row['name_ru'] ?? '';
    }
    public static function getDescription(array $row, string $locale = 'ru'): string
    {
        return $row['description_' . $locale] ?: $row['description_ru'] ?? '';
    }
    public static function getFeatures(array $row, string $locale = 'ru'): string
    {
        return $row['features_' . $locale] ?: $row['features_ru'] ?? '';
    }

    public static function getCategory(int $categoryId): ?array
    {
        return Database::fetchOne('SELECT * FROM room_categories WHERE id = ?', [$categoryId]);
    }

    public static function getAllCategories(): array
    {
        return Database::fetchAll('SELECT * FROM room_categories ORDER BY sort_order ASC, id ASC');
    }
}
