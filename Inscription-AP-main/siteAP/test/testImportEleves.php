<?php

/*
Lancer avec la commande testImportEleves.php
*/


require '../src/Gen/AccesDonnees.php';	// connexion, erreurs...
require '../import/eleve 2nd.CSV';
require '../import/PROFS LYCEE.CSV';
require '../src/Model/ELEVE.php';
require '../src/DAO/eleveManager.php';

//connexion
$pdo = connexion();


$eleveManager = new eleveManager($pdo);

$unEleve = $eleveManager->importEleve('../import/eleve 2nd.CSV');

?>