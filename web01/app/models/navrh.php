<?php
//instrukce pro praci s databazi - ukladani
class navrh {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($kategory, $theme, $email) {
        
        // Dvojtečka označuje pojmenovaný parametr => Místo přímých hodnot se používají placeholdery.
        // PDO je pak nahradí skutečnými hodnotami při volání metody execute().
        // Chrání proti SQL injekci (bezpečnější než přímé vložení hodnot).
        $sql = "INSERT INTO du (kategory, theme, email) 
                VALUES (:kategory, :theme, :email)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':kategory' => $kategory,
            ':theme' => $theme,
            ':email' => $email,
            
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM du ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM du WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $theme, $kategory, $email) {
        $sql = "UPDATE du 
                SET theme = :theme,
                    kategory = :kategory,
                    email = :email,
                WHERE id = :id";
    
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':theme' => $theme,
            ':kategory' => $kategory,
            ':email' => $email,
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM du WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}