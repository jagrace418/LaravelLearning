@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto
			bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
		<h2 class="text-center">Create a project</h2>
		<form method="POST" action="/projects">
			@include('projects.form', [
			'project' => new \App\Project(),
			'buttonText' => 'Create Project'])
		</form>
	</div>
@endsection
