<?php


namespace App;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;

trait RecordsActivity {


	/**
	 * The model's old attributes
	 * @var array
	 */
	public $oldAttributes = [];

	/**
	 * Boot the trait
	 */
	public static function bootRecordsActivity () {

		foreach (self::recordableEvents() as $event) {
			static::$event(function ($model) use ($event) {
				$model->recordActivity($model->activityDescription($event));
			});

			if ($event === 'updated') {
				static::updating(function ($model) {
					$model->oldAttributes = $model->getOriginal();
				});
			}
		}
	}

	/**
	 * Fetch the model events that should trigger activity
	 * @return array
	 */
	protected static function recordableEvents (): array {
		if (isset(static::$recordableEvents)) {
			return static::$recordableEvents;
		}

		return ['created', 'updated', 'deleted'];
	}

	/**
	 * Record activity for the model
	 *
	 * @param string $description
	 */
	public function recordActivity ($description) {
		$this->activity()->create([
			'user_id'     => ($this->project ?? $this)->owner->id,
			'description' => $description,
			'changes'     => $this->activityChanges(),
			'project_id'  => class_basename($this) === 'Project' ? $this->id : $this->project->id,
		]);
	}

	/**
	 * The activity feed for the model
	 * @return MorphMany
	 */
	public function activity () {
		if (get_class($this) === Project::class) {
			return $this->hasMany(Activity::class)->latest();
		}

		return $this->morphMany(Activity::class, 'subject')->latest();
	}

	/**
	 * Fetch changes to the model
	 * @return array | null
	 */
	protected function activityChanges () {
		if ($this->wasChanged()) {
			return [
				'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
				'after'  => Arr::except($this->getChanges(), 'updated_at'),
			];
		}
	}

	/**
	 * Get the description of the model
	 *
	 * @param string $description
	 *
	 * @return string
	 */
	protected function activityDescription ($description) {
		return $event = $description . '_' . strtolower(class_basename($this));
	}
}