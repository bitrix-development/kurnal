<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;
use App\Core\Database;

class Auction extends Model
{
    protected static string $table = 'auctions';

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetchOne('SELECT * FROM auctions WHERE slug = ? AND status = "published"', [$slug]);
    }
    public static function published(int $page = 1, int $perPage = 12): array
    {
        return static::paginate($page, $perPage, 'status = ?', ['published'], 'auction_date DESC, id DESC');
    }
    public static function getTitle(array $row, string $locale = 'ru'): string
    {
        return $row['title_' . $locale] ?: $row['title_ru'] ?? '';
    }
    public static function getExcerpt(array $row, string $locale = 'ru'): string
    {
        return $row['excerpt_' . $locale] ?: $row['excerpt_ru'] ?? '';
    }
    public static function getBody(array $row, string $locale = 'ru'): string
    {
        return $row['body_' . $locale] ?: $row['body_ru'] ?? '';
    }
}
