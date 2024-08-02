<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\TasksRequest;
use App\Models\Task;
use App\Repository\Projects\ProjectsRepository;
use App\Repository\Tasks\TasksRepository;
use App\Services\Tasks\TasksService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @param TasksRepository $tasksRepository
     */
    public function __construct(
        protected TasksRepository    $tasksRepository,
        protected ProjectsRepository $projectsRepository,
    )
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $tasks = $this->tasksRepository->getTasks($request->get('project'));
        $projects = $this->projectsRepository->getProjects();

        return view('tasks.index')
            ->with('tasks', $tasks)
            ->with('projects', $projects);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $projects = $this->projectsRepository->getProjects();

        return view('tasks.create')->with('projects', $projects);;
    }

    /**
     * @param TasksRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TasksRequest $request)
    {
        $taskPriorityNumber = $this->tasksRepository->getMaxPriorityNumber();

        resolve(TasksService::class)->store($request->getTaskData($taskPriorityNumber));

        return redirect()->route('task.index')->with('success', 'Task added successfully');
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Task $task)
    {
        $projects = $this->projectsRepository->getProjects();
        return view('tasks.edit')
            ->with('projects', $projects)
            ->with('task', $task);
    }

    /**
     * @param Task $task
     * @param TasksRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, TasksRequest $request)
    {
        resolve(TasksService::class)->update($task, $request->getTaskData($task->priority));

        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Task $task)
    {
        resolve(TasksService::class)->delete($task);

        return redirect()->route('task.index')->with('success', 'Task deleted successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxReorderTasks(Request $request)
    {
        $tasks = $request->get('tasks');

        if ($tasks) {
            $reorderNumber = 1;
            foreach ($tasks as $taskId) {
                $task = Task::find($taskId);
                $task->priority = $reorderNumber;
                $task->save();
                $reorderNumber++;
            }
            return response()->json([
                'message' => 'Tasks updated successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Updating tasks failed'
        ]);
    }
}
