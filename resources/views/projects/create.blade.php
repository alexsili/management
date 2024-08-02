@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('project.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6 offset-3 py-3 text-lg-start text-center">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Project Name">
                        @error('name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6 offset-3 text-lg-start text-center">
                       <button type="submit" class="btn btn-info">Save Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
