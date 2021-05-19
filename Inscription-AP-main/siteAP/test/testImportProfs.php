<?php

/*
Lancer avec la commande test/testImportProfs.php
*/


require '../src/Gen/AccesDonnees.php';	// connexion, erreurs...
require '../import/PROFS LYCEE.CSV';
require '../src/Model/PROFESSEUR.php';
require '../src/DAO/professeurManager.php';

//connexion
$pdo = connexion();


$professeurManager = new professeurManager($pdo);

$unProfesseur = $professeurManager->importProfesseur('../import/PROFS LYCEE.CSV');

?>