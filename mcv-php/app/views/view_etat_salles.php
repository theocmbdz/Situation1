<?php
session_start();

if($_SESSION['ok']!="oui"){
    header("Location: ../routing/index.php");
}
else{
    if($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "responsable" && $_SESSION['role'] !== "secretariat"){
        header("Location: accueil.php");
    }
}
?>

<?php       
include_once '../controllers/EtatSallesController.php';
include_once '../config/connexion.php';
include_once '../models/Salle.php';

// Initialiser le modèle de réservation
$etatSallesModel = new Salle($connexion);

// Récupérer toutes les réservations
$etatSalles = $etatSallesModel->getEtatSalles();

?>


    <?php include_once '../includes/header.php'; ?>

   <!-- Main Content -->
   <main class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-orange-600 mb-8 text-center">Liste Etats des Salles</h1>

        <!-- Tableau des états des salles -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full border-collapse border border-gray-200 rounded-lg">
                <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">Id</th>
                        <th class="py-3 px-6 text-left">Nom Salle</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Libellé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etatSalles as $etatsSalles): ?>
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="py-3 px-6"><?php echo htmlspecialchars($etatsSalles['salle_id']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($etatsSalles['salle_nom']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($etatsSalles['date']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($etatsSalles['statusReservation']); ?></td> 
                        <td class="py-3 px-6"><?php echo htmlspecialchars($etatsSalles['libelle']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>
</html>
