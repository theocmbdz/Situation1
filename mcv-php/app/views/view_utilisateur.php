<?php
session_start();

if ($_SESSION['ok'] != "oui") {
    header("Location: ../../routing/index.php");
}
else{
    if($_SESSION['role'] !== "admin"){
        header("Location: accueil.php");
    }
}

include_once '../controllers/CompteController.php';
include_once '../config/connexion.php';
include_once '../models/Compte.php';
include_once '../includes/header.php';
include_once '../controllers/UtilisateurController.php';


// Initialisation du contrôleur des comptes
$compteController = new CompteController($connexion);
$comptes = $compteController->getAllComptes();

$utilisateursControlleur = new UtilisateurController($connexion);
$utilisateurs = $utilisateursControlleur->getNPUtilisateurs();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'generate_xml') {
            // Call the generateXMLForUsers method
            $utilisateursControlleur->generateXMLForUsers();
            exit;
        }
        // Ajout d'un compte
        if ($action == 'add_compte') {
            $id_login = $_POST['id_login'];
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hash du mot de passe
            $utilisateur_id = $_POST['utilisateur_id'];
            $statut = $_POST['statut'];

            $compteController->addCompte($id_login, $mdp, $utilisateur_id, $statut);
            header("Location: view_utilisateur.php");
            exit;

            // Mise à jour d'un compte
        } elseif ($action == 'update_compte') {
            $id_login = $_POST['id_login'];
            $utilisateur_id = $_POST['utilisateur_id'];
            $statut = $_POST['statut'];

            $compteController->updateCompte($id_login, $utilisateur_id, $statut);
            header("Location: view_utilisateur.php");
            exit;

            // Suppression d'un compte
        } elseif ($action == 'delete_compte') {
            $id_login = $_POST['id_login'];

            $compteController->deleteCompte($id_login);
            header("Location: view_utilisateur.php");
            exit;
        }
    }
}



?>





    <!-- Header -->
    <?php include_once '../includes/header.php'; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-orange-600 mb-8 text-center">Gestion des Comptes</h1>

        <!-- Formulaire pour ajouter un compte -->
        <section class="bg-white shadow-md rounded-lg p-6 mb-12">
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Ajouter un Compte</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <input type="text" name="id_login" placeholder="Nom d'utilisateur" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="password" name="mdp" placeholder="Mot de passe" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <select name="utilisateur_id" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">-- Associer à un utilisateur --</option>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                        <option value="<?php echo $utilisateur['utilisateur_id']; ?>">
                            <?php echo $utilisateur['nom'] . " " . $utilisateur['prenom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="statut" required class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">-- Sélectionner un statut --</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Secrétariat</option>
                    <option value="3">Responsable</option>
                    <option value="4">Utilisateur</option>
                </select>
                <input type="hidden" name="action" value="add_compte">
                <button type="submit" class="col-span-1 md:col-span-2 lg:col-span-3 bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 transition">
                    Ajouter
                </button>
            </form>
        </section>

        <!-- Liste des Comptes -->
        <section>
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Liste des Comptes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg overflow-hidden">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">Nom d'utilisateur</th>
                            <th class="py-3 px-6 text-left">Utilisateur</th>
                            <th class="py-3 px-6 text-left">Statut</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comptes as $compte): ?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <!-- Formulaire de modification -->
                            <form method="POST">
                                <td class="py-3 px-6">
                                    <input type="text" name="id_login" value="<?php echo htmlspecialchars($compte['id_login']); ?>" readonly class="bg-gray-100 border rounded-lg p-2 w-full">
                                </td>
                                <td class="py-3 px-6">
                                    <select name="utilisateur_id" required class="border rounded-lg p-2 w-full">
                                        <?php foreach ($utilisateurs as $utilisateur): ?>
                                            <option value="<?php echo $utilisateur['utilisateur_id']; ?>"
                                                <?php echo ($utilisateur['utilisateur_id'] == $compte['utilisateur_id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($utilisateur['nom']) . " " . htmlspecialchars($utilisateur['prenom']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td class="py-3 px-6">
                                    <select name="statut" required class="border rounded-lg p-2 w-full">
                                        <option value="1" <?php echo ($compte['statut'] == '1') ? 'selected' : ''; ?>>Administrateur</option>
                                        <option value="2" <?php echo ($compte['statut'] == '2') ? 'selected' : ''; ?>>Secrétariat</option>
                                        <option value="3" <?php echo ($compte['statut'] == '3') ? 'selected' : ''; ?>>Responsable</option>
                                        <option value="4" <?php echo ($compte['statut'] == '4') ? 'selected' : ''; ?>>Utilisateur</option>
                                    </select>
                                </td>
                                <td class="py-3 px-6 flex items-center space-x-2">
                                    <!-- Modifier -->
                                    <input type="hidden" name="action" value="update_compte">
                                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded-lg hover:bg-green-600 transition">
                                        Modifier
                                    </button>
                            </form>
                            <!-- Supprimer -->
                            <?php if($compte['id_login']!=$_SESSION['user_id']){?>
                            <form method="POST">
                                <input type="hidden" name="id_login" value="<?php echo htmlspecialchars($compte['id_login']); ?>">
                                <input type="hidden" name="action" value="delete_compte">
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600 transition">
                                    Supprimer
                                </button>
                            </form>
                            <?php } ?>
                                </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Générer fichier XML -->
        <section class="mt-8">
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Générer le fichier XML</h2>
            <form method="POST" class="flex justify-center">
                <input type="hidden" name="action" value="generate_xml">
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                    Générer XML
                </button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <?php include_once '../includes/footer.php'; ?>

</body>
</html>
