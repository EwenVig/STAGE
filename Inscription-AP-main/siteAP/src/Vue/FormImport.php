<?php

require 'tindex.php';

$affiche = $_GET['MENU'];
$nomFichierEleve = '../../import/eleve.csv';
$nomFichierProf = '../../import/prof.csv';

if (isset($_GET['MENU']) AND $_GET['MENU'] == "RENTREE SEPT.")
{

    global $eleveManager;
    global $professeurManager;

    $eleveManager->deleteAllEleve() ;
    $affiche = 'Suppression des élèves <br> Suppression des inscriptions';

    $nbEleve = $eleveManager->importEleve($nomFichierEleve);
    $affiche = $affiche.'<br><br>'.$nbEleve.' élèves importés<br>';

    $nbProf = $professeurManager->importProfesseur($nomFichierProf);
    $affiche = $affiche.'<br>'.$nbProf.' professeurs importés<br><br>';

}

if (isset($_GET['MENU']) AND $_GET['MENU'] == "IMPORT ELEVE")
{
    $nbEleve = $eleveManager->importEleve($nomFichierEleve);
    $affiche = '<br><br>'.$nbEleve.' élèves importés<br><br>';
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<div class="contenu2">
<br/>

    <h2><?php echo $_GET['MENU']; ?> <img src="../../images/visitr.png" style="width: 49px;"></h2>
    <ul><?php echo $affiche; ?></ul>

</div>
</body>
</html>
