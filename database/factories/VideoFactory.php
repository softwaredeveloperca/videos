<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
		'user_id' => rand(1, 10), 
		'viewers' => rand(0, 1000000), 
		'video_size' => rand(0, 1000000), 
		'exif_raw_data' => '', 
		'tags' => '',
    ];
});
