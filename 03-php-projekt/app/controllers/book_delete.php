
<?php
    require_once '../models/Database.php';
    require_once '../models/Book.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        die('Nepřihlášený uživatel.');
    }

    $currentUserId = $_SESSION['user_id'];
    $isAdmin = ($_SESSION['role'] ?? '') === 'admin';


    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        $db = (new Database())->getConnection();
        $bookModel = new Book($db);
        $book = $bookModel->getById($id);
        $ownsBook = $currentUserId == $book['user_id'];
        if (!$isAdmin && !$ownsBook) {
            die("Nemáte oprávnění smazat tuto knihu.");
        }

        if ($bookModel->delete($id)) {
            header("Location: ../views/books/books_edit_delete.php");
            exit();
        } else {
            echo "Chyba při mazání knihy.";
        }
    } else {
        echo "Neplatný požadavek.";
    }