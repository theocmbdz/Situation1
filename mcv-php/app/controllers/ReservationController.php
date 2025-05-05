<?php
include_once '../config/connexion.php';
include_once '../models/Reservation.php';



class ReservationController {
    private $reservationModel;
    private $db;

    public function __construct($database) {
        // Instancie le modèle Reservation avec la connexion à la base de données
        $this->reservationModel = new Reservation($database);
    }



    public function generateXMLForValidReservationsWeek() {
        // Définir le chemin du répertoire où vous souhaitez sauvegarder les fichiers XML
        $directory = __DIR__ . '/../generated_files'; // Utilisez __DIR__ pour un chemin absolu.
    
        // Vérifier si le répertoire existe, sinon, essayer de le créer
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true)) {
                die('Erreur : Impossible de créer le répertoire ' . $directory);
            }
        }
    
        // Récupérer les réservations validées de la semaine
        $reservations = $this->reservationModel->getValidReservationsForWeek();
    
        // Vérifier si des réservations existent
        if (empty($reservations)) {
            die('Aucune réservation trouvée pour générer le fichier XML.');
        }
    
        // Créer un objet DOMDocument
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
    
        // Créer l'élément racine
        $root = $dom->createElement('reservations');
        $dom->appendChild($root);
    
        // Ajouter chaque réservation validée à l'XML
        foreach ($reservations as $reservation) {
            $reservationElement = $dom->createElement('reservation');
            
            // Ajouter les détails de la réservation comme des éléments enfants
            $reservationElement->appendChild($dom->createElement('id', $reservation['id']));
            $reservationElement->appendChild($dom->createElement('utilisateur_id', $reservation['utilisateur_id']));
            $reservationElement->appendChild($dom->createElement('salle_id', $reservation['salle_id']));
            $reservationElement->appendChild($dom->createElement('date', $reservation['date']));
            $reservationElement->appendChild($dom->createElement('periode', $reservation['periode']));
            $reservationElement->appendChild($dom->createElement('statutReservation', $reservation['statutReservation']));
    
            $root->appendChild($reservationElement);
        }
    
        // Sauvegarder le fichier XML
        $filePath = $directory . '/reservations_valides_semaine_' . date('Y-m-d') . '.xml';
        $dom->save($filePath);
    
        // Fournir le fichier à l'utilisateur pour téléchargement
        header('Content-Type: text/xml');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);
    
        // Quitter pour arrêter le traitement ultérieur
        exit;
    }
    


    // Récupère toutes les réservations
    public function getAllReservations() {
        try {
            $reservations = $this->reservationModel->getAllReservations();
            return $reservations;

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return [];
        }
    }

    // Récupère une réservation par ID
    public function getReservationById($id) {
        try {
            if (!is_numeric($id)) {
                throw new Exception('Invalid reservation ID');
            }

            $reservation = $this->reservationModel->getReservationById($id);
            if ($reservation) {
                echo json_encode(['status' => 'success', 'data' => $reservation]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Reservation not found']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Ajouter une nouvelle réservation
    public function addReservation() {
        try {
            $utilisateur_id = $_SESSION['utilisateur_id'] ?? null;
            $salle_id = $_POST['salle_id'] ?? null;
            $date = $_POST['date'] ?? null;
            $periode = $_POST['periode'] ?? null;

            if (empty($utilisateur_id) || empty($salle_id) || empty($date) || empty($periode)) {
                throw new Exception('All fields are required');
            }

            $this->reservationModel->addReservation($utilisateur_id, $salle_id, $date, $periode);
            echo json_encode(['status' => 'success', 'message' => 'Reservation added successfully']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Mettre à jour une réservation existante
    /*public function updateReservation($id) {
        try {
            $statusReservation = $_POST['statusReservation'] ?? null;

            if (!is_numeric($id)) {
                throw new Exception('Invalid reservation ID');
            }
            if (empty($statusReservation)) {
                throw new Exception('All fields are required');
            }

            $this->reservationModel->updateReservation($id, $statusReservation);
            echo json_encode(['status' => 'success', 'message' => 'Reservation updated successfully']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }*/

    // Supprimer une réservation
    public function deleteReservation($id) {
        try {
            if (!is_numeric($id)) {
                throw new Exception('Invalid reservation ID');
            }

            $this->reservationModel->deleteReservation($id);
            echo json_encode(['status' => 'success', 'message' => 'Reservation deleted successfully']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function validerReservation($id) {
        try {
            $this->reservationModel->validerReservation($id);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    public function annulerReservation($id) {
        try {
            $this->reservationModel->annulerReservation($id);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}

?>
