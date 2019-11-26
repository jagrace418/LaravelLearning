@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto">
		<h2 class="text-center">Edit Project</h2>
		<form method="POST" action="{{$project->path()}}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
			@method('PATCH')
			@include('projects.form',[
			'buttonText' => 'Update Project'])
		</form>
	</div>
@endsection
