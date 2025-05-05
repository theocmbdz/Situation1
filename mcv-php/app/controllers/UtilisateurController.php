<?php
include_once '../models/Utilisateur.php';

class UtilisateurController {
    private $utilisateurModel;

    public function __construct($database) {
        // Instancie le modèle avec la connexion à la base de données
        $this->utilisateurModel = new Utilisateur($database);
    }



    public function generateXMLForUsers() {
        // Définir le chemin du répertoire où vous souhaitez sauvegarder les fichiers XML
        $directory = '../../generated_files'; // Relatif à votre fichier PHP actuel
    
        // Vérifier si le répertoire existe, sinon, le créer avec les permissions appropriées
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true); // Crée le répertoire avec les permissions en lecture, écriture, et exécution pour tous
        }
    
        // Fetch all users who need to be included in the XML
        $utilisateurs = $this->getNPUtilisateurs();
    
        // Create a new DOMDocument object
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
    
        // Create the root element
        $root = $dom->createElement('utilisateurs');
        $dom->appendChild($root);
    
        // Loop through the utilisateurs and add them to the XML
        foreach ($utilisateurs as $utilisateur) {
            $userElement = $dom->createElement('utilisateur');
            
            // Add user details as child elements
            $userElement->appendChild($dom->createElement('id', $utilisateur['utilisateur_id']));
            $userElement->appendChild($dom->createElement('nom', $utilisateur['nom']));
            $userElement->appendChild($dom->createElement('prenom', $utilisateur['prenom']));
            $userElement->appendChild($dom->createElement('email', $utilisateur['email']));
            $userElement->appendChild($dom->createElement('date_creation', $utilisateur['date_creation']));
    
            $root->appendChild($userElement);
        }
    
        // Save the XML to a file
        $filePath = $directory . '/utilisateurs_' . date('Y-m-d') . '.xml';
        $dom->save($filePath);
    
        // Provide the file to the user for download
        header('Content-Type: text/xml');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);
    
        // Exit to stop further processing
        exit;
    }


    // Récupérer tous les utilisateurs
    public function getAllUtilisateurs() {
        try {
            return $this->utilisateurModel->getAllUtilisateurs();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return [];
        }
    }


    
    public function getNPUtilisateurs() {
        try {
            // Exemple d'une structure correcte retournée
            $utilisateurs = $this->utilisateurModel->getNPUtilisateurs();
            if (empty($utilisateurs)) {
                throw new Exception("Aucun utilisateur trouvé.");
            }
            return $utilisateurs;
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return [];
        }
    }

    // Ajouter un nouvel utilisateur
    public function addUtilisateur() {
        try {
            $nom = $_POST['nom'] ?? null;
            $prenom = $_POST['prenom'] ?? null;
            $structure_id = $_POST['structure_id'] ?? null;
            $structure_nom = $_POST['structure_nom'] ?? null;
            $structure_adresse = $_POST['structure_adresse'] ?? null;
            $mail = $_POST['mail'] ?? null;

            if (empty($nom) || empty($prenom) || empty($structure_id) || empty($mail)) {
                throw new Exception('Tous les champs requis doivent être remplis.');
            }

            $this->utilisateurModel->addUtilisateur($nom, $prenom, $structure_id, $structure_nom, $structure_adresse, $mail);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Mettre à jour un utilisateur existant
    public function updateUtilisateur() {
        try {
            $id = $_POST['id'] ?? null;
            $nom = $_POST['nom'] ?? null;
            $prenom = $_POST['prenom'] ?? null;
            $structure_id = $_POST['structure_id'] ?? null;
            $structure_nom = $_POST['structure_nom'] ?? null;
            $structure_adresse = $_POST['structure_adresse'] ?? null;
            $mail = $_POST['mail'] ?? null;
    
            if (!is_numeric($id)) {
                throw new Exception('ID invalide.');
            }
    
            if (empty($nom) || empty($prenom) || empty($structure_id) || empty($mail)) {
                throw new Exception('Tous les champs requis doivent être remplis.');
            }
    
            // Log temporaire
            error_log("Modification utilisateur : ID = $id, Nom = $nom, Prénom = $prenom");
    
            $this->utilisateurModel->updateUtilisateur($id, $nom, $prenom, $structure_id, $structure_nom, $structure_adresse, $mail);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    // Supprimer un utilisateur
    public function deleteUtilisateur() {
        try {
            $id = $_POST['id'] ?? null;

            if (!is_numeric($id)) {
                throw new Exception('ID invalide.');
            }

            $this->utilisateurModel->deleteUtilisateur($id);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
?>
