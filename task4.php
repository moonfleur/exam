<?php

$host = '127.0.0.1';
$db   = 'exam_v1';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (Exception $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

$query = "SELECT c.СNUM,
       c.СNAME,
       c.CITY,
       c.RATING,
       max_values.max_rating FROM customers c, (SELECT
  c.CITY,
  MAX(c.RATING) AS max_rating
FROM customers c
GROUP BY c.CITY) AS max_values WHERE c.CITY = max_values.CITY AND c.RATING = max_values.max_rating";
$data = $pdo->prepare($query);
$data->execute();

?>

<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Task 1</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">СNUM</th>
                            <th scope="col">СNAME</th>
                            <th scope="col">CITY</th>
                            <th scope="col">RATING</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $row) : ?>
                        <tr>
                            <td><?php echo $row['СNUM'] ?></td>
                            <td><?php echo $row['СNAME'] ?></td>
                            <td><?php echo $row['CITY'] ?></td>
                            <td><?php echo $row['max_rating'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
