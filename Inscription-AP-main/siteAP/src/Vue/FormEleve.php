<?php
include 'tindex.php';
require '../Model/GroupeClasse.php';
require '../DAO/GroupeClasseManager.php';

$eleveManager = new eleveManager($pdo);

$eleve = $eleveManager->getEleve(1);

if (isset($_GET['validation'])) {
    $eleve = $eleveManager->creerEleve($_GET);
    header('Location: FormListEleve.php');
    exit();
}

$GroupeClasseManager = new GroupeClasseManager($pdo);

$GroupeClasse = $GroupeClasseManager->getAllGroupeClasse();

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

<label><b>Nom de l' eleve</b></label><br>
<input name="NOM_ELEVE" type="text" value="" size="20" maxlength="25" placeholder="Nom eleve"/><br/>
<label><b>Prenom de l' eleve</b></label><br>
<input name="PRENOM_ELEVE" type="text" value="" size="20" maxlength="25" placeholder="Prenom eleve"/><br/>
<label><b>Classe de l' eleve</b></label><br>
<select name="CLASSE_ELEVE" id="CLASSE_ELEVE">
    <option value="NOM_CLASSE"><?php echo $GroupeClasse->getNom_Classe() ?></option>
</select>
<label><b>Login de l' eleve</b></label><br>
<input name="LOGIN_ELEVE" type="text" value="" size="20" maxlength="25" placeholder="Login eleve"/><br/>
<label><b>Mot de passe de l' eleve</b></label><br>
<input name="MDP_ELEVE" type="text" value="" size="20" maxlength="25" placeholder="Mot de passe eleve"/><br/>
<label><b>Mail de l' eleve</b></label><br>
<input name="MAIL_ELEVE" type="text" value="" size="20" maxlength="25" placeholder="Mail eleve"/><br/>

<input class="inputBlue" id="validation" name="validation" type="Submit" value="Ajouter" onclick="location.href='FormListEleve.php'">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormListEleve.php'">
</form>

</div>
</html>
