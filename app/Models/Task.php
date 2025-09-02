<?php

namespace App\Models;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'frequency',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'status'    => TaskStatus::class,
        'frequency' => TaskFrequency::class,
        'due_date'  => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
