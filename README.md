# Курорт Нальчик — Самописная CMS

PHP 8.2 CMS (без фреймворков) с мультиязычностью (ru/en), ЧПУ, SEO и полной админкой.

---

## Стек

- **PHP 8.2+** (самописный MVC, без Laravel/Symfony/WordPress)
- **MySQL 8 / MariaDB 10.6+**
- **Apache** с mod_rewrite (.htaccess)
- **Composer**: phpdotenv, fast-route, htmlpurifier

---

## Структура

```
kurnal/
├── public/          ← DocumentRoot Apache
│   ├── index.php    ← Front controller
│   ├── .htaccess
│   ├── assets/      ← CSS, JS, изображения
│   └── uploads/     ← Загруженные файлы
├── app/
│   ├── Core/        ← Router, View, Database, Model, Controller, Container
│   ├── Controllers/ ← Фронт + Admin/
│   ├── Models/      ← News, Blog, Room, Service, Event, Auction, Sanatorium...
│   ├── Services/    ← SeoService, I18nService, AuthService, ImageService
│   ├── Views/       ← PHP-шаблоны (layouts, partials, admin)
│   └── helpers.php  ← url(), asset(), e(), t(), format_date(), ...
├── config/
│   ├── routes.php   ← Все маршруты
│   └── lang/        ← ru.php, en.php
├── migrations/
│   └── schema.php
├── seeds/
│   └── initial.php
├── bin/
│   └── console      ← CLI: migrate, seed, user:create
└── .env.example
```

---

## Развёртывание на Beget (Apache, PHP 8.2)

### 1. Клонировать

```bash
cd ~/domains/your-domain.ru/
git clone https://github.com/bitrix-development/kurnal.git .
```

### 2. Composer

```bash
composer install --no-dev --optimize-autoloader
```

### 3. DocumentRoot → public/

В панели Beget: **Сайты** → домен → **DocumentRoot** = `/home/username/domains/your-domain.ru/public`

### 4. MySQL — создать БД

```sql
CREATE DATABASE kurnal_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kurnal_user'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD';
GRANT ALL PRIVILEGES ON kurnal_cms.* TO 'kurnal_user'@'localhost';
FLUSH PRIVILEGES;
```

### 5. Настроить .env

```bash
cp .env.example .env
nano .env
```

```env
APP_URL=https://your-domain.ru
APP_LOCALES=ru,en
APP_DEFAULT_LOCALE=ru

DB_HOST=127.0.0.1
DB_NAME=kurnal_cms
DB_USER=kurnal_user
DB_PASS=STRONG_PASSWORD
```

### 6. Миграции

```bash
php bin/console migrate
```

### 7. Сидер (admin + базовые данные)

```bash
php bin/console seed
```

Создаёт: **admin / Admin123!** — **сразу смените пароль!**

### 8. Права папок

```bash
chmod -R 775 public/uploads storage
```

---

## Смена пароля

```bash
php bin/console user:create
```

---

## URL-структура (ЧПУ)

| URL | Страница |
|-----|---------|
| `/ru` | Главная |
| `/en` | Home (EN) |
| `/ru/news` | Новости |
| `/ru/news/slug` | Деталка новости |
| `/ru/blog` | Блог |
| `/ru/blog/slug` | Статья |
| `/ru/rooms` | Номера |
| `/ru/rooms/slug` | Деталка номера |
| `/ru/services` / `/ru/services/slug` | Услуги |
| `/ru/events` / `/ru/events/slug` | События |
| `/ru/auctions` / `/ru/auctions/slug` | Закупки |
| `/ru/sanatoriums` / `/ru/sanatoriums/slug` | Санатории |
| `/ru/gallery` | Галерея |
| `/ru/reviews` | Отзывы |
| `/ru/contact` | Контакты |
| `/ru/director` | Написать директору |
| `/ru/{slug}` | Любая CMS-страница (about, faq, documents...) |
| `/admin` | Дашборд |
| `/admin/login` | Вход |
| `/sitemap.xml` | Sitemap |

---

## Админка

**URL:** `/admin` — **логин:** `admin` — **пароль:** `Admin123!`

Разделы: Страницы, Новости, Блог, Номера, Услуги, События, Закупки, Санатории, Галерея, Отзывы, SEO, Настройки.

---

## SEO (приоритеты)

1. **Индивидуальное** — поля seo_overrides (title/description на элемент + язык)
2. **Шаблон типа** — seo_templates с плейсхолдерами `{{title}}`, `{{name}}`, `{{excerpt}}`, `{{price_from}}`, `{{site_name}}`
3. **SEO раздела** — seo_routes (для /news, /rooms и т.п.)
4. **Дефолт сайта** — настройки

На всех страницах: `<title>`, `<meta description>`, `<meta robots>`, `<link canonical>`, OG-теги, hreflang.

---

## CLI команды

```bash
php bin/console migrate          # Миграции
php bin/console seed             # Сидер
php bin/console migrate:fresh    # Сброс + повтор
php bin/console user:create      # Создать/сбросить пользователя
php bin/console robots:update    # Обновить public/robots.txt
```

---

## Локальная разработка

```bash
cp .env.example .env
composer install
# настроить .env (DB_*)
php bin/console migrate && php bin/console seed
php -S localhost:8080 -t public
# → http://localhost:8080/ru
```
