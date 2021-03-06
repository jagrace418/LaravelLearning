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

		if (request()->has('tasks')) {
			foreach (request('tasks') as $task) {
				$project->addTask($task['body']);
			}
		}
		//if it's an ajax request, send back where to go to
		if (request()->wantsJson()) {
			return ['message' => $project->path()];
		}

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
		$this->authorize('manage', $project);

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
