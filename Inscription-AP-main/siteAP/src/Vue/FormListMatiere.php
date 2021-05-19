<?php
include 'tindex.php';
require '../Model/MATIERE.php';
require '../DAO/matiereManager.php';

$matiereManager = new matiereManager($pdo);

//----------SUPPRIMER-------------//
if (isset($_GET['supprimer'])) {
    $idMatiere = $_GET['supprimer'];
    $matiere = $matiereManager->getMatiere($idMatiere);
    $matiereManager->supprMatiere($matiere);
    header('Location: FormListMatiere.php');
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
  <h2>LISTE DES MATIERES <img src="../../images/visitr.png" style="width: 49px;"></h2>

  <!-- Bouton ajouter -->
  <form action='FormMatiere.php' method='GET'>
  <p>Ajouter une matiere :
      <button value="MATIERE">
          <img src='../../images/add.png'/>
      </button>
  </p>
  </form>
    
  
<table  style="margin:0px auto; max-width:1110px; background:#dcdee3;">
      <thead>
        <!-- titre des colones -->
        <tr height="50">
        
          <th width="20%"><strong>ID MATIERE</strong></th>
          <th width="20%"><strong>NOM MATIERE</strong></th>
          <th width="20%"><strong>SUPPRIMER</strong></th>
          <th width="20%"><strong>MODIFIER</strong></th>
          
        </tr>
      </thead>

      <?php        
      //----------Afficher--------------//       
      $mesMatieres = $matiereManager->getAllMatiere();
      $i = 0;
      while ($i < count($mesMatieres)) {
          $uneMatiere = $mesMatieres[$i];
          $i = $i + 1;               
      ?>

      <!-- creation des ligne des ateliers -->
      <?php 
      $idMatiere = $uneMatiere->getId_Matiere();
      ?>
        <tr>
        
          <td><?php echo $idMatiere; ?></td>
          <td><?php echo $uneMatiere->getNom_matiere(); ?></td>
          
          <td>      
          <form action='' method='GET'>
              <button type='submit' id='supprimer' name='supprimer' onclick="if(!confirm('Voulez-vous supprimer cette matiere ?')) return false;">
                  <img src='../../images/trash.png'/>
              </button>
              <input id='supprimer' name='supprimer' type='hidden' value="<?php echo $idMatiere; ?>"/>
          </form>     
		  </td>
		  
          <td>
          <form action='FormModifMatiere.php' method='GET'>
              <button type='submit'>
                  <img src='../../images/modify.png'/>
              </button>
              <input id='modifier' name='modifier' type='hidden' value="<?php echo $idMatiere; ?>"/>
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
