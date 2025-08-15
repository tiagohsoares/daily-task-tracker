<?php

namespace App\Enums;

enum TaskStatus: string
{
    case pending = 'PENDING';
    case in_progress = 'IN PROGRESS';
    case completed = 'COMPLETED';

 public function view(){
    return match ($this) {
        self::pending => 'components.pending',
        self::in_progress => 'components.in_progress',
        self::completed => 'components.completed',
    };
}
}