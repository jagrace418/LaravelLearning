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

		tap($project->activity->last(), function (Activity $activity) {
			self::assertEquals('created', $activity->description);
			self::assertNull($activity->changes);
		});
	}

	/** @test */
	public function updatingProject () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$ogTitle = $project->title;

		$project->update(['title' => 'changed']);

		self::assertCount(2, $project->activity);

		tap($project->activity->last(), function (Activity $activity) use ($ogTitle) {
			self::assertEquals('updated', $activity->description);

			$expected = [
				'before' => ['title' => $ogTitle],
				'after'  => ['title' => 'changed'],
			];

			self::assertEquals($expected, $activity->changes);
		});

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
