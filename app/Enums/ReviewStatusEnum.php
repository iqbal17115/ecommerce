<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum ReviewStatusEnum: string
{
    use BaseEnum;

    case APPROVE = "approve";
    case DENY = "deny";
}
