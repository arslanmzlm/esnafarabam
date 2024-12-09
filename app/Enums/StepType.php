<?php

namespace App\Enums;

enum StepType: int
{
    case YEAR = 1;
    case BRAND = 2;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.step.type.{$case->name}"),
                'value' => $case->value,
            ];
        }, self::cases());
    }
}
