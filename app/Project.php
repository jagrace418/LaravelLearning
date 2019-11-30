<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model {

	use RecordsActivity;

	/**
	 * Attributes to guard against mass assignment
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The path to the project
	 * @return string
	 */
	public function path () {
		return "/projects/{$this->id}";
	}

	/**
	 * The project owner
	 * @return BelongsTo
	 */
	public function owner () {
		return $this->belongsTo(User::class);
	}

	/**
	 * The tasks of the project
	 * @return HasMany
	 */
	public function tasks () {
		return $this->hasMany(Task::class);
	}

	/**
	 * Add a task to the project
	 *
	 * @param string $body
	 *
	 * @return Model
	 */
	public function addTask ($body) {
		return $this->tasks()->create(compact('body'));
	}

}
