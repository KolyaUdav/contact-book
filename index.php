<?php
    require_once 'Handlers/DataHandler.php';
    require_once 'util/check_token.php';
    require_once 'util/add_chosen_contact.php';
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
    <title>Contact Book</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Contact Book</a>
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

    <div class="list-group">
        <?php
        $handler = new DataHandler();
        $conn = $handler->getConnect();

        $contactsResult = $handler->getDataFromDB(
            $conn,
            'SELECT id, firstname, lastname, phone_number, email FROM contacts', array());

        if (count($contactsResult) == 0) {
            print '<h1 class="mt-3">Список контактов пуст</h1>';
            return;
        }

        $userContactsResult = $handler->getDataFromDB($conn,
            'SELECT * FROM users_contacts WHERE user_id = :user_id',
                    array('user_id' => $_SESSION['user_id']));

        foreach ($contactsResult as $contact) {
            $addButton = '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">
                            <input type="hidden" name="contact_id" value="'.$contact['id'].'">
                            <input type="submit" class="btn btn-sm btn-success" value="Add">
                           </form>';

            foreach ($userContactsResult as $ucResult) {
                if (array_search($contact['id'], $ucResult)) {
                    $addButton = null;
                    break;
                }
            }

            print
            '<div class="list-group-item">'
                .'<div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">'.$contact['firstname'].' '.$contact['lastname'].'</h5>'
                .'</div>'
                .'<p class="mb-1">'.$contact['phone_number'].'</p>'
                .'<p class="mb-1">'.($contact['email'] != null ? $contact['email'] : null).'</p>'
                .$addButton
            .'</div>';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="js/alert.js"></script>
</body>
</html>
