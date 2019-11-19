<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{

    use Illuminate\Support\Carbon;

    /**
 * App\Project
 *
     * @property int $id
     * @property string $title
     * @property string $description
     * @property int $owner_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project query()
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereOwnerId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App{

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Notifications\DatabaseNotificationCollection;

    /**
 * App\User
 *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
     * @property-read Collection|Project[] $projects
     * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

