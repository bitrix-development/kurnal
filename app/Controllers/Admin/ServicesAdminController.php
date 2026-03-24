<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class ServicesAdminController extends CrudController
{
    protected string $entity      = 'services';
    protected string $viewPrefix  = 'admin/services';
    protected string $routePrefix = '/admin/services';
    protected array  $translatableFields = ['name', 'description', 'body'];
    protected array  $simpleFields = ['slug', 'status', 'image', 'sort_order'];
    protected string $orderBy     = 'sort_order ASC, id ASC';
}
