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
}
