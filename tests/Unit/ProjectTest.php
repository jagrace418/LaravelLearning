<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function hasPath()
    {
        $project = factory('App\Project')->create();
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function belongsToOwner()
    {
        $project = factory('App\Project')->create();
        $this->assertInstanceOf('App\User', $project->owner);
    }

    /** @test */
    public function canAddTask()
    {
        /** @var Project $project */
        $project = factory('App\Project')->create();
        $task = $project->addTask('Test task');
        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
