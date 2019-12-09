<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Project
 * @property int                                                           $id
 * @property string                                                        $title
 * @property string                                                        $description
 * @property string|null                                                   $notes
 * @property int                                                           $owner_id
 * @property \Illuminate\Support\Carbon|null                               $created_at
 * @property \Illuminate\Support\Carbon|null                               $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read int|null                                                 $activity_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[]     $members
 * @property-read int|null                                                 $members_count
 * @property-read \App\User                                                $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[]     $tasks
 * @property-read int|null                                                 $tasks_count
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereNotes($value)
 * @method static Builder|Project whereOwnerId($value)
 * @method static Builder|Project whereTitle($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

	public function invite (User $user) {
		return $this->members()->attach($user);
	}

	public function members () {
		return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
	}

}
