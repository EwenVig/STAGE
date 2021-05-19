<?php @session_start();
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

if (isset($_GET['modifier']))
{
    $_SESSION['ID_CAMPAGNE'] = $_GET['modifier'];   // on mémorise la campagne courante
}

if (isset($_GET['ModifierCampagne'])) {
  $idCampagne = $_GET['ID_CAMPAGNE'];
  $campagne = $campagneManager->getcampagne($idCampagne);
  $campagneManager->modifCampagne($_GET);
  header('Location:FormModifCampagne.php');
  exit();
}

$idCampagne = $_SESSION['ID_CAMPAGNE'];
$uneCampagne = $campagneManager->getCampagne($idCampagne);



//----------SUPPRIMER UN ATELIER -------------//
if (isset($_GET['supprimer'])) {
    $idAtelier = $_GET['supprimer'];
    $atelier = $atelierManager->getAtelier($idAtelier);
    $atelierManager->supprAtelier($atelier);
    header('Location:FormModifCampagne.php');
    exit();
}

if (isset($_GET['ModifierAtelier'])) {
    $idAtelier = $_GET['ID_ATELIER'];
    $atelier = $atelierManager->getAtelier($idAtelier);
    $atelierManager->modifAtelier($_GET);
    header('Location:FormModifCampagne.php');
    exit();
}

// Affichage des classes autorisées
$lesClasses =  $uneCampagne->getLesClasses();

if (count($lesClasses) == 0)
  {
    $afficheClasse = 'Aucune classe autorisée <br><br><br>';
  }
else
{
  // Création de la liste des classes autorisées
  $afficheClasse = '';
  $n = 0;
  while ($n < count($lesClasses)) 
  {
    $afficheClasse = $afficheClasse.'<br>'.$lesClasses[$n]->getId_classe(); 
    $n = $n+1;
  }
}  

$capaciteTotale = 'Capacité totale '.$campagneManager->getCapaciteTotale($idCampagne); 
$syntheseInscription = 'Inscrits '.$campagneManager->getNbInscrits($idCampagne).' / '.$campagneManager->getNbTotalEleve($idCampagne); 

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

<title>AP</title>
<link href="../../styles/defaultAP.css" rel="stylesheet" type="text/css"/>

</head>

<div class="contenu2">

<div class="flex-container">
 <br/>

 <div class="item auto" >

 <h2>CAMPAGNE <?php echo $idCampagne ?></h2>

<form action="" method="GET"> 

<label><b>Nom de la campagne</b></label>
<input type="text" name="NOM_CAMPAGNE" id="NOM_CAMPAGNE" value="<?php echo $uneCampagne->getNom_campagne(); ?>" /><br>

<label><b>Date de début de la campagne</b></label><br>
<input type="date" name="DATEDEBUT_CAMPAGNE" id="DATEDEBUT_CAMPAGNE" value="<?php echo $uneCampagne->getDateDebut_campagne(); ?>" /><br>

<label><b>Date de fin de la campagne</b></label><br>
<input type="date" name="DATEFIN_CAMPAGNE" id="DATEFIN_CAMPAGNE" value="<?php echo $uneCampagne->getDateFin_campagne(); ?>" /><br>

<label><b><?php echo $afficheClasse; ?></b></label><br>
<br>
<label><b><?php echo $capaciteTotale; ?></b></label><br>
<br>
<label><b><?php echo $syntheseInscription; ?></b></label><br>
<br>
<input id='ID_CAMPAGNE' name='ID_CAMPAGNE' type='hidden' value="<?php echo $uneCampagne->getId_campagne(); ?>"/>
<input class="inputBlue" id="ListeInscription" name="ListeInscription" type="button" 
      value="ListeInscription" onclick="location.href='FormListInscription.php?ID_CAMPAGNE=<?php echo $uneCampagne->getId_campagne(); ?>'">
<input class="inputBlue" id="modifier" name="ModifierCampagne" type="Submit" value="Modifier">
<input class="inputBlue" id="back" name="back" type="button" value="Retour" onclick="location.href='FormListCampagne.php'">

</form>

</div>

<div class="item auto" >

  <h2>LISTE DES ATELIERS <img src="../../images/visitr.png" style="width: 49px;"></h2>
  
<!-- Bouton ajouter -->
<form action='FormAtelier.php' method='GET'>
      <button value="ATELIER" type='submit'>
            Ajouter un atelier<img src='../../images/add.png'/> 
      </button>
      <input id='modifier' name='ID_CAMPAGNE' type='hidden' value="<?php echo $idCampagne; ?>"/>
</form>
  
  
<table  style="margin:0px auto; background:#dcdee3;">

      <thead>
        <!-- titre des colones -->
        <tr height="50">
        
          <th width="20%"><strong>NOM ATELIER</strong></th>
          <th width="20%"><strong>DATE DEBUT</strong></th>
          <th width="20%"><strong>DATE FIN</strong></th>
          <th width="20%"><strong>CAPACITE</strong></th>
          <th width="20%"><strong>SUPPRIMER</strong></th>
          <th width="20%"><strong>MODIFIER</strong></th>
          
        </tr>
      </thead>

      <?php        
      //----------Afficher--------------//       
      $mesAteliers = $atelierManager->getAtelierByCampagne($idCampagne);
      $i = 0;
      //print_r($mesAteliers);
      while ($i < count($mesAteliers)) {
          $unAtelier = $mesAteliers[$i];
          $i = $i + 1;               
      ?>

      <!-- creation des ligne des ateliers -->
      <?php 
      $idAtelier = $unAtelier->getId_atelier();
      ?>
        <tr>
        
          <td><?php echo $unAtelier->getNom_atelier(); ?></td>
          <td><?php echo $unAtelier->getDateDebut_atelier(); ?></td>
          <td><?php echo $unAtelier->getDateFin_atelier(); ?></td>
          <td><?php echo $unAtelier->getCapacite_atelier(); ?></td>
          
          <td>      
          <form action='' method='GET'>
              <button type='submit' id='supprimer' name='supprimer' onclick="if(!confirm('Voulez-vous supprimer cet atelier ?')) return false;">
                  <img src='../../images/trash.png'/>
              </button>
              <input id='supprimer' name='supprimer' type='hidden' value="<?php echo $idAtelier; ?>"/>
          </form>     
		  </td>
		  
          <td>
          <form action='FormModifAtelier.php' method='GET'>
              <button  type='submit'>
                  <img src='../../images/modify.png'/>
              </button>
              <input id='modifier' name='ID_ATELIER' type='hidden' value="<?php echo $idAtelier; ?>"/>
              <input id='modifier' name='ID_CAMPAGNE' type='hidden' value="<?php echo $idCampagne; ?>"/>
          </form>
          </td>
        </tr>
          
          <?php          
        }
      ?>
</table>
<br />
	
</div>

</div>
</div>

</html>