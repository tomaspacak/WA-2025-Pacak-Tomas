<?php
require_once '../models/database.php';
require_once '../models/navrh.php';

class navrhController {
    private $db;
    private $navrhModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->navrhModel = new navrh($this->db);
    }

    public function createBook() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kategory = htmlspecialchars($_POST['kategory']);
            $theme = htmlspecialchars($_POST['theme']);
            $email = htmlspecialchars($_POST['email']);
            

            // Zpracování nahraných obrázků
            /*$imagePaths = [];
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
            if ($this->navrhModel->create($kategory, $theme, $email)) {
                header("Location: /WA-2025-Pacak-Tomas/web01/app/views/navrhy/navrh_create.php");
                exit();
            
            } else {
                echo "Chyba při ukládání knihy.";
            }

            if ($this->navrhModel->create($kategory, $theme, $email)) {
               /* header("Location: /03-php-projekt/web01/app/views/navrhy/navrh_create.php");
                header("Location: ../controllers/navrh_list.php");*/
                //header("Location: ../views/navrh_create.php");
                exit();
            } else {
                echo "Chyba při ukládání knihy.";
            }
        }
    }
}

// Volání metody při odeslání formuláře
$controller = new navrhController();
$controller->createBook();