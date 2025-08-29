<?php

namespace App\Console\Commands;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use App\Models\Task;
use Carbon\Carbon;
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

        $tasks = Task::where('due_date', '<', today())->get();

        foreach ($tasks as $task) {

            $nextDate = $this->getNextDueDate($task->due_date, $task->frequency);

            if ($nextDate) {
                $task->update([
                    'due_date' => $nextDate,
                    'status'   => TaskStatus::pending,
                ]);
            }
        }

        $this->info('Tarefas recorrentes atualizadas');

        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }

    private function getNextDueDate($lastDueDate, $taskFrequency)
    {
        $date = Carbon::parse($lastDueDate);
        switch ($taskFrequency) {
            case TaskFrequency::daily:
                while ($date->lt(today())) {
                    $date->addDay();
                }
                break;
            case TaskFrequency::weekly:
                while ($date->lt(today())) {
                    $date->addWeek();
                }
                break;
            case TaskFrequency::monthly:
                while ($date->lt(today())) {
                    $date->addMonth();
                }
                break;
        }

        return $date;
    }
}
