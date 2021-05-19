
<?php

/*
Lancer avec la commande CtrlProfesseur.php?NOM_PROFESSEUR=RIOU&PRENOM_PROFESSEUR=ADRIEN&MAIL_PROFESSEUR=riou@free.fr&LOGIN_PROFESSEUR=loginRiou&MDP_PROFESSEUR=mdpRiou
*/


require '../src/Gen/AccesDonnees.php';	// connexion, erreurs...
require '../src/Model/professeur.php';
require '../src/DAO/professeurManager.php';


//connexion
$pdo = connexion();


$professeurManager = new professeurManager($pdo);

$unProfesseur = $professeurManager->creerProfesseur($_GET);

/* Je récupère le dernier id d'élève dans la table */
$str = "SELECT MAX(id_PROFESSEUR) AS ID_MAX FROM PROFESSEUR;";
$sql = $pdo-> query($str);
$result = $sql -> fetch(PDO::FETCH_ASSOC);
echo $result['ID_MAX'];     // dernier id_PROFESSEUR


$monProfesseur = $professeurManager->getProfesseur($result['ID_MAX']);
print_r($monProfesseur);

$lesProfesseurs = $professeurManager->getAllProfesseur();
print_r(count($lesProfesseurs));
print_r($lesProfesseurs);
?>