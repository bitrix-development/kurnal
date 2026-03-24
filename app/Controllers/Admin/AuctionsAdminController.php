<?php
declare(strict_types=1);
namespace App\Controllers\Admin;

class AuctionsAdminController extends CrudController
{
    protected string $entity      = 'auctions';
    protected string $viewPrefix  = 'admin/auctions';
    protected string $routePrefix = '/admin/auctions';
    protected array  $simpleFields = ['slug', 'status', 'image', 'auction_date', 'price'];
}
