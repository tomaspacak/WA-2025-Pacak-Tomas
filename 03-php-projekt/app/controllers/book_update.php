
<?php
    require_once '../models/Database.php';
    require_once '../models/Book.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        die('Nepřihlášený uživatel.');
    }

    $currentUserId = $_SESSION['user_id'];
    $isAdmin = ($_SESSION['role'] ?? '') === 'admin';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = (int)$_POST['id'];

        $db = (new Database())->getConnection();
        $bookModel = new Book($db);
        $book = $bookModel->getById($id); // Načtení knihy

        // Kontrola oprávnění
        $ownsBook = $currentUserId == $book['user_id'];
        if (!$isAdmin && !$ownsBook) {
            die("Nemáte oprávnění upravovat tuto knihu.");
        }

        $title = htmlspecialchars($_POST['title']);
        $author = htmlspecialchars($_POST['author']);
        $category = htmlspecialchars($_POST['category']);
        $subcategory = !empty($_POST['subcategory']) ? htmlspecialchars($_POST['subcategory']) : null;
        $year = intval($_POST['year']);
        $price = floatval($_POST['price']);
        $isbn = htmlspecialchars($_POST['isbn']);
        $description = htmlspecialchars($_POST['description']);
        $link = htmlspecialchars($_POST['link']);

        

        //aktualizace
        $success = $bookModel->update(
            $id,
            $title,
            $author,
            $category,
            $subcategory,
            $year,
            $price,
            $isbn,
            $description,
            $link
        );

        if ($success) {
            header("Location: ../views/books/books_edit_delete.php");
            exit();
        } else {
            echo "Chyba při aktualizaci knihy.";
        }
    } else {
        echo "Neplatný požadavek.";
    }