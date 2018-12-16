<?php

use Book\User;
use Faker\Generator as Faker;

$factory->define(Book\Order::class, function (Faker $faker) {
    $userIds = User::pluck('id');
    $user_id = $faker->randomElement($userIds);
    while (User::where('id', $user_id)->first()->addresses->isEmpty()) {
        $user_id = $faker->randomElement($userIds);
    }
    $address_id = $faker->randomElement(User::where('id', $user_id)->first()->addresses->pluck('id'));

    return [
        'user_id'    => $user_id,
        'address_id' => $address_id,
    ];
});