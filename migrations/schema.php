<?php
declare(strict_types=1);

use App\Core\Database;

return [
    '001_create_users' => "
        CREATE TABLE IF NOT EXISTS users (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username    VARCHAR(100) NOT NULL UNIQUE,
            email       VARCHAR(255) NOT NULL UNIQUE,
            password    VARCHAR(255) NOT NULL,
            name        VARCHAR(255) NOT NULL DEFAULT '',
            role        ENUM('admin','editor') NOT NULL DEFAULT 'admin',
            is_active   TINYINT(1) NOT NULL DEFAULT 1,
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '002_create_settings' => "
        CREATE TABLE IF NOT EXISTS settings (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `key`       VARCHAR(100) NOT NULL UNIQUE,
            `value`     TEXT NOT NULL DEFAULT '',
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '003_create_pages' => "
        CREATE TABLE IF NOT EXISTS pages (
            id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug         VARCHAR(255) NOT NULL UNIQUE,
            title_ru     TEXT NOT NULL DEFAULT '',
            title_en     TEXT NOT NULL DEFAULT '',
            body_ru      LONGTEXT NOT NULL DEFAULT '',
            body_en      LONGTEXT NOT NULL DEFAULT '',
            status       ENUM('published','draft') NOT NULL DEFAULT 'published',
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug),
            INDEX idx_status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '004_create_news' => "
        CREATE TABLE IF NOT EXISTS news (
            id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug         VARCHAR(255) NOT NULL UNIQUE,
            title_ru     VARCHAR(500) NOT NULL DEFAULT '',
            title_en     VARCHAR(500) NOT NULL DEFAULT '',
            excerpt_ru   TEXT NOT NULL DEFAULT '',
            excerpt_en   TEXT NOT NULL DEFAULT '',
            body_ru      LONGTEXT NOT NULL DEFAULT '',
            body_en      LONGTEXT NOT NULL DEFAULT '',
            image        VARCHAR(500) NOT NULL DEFAULT '',
            category     VARCHAR(255) NOT NULL DEFAULT '',
            status       ENUM('published','draft') NOT NULL DEFAULT 'published',
            published_at DATETIME NULL,
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug),
            INDEX idx_status_date (status, published_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '005_create_blog_posts' => "
        CREATE TABLE IF NOT EXISTS blog_posts (
            id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug         VARCHAR(255) NOT NULL UNIQUE,
            title_ru     VARCHAR(500) NOT NULL DEFAULT '',
            title_en     VARCHAR(500) NOT NULL DEFAULT '',
            excerpt_ru   TEXT NOT NULL DEFAULT '',
            excerpt_en   TEXT NOT NULL DEFAULT '',
            body_ru      LONGTEXT NOT NULL DEFAULT '',
            body_en      LONGTEXT NOT NULL DEFAULT '',
            image        VARCHAR(500) NOT NULL DEFAULT '',
            status       ENUM('published','draft') NOT NULL DEFAULT 'published',
            published_at DATETIME NULL,
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug),
            INDEX idx_status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '006_create_room_categories' => "
        CREATE TABLE IF NOT EXISTS room_categories (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug        VARCHAR(255) NOT NULL UNIQUE,
            name_ru     VARCHAR(255) NOT NULL DEFAULT '',
            name_en     VARCHAR(255) NOT NULL DEFAULT '',
            sort_order  INT UNSIGNED NOT NULL DEFAULT 0,
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '007_create_rooms' => "
        CREATE TABLE IF NOT EXISTS rooms (
            id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug           VARCHAR(255) NOT NULL UNIQUE,
            name_ru        VARCHAR(500) NOT NULL DEFAULT '',
            name_en        VARCHAR(500) NOT NULL DEFAULT '',
            description_ru LONGTEXT NOT NULL DEFAULT '',
            description_en LONGTEXT NOT NULL DEFAULT '',
            features_ru    LONGTEXT NOT NULL DEFAULT '',
            features_en    LONGTEXT NOT NULL DEFAULT '',
            image          VARCHAR(500) NOT NULL DEFAULT '',
            price_from     DECIMAL(10,2) NULL,
            category_id    INT UNSIGNED NULL,
            status         ENUM('active','inactive') NOT NULL DEFAULT 'active',
            sort_order     INT UNSIGNED NOT NULL DEFAULT 0,
            created_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug),
            INDEX idx_status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '008_create_services' => "
        CREATE TABLE IF NOT EXISTS services (
            id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug           VARCHAR(255) NOT NULL UNIQUE,
            name_ru        VARCHAR(500) NOT NULL DEFAULT '',
            name_en        VARCHAR(500) NOT NULL DEFAULT '',
            description_ru LONGTEXT NOT NULL DEFAULT '',
            description_en LONGTEXT NOT NULL DEFAULT '',
            body_ru        LONGTEXT NOT NULL DEFAULT '',
            body_en        LONGTEXT NOT NULL DEFAULT '',
            image          VARCHAR(500) NOT NULL DEFAULT '',
            status         ENUM('active','inactive') NOT NULL DEFAULT 'active',
            sort_order     INT UNSIGNED NOT NULL DEFAULT 0,
            created_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '009_create_events' => "
        CREATE TABLE IF NOT EXISTS events (
            id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug         VARCHAR(255) NOT NULL UNIQUE,
            title_ru     VARCHAR(500) NOT NULL DEFAULT '',
            title_en     VARCHAR(500) NOT NULL DEFAULT '',
            excerpt_ru   TEXT NOT NULL DEFAULT '',
            excerpt_en   TEXT NOT NULL DEFAULT '',
            body_ru      LONGTEXT NOT NULL DEFAULT '',
            body_en      LONGTEXT NOT NULL DEFAULT '',
            image        VARCHAR(500) NOT NULL DEFAULT '',
            event_date   DATETIME NULL,
            status       ENUM('published','draft') NOT NULL DEFAULT 'published',
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '010_create_auctions' => "
        CREATE TABLE IF NOT EXISTS auctions (
            id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug         VARCHAR(255) NOT NULL UNIQUE,
            title_ru     VARCHAR(500) NOT NULL DEFAULT '',
            title_en     VARCHAR(500) NOT NULL DEFAULT '',
            excerpt_ru   TEXT NOT NULL DEFAULT '',
            excerpt_en   TEXT NOT NULL DEFAULT '',
            body_ru      LONGTEXT NOT NULL DEFAULT '',
            body_en      LONGTEXT NOT NULL DEFAULT '',
            image        VARCHAR(500) NOT NULL DEFAULT '',
            price        VARCHAR(255) NOT NULL DEFAULT '',
            auction_date DATETIME NULL,
            status       ENUM('published','draft') NOT NULL DEFAULT 'published',
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '011_create_sanatoriums' => "
        CREATE TABLE IF NOT EXISTS sanatoriums (
            id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            slug           VARCHAR(255) NOT NULL UNIQUE,
            name_ru        VARCHAR(500) NOT NULL DEFAULT '',
            name_en        VARCHAR(500) NOT NULL DEFAULT '',
            description_ru LONGTEXT NOT NULL DEFAULT '',
            description_en LONGTEXT NOT NULL DEFAULT '',
            body_ru        LONGTEXT NOT NULL DEFAULT '',
            body_en        LONGTEXT NOT NULL DEFAULT '',
            image          VARCHAR(500) NOT NULL DEFAULT '',
            status         ENUM('active','inactive') NOT NULL DEFAULT 'active',
            sort_order     INT UNSIGNED NOT NULL DEFAULT 0,
            created_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '012_create_gallery' => "
        CREATE TABLE IF NOT EXISTS gallery (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title_ru    VARCHAR(500) NOT NULL DEFAULT '',
            title_en    VARCHAR(500) NOT NULL DEFAULT '',
            image       VARCHAR(500) NOT NULL DEFAULT '',
            status      ENUM('active','inactive') NOT NULL DEFAULT 'active',
            sort_order  INT UNSIGNED NOT NULL DEFAULT 0,
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '013_create_reviews' => "
        CREATE TABLE IF NOT EXISTS reviews (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            author      VARCHAR(255) NOT NULL DEFAULT '',
            rating      TINYINT UNSIGNED NOT NULL DEFAULT 5,
            text        TEXT NOT NULL DEFAULT '',
            status      ENUM('approved','pending','rejected') NOT NULL DEFAULT 'pending',
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '014_create_seo_templates' => "
        CREATE TABLE IF NOT EXISTS seo_templates (
            id                   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            entity_type          VARCHAR(100) NOT NULL,
            locale               VARCHAR(10) NOT NULL DEFAULT 'ru',
            title_template       TEXT NOT NULL DEFAULT '',
            description_template TEXT NOT NULL DEFAULT '',
            robots               VARCHAR(50) NOT NULL DEFAULT 'index, follow',
            og_type              VARCHAR(50) NOT NULL DEFAULT 'article',
            created_at           DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at           DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY uq_type_locale (entity_type, locale)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '015_create_seo_overrides' => "
        CREATE TABLE IF NOT EXISTS seo_overrides (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            entity_type VARCHAR(100) NOT NULL,
            entity_id   INT UNSIGNED NOT NULL,
            locale      VARCHAR(10) NOT NULL DEFAULT 'ru',
            title       TEXT NOT NULL DEFAULT '',
            description TEXT NOT NULL DEFAULT '',
            robots      VARCHAR(50) NOT NULL DEFAULT 'index, follow',
            og_image    VARCHAR(500) NOT NULL DEFAULT '',
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY uq_entity_locale (entity_type, entity_id, locale)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '016_create_seo_routes' => "
        CREATE TABLE IF NOT EXISTS seo_routes (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            route       VARCHAR(255) NOT NULL,
            locale      VARCHAR(10) NOT NULL DEFAULT 'ru',
            title       TEXT NOT NULL DEFAULT '',
            description TEXT NOT NULL DEFAULT '',
            robots      VARCHAR(50) NOT NULL DEFAULT 'index, follow',
            og_image    VARCHAR(500) NOT NULL DEFAULT '',
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY uq_route_locale (route, locale)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",

    '017_create_migrations_table' => "
        CREATE TABLE IF NOT EXISTS migrations (
            id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            migration  VARCHAR(255) NOT NULL UNIQUE,
            ran_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ",
];
