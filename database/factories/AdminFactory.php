<?php

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Admin::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'email_verified_at' => now(),
		'role_level' => Admin::MODERATOR_LEVEL,
		'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
		'remember_token' => Str::random(10),
	];
});
