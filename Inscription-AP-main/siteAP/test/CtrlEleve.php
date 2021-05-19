
<?php

/*
Lancer avec la commande CtrlEleve.php?NOM_ELEVE=DEDUYER&PRENOM_ELEVE=EDDY&MAIL_ELEVE=EDDY@free.fr&LOGIN_ELEVE=loginEDDY&MDP_ELEVE=mdpEDDY&ID_CLASSE=21
*/


require '../src/Gen/AccesDonnees.php';	// connexion, erreurs...
require '../src/Model/ELEVE.php';
require '../src/DAO/eleveManager.php';


//connexion
$pdo = connexion();


$eleveManager = new eleveManager($pdo);

$unEleve = $eleveManager->creerEleve($_GET);

/* Je récupère le dernier id d'élève dans la table */
$str = "SELECT MAX(id_eleve) AS ID_MAX FROM ELEVE;";
$sql = $pdo-> query($str);
$result = $sql -> fetch(PDO::FETCH_ASSOC);
echo $result['ID_MAX'];     // dernier id_eleve


$monEleve = $eleveManager->getEleve($result['ID_MAX']);
print_r($monEleve);

?>