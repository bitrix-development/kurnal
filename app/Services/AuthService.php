<?php
declare(strict_types=1);

namespace App\Services;

class AuthService
{
    public static function attempt(string $login, string $password): bool
    {
        $user = \App\Core\Database::fetchOne(
            'SELECT * FROM users WHERE (username = ? OR email = ?) AND is_active = 1',
            [$login, $login]
        );

        if (!$user) return false;
        if (!password_verify($password, $user['password'])) return false;

        $_SESSION['admin_id']   = $user['id'];
        $_SESSION['admin_name'] = $user['name'];
        $_SESSION['admin_role'] = $user['role'];

        return true;
    }

    public static function user(): ?array
    {
        if (empty($_SESSION['admin_id'])) return null;
        return \App\Core\Database::fetchOne('SELECT * FROM users WHERE id = ?', [$_SESSION['admin_id']]);
    }

    public static function check(): bool
    {
        return !empty($_SESSION['admin_id']);
    }

    public static function logout(): void
    {
        unset($_SESSION['admin_id'], $_SESSION['admin_name'], $_SESSION['admin_role']);
        session_destroy();
    }

    public static function requireAuth(): void
    {
        if (!self::check()) {
            \App\Core\Response::redirect('/admin/login');
        }
    }
}
