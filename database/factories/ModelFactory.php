<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Src\User\User::class, function ($faker) {
    return [
        'name'           => 'zal',
        'email'          => 'admin@test.com',
        'password'       => bcrypt('admin'),
        'remember_token' => str_random(10),
        'admin'          => 1,
    ];
});

$factory->define(App\Src\Celebrity\Celebrity::class, function ($faker) {
    return [
        'name' => $faker->name
    ];
});


$factory->define(App\Src\Vote\Vote::class, function ($faker) {
    return [
        'celebrity_id' => App\Src\Celebrity\Celebrity::orderByRaw("RAND()")->first()->id
    ];
});

$factory->define(App\Src\Photo\Photo::class, function ($faker) {
    return [
        'imageable_id'   => App\Src\Celebrity\Celebrity::orderByRaw("RAND()")->first()->id,
        'imageable_type' => 'Celebrity',
        'name'           => '7.jpg',
        'thumbnail'      => '1'
    ];
});