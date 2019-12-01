<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//this is a sneaky facade

class ProjectTasksTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function projectHasTasks () {
		/** @var Project $project */
		$project = ProjectFactory::create();
		$this->actingAs($project->owner)
			->post($project->path() . '/tasks', ['body' => 'test task']);
		$this->get($project->path())->assertSee('test task');
	}

	/** @test */
	public function taskRequiresBody () {
		$project = ProjectFactory::create();
		$attributes = factory(Task::class)->raw(['body' => '']);
		$this->actingAs($project->owner)
			->post($project->path() . '/tasks', $attributes)
			->assertSessionHasErrors('body');
	}

	/** @test */
	public function onlyOwnerAddsTasks () {
		$this->signIn();
		/** @var Project $project */
		$project = factory('App\Project')->create();
		$this->post($project->path() . '/tasks', ['body' => 'test of task'])
			->assertStatus(403);
		$this->assertDatabaseMissing('tasks', ['body' => 'test of task']);
	}

	/** @test */
	public function aTaskCanBeUpdated () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$taskAttributes = [
			'body' => 'changed',
		];

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), $taskAttributes);

		$this->assertDatabaseHas('tasks', $taskAttributes);
	}

	/** @test */
	public function aTaskCanBeCompleted () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$taskAttributes = [
			'body'      => 'changed',
			'completed' => true,
		];

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), $taskAttributes);

		$this->assertDatabaseHas('tasks', $taskAttributes);
	}

	/** @test */
	public function aTaskCanBeUnCompleted () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$taskAttributes = [
			'body'      => 'changed',
			'completed' => false,
		];

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), $taskAttributes);

		$this->assertDatabaseHas('tasks', $taskAttributes);
	}

	/** @test */
	public function onlyProjectOwnerCanUpdate () {
		$this->signIn();
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();
		$this->patch($project->tasks()->first()->path(), ['body' => 'changed'])
			->assertStatus(403);

		$this->assertDatabaseMissing('tasks', ['body' => 'changed']);

	}

}
