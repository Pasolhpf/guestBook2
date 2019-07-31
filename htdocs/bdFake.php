<?php

require 'vendor/autoload.php';

use Faker\Factory as Faker;
use RedBeanPHP\R  as RedBean;

$faker = Faker::create();

RedBean::setup('mysql:host=mysql;dbname=guestBook', 'root', 'root');

for ($i = 0; $i < 200; $i++) {
  $preUsername = $faker->userName;
  $username = str_replace('.', '', $preUsername);
  $preTags = $faker->words($nb = 3, $asText = false);
  $tags = "#".implode('##', $preTags)."#";
$data = [
    'username' => $username,
    'email' => $faker->email,
    'homepage' => $faker->url,
    'message' => $faker->text($maxNbChars = 250),
    'tags' => $tags,
    'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')
];

$note = RedBean::dispense('notes');

foreach ($data as $key => $value) {
    $note->{$key} = $value;
}

RedBean::store($note);
}

header('Location: http://172.55.0.3/book.php');

 ?>
