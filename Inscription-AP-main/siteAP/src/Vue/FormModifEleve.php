<?php
include 'tindex.php';

$eleveManager = new eleveManager($pdo);

$idEleve = $_GET['modifier'];
echo $idEleve;

$unEleve = $eleveManager->getEleve($idEleve);
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

<form action="updateEleve.php" method="GET"> 

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
            Modification eleve n° : <br/>
            Nom de l'eleve : <br/>
            </td>

            <td>
            
			<input type="hidden" name="ID_ELEVE" id="ID_ELEVE" value="<?php echo $idEleve ?>" maxlength=6 />
            <input type="text" name="ID_ELEVE" id="ID_ELEVE" value="<?php echo $idEleve ?>" maxlength=6 disabled/><br>
            <input type="text" name="NOM_ELEVE" id="NOM_ELEVE" value="<?php echo $unEleve->getNom_eleve(); ?>" /><br>
            
            </td>
        </tr>
    </tbody>
    
</table><br/>
-->

<input type="hidden" name="ID_ELEVE" id="ID_ELEVE" value="<?php echo $idEleve ?>" maxlength=6 />
<label><b>Nom de l' eleve</b></label><br>
<input type="text" name="NOM_ELEVE" id="NOM_ELEVE" value="<?php echo $unEleve->getNom_eleve(); ?>" /><br>
<label><b>Prenom de l' eleve</b></label><br>
<input type="text" name="PRENOM_ELEVE" id="PRENOM_ELEVE" value="<?php echo $unEleve->getPrenom_eleve(); ?>" /><br>
<label><b>Login de l' eleve</b></label><br>
<input type="text" name="LOGIN_ELEVE" id="LOGIN_ELEVE" value="<?php echo $unEleve->getLogin_eleve(); ?>" /><br>
<label><b>Mot de passe de l' eleve</b></label><br>
<input type="text" name="MDP_ELEVE" id="MDP_ELEVE" value="<?php echo $unEleve->getMdp_eleve(); ?>" /><br>
<label><b>Mail de l' eleve</b></label><br>
<input type="text" name="MAIL_ELEVE" id="MAIL_ELEVE" value="<?php echo $unEleve->getMail_eleve(); ?>" /><br>

<input class="inputBlue" id="modifier" name="modifier" type="Submit" value="Modifier">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormListEleve.php'">
<br/><br/><br/>
</form>
</div>
</html>