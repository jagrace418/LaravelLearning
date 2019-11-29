<div class="card mt-3">
	<ul>
		@foreach($project->activity as $activity)
			<li class="{{$loop->last ? '' : 'mb-1'}}">
				@include("projects.activity.{$activity->description}")
				<span class="text-grey">{{$activity->created_at->diffforhumans(null, true)}}</span>
			</li>
		@endforeach
	</ul>
</div>