<?php @session_start();
require 'Gen/AccesDonnees.php';
require 'Model/ELEVE.php';
require 'DAO/eleveManager.php';

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

    //nom d'utilisateur et mot de passe identiques
    
    
    if ($username == $password) {
        echo $username;
        echo $password;
        header('Location: Vue/FormChangerMdp.php');
        exit();
    } 
    
    //nom d'utilisateur et mot de passe incorrects
    if($username !== "" && $password !== "")
    {
        
        $requeteEleve = "SELECT count(*) FROM ELEVE where
              LOGIN_ELEVE = '".$username."' and MDP_ELEVE = '".$password."' ";
        $exec_requeteEleve = $db->query($requeteEleve);
        $reponseEleve = $exec_requeteEleve->fetch(PDO::FETCH_ASSOC);
        $countEleve = $reponseEleve['count(*)'];     
        
        if($countEleve!=0)// nom d'utilisateur et mot de passe correctes
        {
            $eleveManager = new eleveManager($db);
            $oEleveCnx = $eleveManager->getEleveByLogin($username);
            $_SESSION['LOGIN'] = $username;
            $_SESSION['ID'] = $oEleveCnx->getId_eleve();
            $_SESSION['TYPE'] = 'ELEVE';
            header('Location: Vue/FormInscription.php');
        }
        else 
        {
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
        }
    }
    else
    {
        header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}



?>