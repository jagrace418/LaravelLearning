<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase {

	use RefreshDatabase;

	/** @test */
	public function onlyOwnerCanInvite () {
		$project = ProjectFactory::create();
		$this->actingAs(factory(User::class)->create())
			->post($project->path() . '/invitations')
			->assertStatus(403);
	}

	/** @test */
	public function aProjectOwnerCanInviteUser () {
		$project = ProjectFactory::create();

		$userToInvite = factory(User::class)->create();

		$this->actingAs($project->owner)->post($project->path() . '/invitations', [
			'email' => $userToInvite->email,
		])
			->assertRedirect($project->path());

		self::assertTrue($project->members->contains($userToInvite));
	}

	/** @test */
	public function invitedEmailAddressMustBeValidBirdboardAccount () {
		$project = ProjectFactory::create();

		$this->actingAs($project->owner)
			->post($project->path() . '/invitations', [
				'email' => 'nothingReal@none.no'
			])
			->assertSessionHasErrors([
				'email' => 'The user you are inviting must have an account'
			]);
	}

	/** @test */
	function invitedUsersCanUpdateProject () {
		$project = ProjectFactory::create();

		$project->invite($newUser = factory(User::class)->create());

		$this->signIn($newUser);
		$this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'foo task']);

		$this->assertDatabaseHas('tasks', $task);
	}


}
