@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('task.update', $task) }}" method="post">
                @method('patch')
                @csrf
                <div class="row">
                    <div class="col-6 offset-3 form-group text-lg-start text-center py-3">
                        <label for="project">Task Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ $task->name }}" placeholder="Task Name">
                            @error('name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6 offset-3 form-group text-lg-start text-center py-3">
                        <label for="project">Project Name</label>
                        <div class="input-group">
                            <select class="form-select @error('project') is-invalid @enderror" name="project"
                                    id="project">
                                @foreach($projects as $project)
                                    @if($task->project->id == $project->id)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endif
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6 offset-3 text-lg-start text-center py-3">
                        <button type="submit" class="btn btn-info">Update Task</button>
                        <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal"
                                data-bs-target="#taskModal">
                            <i class="fa-solid fa-trash" title="Delete Task"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('task.delete', $task) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Delete task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete this task?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
