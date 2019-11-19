<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function hasPath(){
        $project = factory('App\Project')->create();
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }
}
