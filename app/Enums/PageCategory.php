<?php

namespace App\Enums;

enum PageCategory: int
{
    case COMMERCIAL = 1;
    case SERVICE = 2;
    case PRIVACY = 3;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.page.category.{$case->name}"),
                'value' => $case->value
            ];
        }, self::cases());
    }
}
