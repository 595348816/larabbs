<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    $now=\Illuminate\Support\Carbon::now()->toDateTimeString();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$E0veHYbhiptl.vCdrzSXk.jIyE7TBwfA6UXCCEvayy8Ob09dP7Fmu', // secret
        'remember_token' => str_random(10),
        'introduction'=>$faker->sentence(),
        'created_at'=>$now,
        'updated_at'=>$now,
    ];
});
