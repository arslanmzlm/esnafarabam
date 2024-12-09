<?php

namespace App\Enums;

enum PhotoState: int
{
    case UPLOADED = 1;
    case APPROVED = 2;
    case REJECTED = 3;
}
