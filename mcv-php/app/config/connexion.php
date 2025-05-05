<?php
	// Définitions de constantes pour la connexion à MySQL
	$hote= "localhost";
	$login= "root";
	$mdp= "";
	$nombd="mission1";


	// Connexion à la base de données
	try {
		$connexion= new PDO ("mysql:host=$hote;dbname=$nombd", $login, $mdp);
	} catch ( Exception $e ) {
		die ("\n Connexion à ".$hote." impossible :  ".$e->getMessage());
	}
?>
