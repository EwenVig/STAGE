<?php @session_start();
require 'Gen/AccesDonnees.php';
require 'Model/PROFESSEUR.php';
require 'DAO/professeurManager.php';

if(isset($_POST['login']) && isset($_POST['pwd']))
{
    // connexion � la base de donn�es
    $db = connexion();
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour �liminer toute attaque de type injection SQL et XSS
    
    //$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['login']));
    //$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['pwd']));
    $username = $_POST['login'];
    $password = $_POST['pwd'];
    
    if($username !== "" && $password !== "")
    {
       
        $requete = "SELECT count(*) FROM PROFESSEUR 
                WHERE ADMIN = 'AP2DB'
                AND LOGIN_PROFESSEUR = '".$username."' 
                and MDP_PROFESSEUR = '".$password."'; ";

        $exec_requete = $db->query($requete);
        $reponse = $exec_requete->fetch(PDO::FETCH_ASSOC);
        $nbUser = $reponse['count(*)'];
             
        
        if($nbUser!=0)// nom d'utilisateur et mot de passe corrects
        {
            $profManager = new professeurManager($db);
            $oProfCnx = $profManager->getProfesseurByLogin($username);
            $_SESSION['LOGIN'] = $username;
            $_SESSION['ID'] = $oProfCnx->getId_professeur();
            $_SESSION['TYPE'] = 'ADMIN';
            header('Location: Vue/FormListCampagne.php');
        }
        else 
        {
            echo '<body onLoad="alert(\'Administrateur non reconnu...\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=../admAP.php">';
        }
    }
    else
    {
        header('Location: admAP.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}


?>