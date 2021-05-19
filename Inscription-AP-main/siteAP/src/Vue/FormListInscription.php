<?php
include 'tindex.php';
require '../Model/INSCRIPTION.php';
require '../DAO/inscriptionManager.php';
require '../Model/ATELIER.php';
require '../DAO/atelierManager.php';
// require '../Model/PROFESSEUR.php';
// require '../DAO/professeurManager.php';

$inscriptionManager = new inscriptionManager($pdo);
$atelierManager = new atelierManager($pdo);
$professeurManager = new professeurManager($pdo);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<div class="contenu2">
  <h2>LISTE DES INSCRIPTIONS AUX ATELIERS <img src="../../images/visitr.png" style="width: 49px;"></h2>

  <div class="flex-container">
    <?php
      $mesAteliers = $atelierManager->getAtelierByCampagne($_GET['ID_CAMPAGNE']);

      /* Pour chaque atelier */
      $i = 0;
      while ($i < count($mesAteliers)) 
      {
            
          $unAtelier = $mesAteliers[$i];
          $idAtelier = $unAtelier->getId_atelier();
            
          $i = $i + 1;
        
          $oProf = $unAtelier->getProfesseur();
          $enteteAtelier = $unAtelier->getNom_atelier().'<br>' ;
          if (!empty($oProf))
          {
            $enteteAtelier = $enteteAtelier.' '.$oProf->getPrenom_professeur().' '.$oProf->getNom_professeur() ;
          }  
          $enteteAtelier = $enteteAtelier.'<br>'.$unAtelier->getSalle() ;
    ?>
    

        <div class="item auto">
          <table  style="margin:0px auto;max-width:1110px; background:#dcdee3;">
          <thead>  
            <!-- titre des colonnes -->
            <tr height="50">
              <th width="20%"><strong><?php echo $enteteAtelier; ?></strong></th>   
            </tr>
          </thead>
          <tbody>

        <?php
          
          $mesEleves = $eleveManager->getEleveByAtelier($idAtelier);
          if (count($mesEleves) == 0)
          {
            /*
            $afficheEleve = "<tr><td> Aucun inscrit</td></tr>";  
            print ($afficheEleve);
            */
            ?>
            <tr><td> Aucun inscrit </td></tr>
            <?php
          }
          else
          {
            /* Pour chaque inscrit dans cet atelier */
            $a = 0;
            while ($a < count($mesEleves)) 
            {
                $unEleve = $mesEleves[$a];
                $idEleve = $unEleve->getId_eleve();
                $afficheEleve = "<tr><td>".$unEleve->getNom_eleve()." ".$unEleve->getPrenom_eleve()."</td></tr>"; 
                $a = $a + 1;

                print ($afficheEleve);
            }    
          }   
        ?>
        </tbody>      
        </table>
      </div>  <!-- item -->

    <?php      
    }
    ?>

</div>
<br />
<form>
  <input class="inputBlue" id="impression" name="impression" type="button" onclick="window.print();" value="Générer un PDF" />
</form>
</div>
</html>