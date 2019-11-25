<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase {

	use WithFaker, RefreshDatabase;

	/** @test */
	public function userCreateProject () {
		//don't handle exe, aka throw the http exe when the route is not founds
		$this->withoutExceptionHandling();
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

		$this->assertDatabaseHas('projects', $attributes);

		$this->get($project->path())
			->assertSee($attributes['title'])
			->assertSee($attributes['description'])
			->assertSee($attributes['notes']);
	}

	/** @test */
	public function userCanUpdateProject () {
		$this->signIn();
		/** @var Project $project */
		$project = factory('App\Project')->create(['owner_id' => auth()->id()]);
		$this->patch($project->path(), [
			'notes' => 'Changed',
		])->assertRedirect($project->path());
		$this->assertDatabaseHas('projects', ['notes' => 'Changed']);
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
		$this->signIn();
		/** @var Project $project */
		$project = factory('App\Project')->create(['owner_id' => auth()->id()]);
		$this->get($project->path())
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