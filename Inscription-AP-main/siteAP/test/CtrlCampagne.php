
<?php

/*
Lancer avec la commande CtrlCampagne.php?ID_CAMPAGNE=1&NOM_CAMPAGNE=test&DATEDEBUT_CAMPAGNE=2021-02-25&DATEFIN_CAMPAGNE=2021-02-28
*/


require '../src/Gen/AccesDonnees.php';	// connexion, erreurs...
require '../src/Model/CAMPAGNE.php';
require '../src/DAO/campagneManager.php';
require '../src/Model/ATELIER.php';
require '../src/DAO/atelierManager.php';
require '../src/Model/GroupeClasse.php';
require '../src/DAO/GroupeClasseManager.php';
require '../src/Model/PROFESSEUR.php';
require '../src/DAO/professeurManager.php';

//connexion
$pdo = connexion();

$campagneManager = new campagneManager($pdo);
$atelierManager = new atelierManager($pdo);
$groupeClasseManager = new GroupeClasseManager($pdo);
$professeurManager = new professeurManager($pdo);

/* Test création simple - la campagne n'aura pas d'ateliers */
$uneCAMPAGNE = $campagneManager->creerCAMPAGNE($_GET);

/* Je récupère le dernier id d'élève dans la table */
$str = "SELECT MAX(id_CAMPAGNE) AS ID_MAX FROM CAMPAGNE;";
$sql = $pdo-> query($str);
$result = $sql -> fetch(PDO::FETCH_ASSOC);
echo $result['ID_MAX'];     // dernier id_CAMPAGNE


$maCAMPAGNE = $campagneManager->getCAMPAGNE($result['ID_MAX']);
print_r($maCAMPAGNE);

echo('<br><br>');

/* Test de la copie La campagne a des ateliers */
$uneCAMPAGNE = $campagneManager->copyCAMPAGNE(1);

/* Je récupère le dernier id d'élève dans la table */
$str = "SELECT MAX(id_CAMPAGNE) AS ID_MAX FROM CAMPAGNE;";
$sql = $pdo-> query($str);
$result = $sql -> fetch(PDO::FETCH_ASSOC);
echo $result['ID_MAX'];     // dernier id_CAMPAGNE


$maCAMPAGNE = $campagneManager->getCAMPAGNE($result['ID_MAX']);
print_r($maCAMPAGNE);
echo('<br><br>');

/* Test récupération une campagne avec des ateliers */

$maCAMPAGNE = $campagneManager->getCAMPAGNE(1);
print_r($maCAMPAGNE);
?>