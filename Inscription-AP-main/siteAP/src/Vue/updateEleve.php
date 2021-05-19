<?php
require 'FormModifEleve.php';
$idEleve = $_GET['modifier'];
$eleveManager = new eleveManager($pdo);
$eleve = $eleveManager->getEleve($idEleve);
        
          //----------SUPPRIMER-------------//
          if (isset($_GET['modifier'])) {
              $eleveManager->modifEleve($_GET);
              header('Location: FormListEleve.php');
              exit();
          }
?>