<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;
use App\Core\Database;

class Sanatorium extends Model
{
    protected static string $table = 'sanatoriums';

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetchOne('SELECT * FROM sanatoriums WHERE slug = ? AND status = "active"', [$slug]);
    }
    public static function active(int $page = 1, int $perPage = 12): array
    {
        return static::paginate($page, $perPage, 'status = ?', ['active'], 'sort_order ASC, id ASC');
    }
    public static function getName(array $row, string $locale = 'ru'): string
    {
        return $row['name_' . $locale] ?: $row['name_ru'] ?? '';
    }
    public static function getDescription(array $row, string $locale = 'ru'): string
    {
        return $row['description_' . $locale] ?: $row['description_ru'] ?? '';
    }
    public static function getBody(array $row, string $locale = 'ru'): string
    {
        return $row['body_' . $locale] ?: $row['body_ru'] ?? '';
    }
}
