@if($errors->{ $bag ?? 'default' }->any())
	<ul class="mt-3 list-reset">
		@foreach($errors->{ $bag ?? 'default' }->all() as $error)
			<li class="text-red-light">{{$error}}</li>
		@endforeach
	</ul>
@endif