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
<?php
require 'connect.php';

if( count($_POST) > 0 ) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email    = trim($_POST['email']);



    if( strlen($username) < 2 || is_numeric($username) ) {
        $name_erorr = '<div class="alert alert-danger">Имя введено неверно</div>';
    }
    elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 ) {
        $email_erorr = '<div class="alert alert-danger">Email введён неверно</div>';
    }
    elseif( strlen($password) < 5 ) {
        $password_erorr = '<div class="alert alert-danger">Пароль введён неверно</div>';
    }
    else {


        $query = "INSERT INTO `users` (`username`, `password`, `email`) VALUES('$username', '$password', '$email')";
        $result = mysqli_query($connection, $query);

        if($result) {
            $s_mas = '<div class="alert alert-success">Регистрация прошла успешно</div>';
        }
        else {
            $f_mas = '<div class="alert alert-danger">Ошибка!Попробуйте позже</div>';
        }
    }
}
?>

<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
        <a href="login.php" class="btn btn-lg btn-outline-dark">Войти</a>
        <h2>Регистрация</h2>

        <?php echo isset($s_mas)          ? "$s_mas"        : ''; ?>
        <?php echo isset($f_mas)          ? "$f_mas"        : ''; ?>
        <?php echo isset($name_erorr)     ? $name_erorr     : ''; ?>
        <?php echo isset($password_erorr) ? $password_erorr : ''; ?>
        <?php echo isset($email_erorr)    ? $email_erorr    : ''; ?>

        <input type="text" name="username" placeholder="Ваше имя" class="form-control">
        <input type="email" name="email" placeholder="Ваш email" class="form-control">
        <input type="password" name="password" placeholder="Ваш пароль" class="form-control">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
    </form>

</div>

</body>
</html>


