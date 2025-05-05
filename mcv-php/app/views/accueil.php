<?php
session_start();

if ($_SESSION['ok'] != "oui") {
    header("Location: ../routing/index.php");
}
?>

<?php include_once '../includes/header.php'; ?>

<main class="container mx-auto px-4 py-10">
    <!-- Titre principal -->
    <section class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-orange-600 tracking-wide">Découvrez la Maison des Ligues</h1>
        <p class="mt-6 text-lg text-gray-700 max-w-2xl mx-auto leading-relaxed">
            La Maison des Ligues est votre partenaire privilégié pour le développement des activités sportives régionales.
            Elle offre des services modernes et un environnement optimal pour les ligues et associations sportives.
        </p>
    </section>

    <!-- Services -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Service 1 -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center transition-transform hover:scale-105">
            <h2 class="text-2xl font-bold text-orange-500 mb-2">Espaces de collaboration</h2>
            <p class="text-gray-600 leading-relaxed">
                Nous proposons des espaces partagés pour organiser vos rencontres sportives, vos réunions et bien plus encore.
            </p>
        </div>
        <!-- Service 2 -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center transition-transform hover:scale-105">
            <h2 class="text-2xl font-bold text-orange-500 mb-2">Assistance pour vos projets</h2>
            <p class="text-gray-600 leading-relaxed">
                La Maison des Ligues propose des services variés tels que l'organisation d'événements,
                le support administratif, et des solutions adaptées pour accompagner vos activités sportives.
            </p>
            <a href="services.php" class="mt-4 inline-block bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-600 transition duration-300">
                Nos Services
            </a>
        </div>
        <!-- Service 3 -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center transition-transform hover:scale-105">
            <h2 class="text-2xl font-bold text-orange-500 mb-2">Hébergement des structures</h2>
            <p class="text-gray-600 leading-relaxed">
                Découvrez nos solutions d'hébergement modernes et confortables pour les ligues et structures affiliées.
            </p>
        </div>
    </section>
</main>




<!-- Témoignages -->
<section class="mt-12">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Ce que disent nos membres</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Témoignage 1 -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <p class="italic text-gray-600">"Un espace parfait pour organiser nos réunions de ligue. Équipe très professionnelle et services de qualité."</p>
            <h4 class="mt-4 text-right font-bold text-orangevi00">- Jean Dupont, Ligue de Football de Lorraine</h4>
        </div>
        <!-- Témoignage 2 -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <p class="italic text-gray-600">"Les salles sont modernes et bien équipées. La M2L nous a grandement facilité la gestion de nos événements."</p>
            <h4 class="mt-4 text-right font-bold text-orange-600">- Marie Lefèvre, Ligue de Basketball de Lorraine</h4>
        </div>
    </div>
</section>

<!-- Contact -->
<section class="mt-16 text-center mb-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Contactez-nous</h2>
    <p class="text-gray-600 mb-4">Pour toute information ou demande spécifique, contactez notre équipe.</p>
    <a href="contact.php" class="bg-orange-500 text-white py-2 px-6 rounded hover:bg-orange-600 transition">Nous Contacter</a>
</section>


</main>

<?php include_once '../includes/footer.php'; ?>
</body>

</html>