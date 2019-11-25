<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        /** @var Project $project */
        $project = auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' => 'required',
			//min 3 characters
			'notes' => 'min:3',
        ]));
        //redirect
        return redirect($project->path());
    }

    public function show(Project $project)
    {
		$this->authorize('update', $project);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

	public function update (Project $project) {
		$this->authorize('update', $project);

		$project->update(request(['notes']));

		return redirect($project->path());
	}
}
