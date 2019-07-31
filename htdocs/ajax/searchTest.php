<?php
  $searchData = $_POST['searchData'];
  $choice = $_POST['choice'];
  global $searchData;
  global $choice;


  $dsn = 'mysql:host=mysql;dbname=guestBook;charset=utf8';
  $pdo = new PDO($dsn, 'root', 'root');

  if ($choice === "username") {
    $sql = 'SELECT * FROM notes WHERE username=? ORDER BY created_at DESC';

    $query = $pdo->prepare($sql);
    $query->bindValue(1, "$searchData", PDO::PARAM_STR);
    $query->execute();
    $total = $query->rowCount();
    $result = $query->fetchAll();
    $arrlen = count($result);
    //echo $arrlen.$total.$choice.$searchData;
  } else if ($choice === "email") {
    $sql = 'SELECT * FROM notes WHERE email=? ORDER BY created_at DESC';

    $query = $pdo->prepare($sql);
    $query->bindValue(1, "$searchData", PDO::PARAM_STR);
    $query->execute();
    $total = $query->rowCount();
    $result = $query->fetchAll();
    $arrlen = count($result);
  //  echo $arrlen.$total.$choice.$searchData;
  } else if ($choice === "createdAt") {
    $sql = 'SELECT * FROM notes WHERE created_at=? ORDER BY created_at DESC';

    $query = $pdo->prepare($sql);
    $query->bindValue(1, "$searchData", PDO::PARAM_STR);
    $query->execute();
    $total = $query->rowCount();
    $result = $query->fetchAll();
    $arrlen = count($result);
  //  echo $arrlen.$total.$choice.$searchData;
  } else if ($choice === "tag") {
    $tagNew = "#".$searchData."#";
    $sql = 'SELECT * FROM notes WHERE tags LIKE ? ORDER BY created_at DESC';

    $query = $pdo->prepare($sql);
    $query->bindValue(1, "%".$tagNew."%", PDO::PARAM_STR);
    $query->execute();
    $total = $query->rowCount();
    $result = $query->fetchAll();
    $arrlen = count($result);
  //  echo $arrlen.$total.$choice.$searchData;
  }

  session_start();
  $_SESSION['result'] = $result;
  $_SESSION['totalRows'] = $total;


?>
