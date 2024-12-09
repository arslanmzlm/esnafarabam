<?php

namespace App\Enums;

enum ItemState: int
{
    case DRAFT = 1;
    case PENDING = 2;
    case REJECTED = 3;
    case APPROVED = 4;
    case PUBLISHED = 5;
    case SOLD = 6;
    case MODIFIED = 7;
    case REMOVED_BY_USER = 8;
    case REMOVED_BY_ADMIN = 9;
    case OUTDATED = 10;
    case DELETED = 11;

    public static function getAll(): array
    {
        return array_map(function ($case) {
            return [
                'name' => $case->name,
                'label' => trans("enums.item.state.{$case->name}"),
                'value' => $case->value,
            ];
        }, self::cases());
    }
}
