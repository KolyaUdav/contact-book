<?php
    require_once 'Config/config.php';
    require_once 'Handlers/RegisterDataHandler.php';
    require_once 'Util/check_register_form.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/alerts.css">
    <title>Registration Page</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-3 pt-3">
            <a href="login.php">Авторизация</a>
        </div>
        <div class="col-sm-6" style="margin-top: 4rem;">
            <h1>Contact Book</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" name="login" id="login"
                           value="<?php if (isset($_POST['login'])) echo $_POST['login'] ?>"
                           placeholder="Input Login" class="form-control"
                           required>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Имя</label>
                    <input type="text" name="firstname" id="firstname"
                           placeholder="Your Firstname" class="form-control"
                           value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname'] ?>"
                           required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Фамилия</label>
                    <input type="text" name="lastname" id="lastname"
                           placeholder="Your Lastname" class="form-control"
                           value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname'] ?>"
                           required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password" id="password"
                           class="form-control" placeholder="Input Password"
                           required>
                </div>
                <div class="mb-3">
                    <label for="repeat_password" class="form-label">Повторите пароль</label>
                    <input type="password" name="repeat_password" id="repeat_password"
                           placeholder="Repeat Password" class="form-control"
                           required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Send">
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="js/alert.js"></script>
</body>
</html>
