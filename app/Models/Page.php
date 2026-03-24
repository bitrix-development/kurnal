<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;
use App\Core\Database;

class Page extends Model
{
    protected static string $table = 'pages';

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetchOne('SELECT * FROM pages WHERE slug = ? AND status = "published"', [$slug]);
    }
    public static function getTitle(array $row, string $locale = 'ru'): string
    {
        return $row['title_' . $locale] ?: $row['title_ru'] ?? $row['title'] ?? '';
    }
    public static function getBody(array $row, string $locale = 'ru'): string
    {
        return $row['body_' . $locale] ?: $row['body_ru'] ?? $row['body'] ?? '';
    }
}
