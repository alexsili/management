<?php

namespace App\Repository\Tasks;

use App\Models\Task;
use App\Repository\BaseRepository;

class TasksRepository extends BaseRepository
{
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function getTasks($projectName)
    {
        return $this->model::query()
            ->when($projectName, function ($query) use ($projectName) {
                $query->whereHas('project', fn($query) => $query->where('name', $projectName));
            })
            ->orderBy('priority', 'asc')
            ->get();
    }

    public function getMaxPriorityNumber()
    {
        return $this->model::query()
            ->max('priority');
    }
}
