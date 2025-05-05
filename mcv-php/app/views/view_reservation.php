<?php
session_start();

if ($_SESSION['ok'] != "oui") {
    header("Location: ../routing/index.php");
}
else{
    if($_SESSION['role'] !== "utilisateur" && $_SESSION['role'] !== "responsable" && $_SESSION['role'] !== "secretariat"){
        header("Location: accueil.php");
    }
}
?>

<?php
include_once '../controllers/ReservationController.php';
include_once '../config/connexion.php';
include_once '../models/Reservation.php';
include_once '../includes/header.php';
?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-orange-600 mb-8 text-center">Gestion des Réservations</h1>

    <?php
    switch ($_SESSION["role"]) {
        case "utilisateur":
            echo "<h2 class='text-2xl font-bold text-gray-700 mb-6'>Vos Réservations</h2>";

            $reservationModel = new Reservation($connexion);
            $reservations = $reservationModel->getAllReservations();
    ?>
            <section class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Utilisateur</th>
                            <th class="py-3 px-6 text-left">Salle</th>
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Période</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reservations as $reservation): 
                            if($reservation['statusReservation']!="Annulé"){
                            ?>
                            <tr class="border-b hover:bg-gray-100 transition">
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['id']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['nom'])." ".htmlspecialchars($reservation['prenom']);?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['salle_nom']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['date']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['periode']); ?></td>
                            </tr>
                        <?php 
                            }
                        endforeach; 
                        ?>
                    </tbody>
                </table>
            </section>
    <?php
            break;

        case "responsable":
            $reservationController = new ReservationController($connexion);
            $reservations = $reservationController->getAllReservations();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['action'])) {
                    if ($_POST['action'] == 'add') {
                        $reservationController->addReservation();
                        header("Location: view_reservation.php");
                        exit;
                    }
                }
            }
    ?>
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-orange-500 mb-6">Ajouter une Réservation</h2>
                <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white shadow-md rounded-lg p-6">
                    <input type="text" name="utilisateur_id" value="<?php echo $_SESSION['user_id']; ?>" placeholder="ID Utilisateur" min="1" readonly class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500"> 
                    <input type="number" name="salle_id" placeholder="ID Salle" min="1" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <input type="date" name="date" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500" min="<?= date('Y-m-d'); ?>">
                    <input type="text" name="periode" placeholder="Période" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="col-span-1 md:col-span-2 bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                        Ajouter
                    </button>
                </form>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-orange-500 mb-6">Liste des Réservations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Utilisateur</th>
                                <th class="py-3 px-6 text-left">Salle</th>
                                <th class="py-3 px-6 text-left">Date</th>
                                <th class="py-3 px-6 text-left">Période</th>
                                <th class="py-3 px-6 text-left">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr class="border-b hover:bg-gray-100 transition">
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['id']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['nom'])." ".htmlspecialchars($reservation['prenom']);?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['salle_nom']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['date']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['periode']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['statusReservation']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <?php break; ?>

        <?php
        case "secretariat":
            $reservationController = new ReservationController($connexion);
            $reservations = $reservationController->getAllReservations();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['action'])) {
                    if ($_POST['action'] == 'add') {
                        $reservationController->addReservation();
                        header("Location: view_reservation.php");
                        exit;
                    } elseif ($_POST['action'] == 'valider') {
                        $reservationController->validerReservation($_POST['id']);
                        header("Location: view_reservation.php");
                        exit;
                    } elseif ($_POST['action'] == 'annuler') {
                        $reservationController->annulerReservation($_POST['id']);
                        header("Location: view_reservation.php");
                        exit;
                    }
                }
            }
    ?>
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-orange-500 mb-6">Ajouter une Réservation</h2>
                <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white shadow-md rounded-lg p-6">
                    <input type="number" name="utilisateur_id" placeholder="ID Utilisateur" min="1" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <input type="number" name="salle_id" placeholder="ID Salle" min="1" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <input type="date" name="date" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500" min="<?= date('Y-m-d'); ?>">
                    <input type="text" name="periode" placeholder="Période" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="col-span-1 md:col-span-2 bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                        Ajouter
                    </button>
                </form>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-orange-500 mb-6">Liste des Réservations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Utilisateur</th>
                                <th class="py-3 px-6 text-left">Salle</th>
                                <th class="py-3 px-6 text-left">Date</th>
                                <th class="py-3 px-6 text-left">Période</th>
                                <th class="py-3 px-6 text-left">Statut</th>
                                <th class="py-3 px-6 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr class="border-b hover:bg-gray-100 transition">
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['id']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['nom'])." ".htmlspecialchars($reservation['prenom']);?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['salle_nom']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['date']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['periode']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($reservation['statusReservation']); ?></td>
                                    <td class="py-3 px-6 flex items-center space-x-2">
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                            <input type="hidden" name="action" value="valider">
                                            <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded-lg hover:bg-green-600 transition">
                                                Confirmé
                                            </button>
                                        </form>
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                            <input type="hidden" name="action" value="annuler">
                                            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600 transition">
                                                Annulé
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
    <?php
            break;
    }
    ?>
</main>

<?php include_once '../includes/footer.php'; ?>
