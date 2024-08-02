<?php

namespace App\Services\Tasks;

use App\Models\Task;
use App\Repository\Tasks\TasksRepository;

class TasksService
{
    public function __construct(
        protected TasksRepository $tasksRepository
    )
    {
    }

    public function store(array $taskData)
    {
        $this->tasksRepository->create($taskData);
    }

    public function update(Task $task, $taskData)
    {
        $this->tasksRepository->update($task, $taskData);
    }

    public function delete(Task $task)
    {
        $task->delete();
    }
}
