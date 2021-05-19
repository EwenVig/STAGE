<?php
class eleveManager {

    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }

    public function setDB(PDO $db) {
        $this-> db = $db;
    }
    
    public function getEleve($id) {
        $str = 'SELECT * FROM ELEVE WHERE ID_ELEVE = "'.$id.'";';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        $eleve = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new ELEVE($eleve);
    }
    
    public function getAllEleve() {
        $str = 'SELECT * FROM ELEVE;';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $mesEleves = array();
        $i = 0;
        
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $eleve = new ELEVE($ligne);
            $mesEleves [$i] = $eleve;
            $i = $i + 1;
        }
        
        return $mesEleves;
    }
    
    public function getEleveByLogin($login) {
        $str = 'SELECT * FROM ELEVE WHERE LOGIN_ELEVE = "'.$login.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $eleve = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new ELEVE($eleve);
    }
    
    public function supprEleve(ELEVE $eleve) {
        $str = 'DELETE FROM ELEVE WHERE ID_ELEVE = '.$eleve->getId_eleve().';';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
    }
    
    public function modifEleve($donnees) {
        $oEleve = new ELEVE($donnees);
        
        $str = 'UPDATE ELEVE
                SET nom_eleve = "'.$oEleve->getNom_eleve().'",
                    prenom_eleve = "'.$oEleve->getPrenom_eleve().'",
                    login_eleve = "'.$oEleve->getLogin_eleve().'",
                    mdp_eleve = '.$oEleve->getMdp_eleve().',
                    mail_eleve = "'.$oEleve->getMail_eleve().'"
                WHERE id_eleve = '.$oEleve->getId_eleve().';';
        ecritRequeteSQL($str);
        $sql = $this-> db-> query($str);
    }

    public function existEleve($login) {
        $str = 'SELECT count(*) nbEleve FROM ELEVE WHERE LOGIN_ELEVE = "'.$login.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $nbEleve = $sql-> fetch(PDO::FETCH_COLUMN);
        
        return $nbEleve;
    }

    public function getEleveByAtelier($idAtelier) {
        $str = 'SELECT * FROM ELEVE, INSCRIPTION 
                WHERE ELEVE.id_eleve = INSCRIPTION.id_eleve
                AND ID_ATELIER = '.$idAtelier.';';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $mesEleves = array();
        $i = 0;
        
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $eleve = new ELEVE($ligne);
            $mesEleves [$i] = $eleve;
            $i = $i + 1;
        }
        
        return $mesEleves;
    }
   
    public function creerEleve($donnees) {
        //pour contourner l'id d'auto increment qui sera incr�ment� par le SGBD
        $donnees['ID_ELEVE'] = -1;
        $oEleve = new ELEVE($donnees);
        
        $str = 'INSERT INTO ELEVE (nom_eleve, prenom_eleve, mail_eleve, login_eleve, mdp_eleve, id_classe)
        Values ("'.$oEleve->getNom_eleve().'", "'.$oEleve->getPrenom_eleve().'", "'.$oEleve->getMail_eleve().'", "'.$oEleve->getLogin_eleve().'", "'.$oEleve->getMdp_eleve().'","'.$oEleve->getId_classe().'");';
        ecritRequeteSQL($str);


        // Prévoir try and catch (afficheErreur($str, $this->db->errorInfo()));
        $sql = $this->db->query($str);
    
        // recup�ration de l'auto increment
        $id_eleve = $this-> db->lastInsertId();
        $retour = $oEleve -> setId_eleve($id_eleve);
        
        return $oEleve;
    }
    
    public function importEleve($nomFichier) {
        // retourne une collection d'élève à insérer dans la base de données
        // Lire le fichier $nomFichier
        $fichier_ligne = file($nomFichier);
	    $nbEleve = count($fichier_ligne)-1; // $i compte le nombre de ligne dans le fichier 1ere ligne non lue
        // On boucle
        $n = 1;                             // compteur de lignes - 1ere ligne entete non lue
        $cpt = 0;                           // compteur d'insertion
        while ($n <= $nbEleve) 
        {

            list($classe, $nom, $prenom, $mail) = explode(";", $fichier_ligne[$n]);
            
            $donnees['ID_ELEVE'] = -1;
            $donnees['NOM_ELEVE'] = $nom;
            $donnees['PRENOM_ELEVE'] = $prenom;
            $donnees['MAIL_ELEVE'] = $mail;
            $donnees['ID_CLASSE'] = $classe;
            list($donnees['LOGIN_ELEVE'],$tmp) = explode('@', $mail);
            list($donnees['MDP_ELEVE'],$tmp) = explode('@', $mail);

            /* Si l'élève n'existe pas déjà, on le crée */
            if (!($this->existEleve($donnees['LOGIN_ELEVE'])))
            {
                $this -> creerEleve($donnees);
                $cpt = $cpt+1;
            }

            $n = $n +1;
        }

        return $cpt;
    }
    
    public function deleteAllEleve() 
    {
        $str = 'DELETE FROM ELEVE;';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);

        
        return 1;
    }

}
