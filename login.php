<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .form {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
        <a href="index.php" class="btn btn-lg btn-outline-dark">Регистрация</a>
        <h2>Вход</h2>

        <input type="text" name="username" placeholder="Ваше имя" class="form-control">
        <input type="password" name="password" placeholder="Ваш пароль" class="form-control">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

<?php
session_start();
require 'connect.php';

if( count($_POST) > 0 ) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM `users` WHERE `username`='$username' and `password`='$password'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if( $count == 1 ) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    }
    else {
        $fmas = 'Не удалось войти';
    }
}
if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    echo "Привет, $username<br>";
    echo "Твой пароль: $password<br>";
    echo 'Вы вошли<br>';
    echo '<a href="log-out.php" class="btn btn-lg btn-outline-dark">Выйти</a>';
}
?>
    </form>
</div>
</body>
</html>