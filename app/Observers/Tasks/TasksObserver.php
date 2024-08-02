<?php

namespace App\Observers\Tasks;

use App\Models\Task;

class TasksObserver
{
    /**
     * @param Task $task
     * @return void
     */
    public function deleted(Task $task): void
    {
        $priorityTasks = Task::query()
            ->where('project_id', $task->project_id)
            ->where('priority', '>', $task->priority)
            ->get();

        foreach ($priorityTasks as $priorityTask) {
            $priorityTask->priority--;
            $priorityTask->save();
        }
    }
}
