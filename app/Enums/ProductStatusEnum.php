<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum ProductStatusEnum: string
{
    use BaseEnum;

    case PENDING = "pending";
    case APPROVE = "approve";
    case CANCEL = "cancel";
}
