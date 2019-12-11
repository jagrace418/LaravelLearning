<div class="card flex flex-col mt-3">
	<h3 class="font-normal text-black text-xl py-3 -ml-5 mb-3 border-solid border-l-4 border-black pl-3">
		<a href="{{ $project->path() }}" class="text-black no-underline"> {{ $project->title }}</a>
	</h3>

	<div class="text-grey flex-1">
		{{Str::limit($project->description, 100)}}
	</div>

	<footer>
		<form method="POST" action="{{$project->path() . '/invitations'}}" class="text-right">
			@csrf
			<div class="mb-3">
				<input type="email" name="email" placeholder="Email Address"
					   class="bg-card border border-grey rounded w-full py-2 px-2">
			</div>
			<button type="submit" class="button">Invite</button>

			@include('errors', ['bag' => 'invitations'])

		</form>
	</footer>
</div>