<?php

namespace App\Console\Commands;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Console\Command;

class generateRecurringTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-recurring-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = today();

        $tasks = Task::where('due_date', '<', $today)->get();

        foreach ($tasks as $task) {
            switch ($task->frequency) {
                case TaskFrequency::daily
                :
                    Task::update(['due_date' => $today->copy()->addDay()]);
                case TaskFrequency::weekly
                :
                    Task::update(['due_date' => $today->copy()->addDays(7)]);
                case TaskFrequency::monthly
                :
                    Task::update(['due_date' => $today->copy()->subMonth()]);
            }
            Task::update(['status'=> TaskStatus::pending]);
        }
        $this->info("Tarefas recorrentes atualizadas");
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }
}
