<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

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
