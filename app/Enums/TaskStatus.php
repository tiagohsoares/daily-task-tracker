<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case In_progress = 'in_progress';
    case Completed = 'completed';
}
