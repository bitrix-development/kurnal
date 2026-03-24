<?php
declare(strict_types=1);

namespace App\Core;

abstract class Model
{
    protected static string $table = '';
    protected static string $primaryKey = 'id';

    public static function find(int $id): ?array
    {
        $table = static::$table;
        $pk    = static::$primaryKey;
        return Database::fetchOne("SELECT * FROM {$table} WHERE {$pk} = ?", [$id]);
    }

    public static function findBy(string $column, mixed $value): ?array
    {
        $table = static::$table;
        return Database::fetchOne("SELECT * FROM {$table} WHERE {$column} = ? LIMIT 1", [$value]);
    }

    public static function all(string $order = 'id DESC'): array
    {
        $table = static::$table;
        return Database::fetchAll("SELECT * FROM {$table} ORDER BY {$order}");
    }

    public static function where(string $conditions, array $params = [], string $order = 'id DESC', ?int $limit = null, int $offset = 0): array
    {
        $table = static::$table;
        $sql   = "SELECT * FROM {$table} WHERE {$conditions} ORDER BY {$order}";
        if ($limit !== null) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        return Database::fetchAll($sql, $params);
    }

    public static function count(string $conditions = '1=1', array $params = []): int
    {
        $table = static::$table;
        return (int)Database::fetchValue("SELECT COUNT(*) FROM {$table} WHERE {$conditions}", $params);
    }

    public static function create(array $data): int
    {
        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        if (!isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        return Database::insert(static::$table, $data);
    }

    public static function update(int $id, array $data): int
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return Database::update(static::$table, $data, static::$primaryKey . ' = ?', [$id]);
    }

    public static function delete(int $id): int
    {
        return Database::delete(static::$table, static::$primaryKey . ' = ?', [$id]);
    }

    public static function paginate(int $page, int $perPage, string $conditions = '1=1', array $params = [], string $order = 'id DESC'): array
    {
        $total  = static::count($conditions, $params);
        $offset = ($page - 1) * $perPage;
        $items  = static::where($conditions, $params, $order, $perPage, $offset);

        return [
            'items'       => $items,
            'total'       => $total,
            'per_page'    => $perPage,
            'current_page'=> $page,
            'last_page'   => (int)ceil($total / $perPage),
        ];
    }
}
