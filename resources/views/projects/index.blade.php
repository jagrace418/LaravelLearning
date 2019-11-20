<?php /** @var \App\Project[]|\Illuminate\Database\Eloquent\Collection $projects */ ?>
@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3">
        <div class="flex justify-between w-full items-center">
            <h2 class="text-grey text-sm font-normal">My Projects</h2>

            <a href="/projects/create" class="button">Create Project</a>
        </div>
    </header>


    <main class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-1/4 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>
                No projects yet.
            </div>
        @endforelse
    </main>
@endsection
