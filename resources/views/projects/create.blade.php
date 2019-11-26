@extends('layouts.app')

@section('content')
	<div class="w-full max-w-xs content-center mx-auto">
		<form method="POST" action="/projects" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
			<h2 class="text-center">Create a project</h2>
			@csrf
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="title">
					Title
				</label>

				<input type="text"
					   class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					   name="title" placeholder="title">

			</div>

			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="description">
					Description
				</label>

				<textarea name="description"
						  class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>

			</div>

			<button class="button is-link">Submit</button>
			<a href="/projects">Cancel</a>
		</form>
	</div>
@endsection
