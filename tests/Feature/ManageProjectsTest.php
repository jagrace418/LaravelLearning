<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase {

	use WithFaker, RefreshDatabase;

	/** @test */
	public function userCreateProject () {
		$this->signIn();

		$this->get('/projects/create')->assertStatus(200);

		$attributes = [
			'title'       => $this->faker->sentence,
			'description' => $this->faker->sentence,
			'notes'       => $this->faker->sentence,
		];

		$response = $this->post('/projects', $attributes);

		$project = Project::where($attributes)->first();

		$response->assertRedirect($project->path());

		$this->get($project->path())
			->assertSee($attributes['title'])
			->assertSee($attributes['description'])
			->assertSee($attributes['notes']);
	}

	/** @test */
	public function userDeleteProject () {
		$project = ProjectFactory::create();
		$this->actingAs($project->owner)
			->delete($project->path())
			->assertRedirect('/projects');

		$this->assertDatabaseMissing('projects', $project->only('id'));
	}

	/** @test */
	public function guestsCannotDeleteProject () {
		$project = ProjectFactory::create();
		$this->delete($project->path())
			->assertRedirect('/login');

		$this->signIn();

		$this->delete($project->path())->assertStatus(403);

		$this->assertDatabaseHas('projects', $project->only('id'));
	}

	/** @test */
	public function userCanUpdateProject () {
		$project = ProjectFactory::create();
		$this->actingAs($project->owner)
			->patch($project->path(), $attributes = ['notes' => 'Changed', 'title' => 'Changed', 'description' => 'Changed'])
			->assertRedirect($project->path());

		$this->get($project->path() . '/edit')->assertStatus(200);
		$this->assertDatabaseHas('projects', $attributes);
	}

	/** @test */
	public function userCanUpdateProjectNotes () {
		$project = ProjectFactory::create();
		$this->actingAs($project->owner)
			->patch($project->path(), $attributes = ['notes' => 'Changed'])
			->assertRedirect($project->path());

		$this->get($project->path() . '/edit')->assertStatus(200);
		$this->assertDatabaseHas('projects', $attributes);
	}

	/** @test */
	public function projectRequiresTitle () {
		$this->signIn();
		//create a project with empty title, do not persist
		$attributes = factory('App\Project')->raw(['title' => '']);
//        $attributes = factory('App\Project')->create(['title' => '']);//saves to db
//        $attributes = factory('App\Project')->make(['title' => '']);//does not save to db
		$this->post('/projects', $attributes)->assertSessionHasErrors('title');
	}

	/** @test */
	public function projectRequiresDescription () {
		$this->signIn();
		$attributes = factory('App\Project')->raw(['description' => '']);
		$this->post('/projects', $attributes)->assertSessionHasErrors('description');
	}

	/** @test */
	public function guestsCanNotManageProjects () {
		$project = factory('App\Project')->create();
		//if you try to access the project dashboard
		$this->get('/projects')->assertRedirect('login');
		//can not get to the create form
		$this->get('/projects/create')->assertRedirect('login');
		$this->get($project->path() . '/edit')->assertRedirect('login');
		//if you try to access a project
		$this->get($project->path())->assertRedirect('login');
		//if you try to make a new project
		$this->post('/projects', $project->toArray())->assertRedirect('login');
	}

	/** @test */
	public function guestsCanNotUpdateProjects () {
		$this->signIn();
		/** @var Project $project */
		$project = factory('App\Project')->create();
		$this->patch($project->path())->assertStatus(403);
	}


	/** @test */
	public function userViewTheirProject () {
		$project = ProjectFactory::create();
		$this->actingAs($project->owner)
			->get($project->path())
			->assertSee($project->title);
//			->assertSee($project->description);
	}

	/** @test */
	public function userCanNotViewNotTheirProjects () {
		$this->signIn();
		$project = factory('App\Project')->create();
		$this->get($project->path())->assertStatus(403);
	}
}
