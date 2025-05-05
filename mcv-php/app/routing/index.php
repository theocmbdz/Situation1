<?php
include_once "../models/Compte.php";

$nomSaisi="";
$motPasseSaisi="";
$appuieValider=isset($_POST['ok']);
$err="";
if ($appuieValider==true){
    ob_start();
// Appel du script de connexion au serveur et à la base de données
    require("../config/connexion.php"); 

// On récupère les données saisies dans le formulaire
    $nomSaisi =  $_POST['nom'];
    $motPasseSaisi = $_POST['mdp'];
    //$motPasseSaisi = md5($motPasseSaisi);
// On récupère dans la base de données le mot de passe qui correspond au nom saisi par le visiteur
    $sql = "SELECT utilisateur_id, id_login, mdp, statut FROM compte WHERE id_login = :nomSaisi";
    $res = $connexion->prepare($sql);
    $res->bindParam(':nomSaisi', $nomSaisi, PDO::PARAM_STR);
    $res->execute();


    $ligne = $res->fetch(PDO::FETCH_ASSOC);

    $stmt = $connexion->prepare($sql);

// On lie la variable $nomSaisi au paramètre de la requête
$stmt->bindParam(':nomSaisi', $nomSaisi, PDO::PARAM_STR);

// Exécution de la requête


    if($ligne=="")
    {
        $err="Votre saisie est erronée, Recommencez SVP..."; 
    }
    // On vérifie que le mot de passe saisi est identique à celui enregistré dans la base de données
    else
    {
        $motPasseBdd = $ligne['mdp'];

        if  ($motPasseBdd!=$motPasseSaisi)
        // Le mot de passe est différent de celui de la base utilisateur
        {
            $err="Votre saisie est erronée, Recommencez SVP..."; 

            // On inclut le formulaire d'identification (index.html)
            //include "../index.html";
            //header("Location: index.php");

            ob_end_flush();

            // On quitte le script courant sans effectuer les éventuelles instructions qui suivent
            //exit; 
        }
        else
        // Le mot de passe saisi correspond à celui de la base utilisateur
        {
            session_start();
            switch($ligne['statut']){
                //Admin
                case "1":
                    $_SESSION['ok']="oui";
                    $_SESSION['user_id'] = $ligne['id_login'];
                    $_SESSION['role']='admin';
                    $_SESSION['utilisateur_id']= $ligne['utilisateur_id'];
                    // Retour vers la page d'entrée du site
                    header("Location: ../views/accueil.php");
                    ob_end_flush();
                    break;

                //Secretariat    
                case "2":
                    $_SESSION['ok']="oui";
                    $_SESSION['user_id'] = $ligne['id_login'];
                    $_SESSION['role']='secretariat';
                    $_SESSION['utilisateur_id']= $ligne['utilisateur_id'];

                    // Retour vers la page d'entrée du site
                    header("Location: ../views/accueil.php");
                    ob_end_flush();
                    break;

                //Responsable    
                case "3":
                    $_SESSION['ok']="oui";
                    $_SESSION['user_id'] = $ligne['id_login'];
                    $_SESSION['role']='responsable';
                    $_SESSION['utilisateur_id']= $ligne['utilisateur_id'];

                    // Retour vers la page d'entrée du site
                    header("Location: ../views/accueil.php");
                    ob_end_flush();
                    break;

                //Utilisateur
                case "4":
                    $_SESSION['ok']="oui";
                    $_SESSION['user_id'] = $ligne['id_login'];
                    $_SESSION['role']='utilisateur';
                    $_SESSION['utilisateur_id']= $ligne['utilisateur_id'];

                    // Retour vers la page d'entrée du site
                    header("Location: ../views/accueil.php");
                    ob_end_flush();
                    break;

            }
            /*$_SESSION['ok']="oui";
            $sql2 = "SELECT `colNom` FROM `collaborateur` WHERE colMatricule='$nomSaisi'";
            $res = $connexion->query($sql2);
            $ligne = $res->fetch();

            $_SESSION['matricule']=$ligne[0];
            $_SESSION['visMatricule']=$nomSaisi;
            */



            
            // On quitte le script courant sans effectuer les éventuelles  instructions qui suivent
            exit;
        }
    
    //on libère le jeu d'enregistrement
    $sql=null;
    $res =null;
    $connexion=null;

    // on ferme la connexion au SGBD
    //$res->closeCursor();

    //mysql_close() ;
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-red-100 via-white to-red-50 flex items-center justify-center">

    <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8">
        <div class="text-center mb-6">
            <img src="../views/images/1242652_orig.jpg" alt="Logo" class="mx-auto w-24 h-24 rounded-full shadow-lg">
            <h1 class="text-3xl font-bold text-gray-700 mt-4">Maison des Ligues</h1>
            <p class="text-gray-500 text-sm">Connectez-vous pour accéder à votre compte</p>
        </div>
        <form action="index.php" onsubmit="return verifChamps()" method="post" class="space-y-6">
            <div>
                <label for="nom" class="block text-gray-600 font-medium">Nom d'utilisateur :</label>
                <input type="text" name="nom" id="nom" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition">
            </div>
            <div>
                <label for="mdp" class="block text-gray-600 font-medium">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition">
            </div>
            <div>
                <input type="submit" name="ok" value="Se Connecter"
                    class="w-full bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-500 shadow-md transition transform hover:scale-105">
            </div>
            <?php if (isset($err) && $err): ?>
                <div class="text-center text-red-500 mt-4">
                    <?= htmlspecialchars($err); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>