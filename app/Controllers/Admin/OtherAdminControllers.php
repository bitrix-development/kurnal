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

class AuctionsAdminController extends CrudController
{
    protected string $entity      = 'auctions';
    protected string $viewPrefix  = 'admin/auctions';
    protected string $routePrefix = '/admin/auctions';
    protected array  $simpleFields = ['slug', 'status', 'image', 'auction_date', 'price'];
}

class SanatoriumsAdminController extends CrudController
{
    protected string $entity      = 'sanatoriums';
    protected string $viewPrefix  = 'admin/sanatoriums';
    protected string $routePrefix = '/admin/sanatoriums';
    protected array  $translatableFields = ['name', 'description', 'body'];
    protected array  $simpleFields = ['slug', 'status', 'image', 'sort_order'];
    protected string $orderBy     = 'sort_order ASC, id ASC';
}

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

class ReviewsAdminController extends CrudController
{
    protected string $entity      = 'reviews';
    protected string $viewPrefix  = 'admin/reviews';
    protected string $routePrefix = '/admin/reviews';
    protected array  $translatableFields = [];
    protected array  $simpleFields = ['author', 'rating', 'text', 'status'];
    protected string $orderBy     = 'id DESC';

    protected function validate(array $data): array { return []; }
}
