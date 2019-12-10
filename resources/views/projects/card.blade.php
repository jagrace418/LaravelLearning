<div class="card flex flex-col" style="height: 200px">
	<h3 class="font-normal text-black text-xl py-3 -ml-5 mb-3 border-solid border-l-4 border-black pl-3">
		<a href="{{ $project->path() }}" class="text-black no-underline"> {{ $project->title }}</a>
	</h3>

	<div class="text-grey flex-1">
		{{Str::limit($project->description, 100)}}
	</div>

	<footer>
		<form method="POST" action="{{$project->path()}}" class="text-right">
			@method('DELETE')
			@csrf
			<button type="submit" class="button text-xs">Delete</button>
		</form>
	</footer>
</div>
