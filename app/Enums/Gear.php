<?php

namespace App\Enums;

enum Gear: int
{
    case MANUAL = 1;
    case AUTOMATIC = 2;
    case SEMI_AUTOMATIC = 3;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.gear.{$case->name}"),
                'value' => $case->value
            ];
        }, self::cases());
    }
}
