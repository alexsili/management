@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="col-4 form-group text-lg-start text-center">
                <label for="project">Project Name</label>
                <div class="input-group">
                    <select class="form-select" name="project" id="project">
                        <option value="*">Choose project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->name }}"
                                    @if(\Request::get('project') == $project->name) selected @endif>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-8 text-lg-end text-center">
                <a href="{{ route('task.create') }}" class="btn btn-info">New Task</a>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-12">
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! $message !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="ajax-response">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="ajax-message"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">{{__('ID')}}</th>
                        <th class="text-center" scope="col">{{__('Name')}}</th>
                        <th class="text-center" scope="col">{{__('Project Name')}}</th>
                        <th class="text-center" scope="col">{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody id="sortableTasks">
                    @forelse($tasks as $task)
                        <tr class="sortableTasksPriority" id="{{ $task->id }}">
                            <td class="text-center">{{ $task->id }}</td>
                            <td class="text-center">{{ $task->name }}</td>
                            <td class="text-center">{{ $task->project->name }}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-warning mx-2" href="{{ route('task.edit', $task) }}">
                                    <i class="fa-solid fa-pen-to-square" title="Edit Task"></i>
                                </a>
                                <i class="fa-solid fa-bars mx-2 change-task-priority" title="Change priority"></i>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4"> No tasks found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .change-task-priority {
            cursor: all-scroll;
        }

        .ajax-response {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {

            $('#sortableTasks').sortable({

                update: function (event, ui) {

                    let token = $('meta[name="csrf-token"]').attr('content');
                    let tasks = [];
                    let projects = [];

                    $('#sortableTasks .sortableTasksPriority').each(function () {
                        tasks.push($(this).attr('id'));
                    });

                    $.ajax({
                        async: false,
                        url: '/reorder-tasks',
                        type: 'POST',
                        data: {
                            _token: token,
                            tasks: tasks,
                        },
                        success: function (response) {
                            $('.ajax-response').show();
                            $('.ajax-message').html(response.message);
                            $('.ajax-response').delay(2000).hide(1);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }
                    });
                }
            });

            $('#project').on('change', function () {
                if (this.value === '*') {
                    window.location = '/';
                } else {
                    window.location = '/?project=' + this.value;
                }
            });
        });
    </script>
@endpush
