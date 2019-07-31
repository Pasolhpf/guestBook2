<?php
  session_start();
  $captchastring = $_SESSION["code"];

  $username = $_POST['username'];
  $email = $_POST['email'];
  $homepage = $_POST['homepage'];
  $message = $_POST['message'];
  $tags = $_POST['tags'];
  $createdAt = $_POST['createdAt'];
  $captcha = $_POST['captcha'];

  if ($captcha !== $captchastring) {
    echo "CAPTCHA введена неправильно!";
  } else {
    $tagsLength = strlen($tags);
    $i = 0;
    $res = "#";
    while ($i < $tagsLength) {
      if ($tags[$i] !== ",") {
        $res = $res . $tags[$i];
      } else {
        $res = $res . "##";
      }
      $i = $i + 1;
    }
    $res = $res . "#";

    $dsn = 'mysql:host=mysql;dbname=testdrive;charset=utf8';
    $pdo = new PDO($dsn, 'root', 'root');

    $sql = 'INSERT INTO notes(username, email, homepage, message, tags, created_at) VALUES(:username, :email, :homepage, :message, :tags, :createdAt)';
    $query = $pdo->prepare($sql);
    $query->execute([':username' => $username, ':email' => $email, ':homepage' => $homepage, ':message' => $message, ':tags' => $res, ':createdAt' => $createdAt]);

    header('Location: http://172.55.0.3/book.php');
  }
 ?>
