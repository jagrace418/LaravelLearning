<?php

namespace Tests\Unit;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function hasUser () {
		$user = $this->signIn();

		$project = ProjectFactory::ownedBy($user)->create();

		self::assertEquals($user->id, $project->activity->first()->user->id);
	}
}
