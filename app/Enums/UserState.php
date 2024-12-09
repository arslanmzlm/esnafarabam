<?php

namespace App\Enums;

enum UserState: int
{
    case PENDING = 1;
    case ACTIVE = 2;
    case CLOSED = 3;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.user.state.{$case->name}"),
                'value' => $case->value,
            ];
        }, self::cases());
    }
}
