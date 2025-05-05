<?php
session_start();

if($_SESSION['ok']!="oui"){
    header("Location: ../routing/index.php");
}


include_once '../config/connexion.php';
include_once '../models/Compte.php';
//include_once '../includes/utils.php';
$dir=dirname(__DIR__);
?>
     


    <script src="../views/js/script.js"></script>

    <?php include_once '../includes/header.php'; ?>

    <div class="container mx-auto mt-8 px-6 lg:px-16">
        <h1 class="text-4xl font-extrabold text-center text-orange-600 mb-12">Nos Services</h1>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?
        switch($_SESSION["role"])
        {
        case "utilisateur":
          ?>
        <!-- Service: Voir les Réservations -->
        <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Voir les Réservations</h2>
                    <p class="text-gray-600 mb-6">Gérez toutes les réservations de salles en un seul endroit.</p>
                    <a href="view_reservation.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Réservations</a>
                </div>
            </div>
          <?
          break;


        case "responsable":
          ?>
            <!-- Service: Consulter les salles -->
            <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3L7.5 5.25m0 0L5.25 3m2.25 2.25V9m0 0H3m3.75 0H21M9.75 21L7.5 18.75m0 0L5.25 21m2.25-2.25V15m0 0H3m3.75 0H21m0 6h-7.5m7.5 0V9m0 12V9m0 0h-7.5m0 0v3" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Consulter les Salles</h2>
                    <p class="text-gray-600 mb-6">Découvrez toutes nos salles disponibles, leurs équipements et leur état.</p>
                    <a href="view_etat_salles.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Salles</a>
                </div>
            </div>
            <!-- Service: Voir les Réservations -->
            <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Voir les Réservations</h2>
                    <p class="text-gray-600 mb-6">Gérez toutes les réservations de salles en un seul endroit.</p>
                    <a href="view_reservation.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Réservations</a>
                </div>
            </div>
          <?
          break;

        case "secretariat":
          ?>
            <!-- Service: Consulter les salles -->
            <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3L7.5 5.25m0 0L5.25 3m2.25 2.25V9m0 0H3m3.75 0H21M9.75 21L7.5 18.75m0 0L5.25 21m2.25-2.25V15m0 0H3m3.75 0H21m0 6h-7.5m7.5 0V9m0 12V9m0 0h-7.5m0 0v3" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Consulter les Salles</h2>
                    <p class="text-gray-600 mb-6">Découvrez toutes nos salles disponibles, leurs équipements et leur état.</p>
                    <a href="view_etat_salles.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Salles</a>
                </div>
            </div>
            <!-- Service: Voir les Réservations -->
            <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Voir les Réservations</h2>
                    <p class="text-gray-600 mb-6">Gérez toutes les réservations de salles en un seul endroit.</p>
                    <a href="view_reservation.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Réservations</a>
                </div>
            </div>
          <?
          break;

        case "admin":
          ?>
             <!-- Service: Voir les utilisateurs -->
             <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A6.002 6.002 0 0112 15a6.002 6.002 0 016.879 2.804M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 9h12m-6-6h12" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Voir les Utilisateurs</h2>
                    <p class="text-gray-600 mb-6">Consultez la liste de tous les utilisateurs enregistrés dans le système.</p>
                    <a href="view_utilisateur.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Utilisateurs</a>
                </div>
            </div>
            <!-- Service: Consulter les salles -->

<div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 rounded-full bg-orange-100 mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3L7.5 5.25m0 0L5.25 3m2.25 2.25V9m0 0H3m3.75 0H21M9.75 21L7.5 18.75m0 0L5.25 21m2.25-2.25V15m0 0H3m3.75 0H21m0 6h-7.5m7.5 0V9m0 12V9m0 0h-7.5m0 0v3" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Consulter les Salles</h2>
                    <p class="text-gray-600 mb-6">Découvrez toutes nos salles disponibles, leurs équipements et leur état.</p>
                    <a href="view_etat_salles.php" class="inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition">Voir les Salles</a>
                </div>
            </div>
          <?
          
          break;
      }?>
        </div>
    </div>

    <?php include_once '../includes/footer.php'; ?>


</html>
<?php 
