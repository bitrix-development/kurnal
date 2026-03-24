<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class BlogAdminController extends CrudController
{
    protected string $entity      = 'blog_posts';
    protected string $viewPrefix  = 'admin/blog';
    protected string $routePrefix = '/admin/blog';
    protected array  $simpleFields = ['slug', 'status', 'image', 'published_at'];
    protected string $orderBy     = 'id DESC';

    protected function getTable(): string { return 'blog_posts'; }
}
