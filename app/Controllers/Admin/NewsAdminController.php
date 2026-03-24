<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class NewsAdminController extends CrudController
{
    protected string $entity      = 'news';
    protected string $viewPrefix  = 'admin/news';
    protected string $routePrefix = '/admin/news';
    protected array  $simpleFields = ['slug', 'status', 'image', 'published_at', 'category'];
}
