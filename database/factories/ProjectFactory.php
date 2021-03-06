<?php

/** @var Factory $factory */

use App\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Project::class, function (Faker $faker) {
    return [
		'title'       => $faker->sentence(4),
		'description' => $faker->paragraph(1),
		'notes'       => $faker->sentence(7),
		'owner_id'    => \factory(\App\User::class)
	];
});
