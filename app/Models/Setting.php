<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;
use App\Core\Database;

class Setting extends Model
{
    protected static string $table = 'settings';
    protected static string $primaryKey = 'id';

    public static function get(string $key, mixed $default = null): mixed
    {
        $row = Database::fetchOne('SELECT value FROM settings WHERE `key` = ?', [$key]);
        return $row ? $row['value'] : $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $existing = Database::fetchOne('SELECT id FROM settings WHERE `key` = ?', [$key]);
        if ($existing) {
            Database::update('settings', ['value' => $value, 'updated_at' => date('Y-m-d H:i:s')], '`key` = ?', [$key]);
        } else {
            Database::insert('settings', ['key' => $key, 'value' => $value, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }
    }

    public static function all(): array
    {
        $rows   = Database::fetchAll('SELECT `key`, `value` FROM settings');
        $result = [];
        foreach ($rows as $row) {
            $result[$row['key']] = $row['value'];
        }
        return $result;
    }
}
