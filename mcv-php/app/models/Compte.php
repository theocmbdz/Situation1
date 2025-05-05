<?php
class Compte {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Récupérer tous les comptes
    public function getAllComptes() {
        $sql = "SELECT * FROM compte";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un compte par son login
    public function getCompteByLogin($id_login) {
        $sql = "SELECT * FROM compte WHERE id_login = :id_login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_login' => $id_login]);
        $compte = $stmt->fetch();

        //print_r($stmt);
        return $compte["id_login"];
    }

    // Ajouter un nouveau compte
    public function addCompte($id_login, $mdp, $utilisateur_id, $statut) {
        $sql = "INSERT INTO compte (id_login, mdp, utilisateur_id, statut) VALUES (:id_login, :mdp, :utilisateur_id, :statut)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_login' => $id_login,
            ':mdp' => $mdp,
            ':utilisateur_id' => $utilisateur_id,
            ':statut' => $statut
        ]);
    }

    // Mettre à jour un compte existant
    public function updateCompte($id_login, $utilisateur_id, $statut) {
        $sql = "UPDATE compte SET utilisateur_id = :utilisateur_id, statut = :statut WHERE id_login = :id_login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_login' => $id_login,
            ':utilisateur_id' => $utilisateur_id,
            ':statut' => $statut
        ]);
    }

    // Supprimer un compte
    public function deleteCompte($id_login) {
        $sql = "DELETE FROM compte WHERE id_login = :id_login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_login' => $id_login]);
    }
}

?>
