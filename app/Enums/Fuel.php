<?php

namespace App\Enums;

enum Fuel: int
{
    case PETROL = 1;
    case LPG = 2;
    case DIESEL = 3;
    case ELECTRIC = 4;
    case HYBRID = 5;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.fuel.{$case->name}"),
                'value' => $case->value
            ];
        }, self::cases());
    }
}
