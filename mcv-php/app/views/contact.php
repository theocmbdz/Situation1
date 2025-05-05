<?php
session_start();

if ($_SESSION['ok'] != "oui") {
    header("Location: ../routing/index.php");
}
?>


<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        echo "<p class='text-center text-green-500 text-3xl font-bold' >Votre demande a était pris en compte</p>";

    }
    ?>
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center text-orange-600 mb-8">Contactez-nous</h1>
        <p class="text-center text-lg text-gray-600 mb-12">
            Vous avez une question ou besoin d'assistance ? Remplissez le formulaire ci-dessous, et nous reviendrons vers vous rapidement.
        </p>

        <!-- Formulaire de contact -->
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <form action="contact.php" method="POST" class="space-y-6">
                <!-- Nom complet -->
                <div>
                    <label for="nom" class="block text-lg font-semibold text-gray-700 mb-2">Nom complet</label>
                    <input type="text" id="nom" name="nom"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Entrez votre nom complet" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-lg font-semibold text-gray-700 mb-2">Adresse e-mail</label>
                    <input type="email" id="email" name="email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Entrez votre adresse e-mail" required>
                </div>

                <!-- Sujet -->
                <div>
                    <label for="sujet" class="block text-lg font-semibold text-gray-700 mb-2">Sujet</label>
                    <input type="text" id="sujet" name="sujet"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Entrez le sujet de votre message" required>
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-lg font-semibold text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="6"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Écrivez votre message ici" required></textarea>
                </div>

                <!-- Bouton d'envoi -->
                <div class="text-center">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include_once '../includes/footer.php'; ?>

</body>

</html>