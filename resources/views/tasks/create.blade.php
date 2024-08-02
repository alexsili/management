@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('task.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6 offset-3 form-group text-lg-start text-center py-3">
                        <label for="project">Task Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" placeholder="Task Name">
                            @error('name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6 offset-3 form-group text-lg-start text-center py-3">
                        <label for="project">Project Name</label>
                        <div class="input-group">
                            <select class="form-select @error('project') is-invalid @enderror" name="project"
                                    id="project">
                                <option value="*">Choose project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6 offset-3 text-lg-start text-center py-3">
                        <button type="submit" class="btn btn-info">Save Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
