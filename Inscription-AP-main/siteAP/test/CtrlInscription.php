
<?php

/*
Lancer avec la commande Ctrlinscription.php?ID_ELEVE=2&ID_ATELIER=2
*/

require '../connexions/AccesDonnees.php';	// connexion, erreurs...
require '../src/Model/INSCRIPTION.php';
require '../src/DAO/inscriptionManager.php';
require '../src/Model/ATELIER.php';
require '../src/DAO/atelierManager.php';
require '../src/Model/ELEVE.php';
require '../src/DAO/eleveManager.php';

//connexion
$pdo = connexion();

$atelierManager = new atelierManager($pdo);
$eleveManager = new eleveManager($pdo);
$inscriptionManager = new inscriptionManager($pdo);

$uneInscription = $inscriptionManager->creerInscription($_GET);

/* Je récupère le dernier id d'élève dans la table */
$str = "SELECT MAX(id_inscription) AS ID_MAX FROM inscription;";
$sql = $pdo-> query($str);
$result = $sql -> fetch(PDO::FETCH_ASSOC);
echo $result['ID_MAX'];     // dernier id_inscription

$monInscription = $inscriptionManager->getInscription($result['ID_MAX']);

$monInscription = $inscriptionManager->getInscription($result['ID_MAX']);

print_r($monInscription);

?>