<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class GalleryAdminController extends CrudController
{
    protected string $entity      = 'gallery';
    protected string $viewPrefix  = 'admin/gallery';
    protected string $routePrefix = '/admin/gallery';
    protected array  $translatableFields = ['title'];
    protected array  $simpleFields = ['image', 'status', 'sort_order'];
    protected string $orderBy     = 'sort_order ASC, id ASC';

    protected function validate(array $data): array { return []; }
}
