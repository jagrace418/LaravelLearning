<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function userHasProjects () {
		$user = factory('App\User')->create();
		$this->assertInstanceOf(Collection::class, $user->projects);
	}

	/** @test */
	public function userHasAvailableProjects () {
		$user1 = $this->signIn();

		$project = ProjectFactory::ownedBy($user1)->create();

		self::assertCount(1, $user1->availableProjects());

		$user2 = factory(User::class)->create();
		$user3 = factory(User::class)->create();

		$user2Project = tap(ProjectFactory::ownedBy($user2)->create())->invite($user3);

		self::assertCount(1, $user1->availableProjects());

		$user2Project->invite($user1);

		self::assertCount(2, $user1->availableProjects());
	}
}
