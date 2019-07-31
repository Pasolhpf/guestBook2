<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Записи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container">
    <h1>Записи гостевой книги</h1>
    <div class="form-inline">
      <form>
        <input type="text" name="searchData" id="searchData" class="form-control">
        <select class="form-control form-control-sm" style="width: 50%" name="choice" id="choice">
        <option selected>Поиск по...</option>
        <option value="username">Username</option>
        <option value="email">Email</option>
        <option value="createdAt">CreatedAt</option>
        <option value="tag">Tag</option>
        </select>
        <button type="button" id="searchRun" class="btn btn-primary btn-sm">Поиск</button>
      </form>
      <div id="errorSearch"></div>
    </div><br>

      <table class="table" id="tableBook">
        <thead class="thead-dark">
          <tr>
            <!--<th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Homepage</th>
            <th style="width: 50%" scope="col">Message</th>
            <th scope="col">Tags</th>
            <th scope="col">CreatedAt</th>-->
            <th>Username</th>
            <th>Email</th>
            <th>Homepage</th>
            <th style="width: 300px">Message</th>
            <th>Tags</th>
            <th>CreatedAt</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $dsn = 'mysql:host=mysql;dbname=guestBook;charset=utf8';
          $pdo = new PDO($dsn, 'root', 'root');


          $sqlTotal = 'SELECT * FROM notes';
          $queryTotal = $pdo->prepare($sqlTotal);
          $queryTotal->execute();
          $total = $queryTotal->rowCount();


          if (isset($_GET['page'])) {
        	   $page = $_GET['page'];
          } else $page = 1;
          $noteNum = 10;
          $noteStart = ($page * $noteNum) - $noteNum;
          $countPages = ceil($total / $noteNum);



          $sql = 'SELECT * FROM notes ORDER BY `created_at` DESC LIMIT :noteNum OFFSET :noteStart';

          $query = $pdo->prepare($sql);
          $query->bindValue(':noteNum', $noteNum, PDO::PARAM_INT);
          $query->bindValue(':noteStart', $noteStart, PDO::PARAM_INT);
          $query->execute();


          while($row = $query->fetch()) {
            echo '<tr><td>'.$row['username'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['homepage'].'</td>';
            echo '<td>'.$row['message'].'</td>';
            echo '<td>'.$row['tags'].'</td>';
            echo '<td>'.$row['created_at'].'</td></tr>';
          }

          ?>
        </tbody>
      </table>
    </div>

<div class="container">
  <nav aria-label="Page navigation example">
    <ul class='pagination'>
      <?php
      $n = 1;
      for ($i = 1; $i <= $countPages; $i++) {
        if($i <= 25 * $n) {
          echo "<li class='page-item'><a class='page-link' href='http://172.55.0.3/book.php?page=$i'>".$i."</a></li>";
        } else {
          echo "</ul><br><ul class='pagination'><li class='page-item'><a class='page-link' href='http://172.55.0.3/book.php?page=$i'>".$i."</a></li>";
          $n = $n + 1;
        }
      }
      ?>
      </ul>
  </nav>
</div>
<div class="container">
  <nav class="nav">
    <a class="btn btn-success" href="http://172.55.0.3/index.html">Добавить</a>
  </nav>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/formSearch.js"></script>
</body>
</html>
