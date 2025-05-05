<?php 
if($_SESSION['ok']!="oui"){
  header("Location: ../routing/index.php");
}

include_once '../config/connexion.php';
include_once '../models/Compte.php';
//include_once '../includes/utils.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison des ligues</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-orange-600 text-white shadow-md relative">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3">
                <a href="../views/accueil.php">
                    <img src="../views/images/1242652_orig.jpg" alt="logo" class="w-12 h-12 rounded-full" />
                </a>
                <h1 class="text-2xl font-bold">Maison des Ligues</h1>

            </div>

            <!-- Navigation Links -->
            <ul class="hidden md:flex space-x-6">
                <li><a href="accueil.php" class="hover:text-gray-300">Home</a></li>
                <li><a href="services.php" class="hover:text-gray-300">Services</a></li>
                <li><a href="contact.php" class="hover:text-gray-300">Contact Us</a></li>
                <li><a href="../config/deconnexion.php" class="hover:text-gray-300">Se déconnecter</a></li>
            </ul>

            <!-- Hamburger Menu -->
            <button id="hamburger" class="md:hidden focus:outline-none flex flex-col space-y-1">
                <span class="block w-6 h-1 bg-white"></span>
                <span class="block w-6 h-1 bg-white"></span>
                <span class="block w-6 h-1 bg-white"></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden bg-orange-700 md:hidden">
            <ul class="flex flex-col space-y-4 p-4">
                <li><a href="accueil.php" class="hover:text-gray-300">Home</a></li>
                <li><a href="services.php" class="hover:text-gray-300">Services</a></li>
                <li><a href="contact.php" class="hover:text-gray-300">Contact Us</a></li>
                <li><a href="../config/deconnexion.php" class="hover:text-gray-300">Se déconnecter</a></li>
            </ul>
        </div>
        <span class="text-sm font-light absolute top-1 right-1"><?php echo $_SESSION['user_id']; ?></span>
        <?php echo $_SESSION['role']; ?>
    </nav>

    <script>
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
