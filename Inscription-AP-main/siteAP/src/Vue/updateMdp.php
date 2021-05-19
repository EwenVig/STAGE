<?php @session_start();

require '../DAO/eleveManager.php';
require '../Gen/AccesDonnees.php';
require '../Model/ELEVE.php';

$idEleve = $_SESSION['ID'];
$pwd1 = $_GET['pwd1'];
$pwd2 = $_GET['pwd2'];
$pdo = connexion();
$eleveManager = new eleveManager($pdo);
$oEleve = $eleveManager->getEleve($idEleve);


if ($pwd1 == $pwd2) {
    $oEleve->setMdp_eleve($pwd2);
    $eleveManager->modifEleve($oEleve);
    header('Location: index.php');
    exit();
} else {
    header('FormChangerMdp.php');
}
        
?>