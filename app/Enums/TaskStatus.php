<?php

namespace App\Enums;

enum TaskStatus: string
{
    case pending = 'PENDING';
    case in_progress = 'IN_PROGRESS';
    case completed = 'COMPLETED';
}
