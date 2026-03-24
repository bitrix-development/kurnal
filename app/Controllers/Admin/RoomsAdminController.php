<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class RoomsAdminController extends CrudController
{
    protected string $entity      = 'rooms';
    protected string $viewPrefix  = 'admin/rooms';
    protected string $routePrefix = '/admin/rooms';
    protected array  $translatableFields = ['name', 'description', 'features'];
    protected array  $simpleFields = ['slug', 'status', 'image', 'price_from', 'category_id', 'sort_order'];
    protected string $orderBy     = 'sort_order ASC, id ASC';
}
