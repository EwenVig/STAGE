<?php
require 'tindex.php';
require '../Model/MATIERE.php';
require '../DAO/matiereManager.php';

$matiereManager = new matiereManager($pdo);
$matiere = $matiereManager->getMatiere(1);

if (isset($_GET['validation'])) {
    $matiere = $matiereManager->creerMatiere($_GET);
    header('Location: FormListMatiere.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<!--  <div class="contenu" style="background-color:white;display: block;margin-left: auto; margin-right: auto; text-align: center; "> -->
<div class="contenu2 item">
<br/>

<form action="" method="GET"> 

<label><b>Nom de la matière</b></label><br>
<input name="NOM_MATIERE" type="text" value="" size="20" maxlength="25" placeholder="Nom matière"/><br/>

<input class="inputBlue" id="validation" name="validation" type="Submit" value="Ajouter" onclick="location.href='FormListMatiere.php'">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormListMatiere.php'">
</form>

</div>
</html>
