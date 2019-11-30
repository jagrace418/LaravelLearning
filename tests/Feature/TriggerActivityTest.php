<?php

namespace Tests\Feature;

use App\Activity;
use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TriggerActivityTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function createProject () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$this->assertCount(1, $project->activity);

		self::assertEquals('created', $project->activity[0]->description);
	}

	/** @test */
	public function updatingProject () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$project->update(['title' => 'changed']);

		self::assertCount(2, $project->activity);

		self::assertEquals('updated', $project->activity->last()->description);
	}

	/** @test */
	public function creatingTask () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$project->addTask('something');

		tap($project->activity->last(), function (Activity $activity) {
			self::assertEquals('created_task', $activity->description);
			self::assertInstanceOf(Task::class, $activity->subject);
		});

	}

	/** @test */
	public function completingTask () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), [
				'body'      => 'foo',
				'completed' => true,
			]);

		self::assertCount(3, $project->activity);

		tap($project->activity->last(), function (Activity $activity) {
			self::assertEquals('completed_task', $activity->description);
			self::assertInstanceOf(Task::class, $activity->subject);
		});
	}

	/** @test */
	public function incompleteTask () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), [
				'body'      => 'foo',
				'completed' => true,
			]);

		self::assertCount(3, $project->activity);

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), [
				'body'      => 'foo',
				'completed' => false,
			]);

		//fresh makes sure that it's updated from the db or else this fails
		$project->refresh();

		self::assertCount(4, $project->activity);

		self::assertEquals('incompleted_task', $project->activity->last()->description);
	}

	/** @test */
	public function deleteTask () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$project->tasks[0]->delete();

		self::assertCount(3, $project->activity);
	}
}
