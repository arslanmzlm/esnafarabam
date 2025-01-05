<?php

return [
    'step' => [
        'type' => [
            'YEAR' => 'Yıl > Marka > Seri > Model > Alt Model',
            'BRAND' => 'Marka > Model',
        ],
    ],
    'attribute' => [
        'type' => [
            'VEHICLE' => 'Taşıt',
            'ITEM' => 'İlan',
            'BOTH' => 'Hem İlan Hem Taşıt',
        ],
        'input' => [
            'TEXT' => 'Yazı',
            'NUMBER' => 'Sayı',
            'DATE' => 'Tarih',
            'SELECT' => 'Seçenek Kutusu',
            'RADIO' => 'Seçenekler',
            'CHECKBOX' => 'Çoklu Seçenek',
        ]
    ],
    'gear' => [
        'MANUAL' => 'Düz',
        'AUTOMATIC' => 'Otomatik',
        'SEMI_AUTOMATIC' => 'Yarı Otomatik',
    ],
    'fuel' => [
        'PETROL' => 'Benzin',
        'LPG' => 'LPG',
        'DIESEL' => 'Dizel',
        'ELECTRIC' => 'Elektrik',
        'HYBRID' => 'Hibrit',
    ],
    'item' => [
        'state' => [
            'DRAFT' => 'Taslak',
            'PENDING' => 'Beklemede',
            'REJECTED' => 'Reddedildi',
            'APPROVED' => 'Onaylandı',
            'PUBLISHED' => 'Yayında',
            'SOLD' => 'Satıldı',
            'MODIFIED' => 'Düzenlendi',
            'REMOVED_BY_USER' => 'Kullanıcı Tarafından Kaldırıldı',
            'REMOVED_BY_ADMIN' => 'Yönetici Tarafından Kaldırıldı',
            'OUTDATED' => 'Zaman Aşımına Uğradı',
            'DELETED' => 'Silindi',
        ]
    ],
    'page' => [
        'category' => [
            'COMMERCIAL' => 'Kurumsal',
            'SERVICE' => 'Hizmetler',
            'PRIVACY' => 'Gizlilik',
        ]
    ],
    'banner' => [
        'field' => [
            'HOME_SLIDER' => 'Anasayfa Sliderı'
        ]
    ],
];
