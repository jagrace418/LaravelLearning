<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function userCreateProject()
    {
        //don't handle exe, aka throw the http exe when the route is not founds
        $this->withoutExceptionHandling();
        $this->actingAs(factory('App\User')->create());
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function projectRequiresTitle()
    {
        $this->actingAs(factory('App\User')->create());
        //create a project with empty title, do not persist
        $attributes = factory('App\Project')->raw(['title' => '']);
//        $attributes = factory('App\Project')->create(['title' => '']);//saves to db
//        $attributes = factory('App\Project')->make(['title' => '']);//does not save to db
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function projectRequiresDescription()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function onlyLoggedInUsersCanCreateProject()
    {
        $attributes = factory('App\Project')->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function userViewProject()
    {
        $project = factory('App\Project')->create();
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
}
