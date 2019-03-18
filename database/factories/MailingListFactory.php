<?php

use App\MailingListAuthor;
use App\MailingListTopic;
use App\MailingListMessage;
use Faker\Generator as Faker;

$factory->define(MailingListAuthor::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'display_name' => $faker->name,
    ];
});

$factory->define(MailingListTopic::class, function (Faker $faker) {
    return [
        'topic' => $faker->sentence(5),
        'created_at' => $faker->dateTime(),
    ];
});

$factory->define(MailingListMessage::class, function (Faker $faker) {
    return [
        'hash' => $faker->md5(),
        'content' => $faker->paragraphs(3, true),
        'raw' => $faker->paragraphs(3, true),
        'created_at' => $faker->dateTime(),
    ];
});
