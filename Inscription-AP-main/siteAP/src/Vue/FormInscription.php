<?php @session_start();
include 'tindex.php';
//insertion de la connection a la base de donn�es

// ELEVE et PROFESSEUR dans tindex.php
require '../Model/ATELIER.php';
require '../DAO/atelierManager.php';
require '../Model/GroupeClasse.php';
require '../DAO/GroupeClasseManager.php';
require '../Model/CAMPAGNE.php';
require '../DAO/campagneManager.php';
require '../Model/INSCRIPTION.php';
require '../DAO/inscriptionManager.php';

//$pdo = connexion(); dans tindex.php
$atelierManager = new atelierManager($pdo);
$inscriptionManager = new inscriptionManager($pdo);
//$eleveManager = new eleveManager($pdo);
$campagneManager = new campagneManager($pdo);
$groupeClasseManager = new GroupeClasseManager($pdo);
$professeurManager = new professeurManager($pdo);

/* Traitement après inscription */
if (isset($_GET['inscrire']) AND $_SESSION['TYPE'] == 'ELEVE') 
{
    $idEleveCourant = $_SESSION['ID'];
    $inscriptionManager->creerInscription($_GET);
    header('Location: FormInscription.php');
    exit();
}
else if (isset($_GET['inscrire']) AND $_SESSION['TYPE'] == 'ADMIN') 
{
  $inscriptionManager->creerInscription($_GET);
  header('Location: FormInscription.php');
  exit();
}
else if (isset($_GET['clore']) AND $_SESSION['TYPE'] == 'ADMIN') 
{
  $_SESSION['ID_CAMPAGNE'] = $_GET['clore'];

}


/* Récupérer la campagne courante et ses ateliers */
if ($_SESSION['TYPE'] == 'ELEVE') 
{
  $idEleveCourant = $_SESSION['ID'];
  $campagneCourante = $campagneManager->getCampagneCourante($idEleveCourant); 
  $_SESSION['ID_CAMPAGNE'] = $campagneCourante->getId_campagne();
}

if ($_SESSION['TYPE'] == 'ADMIN') 
{
  $campagneCourante = $campagneManager->getCampagne($_SESSION['ID_CAMPAGNE']); 
  $lesEleves =  $campagneManager->getElevesNonInscrits($_SESSION['ID_CAMPAGNE']);

  if (count($lesEleves) == 0)
    {
      $afficheEleve = 'Tous les élèves sont affectés à un atelier <br><br><br>';
    }
  else
  {
    $idEleveCourant = $lesEleves[0]->getId_eleve();

    // Création de la liste des élèves non inscrits
    $afficheEleve = '';
    $n = 0;
    while ($n < count($lesEleves)) 
    {
      $afficheEleve = $afficheEleve.'<br>'.$lesEleves[$n]->getPrenom_eleve().' '.$lesEleves[$n]->getNom_eleve(); 
      $n = $n+1;
    }
  }  
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<div class="contenu2">

  <h2 style="text-align: left; padding-left:2%"><u>LISTE DES ATELIERS </u><img src="../../images/visitr.png" style="width: 49px;"></h2>
 
  <div class="flex-container">
        <?php

        /* Session Administrateur : affichage des élèves non inscrits */
        if ($_SESSION['TYPE'] == 'ADMIN') 
        {
            echo $afficheEleve;
            /* Fin du traitement si tous les élèves sont inscrits */
            if (count($lesEleves) == 0)
            {
              exit();
            }
}
        /* Session Eleve : inscription déjà réalisée */
        if ($inscriptionManager->getNbInscription($idEleveCourant) >= 1 AND $_SESSION['TYPE'] == 'ELEVE')
        {
                
              $idInscription = $inscriptionManager->getInscriptionByEleve($_SESSION['ID_CAMPAGNE'],$idEleveCourant);
              $oInscription = $inscriptionManager->getInscription($idInscription);

              /* Conversion de la date d'inscription en français */
              $strDate = strtotime($oInscription->getDate_inscription());
              $strDate = date("m.d.Y",$strDate);
              
              /* Affichage de la matière et de date d'inscription en français */
              echo '<pre>';
              echo '<br/> <br/> <br/>';
              echo '      Vous êtes inscrit à l\'atelier de '.$oInscription->getOAtelier()->getNom_atelier().' le '.$strDate;
              echo '<br/> <br/> <br/>';
              echo '</pre>';
  
        }

        else 
        {

         //----------Afficher la liste des ateliers --------------//    
   
         $mesAteliers = $campagneCourante->getLesAteliers();
        
        /* print_r($mesAteliers); */

        // ---- Pour chaque atelier, créer une forme avec un bouton d'inscription  
        $i = 0;
        while ($i < count($mesAteliers)) {
            $unAtelier = $mesAteliers[$i];
            $i = $i + 1;
        
            $idAtelier = $unAtelier->getId_atelier();
            $libelle = $unAtelier->getNom_atelier()."<br> Du ".$unAtelier->getDateDebut_atelier()." au ".$unAtelier->getDateFin_atelier()
                            ."<br><br>".$atelierManager->getCapaciteRestante($unAtelier)."<br>";

            if ($atelierManager->getCapaciteRestante($unAtelier) <= 0 ) 
            {

              $visuButton = "myButtonDesactive";   //classe pour le bouton désactive
              $ButtonDisabled = "disabled";
            }
            else 
            {
                $visuButton = "myButton";   //classe pour bouton ok 
                $ButtonDisabled = "";

            }
        
        ?>
          
        <form action='' method='GET'>

            <div class="item auto">
              <button class=<?php echo $visuButton; ?> type='submit' id='inscrire' name='inscrire' onclick="if(!confirm('Voulez-vous vous inscrire à cet atelier ?')) return false;" <?php echo $ButtonDisabled; ?>>
                  <?php echo $libelle; ?>
                
              </button>
            </div>
            <input id='ID_ATELIER' name='ID_ATELIER' type='hidden' value="<?php echo $idAtelier; ?>" />
            <input id='ID_ELEVE' name='ID_ELEVE' type='hidden' value="<?php echo $idEleveCourant; ?>" />
       
        </form>   

        <?php          
          }
        }
      ?>
  </div>
</div>
</html>
