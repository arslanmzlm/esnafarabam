<?php

namespace App\Enums;

enum AttributeType: int
{
    case VEHICLE = 1;
    case ITEM = 2;
    case BOTH = 3;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.attribute.type.{$case->name}"),
                'value' => $case->value,
            ];
        }, self::cases());
    }

    public static function getForVehicle(): array
    {
        return [
            self::VEHICLE,
            self::BOTH
        ];
    }

    public static function getForItem(): array
    {
        return [
            self::ITEM,
            self::BOTH
        ];
    }
}
