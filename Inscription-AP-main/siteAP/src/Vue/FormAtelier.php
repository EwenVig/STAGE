<?php @session_start();
require 'tindex.php';
require '../Model/ATELIER.php';
require '../DAO/atelierManager.php';
/* require '../Model/PROFESSEUR.php';
require '../DAO/professeurManager.php'; */

require '../Model/CAMPAGNE.php';
require '../DAO/campagneManager.php';
require '../Model/MATIERE.php';
require '../DAO/matiereManager.php';


$atelierManager = new atelierManager($pdo);
$professeurManager = new professeurManager($pdo);
$campagneManager = new campagneManager($pdo);
$matiereManager = new matiereManager($pdo);

/*
$professeur = $professeurManager->getProfesseur(1);
$atelier = $atelierManager->getAtelier(1);
$campagne = $campagneManager->getCampagne(1);
$matiere = $matiereManager->getMatiere(1);
*/


if (isset($_GET['validation'])) {
    $atelier = $atelierManager->creerAtelier($_GET);
    header('Location: FormModifCampagne.php');
    exit();
}

/*
if (isset($_GET['ID_PROFESSEUR'])) {
    $id_professeur = $_GET['ID_PROFESSEUR'];
    echo $id_professeur;
}

if (isset($_GET['ID_MATIERE'])) {
    $id_matiere = $_GET['ID_MATIERE'];
    echo $id_matiere;
}
*/

if (isset($_GET['ID_CAMPAGNE'])) {
    $id_campagne = $_GET['ID_CAMPAGNE'];
} else {
    $id_campagne = $_SESSION['ID_CAMPAGNE'];
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<!-- <div class="contenu" style="background-color:white;display: block;margin-left: auto; margin-right: auto; text-align: center; "> -->else
<div class="contenu2">

<div class="flex-container">

<div class="item auto">
<br/>

<form action="" method="GET"> 

    <label><b>Nom de l'atelier</b></label>
    <input name="NOM_ATELIER" type="text" required value="" size="20" maxlength="25" placeholder="Nom atelier"/><br/>

    <label><b>Date de début de l'atelier</b></label>
    <input name="DATEDEBUT_ATELIER" type="date" value="" size="20" maxlength="14"/><br/>

    <label><b>Date de fin de l'atelier</b></label>
    <input name="DATEFIN_ATELIER" type="date" value="" size="20" maxlength="14"/><br/>

    <label><b>Capacité de l'atelier</b></label>
    <input name="CAPACITE_ATELIER" type="number" required value="100" size="3" maxlength="3" placeholder="Capacité"/><br/>

    <label><b>Professeur </b></label>
    <select name="ID_PROFESSEUR" id="ID_PROFESSEUR">
            <?php echo $professeurManager->getSelectProfesseur(-1); ?>
    </select>

    <label><b>Matière</b></label>
    <select name="ID_MATIERE" id="ID_MATIERE">
            <?php echo $matiereManager->getSelectMatiere(-1); ?>
    </select>

    <label><b>Salle</b></label>
    <input name="SALLE" type="text" value="" size="30" maxlength="30" placeholder="Salle"/><br/>

<input type="hidden" name="ID_CAMPAGNE" value="<?php echo $id_campagne ?>" >
<input class="inputBlue" id="validation" name="validation" type="Submit" value="Ajouter" onclick="location.href='FormModifCampagne.php'">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormModifCampagne.php'">
</form>

</div>
</div>
</div>
</html>
