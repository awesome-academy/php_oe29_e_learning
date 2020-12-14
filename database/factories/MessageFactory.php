<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Message::class, function (Faker $faker) {
    do {
        $fromId = rand(1, 10);
        $toId = rand(1, 10);
        $isRead = rand(0, 1);
    } while ($fromId === $toId);

    return [
        'from_id' => $fromId,
        'to_id' => $toId,
        'is_read' => $isRead,
        'message' => $faker->sentence(config('title.limit_words'), true),
    ];
});
