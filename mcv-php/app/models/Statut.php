<?php
class Statut {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Récupérer tous les statuts
    public function getAllStatuts() {
        $sql = "SELECT * FROM statut";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un statut par son ID
    public function getStatutById($id) {
        $sql = "SELECT * FROM statut WHERE TypeStatut = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouveau statut
    public function addStatut($libelleStatut) {
        $sql = "INSERT INTO statut (libelleStatut) VALUES (:libelleStatut)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':libelleStatut' => $libelleStatut]);
    }

    // Mettre à jour un statut existant
    public function updateStatut($id, $libelleStatut) {
        $sql = "UPDATE statut SET libelleStatut = :libelleStatut WHERE TypeStatut = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':libelleStatut' => $libelleStatut
        ]);
    }

    // Supprimer un statut
    public function deleteStatut($id) {
        $sql = "DELETE FROM statut WHERE TypeStatut = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
