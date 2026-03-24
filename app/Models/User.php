<?php declare(strict_types=1);
namespace App\Models;
use App\Core\Model;

class User extends Model
{
    protected static string $table = 'users';

    public static function findByLogin(string $login): ?array
    {
        return \App\Core\Database::fetchOne(
            'SELECT * FROM users WHERE (username = ? OR email = ?) AND is_active = 1',
            [$login, $login]
        );
    }

    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
