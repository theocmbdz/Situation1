<?php
class Reservation {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Récupérer toutes les réservations
    public function getAllReservations() {
        $sql = "SELECT reservation.id, reservation.utilisateur_id, reservation.salle_id, reservation.date, reservation.periode, reservation.statusReservation, utilisateur.utilisateur_id, utilisateur.nom, utilisateur.prenom, salle.id AS salleId, salle.salle_nom FROM reservation, utilisateur,salle WHERE utilisateur.utilisateur_id=reservation.utilisateur_id AND reservation.salle_id=salle.id ORDER BY date DESC";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une réservation par son ID
    public function getReservationById($id) {
        $sql = "SELECT * FROM reservation WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter une nouvelle réservation
    public function addReservation($utilisateur_id, $salle_id, $date, $periode) {
        $sql = "INSERT INTO reservation (utilisateur_id, salle_id, date, periode) VALUES (:utilisateur_id, :salle_id, :date, :periode)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $utilisateur_id,
            ':salle_id' => $salle_id,
            ':date' => $date,
            ':periode' => $periode
        ]);
    }
/*
    // Mettre à jour une réservation existante
    public function updateReservation($id, $utilisateur_id, $salle_id, $date, $periode) {
        $sql = "UPDATE reservation SET statusReservation = :statusReservation WHERE id = :id AND statusReservation = 'Confirmé' OR statusReservation = 'Annulé'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':statusReservation' => $statusReservation,
        ]);
    }
*/
    // Supprimer une réservation
    public function deleteReservation($id) {
        $sql = "DELETE FROM reservation WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

// Valider une réservation
public function validerReservation($id) {
    $sql = "UPDATE reservation SET statusReservation = 'Confirmé' WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute([':id' => $id]);
}

// Annuler une réservation
public function annulerReservation($id) {
    $sql = "UPDATE reservation SET statusReservation = 'Annulé' WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute([':id' => $id]);

}
}

?>