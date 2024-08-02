<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\ProjectsRequest;
use App\Repository\Projects\ProjectsRepository;
use App\Services\Projects\ProjectsService;

class ProjectController extends Controller
{
    /**
     * @param  ProjectsRepository  $projectsRepository
     */
    public function __construct(
        protected ProjectsRepository $projectsRepository
    ) {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $projects = $this->projectsRepository->getProjects();

        return view('projects.index')->with('projects', $projects);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * @param  ProjectsRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectsRequest $request)
    {
        resolve(ProjectsService::class)->store($request->getProjectData());

        return redirect()->route('project.index')->with('success', 'Project added successfully');
    }
}
