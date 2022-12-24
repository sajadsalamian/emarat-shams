@extends('common.master')
@section('backRoute', route('main'))
@section('pageTitle', 'همه پروژه ها')

@section('content')
    <div class="notif-list">
        <div class="main-pad">
            @if (auth()->user()->role == 0)
                <a href="{{ route('Project.add') }}" class="btn btn-primary">افزودن پروژه</a>
            @endif
            <div class="items mt-4">
                @foreach ($projects as $project)
                    <a href="{{ route('Project.id', $project->id) }}">
                        <div class="item">
                            <iconify-icon icon="clarity:building-line" width="36" height="36"></iconify-icon>
                            <p class="mb-0 fw-bold">{{ $project->title }}</p>
                            <p class="desc mb-0">{{ $project->address }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
