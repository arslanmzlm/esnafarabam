<?php

namespace App\Enums;

enum BannerField: int
{
    case HOME_SLIDER = 1;
    case ITEM_DETAIL_SIDEBAR = 2;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.banner.field.{$case->name}"),
                'value' => $case->value
            ];
        }, self::cases());
    }
}
