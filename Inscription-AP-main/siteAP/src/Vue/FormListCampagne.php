<?php
include 'tindex.php';
require '../Model/CAMPAGNE.php';
require '../DAO/campagneManager.php';
require '../Model/ATELIER.php';
require '../DAO/atelierManager.php';
require '../Model/GroupeClasse.php';
require '../DAO/GroupeClasseManager.php';

$campagneManager = new campagneManager($pdo);
$atelierManager = new atelierManager($pdo);
$groupeClasseManager = new GroupeClasseManager($pdo);


//----------SUPPRIMER-------------//
if (isset($_GET['supprimer'])) 
{
    $idCampagne = $_GET['supprimer'];
    $oCampagne = $campagneManager->getCampagne($idCampagne);
    $campagneManager->supprCampagne($oCampagne);
    header('Location: FormListCampagne.php');
    exit();
}

//----------SUPPRIMER-------------//
if (isset($_GET['copier'])) 
{
  $idCampagne = $_GET['copier'];
  $campagneManager->copyCampagne($idCampagne);
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

<div class="contenu2">
  <h2>LISTE DES CAMPAGNES <img src="../../images/visitr.png" style="width: 49px;"></h2> 
  
<table  style="margin:0px auto; max-width:1110px; background:#dcdee3;">
      <thead>
        <!-- titre des colones -->
        <tr height="50">
        
          <th width="20%"><strong>CAMPAGNE</strong></th>
          <th width="20%"><strong>NOM CAMPAGNE</strong></th>
          <th width="20%"><strong>DATE DEBUT CAMPAGNE</strong></th>
          <th width="20%"><strong>DATE FIN CAMPAGNE</strong></th>
          <th width="20%"><strong>SUPPRIMER</strong></th>
          <th width="20%"><strong>MODIFIER</strong></th>
          <th width="20%"><strong>COPIER</strong></th>
          <th width="20%"><strong>CLORE</strong></th>
          
        </tr>
      </thead>

      <?php        
      //----------Afficher--------------//       
      $mesCampagnes = $campagneManager->getAllCampagne();
      $i = 0;
      //print_r($mesCampagnes);
      while ($i < count($mesCampagnes)) {
          $uneCampagne = $mesCampagnes[$i];
          $i = $i + 1;               
      ?>

      <!-- creation des ligne des ateliers -->
      <?php 
      $idCampagne = $uneCampagne->getId_campagne();
      ?>
        <tr>
        
          <td><?php echo $idCampagne; ?></td>
          <td><?php echo $uneCampagne->getNom_campagne(); ?></td>
          <td><?php echo $uneCampagne->getDateDebut_campagne(); ?></td>
          <td><?php echo $uneCampagne->getDateFin_campagne(); ?></td>
          
          <td>      
          <form action='' method='GET'>
              <button type='submit' id='supprimer' name='supprimer' onclick="if(!confirm('Voulez-vous supprimer cette campagne ?')) return false;">
                  <img src='../../images/trash.png'/>
              </button>
              <input id='supprimer' name='supprimer' type='hidden' value="<?php echo $idCampagne; ?>"/>
          </form>     
		  </td>
		  
          <td>
          <form action='FormModifCampagne.php' method='GET'>
              <button type='submit'>
                  <img src='../../images/modify.png'/>
              </button>
              <input id='modifier' name='modifier' type='hidden' value="<?php echo $idCampagne; ?>"/>
          </form>
          </td>
          
          <td>
          <form action='' method='GET'>
              <button type='submit' id='copier' name='copier' onclick="if(!confirm('Voulez-vous copier cette campagne ?')) return false;">
                  <img src='../../images/add.png'/>
              </button>
              <input id='copier' name='copier' type='hidden' value="<?php echo $idCampagne; ?>"/>
          </form>
          </td>

          <td>
          <form action='FormInscription.php' method='GET'>
              <button type='submit' id='clore' name='clore'>
                  <img src='../../images/lock.png'/>
              </button>
              <input id='clore' name='clore' type='hidden' value="<?php echo $idCampagne; ?>"/>
          </form>
          </td>
        </tr>
          
          <?php          
        }
      ?>
</table>
<br />	
</div>
</html>
