<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Activity
 * @property int                                                $id
 * @property int                                                $project_id
 * @property int                                                $user_id
 * @property string|null                                        $subject_type
 * @property int|null                                           $subject_id
 * @property \Illuminate\Support\Carbon|null                    $created_at
 * @property \Illuminate\Support\Carbon|null                    $updated_at
 * @property string                                             $description
 * @property array|null                                         $changes
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @property-read \App\User                                     $user
 * @method static Builder|Activity newModelQuery()
 * @method static Builder|Activity newQuery()
 * @method static Builder|Activity query()
 * @method static Builder|Activity whereChanges($value)
 * @method static Builder|Activity whereCreatedAt($value)
 * @method static Builder|Activity whereDescription($value)
 * @method static Builder|Activity whereId($value)
 * @method static Builder|Activity whereProjectId($value)
 * @method static Builder|Activity whereSubjectId($value)
 * @method static Builder|Activity whereSubjectType($value)
 * @method static Builder|Activity whereUpdatedAt($value)
 * @method static Builder|Activity whereUserId($value)
 * @mixin \Eloquent
 */
class Activity extends Model {

	protected $guarded = [];

	protected $casts = [
		'changes' => 'array',
	];

	public function subject () {
		return $this->morphTo();
	}

	public function user () {
		return $this->belongsTo(User::class);
	}
}
