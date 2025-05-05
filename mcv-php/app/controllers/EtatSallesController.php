<?php
include_once '../config/connexion.php';
include_once '../models/Salle.php';


class EtatSallesController {
    private $etatSallesModel;



public function __construct($database){
    $this->etatSallesModel = new Salle ($database);
}


    // Récupère toutes les etats des salles
    public function getEtatSalles() {
        try {
            $etatSalles = $this->etatSallesModel->getEtatSalles();
            return $etatSalles;

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return [];
        }
    }

}

?>