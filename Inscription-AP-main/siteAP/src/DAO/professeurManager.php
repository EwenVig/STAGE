<?php
class professeurManager {

    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }

    public function setDB(PDO $db) {
        $this-> db = $db;
    }
    
    public function getProfesseur($id) {
        
        $str = 'SELECT * FROM PROFESSEUR WHERE id_professeur = "'.$id.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $professeur = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new PROFESSEUR($professeur);
    }
    
    public function getAllProfesseur() {
        $str = 'SELECT * FROM PROFESSEUR ORDER BY NOM_PROFESSEUR;';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $i = 0;
        
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $professeur = new PROFESSEUR($ligne);
            $mesProfesseurs [$i] = $professeur;
            $i = $i + 1;
        }
        
        return $mesProfesseurs;
    }
    
    public function creerProfesseur($donnees) {
        //pour contourner l'id d'auto increment qui sera incr�ment� par le SGBD
        $donnees['ID_PROFESSEUR'] = -1;
        $oProf = new PROFESSEUR($donnees);
        
        $str = 'INSERT INTO PROFESSEUR (nom_professeur, prenom_professeur, mail_professeur, login_professeur, mdp_professeur)
        Values ("'.$oProf->getNom_professeur().'", "'.$oProf->getPrenom_professeur().'", "'.$oProf->getMail_professeur().'", "'.$oProf->getLogin_professeur().'", "'.$oProf->getMdp_professeur().'");';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        
        // recup�ration de l'auto increment
        $id_professeur = $this-> db->lastInsertId();
        $retour = $oProf -> setId_professeur($id_professeur);
        
        return $oProf;
    }

    public function getProfesseurByLogin($login) {
        $str = 'SELECT * FROM PROFESSEUR WHERE LOGIN_PROFESSEUR = "'.$login.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $prof = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new PROFESSEUR($prof);
    }

    public function existProfesseur($login) {
        $str = 'SELECT count(*) nbProfesseur FROM PROFESSEUR WHERE LOGIN_Professeur = "'.$login.'";';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        $nbProfesseur = $sql-> fetch(PDO::FETCH_COLUMN);
        
        return $nbProfesseur;
    }
    
    public function importProfesseur($nomFichier) {
        // retourne une collection d'élève à insérer dans la base de données
        $nbProfesseur = 0;
        // Lire le fichier $nomFichier
        $fichier_ligne = file($nomFichier);
	    $nbProfesseur = count($fichier_ligne); // $i compte le nombre de ligne dans le fichier

        // On boucle
        $n = 1;         // compteur de lignes - On saute la ligne d'entete
        $cpt = 0;       // compteur d'insertions
        while ($n < $nbProfesseur) {

            list($nom, $prenom,$mail) = explode(";", $fichier_ligne[$n]);
            
            $donnees['ID_Professeur'] = -1;
            $donnees['NOM_PROFESSEUR'] = $nom;
            $donnees['PRENOM_PROFESSEUR'] = $prenom;
            $donnees['MAIL_PROFESSEUR'] = $mail;
            list($donnees['LOGIN_PROFESSEUR'],$tmp) = explode('@', $mail);
            list($donnees['MDP_PROFESSEUR'],$tmp) = explode('@', $mail);

            /* Si le prof n'existe pas déjà, on le crée */
            if (!($this->existProfesseur($donnees['LOGIN_PROFESSEUR'])))
            {
                $this -> creerProfesseur($donnees);
                $cpt = $cpt+1;
            }

            $n = $n +1;
        }

        return $cpt;
    }

    public function getSelectProfesseur($idSelect) {
        // retourne la chaine de <option value HTML> pour tous les professeurs
        $mesProfesseurs = $this->getAllProfesseur();
            
        $strOptionValue = '==>'.$idSelect;

        $i = 0;
        $strOptionValue = '';
        while ($i < count($mesProfesseurs)) 
        {
            $unProfesseur = $mesProfesseurs[$i];
            $id = $unProfesseur->getId_professeur();
            $nom = $unProfesseur->getNom_professeur();
            $prenom = $unProfesseur->getPrenom_professeur();

            if (!empty($idSelect) AND $id == $idSelect)
            {
                $strOptionValue = $strOptionValue."<option value=".$id." selected>".$nom." ".$prenom."</option>" ; 
            }
            else
            {
                $strOptionValue = $strOptionValue."<option value=".$id.">".$nom." ".$prenom."</option>" ; 
            }
            $i = $i + 1;
        }      
        return $strOptionValue;
    }  

}
