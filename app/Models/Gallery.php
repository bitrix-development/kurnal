<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;

class Gallery extends Model
{
    protected static string $table = 'gallery';

    public static function active(): array
    {
        return static::where('status = ?', ['active'], 'sort_order ASC, id ASC');
    }
    public static function getTitle(array $row, string $locale = 'ru'): string
    {
        return $row['title_' . $locale] ?: $row['title_ru'] ?? '';
    }
}
