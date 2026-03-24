<?php
declare(strict_types=1);

// Seeds: create default admin, basic pages, SEO templates, settings

return function(\App\Core\Database $db): void {

    // 1. Admin user
    $admin = $db::fetchOne('SELECT id FROM users WHERE username = ?', ['admin']);
    if (!$admin) {
        $db::insert('users', [
            'username'   => 'admin',
            'email'      => 'admin@kurnal.ru',
            'password'   => password_hash('Admin123!', PASSWORD_BCRYPT),
            'name'       => 'Администратор',
            'role'       => 'admin',
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        echo "✓ Admin user created (login: admin / password: Admin123!)\n";
    } else {
        echo "  Admin user already exists\n";
    }

    // 2. Settings
    $defaultSettings = [
        'site_name'              => 'Курорт Нальчик',
        'site_email'             => 'info@kurnal.ru',
        'site_phone'             => '+7 928 000 00 11',
        'site_address'           => 'г. Нальчик, ул. Шогенцукова, 5а',
        'default_description_ru' => 'Курорт Нальчик — место отдыха и оздоровления у подножия Кавказских гор.',
        'default_description_en' => 'Kurort Nalchik — a resort at the foot of the Caucasian mountains.',
        'og_image'               => '',
        'google_analytics'       => '',
        'robots_txt'             => "User-agent: *\nAllow: /\n\nSitemap: /sitemap.xml",
    ];
    foreach ($defaultSettings as $key => $value) {
        $existing = $db::fetchOne('SELECT id FROM settings WHERE `key` = ?', [$key]);
        if (!$existing) {
            $db::insert('settings', [
                'key'        => $key,
                'value'      => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
    echo "✓ Default settings created\n";

    // 3. Default pages
    $pages = [
        ['slug' => 'about',           'title_ru' => 'О нас',                          'title_en' => 'About Us'],
        ['slug' => 'faq',             'title_ru' => 'Часто задаваемые вопросы',       'title_en' => 'FAQ'],
        ['slug' => 'documents',       'title_ru' => 'Документы',                      'title_en' => 'Documents'],
        ['slug' => 'privacy-policy',  'title_ru' => 'Политика конфиденциальности',    'title_en' => 'Privacy Policy'],
        ['slug' => 'agreement',       'title_ru' => 'Правила обработки персональных данных', 'title_en' => 'Data Processing Rules'],
        ['slug' => 'html-map',        'title_ru' => 'Карта сайта',                    'title_en' => 'Site Map'],
    ];
    foreach ($pages as $pageData) {
        $existing = $db::fetchOne('SELECT id FROM pages WHERE slug = ?', [$pageData['slug']]);
        if (!$existing) {
            $db::insert('pages', array_merge($pageData, [
                'body_ru'    => '<p>' . $pageData['title_ru'] . '</p>',
                'body_en'    => '<p>' . $pageData['title_en'] . '</p>',
                'status'     => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]));
        }
    }
    echo "✓ Default pages created\n";

    // 4. SEO templates
    $entityTypes = ['news', 'blog', 'room', 'service', 'event', 'auction', 'sanatorium', 'page'];
    $locales     = ['ru', 'en'];
    $templates   = [
        'ru' => [
            'news'       => ['{{title}} — Новости — {{site_name}}', '{{excerpt}}'],
            'blog'       => ['{{title}} — Блог — {{site_name}}', '{{excerpt}}'],
            'room'       => ['{{name}} — Номер — {{site_name}}', '{{name}}. Цена от {{price_from}} ₽.'],
            'service'    => ['{{name}} — Услуги — {{site_name}}', '{{name}} в {{site_name}}.'],
            'event'      => ['{{title}} — События — {{site_name}}', '{{excerpt}}'],
            'auction'    => ['{{title}} — Закупки — {{site_name}}', '{{excerpt}}'],
            'sanatorium' => ['{{name}} — Санатории — {{site_name}}', '{{name}}.'],
            'page'       => ['{{title}} — {{site_name}}', ''],
        ],
        'en' => [
            'news'       => ['{{title}} — News — {{site_name}}', '{{excerpt}}'],
            'blog'       => ['{{title}} — Blog — {{site_name}}', '{{excerpt}}'],
            'room'       => ['{{name}} — Room — {{site_name}}', '{{name}}. Price from {{price_from}} RUB.'],
            'service'    => ['{{name}} — Services — {{site_name}}', '{{name}} at {{site_name}}.'],
            'event'      => ['{{title}} — Events — {{site_name}}', '{{excerpt}}'],
            'auction'    => ['{{title}} — Procurement — {{site_name}}', '{{excerpt}}'],
            'sanatorium' => ['{{name}} — Sanatoriums — {{site_name}}', '{{name}}.'],
            'page'       => ['{{title}} — {{site_name}}', ''],
        ],
    ];

    foreach ($locales as $locale) {
        foreach ($entityTypes as $type) {
            $tpl = $templates[$locale][$type] ?? ['{{title}} — {{site_name}}', ''];
            $existing = $db::fetchOne('SELECT id FROM seo_templates WHERE entity_type = ? AND locale = ?', [$type, $locale]);
            if (!$existing) {
                $db::insert('seo_templates', [
                    'entity_type'          => $type,
                    'locale'               => $locale,
                    'title_template'       => $tpl[0],
                    'description_template' => $tpl[1],
                    'robots'               => 'index, follow',
                    'og_type'              => 'article',
                    'created_at'           => date('Y-m-d H:i:s'),
                    'updated_at'           => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
    echo "✓ SEO templates created\n";

    // 5. Sample news
    $newsExisting = $db::fetchValue('SELECT COUNT(*) FROM news');
    if (!$newsExisting) {
        $db::insert('news', [
            'slug'         => 'pervaya-novost',
            'title_ru'     => 'Открытие нового сезона',
            'title_en'     => 'New Season Opening',
            'excerpt_ru'   => 'Приглашаем вас посетить наш курорт в новом сезоне.',
            'excerpt_en'   => 'We invite you to visit our resort in the new season.',
            'body_ru'      => '<p>Уважаемые гости! Рады сообщить об открытии нового сезона. Ждём вас!</p>',
            'body_en'      => '<p>Dear guests! We are pleased to announce the opening of the new season. We look forward to seeing you!</p>',
            'image'        => '',
            'category'     => 'Объявления',
            'status'       => 'published',
            'published_at' => date('Y-m-d H:i:s'),
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);
        echo "✓ Sample news created\n";
    }
};
