
<?php
    require_once '../models/Database.php';
    require_once '../models/navrh.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = (int)$_POST['id'];
        $theme = htmlspecialchars($_POST['theme']);
        $kategory = htmlspecialchars($_POST['kategory']);
        $email = htmlspecialchars($_POST['email']);
        

        $db = (new Database())->getConnection();
        $navrhModel = new navrh($db);

        //lets go
        $success = $navrhModel->update(
        $id,
        $theme,
        $kategory,
        $email,
        );

        if ($success) {
            header("Location: ../views/navrhy/navrhy_edit_delete.php");
            exit();
        } else {
            echo "Chyba při aktualizaci knihy.";
        }
    } else {
        echo "Neplatný požadavek.";
    }