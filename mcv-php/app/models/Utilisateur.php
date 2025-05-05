<?php
class Utilisateur {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($database) {
        $this->db = $database;
    }

    // Récupérer tous les utilisateurs
    public function getAllUtilisateurs() {
        // Requête SQL pour sélectionner tous les utilisateurs
        $sql = "SELECT * FROM utilisateur";
        $query = $this->db->query($sql);
        // Retourner tous les résultats sous forme de tableau associatif
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNPUtilisateurs() {
        $sql = "SELECT utilisateur_id, nom, prenom FROM utilisateur";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Assurez-vous d'utiliser FETCH_ASSOC
    }
    


    // Récupérer un utilisateur par son ID
    public function getUtilisateurById($id) {
        // Requête SQL pour sélectionner un utilisateur spécifique par son ID
        $sql = "SELECT * FROM utilisateur WHERE utilisateur_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        // Retourner le résultat sous forme de tableau associatif
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouvel utilisateur
    public function addUtilisateur($nom, $prenom, $structure_id, $structure_nom, $structure_adresse, $mail) {
        // Requête SQL pour insérer un nouvel utilisateur dans la base de données
        $sql = "INSERT INTO utilisateur (nom, prenom, structure_id, structure_nom, structure_adresse, mail) 
                VALUES (:nom, :prenom, :structure_id, :structure_nom, :structure_adresse, :mail)";
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête avec les valeurs passées en paramètres
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':structure_id' => $structure_id,
            ':structure_nom' => $structure_nom,
            ':structure_adresse' => $structure_adresse,
            ':mail' => $mail
        ]);
    }

    // Mettre à jour un utilisateur existant
    public function updateUtilisateur($id, $nom, $prenom, $structure_id, $structure_nom, $structure_adresse, $mail) {
        // Requête SQL pour mettre à jour les informations d'un utilisateur
        $sql = "UPDATE utilisateur 
                SET nom = :nom, prenom = :prenom, structure_id = :structure_id, 
                    structure_nom = :structure_nom, structure_adresse = :structure_adresse, mail = :mail 
                WHERE utilisateur_id = :id";
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête avec les nouvelles valeurs
        $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':structure_id' => $structure_id,
            ':structure_nom' => $structure_nom,
            ':structure_adresse' => $structure_adresse,
            ':mail' => $mail
        ]);
    }

    // Supprimer un utilisateur
    public function deleteUtilisateur($id) {
        // Requête SQL pour supprimer un utilisateur par son ID
        $sql = "DELETE FROM utilisateur WHERE utilisateur_id = :id";
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête pour supprimer l'utilisateur
        $stmt->execute([':id' => $id]);
    }

}

?>