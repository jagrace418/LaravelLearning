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

	<modal name="hello-modal" classes="p-10 bg-card rounded-lg" height="auto">
		<h1 class="font-normal text-2xl mb-16 text-center">Let's Start Something New</h1>
		<div class="flex">
			{{--            left side--}}
			<div class="flex-1 mr-4">
				<div class="mb-4">
					<label for="title" class="text-sm block mb-2">Title</label>
					<input type="text" id="title"
						   class="border py-1 px-2 text-xs block rounded w-full">
				</div>
				<div class="mb-4">
					<label for="description"
						   class="text-sm block mb-2">Description</label>
					<textarea id="description" rows="7"
							  class="border py-1 px-2 text-xs block w-full rounded"></textarea>
				</div>
			</div>
			{{--            right side--}}
			<div class="flex-1 mr-4">
				<div class="mb-4">
					<label for="tasks"
						   class="text-sm block mb-2 w-full">Need Some Tasks?</label>
					<input type="text" id="tasks" placeholder="Task"
						   class="border py-1 px-2 text-xs block rounded">
				</div>

				<button class="inline-flex items-center button text-xs">
					<span>Add New Task Field</span>
				</button>
			</div>
		</div>

		<footer class="flex justify-end">
			<button class="button mr-2 is-outlined">Cancel</button>
			<button class="button">Create Project</button>
		</footer>
	</modal>

	<a href="" @click.prevent="$modal.show('hello-modal')">show modal</a>
@endsection
