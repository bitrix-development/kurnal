<?php
declare(strict_types=1);

namespace App\Services;

class CsrfService
{
    private const TOKEN_KEY = '_csrf_token';
    private const TOKEN_LENGTH = 32;

    public static function generateToken(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION[self::TOKEN_KEY])) {
            $_SESSION[self::TOKEN_KEY] = bin2hex(random_bytes(self::TOKEN_LENGTH));
        }

        return $_SESSION[self::TOKEN_KEY];
    }

    public static function getToken(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return $_SESSION[self::TOKEN_KEY] ?? self::generateToken();
    }

    public static function validate(string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $stored = $_SESSION[self::TOKEN_KEY] ?? '';
        return $stored !== '' && hash_equals($stored, $token);
    }

    public static function field(): string
    {
        $token = self::getToken();
        return '<input type="hidden" name="_csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function validateRequest(): void
    {
        $token = $_POST['_csrf_token'] ?? '';
        if (!self::validate($token)) {
            http_response_code(403);
            echo 'CSRF token validation failed. Please go back and try again.';
            exit;
        }
    }
}
