<?php /** @var \App\Project $project */ ?>
@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3">
        <div class="flex justify-between w-full items-center">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a>
                / {{ $project->title }}
            </p>

            <a href="/projects/create" class="button">Create Project</a>
        </div>
    </header>
    <main>
        <div class="flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="text-grey font-normal text-lg mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">{{ $task->body }}</div>
                    @endforeach
                    {{--                Tasks--}}
                </div>
                <div>
                    <h2 class="text-grey font-normal text-lg mb-3">General Notes</h2>
                    {{--                Notes--}}
                    <textarea class="card w-5/6" style="min-height: 150px">Card stuff</textarea>
                </div>

            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>

@endsection
