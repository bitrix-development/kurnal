<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class SanatoriumsAdminController extends CrudController
{
    protected string $entity      = 'sanatoriums';
    protected string $viewPrefix  = 'admin/sanatoriums';
    protected string $routePrefix = '/admin/sanatoriums';
    protected array  $translatableFields = ['name', 'description', 'body'];
    protected array  $simpleFields = ['slug', 'status', 'image', 'sort_order'];
    protected string $orderBy     = 'sort_order ASC, id ASC';
}
