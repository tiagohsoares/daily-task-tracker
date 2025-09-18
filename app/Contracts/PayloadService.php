<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

final class PayloadService
{
    protected array $payload = [];
    public function __construct($payload)
    {
        $this->payload = $payload;
    }
    public function update(Model $model): void
    {
        $model->query()->find($model->id)->update($this->payload);
    }
    public function delete(Model $model): void
    {
        $model->query()->find($model->id)->destroy($this->payload);
    }
    public function create(Model $model): void
    {
        $model->query()->create($this->payload);
    }
}
