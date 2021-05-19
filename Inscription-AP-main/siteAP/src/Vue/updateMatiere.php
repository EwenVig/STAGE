<?php
require 'FormModifMatiere.php';
$idMatiere = $_GET['modifier'];
          $matiereManager = new matiereManager($pdo);
          $matiere = $matiereManager->getMatiere($idMatiere);
        
          //----------SUPPRIMER-------------//
          if (isset($_GET['modifier'])) {
              $matiereManager->modifMatiere($_GET);
              header('Location: FormListMatiere.php');
              exit();
          }
?>