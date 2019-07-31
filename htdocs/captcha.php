<?php

  session_start();

  $captchastring = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
  $captchastring = substr(str_shuffle($captchastring), 0, 6);
  $_SESSION["code"] = $captchastring;

  $image = imagecreatefrompng('background.png');
  $colour = imagecolorallocate($image, 103, 0, 217);
  $font = 'Oswald-Bold.ttf';
  $rotate = rand(-10, 10);
  imagettftext($image, 24, $rotate, 40, 60, $colour, $font, $captchastring);
  header('Content-type: image/png');
  imagepng($image);

?>
