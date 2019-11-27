<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeedTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function createProjectRecordsActivity () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$this->assertCount(1, $project->activity);

		self::assertEquals('created', $project->activity[0]->description);
	}

	/** @test */
	public function updatingProjectRecordsActivity () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$project->update(['title' => 'changed']);

		self::assertCount(2, $project->activity);

		self::assertEquals('updated', $project->activity->last()->description);
	}

	/** @test */
	public function creatingNewTaskRecordsActivityForProject () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$project->addTask('something');

		self::assertCount(2, $project->activity);
	}

	/** @test */
	public function completingTaskRecordsActivity () {
		/** @var Project $project */
		$project = ProjectFactory::withTasks(1)->create();

		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), [
				'body'      => 'foo',
				'completed' => true,
			]);

		self::assertCount(3, $project->activity);
		self::assertEquals('completed_task', $project->activity->last()->description);
	}
}
