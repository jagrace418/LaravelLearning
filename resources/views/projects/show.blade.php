<?php /** @var \App\Project $project */ ?>
@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3">
		<div class="flex justify-between w-full items-center">
			<p class="text-default text-sm font-normal">
				<a href="/projects" class="text-default text-sm font-normal no-underline">My Projects</a>
				/ {{ $project->title }}
			</p>
			<div class="flex items-center">
				@foreach($project->members as $member)
					<img
							src="{{gravatar_url($member->email)}}"
							alt="{{$member->name}}'s avatar"
							class="rounded-full w-8 mr-2">
				@endforeach
				<a href="{{$project->path() . '/edit'}}" class="button ml-4">Edit Project</a>
			</div>
		</div>
	</header>
	<main>
		<div class="flex">
			<div class="flex-auto -mx-3">
				<h2 class="text-default font-normal text-lg mb-3">Tasks</h2>
				@foreach($project->tasks as $task)
					<div class="card mb-3">
						<form action="{{$task->path()}}" method="post">
							@method('PATCH')
							@csrf
							<div class="flex">
								<input name="body" value="{{$task->body}}"
									   class="w-full {{$task->completed ? 'text-grey' : ''}}
											   shadow appearance-none border rounded w-full text-default leading-tight focus:outline-none focus:shadow-outline">
								<input type="checkbox" name="completed"
									   onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
							</div>
						</form>
					</div>
				@endforeach
				<div class="card mb-3">
					<form action="{{$project->path() . '/tasks' }}" method="POST">
						@csrf
						<input placeholder="Add new task"
							   class="bg-card shadow appearance-none border rounded w-full leading-tight focus:outline-none focus:shadow-outline"
							   name="body">
					</form>
				</div>
			</div>


			<div class="flex-auto mx-6">
				<h2 class="text-default font-normal text-lg mb-3">General Notes</h2>
				{{--                Notes--}}
				<form action="{{$project->path()}}" method="POST">
					@csrf
					@method('PATCH')

					<textarea class="bg-card card w-5/6" style="min-height: 150px"
							  name="notes"
							  placeholder="What would you like to make a note of?">
                            {{$project->notes}}
                        </textarea>

					<button type="submit" class="button">Save</button>
				</form>

				@include('errors')

			</div>
			<div class="flex-auto -mx-8">
				@include('projects.card')
				@include('projects.activity.card')

				@can('manage', $project)
					@include('projects.invite')
				@endcan
			</div>
		</div>
	</main>
@endsection
