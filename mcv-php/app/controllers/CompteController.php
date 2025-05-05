<?php
class CompteController {
    private $compteModel;

    // Constructeur pour initialiser le modèle Compte
    public function __construct($database) {
        $this->compteModel = new Compte($database);
    }

    // Récupérer tous les comptes
    public function getAllComptes() {
        try {
            return $this->compteModel->getAllComptes();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des comptes : " . $e->getMessage());
        }
    }

    // Ajouter un compte
    public function addCompte() {
        try {
            $id_login = $_POST['id_login'] ?? '';
            $mdp = $_POST['mdp'] ?? '';
            $utilisateur_id = $_POST['utilisateur_id'] ?? '';
            $statut = $_POST['statut'] ?? '';

            if (empty($id_login) || empty($mdp) || empty($utilisateur_id) || empty($statut)) {
                throw new Exception("Tous les champs sont obligatoires.");
            }

            $hashedMdp = password_hash($mdp, PASSWORD_BCRYPT); // Hachage du mot de passe
            $this->compteModel->addCompte($id_login, $hashedMdp, $utilisateur_id, $statut);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du compte : " . $e->getMessage());
        }
    }

    public function updateCompte() {
        try {
            $id_login = $_POST['id_login'] ?? '';
            $utilisateur_id = $_POST['utilisateur_id'] ?? '';
            $statut = $_POST['statut'] ?? '';
    
            if (empty($id_login) || empty($utilisateur_id) || empty($statut)) {
                throw new Exception("Les champs Nom d'utilisateur, ID Utilisateur, et Statut sont obligatoires.");
            }

            // Appeler le modèle pour mettre à jour
            $this->compteModel->updateCompte($id_login, $utilisateur_id, $statut);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour du compte : " . $e->getMessage());
        }
    }
    

    // Supprimer un compte
    public function deleteCompte() {
        try {
            $id_login = $_POST['id_login'] ?? '';

            if (empty($id_login)) {
                throw new Exception("Nom d'utilisateur manquant pour la suppression.");
            }

            $this->compteModel->deleteCompte($id_login);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du compte : " . $e->getMessage());
        }
    }
}
?>
