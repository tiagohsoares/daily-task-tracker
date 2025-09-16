<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

final class PayloadService
{
    protected array $payload = [];
    public function __construct($payload)
    {
        if (empty($payload['user_id'])) {
            $payload['user_id'] = auth()->id();
        }

        $this->payload = $payload;
    }
    public function update(Model $model): void
    {
        $model->query()->update($this->payload);
    }
    public function delete(Model $model): void
    {
        $model->query()->destroy($this->payload);
    }
    public function create(Model $model): void
    {
        $model->query()->create($this->payload);
    }
}
