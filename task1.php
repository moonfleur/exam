<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $query = "INSERT INTO `sellers` (`SNAME`, `CITY`, `COMM`) VALUES (:sname, :city, :comm)";
    $params = [
        'sname' => $_POST['sname'],
        'city' => $_POST['city'],
        'comm' => $_POST['comm']
    ];

    $stmt = $pdo->prepare($query);
    $result = $stmt->execute($params);
}

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
<?php if(isset($result)) : ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Збережено!
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="post">
                <div class="form-group">
                    <label for="sname">Ім’я продавця</label>
                    <input type="text" class="form-control" name="sname" id="sname">
                </div>
                <div class="form-group">
                    <label for="city">Місто, в якому працює продавець</label>
                    <input type="text" class="form-control" name="city" id="city">
                </div>
                <div class="form-group">
                    <label for="comm">% комісійних продавця</label>
                    <input type="number" class="form-control" name="comm" id="comm">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
