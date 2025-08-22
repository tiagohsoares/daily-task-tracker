<?php

namespace App\Contracts;

use Carbon\Carbon;

interface TaskService
{
    public function findTask(int $taskId);

    public function getAll(int $taskId);

    public function create(int $taskId, string $title, string $description, string $status, string $frequency, ?Carbon $dueDate);

    public function update(int $taskId);

    public function destroy(int $taskId);
}
