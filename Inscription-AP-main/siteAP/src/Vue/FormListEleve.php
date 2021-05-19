<?php
include 'tindex.php';

$eleveManager = new eleveManager($pdo);

//----------SUPPRIMER-------------//
if (isset($_GET['supprimer'])) {
    $idEleve = $_GET['supprimer'];
    $eleve = $eleveManager->getEleve($idEleve);
    $eleveManager->supprEleve($eleve);
    header('Location: FormListEleve.php');
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
  <h2>LISTE DES ELEVES <img src="../../images/visitr.png" style="width: 49px;"></h2>

  <!-- Bouton ajouter -->
  <form action='FormEleve.php' method='GET'>
  <p>Ajouter un eleve :
      <button value="ELEVE">
          <img src='../../images/add.png'/>
      </button>
  </p>
  </form>
    
  
<table  style="margin:0px auto; max-width:1110px; background:#dcdee3;">
      <thead>
        <!-- titre des colones -->
        <tr height="50">
        
          <th width="20%"><strong>ID ELEVE</strong></th>
          <th width="20%"><strong>NOM ELEVE</strong></th>
          <th width="20%"><strong>PRENOM ELEVE</strong></th>
          <th width="20%"><strong>CLASSE ELEVE</strong></th>
          <th width="20%"><strong>LOGIN ELEVE</strong></th>
          <th width="20%"><strong>MOT DE PASSE ELEVE</strong></th>
          <th width="20%"><strong>MAIL ELEVE</strong></th>
          <th width="20%"><strong>SUPPRIMER</strong></th>
          <th width="20%"><strong>MODIFIER</strong></th>
          
        </tr>
      </thead>

      <?php        
      //----------Afficher--------------//       
      $mesEleves = $eleveManager->getAllEleve();
      $i = 0;
      while ($i < count($mesEleves)) {
          $unEleve = $mesEleves[$i];
          $i = $i + 1;               
      ?>

      <!-- creation des ligne des ateliers -->
      <?php 
      $idEleve = $unEleve->getId_eleve();
      ?>
        <tr>
        
          <td><?php echo $idEleve; ?></td>
          <td><?php echo $unEleve->getNom_eleve(); ?></td>
          <td><?php echo $unEleve->getPrenom_eleve(); ?></td>
          <td><?php echo $unEleve->getId_classe(); ?></td>
          <td><?php echo $unEleve->getLogin_Eleve(); ?></td>
          <td><?php echo $unEleve->getMdp_eleve(); ?></td>
          <td><?php echo $unEleve->getMail_eleve(); ?></td>
          
          <td>      
          <form action='' method='GET'>
              <button type='submit' id='supprimer' name='supprimer' onclick="if(!confirm('Voulez-vous supprimer cette eleve ?')) return false;">
                  <img src='../../images/trash.png'/>
              </button>
              <input id='supprimer' name='supprimer' type='hidden' value="<?php echo $idEleve; ?>"/>
          </form>     
		  </td>
		  
          <td>
          <form action='FormModifEleve.php' method='GET'>
              <button type='submit'>
                  <img src='../../images/modify.png'/>
              </button>
              <input id='modifier' name='modifier' type='hidden' value="<?php echo $idEleve; ?>"/>
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
