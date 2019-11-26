@csrf
<div class="mb-4">
	<label class="block text-gray-700 text-sm font-bold mb-2" for="title">
		Title
	</label>

	<input type="text" required
		   class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
		   name="title" placeholder="title" value="{{$project->title}}">

</div>

<div class="mb-4">
	<label class="block text-gray-700 text-sm font-bold mb-2" for="description">
		Description
	</label>

	<textarea name="description" required
			  class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
		{{$project->description}}
	</textarea>

</div>

<button class="button is-link">{{$buttonText}}</button>
<a href="{{$project->path()}}">Cancel</a>

@if($errors->any())
	<div class="mt-3">
		@foreach($errors->all() as $error)
			<li class="text-red-light">{{$error}}</li>
		@endforeach
	</div>
@endif