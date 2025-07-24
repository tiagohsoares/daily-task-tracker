<?php

namespace App\Contracts;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;

readonly class TaskContractService implements TaskService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public DatabaseManager $db)
    {
        //
    }
    public function findTask(int $taskId): array {
        return [
            'id' => $taskId,
            'category_id' => 2,
            'title' => 'nemo',
            'description' => 'at atsu latem',
            'status' => 'pending',
            'frequency' => 'monthly',
            'due_date' => '2025-08-02 10:15:03'
        ];
    }

    public function getAll(int $taskId){
        return $this->db->find($taskId);
    }
    public function create(int $taskId, string $title , string $description, string $status, string $frequency, ?Carbon $dueDate){
        $this->db->insert('INSERT INTO tasks (title, description, status, frequency, due_date) VALUES (?,?,?,?,?)', [$title, $description, $status, $frequency, $dueDate ]);
    }
    public function update(int $taskId){
    }
    public function destroy(int $taskId){
    }
}
