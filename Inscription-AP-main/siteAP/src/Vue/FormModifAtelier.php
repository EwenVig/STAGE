<?php 
include 'tindex.php';
require '../Model/ATELIER.php';
require '../DAO/atelierManager.php';
require '../Model/MATIERE.php';
require '../DAO/matiereManager.php';

$atelierManager = new atelierManager($pdo);
$matiereManager = new matiereManager($pdo);

$idAtelier = $_GET['ID_ATELIER'];
$idCampagne = $_GET['ID_CAMPAGNE'];

$unAtelier = $atelierManager->getAtelier($idAtelier);

if (empty($unAtelier->getProfesseur()))
        {$idProfSelect = -1;}
else
        {$idProfSelect = $unAtelier->getProfesseur()->getId_professeur(); }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<div class="contenu2">

<div class="flex-container">

<div class="item auto">
 <br/>

<form action="FormModifCampagne.php" method="GET" id="FormAtelier"> 

    <label><b>Nom de l'atelier</b></label>
    <input type="text" name="NOM_ATELIER" id="NOM_ATELIER" value="<?php echo $unAtelier->getNom_atelier(); ?>" /><br>

    <label><b>Date de début de l'atelier</b></label>
    <input type="date" name="DATEDEBUT_ATELIER" id="DATEDEBUT_ATELIER" value="<?php echo $unAtelier->getDateDebut_atelier(); ?>" /><br>

    <label><b>Date de fin de l'atelier</b></label>
    <input type="date" name="DATEFIN_ATELIER" id="DATEFIN_ATELIER"  value="<?php echo $unAtelier->getDateFin_atelier(); ?>" /><br>

    <label><b>Capacité de l'atelier</b></label>
    <input type="number" name="CAPACITE_ATELIER" id="CAPACITE_ATELIER"  value="<?php echo $unAtelier->getCapacite_atelier();  ?>" /><br>

    <label><b>Professeur </b></label>
    <select name="ID_PROFESSEUR" id="ID_PROFESSEUR" form="FormAtelier">
            <?php echo $professeurManager->getSelectProfesseur($idProfSelect);  ?>
    </select>

    <label><b>Matière</b></label>
    <select name="ID_MATIERE" id="ID_MATIERE" form="FormAtelier">
            <?php echo $matiereManager->getSelectMatiere($unAtelier->getId_matiere()); ?>
    </select>

    <label><b>Salle</b></label>
    <input name="SALLE" type="text" value="<?php echo $unAtelier->getSalle(); ?>" ><br/>


    <input class="inputBlue" name="ModifierAtelier" type="Submit" value="Modifier">
    <input type="hidden" name="ID_ATELIER" value="<?php echo $idAtelier ?>" >
    <input type="hidden" name="ID_CAMPAGNE" value="<?php echo $idCampagne ?>" >
    <input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormModifCampagne.php'">

    <br/><br/><br/>
</form>

</div>
</div>
</div>
</html>
