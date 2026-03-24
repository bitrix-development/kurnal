<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class PagesAdminController extends CrudController
{
    protected string $entity      = 'pages';
    protected string $viewPrefix  = 'admin/pages';
    protected string $routePrefix = '/admin/pages';
    protected array  $translatableFields = ['title', 'body'];
    protected array  $simpleFields = ['slug', 'status'];
    protected string $orderBy     = 'id ASC';
}
