<?php

namespace App\Enums;

enum FileStatus : string
{
    case PENDING = 'Pending';
    case PROCESSING = 'Processing';
    case FAILED = 'Failed';
    case COMPLETED = 'Completed';

    public function label(): string
    {
        return $this->value;
    }
}

