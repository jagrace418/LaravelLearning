<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function projectHasTasks () {
		$this->signIn();
		/** @var Project $project */
		$project = auth()->user()->projects()->create(
			factory(Project::class)->raw()
		);
		$this->post($project->path() . '/tasks', ['body' => 'test task']);
		$this->get($project->path())->assertSee('test task');
	}

	/** @test */
	public function taskRequiresBody () {
		$this->signIn();
		/** @var Project $project */
		$project = auth()->user()->projects()->create(
			factory(Project::class)->raw()
		);
		$attributes = factory(Task::class)->raw(['body' => '']);
		$this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
	}

}
