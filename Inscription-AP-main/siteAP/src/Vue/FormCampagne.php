<?php
require 'tindex.php';
require '../Model/CAMPAGNE.php';
require '../DAO/campagneManager.php';

$campagneManager = new campagneManager($pdo);
$campagne = $campagneManager->getCampagne(1);

if (isset($_GET['validation'])) {
    $campagne = $campagneManager->creerCampagne($_GET);
    header('Location: FormListCampagne.php');
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

<div class="contenu" style="background-color:white;display: block;margin-left: auto; margin-right: auto; text-align: center; ">
<br/>

<form action="" method="GET"> 
<table style="margin: 0px auto; background: #dcdee3; width: 30%;">
    <thead>
        <tr >
            <th colspan="2" style="text-align:center">CAMPAGNE</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>
            Nom campagne : <br/>
            Date de Debut campagne : <br/>
            Date de Fin campagne : <br/>
            </td>   
            
            <td>            
                <input name="NOM_CAMPAGNE" type="text" value="" size="20" maxlength="25" placeholder="Nom campagne"/><br/>
                <input name="DATEDEBUT_CAMPAGNE" type="date" value="" size="20" maxlength="25"/><br/>
                <input name="DATEFIN_CAMPAGNE" type="date" value="" size="20" maxlength="25"/><br/>
            </td>
        </tr>
    </tbody>
    
</table><br/>
<input class="inputBlue" id="validation" name="validation" type="Submit" value="Ajouter" onclick="location.href='FormListCampagne.php'">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormListCampagne.php'">
</form>

</div>
</html>
