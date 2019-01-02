<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'user_id'=>function(){
            return App\User::all()->random();
        },
        'details'=>$faker->paragraph,
        'price'=>$faker->numberBetween(100,1000),
        'stock'=>$faker->randomDigit,
        'discount'=>$faker->numberBetween(10,30),
    ];
});


