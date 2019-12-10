<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;

class ProjectsController extends Controller {

	public function index () {
		$projects = auth()->user()->availableProjects();

		return view('projects.index', compact('projects'));
	}

	public function store () {
		/** @var Project $project */
		$project = auth()->user()->projects()->create($this->validateRequest());

		//redirect
		return redirect($project->path());
	}

	public function show (Project $project) {
		$this->authorize('update', $project);

		return view('projects.show', compact('project'));
	}

	public function create () {
		return view('projects.create');
	}

	public function destroy (Project $project) {
		$this->authorize('update', $project);

		$project->delete();

		return redirect('/projects');
	}

	public function edit (Project $project) {
		return view('projects.edit', compact('project'));
	}

	public function update (Project $project) {
		$this->authorize('update', $project);

		$project->update($this->validateRequest());

		return redirect($project->path());
	}

	/**
	 * @return array
	 */
	protected function validateRequest () {
		return request()->validate([
			'title'       => 'sometimes|required',
			'description' => 'sometimes|required',
			//min 3 characters
			'notes'       => 'nullable',
		]);
	}
}
