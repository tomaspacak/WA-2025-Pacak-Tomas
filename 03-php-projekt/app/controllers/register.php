<?php
require_once '../models/Database.php';
require_once '../models/User.php';

class UserController {
    private $db;
    private $registerModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->registerModel = new User($this->db);
    }

    public function createUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $name = htmlspecialchars($_POST['name']);
            $surname = !empty($_POST['surname']) ? htmlspecialchars($_POST['surname']) : null;
            $password_hash = intval($_POST['password_hash']);
           

            // Zpracování nahraných obrázků
           /* $imagePaths = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/images/';
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $filename = basename($_FILES['images']['name'][$key]);
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($tmp_name, $targetPath)) {
                        $imagePaths[] = '/public/images/' . $filename; // Relativní cesta
                    }
                }
            }*/

            // Uložení knihy do DB
            // if ($this->bookModel->create($title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $imagePaths)) {
            //     header("Location: /public/books_list.php");
            //     exit();
            // } else {
            //     echo "Chyba při ukládání knihy.";
            // }

            // Uložení knihy do DB - dočasné řešení, než budeme mít výpis knih
            if ($this->registerModel->create($username, $email, $name, $surname, $password_hash)) {
                //header("Location: /03-php-projekt/app/views/books/book_create.php");
                header("Location: ../controllers/login.php");
                exit();
            } else {
                echo "Chyba při ukládání knihy.";
            }
        }
    }

    public function listUsers () {
        $users = $this->usersModel->getAll();
        //include '../views/auth/book_list.php';
    }
}

// Volání metody při odeslání formuláře
$controller = new UserController();
$controller->createUser();