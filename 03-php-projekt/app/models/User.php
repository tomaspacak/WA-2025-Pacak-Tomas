<?php


class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function existsByUsername($username) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }

    public function register($username, $email, $password_hash, $name = null, $surname = null) {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password_hash, name, surname)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$username, $email, $password_hash, $name, $surname]);
    }

    //login
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

/*class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($username, $email, $name, $surname, $password_hash) {
        
        // Dvojtečka označuje pojmenovaný parametr => Místo přímých hodnot se používají placeholdery.
        // PDO je pak nahradí skutečnými hodnotami při volání metody execute().
        // Chrání proti SQL injekci (bezpečnější než přímé vložení hodnot).
        $sql = "INSERT INTO users (username, email, name, surname, password_hash) 
                VALUES (:username, :email, :name, :surname, :password_hash)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email ?: null,
            ':name' => $name ?: null,
            ':surname' => $surname ?: null,
            ':password' => $password,
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //edit
    /*public function getById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/

    //nahrani novych dat
    /*public function update($id, $username, $email, $name, $surname, $password_hash) {
        $sql = "UPDATE users 
                SET username = :username,
                    email = :email,
                    name = :name,
                    surname = :surname,
                    password = :password,
                WHERE id = :id";
    
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':email' => $email,
            ':username' => $username,
            ':name' => $name,
            ':surname' => $surname,
            ':password' => $password,
        ]);
    }

   /* public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }*/

    

/*}   */
