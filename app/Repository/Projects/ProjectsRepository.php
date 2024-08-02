<?php

namespace App\Repository\Projects;


use App\Models\Project;
use App\Repository\BaseRepository;

class ProjectsRepository extends BaseRepository
{
    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    public function getProjects()
    {
        $projects = $this->model::all();

        return $projects;
    }
}
