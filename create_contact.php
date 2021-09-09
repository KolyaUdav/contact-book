<?php
require_once 'Config/config.php';
require_once 'Handlers/DataHandler.php';
require_once 'util/check_token.php';
require_once 'Util/check_new_contact.php';
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
    <title>Add Contact</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Добавить</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Все контакты</a>
                    <a class="nav-link" href="chosen_contacts.php">Избранные</a>
                    <a class="nav-link" href="create_contact.php">Добавить</a>
                    <a class="nav-link" href="logout.php">Выйти</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="mb-3 mt-3">
                    <label for="firstname" class="form-label">Имя</label>
                    <input type="text" name="firstname" id="firstname"
                           placeholder="Type Firstname" class="form-control"
                           required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Фамилия</label>
                    <input type="text" name="lastname" id="lastname"
                           placeholder="Type Lastname" class="form-control"
                           required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Номер телефона (В формате 375-29-XXX-XX-XX)</label>
                    <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2}" name="phone_number" id="phone_number"
                           placeholder="Type Phone Number" class="form-control"
                           required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input type="email" name="email" id="email"
                           placeholder="Type E-Mail" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Create">
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
