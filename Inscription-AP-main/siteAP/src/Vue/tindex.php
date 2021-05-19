<?php @SESSION_START();

require '../Gen/AccesDonnees.php';
require '../Model/ELEVE.php';
require '../DAO/eleveManager.php';
require '../Model/PROFESSEUR.php';
require '../DAO/professeurManager.php';

$pdo = connexion();
$eleveManager = new eleveManager($pdo);
$professeurManager = new professeurManager($pdo);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<div class="menu"><br>

<img class="tete" src="../../images/estran.jpg" >


<?php 


    IF ($_SESSION['TYPE'] == 'ADMIN' OR $_SESSION['TYPE'] == 'PROF')
    {
        $idProf=$_SESSION['ID'];
        $oProfCnx = $professeurManager->getProfesseur($idProf);

        echo '<br /><br /><br /><p >' .$oProfCnx->getPrenom_professeur(). ' '.$oProfCnx->getNom_professeur().'<br /><br /><br /></p>';

        // Menu Administrateur 
        echo "
            <form action='FormListCampagne.php' method='GET'>
                <input class='inputBlue' type='Submit' value='CAMPAGNE'>
            </form>
  
            <form action='FormListMatiere.php' method='GET'>
                <input class='inputBlue' type='Submit' value='MATIERE'>
            </form> 

            <form action='FormListEleve.php' method='GET'>
                <input class='inputBlue' type='Submit' value='ELEVE'>
            </form> 

            <form action='FormImport.php' method='GET'>
                <input class='inputBlue' type='Submit' name='MENU' value='IMPORT ELEVE'>
            </form> 

            <form action='FormImport.php' method='GET'>
                <input class='inputBlue' type='Submit' name='MENU' value='RENTREE SEPT.'>
            </form> 

            "; 

    }

    IF ($_SESSION['TYPE'] == 'ELEVE')
    {
        $idEleve=$_SESSION['ID'];
        $oEleveCnx = $eleveManager->getEleve($idEleve);
        echo '<br /><br /><br />' .$oEleveCnx->getPrenom_eleve(). ' '.$oEleveCnx->getNom_eleve().'<br /><br /><br />';
    }

?>
           
 
</div>

</html>