<?php

namespace App\Contracts;

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
}
