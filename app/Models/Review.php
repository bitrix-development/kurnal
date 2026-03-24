<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;

class Review extends Model
{
    protected static string $table = 'reviews';

    public static function approved(): array
    {
        return static::where('status = ?', ['approved'], 'created_at DESC');
    }
}
