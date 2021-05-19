<?php
include 'tindex.php';
require '../Model/MATIERE.php';
require '../DAO/matiereManager.php';

$matiereManager = new matiereManager($pdo);

$idMatiere = $_GET['modifier'];
echo $idMatiere;

$uneMatiere = $matiereManager->getMatiere($idMatiere);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<div class="contenu2 item">
 <br/>

<form action="updateMatiere.php" method="GET"> 

<!--
<table style="margin:0px auto; background: #dcdee3; width: 40%;">
    <thead>
        <tr >
            <th colspan="2" style="text-align:center">MATIERE</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>
            Modification matiere n° : <br/>
            Nom de la matiere : <br/>
            </td>

            <td>
            
			<input type="hidden" name="ID_MATIERE" id="ID_MATIERE" value="<?php echo $idMatiere ?>" maxlength=6 />
            <input type="text" name="ID_MATIERE" id="ID_MATIERE" value="<?php echo $idMatiere ?>" maxlength=6 disabled/><br>
            <input type="text" name="NOM_MATIERE" id="NOM_MATIERE" value="<?php echo $uneMatiere->getNom_matiere(); ?>" /><br>
            
            </td>
        </tr>
    </tbody>
    
</table><br/>
-->

<input type="hidden" name="ID_MATIERE" id="ID_MATIERE" value="<?php echo $idMatiere ?>" maxlength=6 />
<label><b>Nom de la matière</b></label><br>
<input type="text" name="NOM_MATIERE" id="NOM_MATIERE" value="<?php echo $uneMatiere->getNom_matiere(); ?>" /><br>
<input class="inputBlue" id="modifier" name="modifier" type="Submit" value="Modifier">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormListMatiere.php'">
<br/><br/><br/>
</form>
</div>
</html>