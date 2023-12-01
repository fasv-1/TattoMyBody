<?php
require_once '../../vendor/autoload.php';
require_once('../functions.php');

$faker = \Faker\Factory::create();

for ($i = 0; $i < 1000; $i++) {
  $sql = "INSERT INTO users (username, email, password, level, status, token, date, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  $username = $faker->name;
  $email = $faker->email;
  $password = $faker->password;
  $level = $faker->numberBetween($min = 1, $max = 3);
  $status = $faker->numberBetween($min = 1, $max = 3);
  $token = $faker->sha1;
  $date = $faker->unixTime();
  $avatar = $faker->imageUrl(300, 500, 'cats', true, 'Faker', true);

  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$username, $email, $password, $level, $status, $token, $date, $avatar])) {
    $stmt = null;
  }
};

for ($i = 0; $i < 100; $i++) {
  $sql = "INSERT INTO news (title, summary, body, author, image, validation, date, token_news, tattooers_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
  $summary = $faker->text($maxNbChars = 100);
  $body = $faker->text($maxNbChars = 400);
  $author = $faker->name;
  $image = $faker->imageUrl($width = 640, $height = 480);
  $validation = $faker->numberBetween($min = 0, $max = 3);
  $date = $faker->iso8601($max = 'now');
  $token_news = $faker->sha1;
  $tattooers_token = $faker->md5;

  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$title, $summary, $body, $author, $image, $validation, $date, $token_news, $tattooers_token])) {
    $stmt = null;
  }
};

echo "Registers done";
