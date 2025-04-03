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
}