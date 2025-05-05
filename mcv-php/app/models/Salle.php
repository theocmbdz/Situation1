<?php
class Salle {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Récupérer toutes les salles
    public function getAllSalles() {
        $sql = "SELECT * FROM salle";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtatSalles() {
        $sql = "SELECT salle_id, salle_nom, date, statusReservation, libelle FROM salle s, reservation r,categorie_salle c WHERE s.categorie = c.id AND s.id = r.salle_id AND r.date=DATE_FORMAT(NOW(), '%Y/%m/%d') AND (statusReservation LIKE ('Confirmé') OR statusReservation ='Provisoire');";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    // Récupérer une salle par son ID
    public function getSalleById($id) {
        $sql = "SELECT * FROM salle WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter une nouvelle salle
    public function addSalle($salle_nom, $categorie) {
        $sql = "INSERT INTO salle (salle_nom, categorie) VALUES (:salle_nom, :categorie)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':salle_nom' => $salle_nom,
            ':categorie' => $categorie
        ]);
    }

    // Mettre à jour une salle existante
    public function updateSalle($id, $salle_nom, $categorie) {
        $sql = "UPDATE salle SET salle_nom = :salle_nom, categorie = :categorie WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':salle_nom' => $salle_nom,
            ':categorie' => $categorie
        ]);
    }

    // Supprimer une salle
    public function deleteSalle($id) {
        $sql = "DELETE FROM salle WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}

?>