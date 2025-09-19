<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

final readonly class PayloadService
{
    public function __construct(
        protected array $payload
    ) {
    }

    public function update(Model $model): void
    {
        $model->query()->find(isset($model->id))->update($this->payload);
    }
    public function create(Model $model): void
    {
        $model->query()->create($this->payload);
    }
}
