<?php

namespace App\Enums;

enum TaskStatus: string
{
    case pending = 'pending';
    case in_progress = 'in_progress';
    case completed = 'completed';

 public function view(){
    return match ($this) {
        self::pending => 'components.pending',
        self::in_progress => 'components.in-progress',
        self::completed => 'components.completed',
    };
}
}