<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Результаты поиска</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
  <body>
    <div class="container">
      <h1>Результаты поиска</h1>
      <table class="table" id="tableSearch">
        <thead class="thead-dark">
          <tr>
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
          session_start();

          $total = $_SESSION['totalRows'];

          if (isset($_GET['page'])) {
        	 $page = $_GET['page'];
          } else $page = 1;
          $noteNum = 10;
          $noteStart = ($page * $noteNum) - $noteNum;
          $countPages = ceil($total / $noteNum);
          if ($total - $noteStart >= $noteNum) {
            $cut = 0;
          } else {
            $cut = $noteNum + $noteStart - $total;
          }

          $result = $_SESSION['result'];

          for ($counter = $noteStart; $counter < $noteStart + $noteNum - $cut; $counter++) {
             echo '<tr><td>'.$result[$counter]['username'].'</td>';
             echo '<td>'.$result[$counter]['email'].'</td>';
             echo '<td>'.$result[$counter]['homepage'].'</td>';
             echo '<td>'.$result[$counter]['message'].'</td>';
             echo '<td>'.$result[$counter]['tags'].'</td>';
             echo '<td>'.$result[$counter]['created_at'].'</td></tr>';
           }

          ?>
        </tbody>
      </table>
    </div>
    <div class="container">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php
          $n = 1;
          for ($i = 1; $i <= $countPages; $i++) {
            if($i <= 25 * $n) {
              echo "<li class='page-item'><a class='page-link' href='http://172.55.0.3/search.php?page=$i'>".$i."</a></li>";
            } else {
              echo "</ul><br><ul class='pagination'><li class='page-item'><a class='page-link' href='http://172.55.0.3/search.php?page=$i'>".$i."</a></li>";
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
        <a class="btn btn-danger" href="http://172.55.0.3/book.php">Сбросить поиск</a>
      </nav>
    </div>
  </body>
</html>
