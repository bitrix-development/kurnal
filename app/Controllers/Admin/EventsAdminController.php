<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class EventsAdminController extends CrudController
{
    protected string $entity      = 'events';
    protected string $viewPrefix  = 'admin/events';
    protected string $routePrefix = '/admin/events';
    protected array  $simpleFields = ['slug', 'status', 'image', 'event_date'];
}
