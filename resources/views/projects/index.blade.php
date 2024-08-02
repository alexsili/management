@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-lg-end text-center">
                <a href="{{ route('project.create') }}" class="btn btn-info">New Project</a>
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
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">{{__('ID')}}</th>
                        <th class="text-center" scope="col">{{__('Name')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td class="text-center">{{ $project->id }}</td>
                            <td class="text-center">{{ $project->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="2"> No projects found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
