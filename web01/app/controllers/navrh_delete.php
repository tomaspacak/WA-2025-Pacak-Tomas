
<?php
    require_once '../models/Database.php';
    require_once '../models/navrh.php';

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        $db = (new Database())->getConnection();
        $navrhModel = new navrh($db);

        if ($navrhModel->delete($id)) {
            header("Location: ../views/navrhy/navrhy_edit_delete.php");
            exit();
        } else {
            echo "Chyba při mazání knihy.";
        }
    } else {
        echo "Neplatný požadavek.";
    }