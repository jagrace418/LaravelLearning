<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeedTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function createProjectGeneratesActivity () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$this->assertCount(1, $project->activity);

		self::assertEquals('created', $project->activity[0]->description);
	}

	/** @test */
	public function updatingProjectGeneratesActivity () {
		/** @var Project $project */
		$project = ProjectFactory::create();

		$project->update(['title' => 'changed']);

		self::assertCount(2, $project->activity);

		self::assertEquals('updated', $project->activity->last()->description);
	}
}
