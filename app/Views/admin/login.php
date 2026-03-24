<?php
/**
 * Admin login page (no layout)
 * @var string|null $error
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход — Курорт Нальчик</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="/assets/css/bootstrap.min-1.css" rel="stylesheet">
    <style>
        body { background:#1a1a2e; display:flex; align-items:center; justify-content:center; min-height:100vh; }
        .login-box { background:#fff; border-radius:16px; padding:48px; width:100%; max-width:400px; }
        .login-box h1 { font-size:28px; font-weight:700; margin-bottom:8px; }
        .login-box p { color:#6c757d; margin-bottom:32px; }
        .form-control { border-radius:8px; padding:12px 16px; border:1px solid #e9ecef; }
        .btn-primary { background:#1a1a2e; border-color:#1a1a2e; border-radius:8px; padding:12px 24px; font-weight:600; width:100%; }
        .btn-primary:hover { background:#16213e; border-color:#16213e; }
        .alert { border-radius:8px; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="text-center mb-40">
        <img src="/assets/img/home2-header-logo-1.svg" alt="" height="50" style="filter:invert(1);">
        <h1 class="mt-20">Вход в систему</h1>
        <p>Введите данные администратора</p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES) ?></div>
    <?php endif; ?>

    <form method="post" action="/admin/login">
        <div class="mb-3">
            <label class="form-label fw-semibold">Логин</label>
            <input type="text" name="login" class="form-control" placeholder="Имя пользователя или email" required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Пароль</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
</body>
</html>
