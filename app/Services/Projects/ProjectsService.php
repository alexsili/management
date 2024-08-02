<?php

namespace App\Services\Projects;

use App\Repository\Projects\ProjectsRepository;

class ProjectsService
{
    public function __construct(
        protected ProjectsRepository $projectsRepository
    ) {
    }

    public function store(array $projectData)
    {
        $this->projectsRepository->create($projectData);
    }
}
