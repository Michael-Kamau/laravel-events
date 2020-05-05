<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Events\Event;
use App\Events\EventCategory;
use Faker\Generator as Faker;


//Event Factory
$factory->define(Event::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name'=>$faker->name(),
        'event_category_id'=>function(){

        return factory('App\Events\EventCategory');
        },
        'start_date'=>$faker->date(),
        'end_date'=>$faker->date(),
        'charges'=>$faker->randomDigit,
        'location'=>$faker->sentence
    ];
});


//Categories Factory
$factory->define(EventCategory::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,

    ];
});
