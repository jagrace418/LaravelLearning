<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function hasPath () {
		$task = factory(Task::class)->create();
		$this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
	}

	/** @test */
	public function taskBelongsToProject () {
		/** @var Task $task */
		$task = factory(Task::class)->create();
		self::assertInstanceOf(Project::class, $task->project);
	}

	/** @test */
	public function taskCanBeCompleted () {
		/** @var Task $task */
		$task = factory(Task::class)->create();

		self::assertFalse($task->completed);

		$task->complete();

		self::assertTrue($task->fresh()->completed);
	}

	/** @test */
	public function taskCanBeUnCompleted () {
		/** @var Task $task */
		$task = factory(Task::class)->create(['completed' => true]);

		self::assertTrue($task->completed);

		$task->incomplete();

		self::assertFalse($task->fresh()->completed);
	}
}
