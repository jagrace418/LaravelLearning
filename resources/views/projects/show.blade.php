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
                        <div class="card mb-3">
                            <form action="{{$task->path()}}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{$task->body}}"
                                           class="w-full {{$task->completed ? 'text-grey' : ''}}">
                                    <input type="checkbox" name="completed"
                                           onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{$project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input placeholder="Add new task" class="w-full" name="body">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-grey font-normal text-lg mb-3">General Notes</h2>
                    {{--                Notes--}}
                    <form action="{{$project->path()}}" method="POST">
                        @csrf
                        @method('PATCH')

                        <textarea class="card w-5/6" style="min-height: 150px"
                                  name="notes"
                                  placeholder="What would you like to make a note of?">
                            {{$project->notes}}
                        </textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                </div>

            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>

@endsection
