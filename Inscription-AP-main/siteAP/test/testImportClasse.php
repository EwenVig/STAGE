<?php

/*
Lancer avec la commande testImportClasse.php
*/


require '../src/Gen/AccesDonnees.php';	// connexion, erreurs...
require '../src/Model/GroupeClasse.php';
require '../src/DAO/GroupeClasseManager.php';

//connexion
$pdo = connexion();


$oclasseManager = new GroupeClasseManager($pdo);

$uneClasse = $oclasseManager->importGroupeClasse('../import/eleve 2nd.CSV');

?>