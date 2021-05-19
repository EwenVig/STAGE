<?php @SESSION_START();

class inscriptionManager {

    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }

    public function setDB(PDO $db) {
        $this-> db = $db;
    }
    
    public function getInscription($id) {

        $str = 'SELECT * FROM INSCRIPTION WHERE id_inscription = "'.$id.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $oInscription = $sql-> fetch(PDO::FETCH_ASSOC);

        return new INSCRIPTION($oInscription);
    }
    
    public function getAllInscription() {
        $str = 'SELECT * FROM INSCRIPTION ORDER BY ID_ATELIER;';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $mesInscriptions = array();
        $i = 0;
        
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $inscription = new INSCRIPTION($ligne);
            $mesInscriptions [$i] = $inscription;
            $i = $i + 1;
        }
        
        return $mesInscriptions;
    }
    
    public function creerInscription($donnees) {
        //pour contourner l'id d'auto increment qui sera incr�ment� par le SGBD
        $donnees['ID_INSCRIPTION'] = -1;
        $donnees['DATE_INSCRIPTION'] = date("Y-m-d H:i:s");       // date du jour
        $oInscription = new INSCRIPTION($donnees);
        
        $str = 'INSERT INTO INSCRIPTION (id_eleve, id_atelier, date_inscription)
        VALUES ('.$oInscription->getOEleve()->getId_eleve().', '.$oInscription->getOAtelier()->getId_atelier().', "'.$oInscription->getDate_Inscription().'");';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        
        // recup�ration de l'auto increment
        $id_Inscription = $this-> db->lastInsertId();
        $retour = $oInscription -> setId_Inscription($id_Inscription);
        
        return $oInscription;
    }

    public function getNbInscription($idEleve) {

        global $campagneManager;

        $oCampagneCourante = $campagneManager->getCampagneCourante($idEleve);

        $idCampagne = $oCampagneCourante->getId_Campagne();

        $str ='SELECT COUNT(*) FROM INSCRIPTION,ATELIER 
                WHERE INSCRIPTION.ID_ATELIER = ATELIER.ID_ATELIER 
                AND ID_ELEVE = '.$idEleve. ' AND ID_CAMPAGNE = ' .$idCampagne.';';
        ecritRequeteSQL($str);  

        $sql = $this-> db-> query($str);
        //$NbInscription = $sql-> fetch(PDO::FETCH_ASSOC);
        $NbInscription = $sql-> fetchColumn();
        

        return $NbInscription;
    }

    public function getInscriptionByEleve($idCampagne,$idEleve) {

        $str ='SELECT id_inscription FROM INSCRIPTION,ATELIER
        WHERE INSCRIPTION.ID_ATELIER = ATELIER.ID_ATELIER 
                
                AND ID_ELEVE = '.$idEleve. ' AND ID_CAMPAGNE = ' .$idCampagne.';';
        ecritRequeteSQL($str);  

        $sql = $this-> db-> query($str);
        //$NbInscription = $sql-> fetch(PDO::FETCH_ASSOC);
        $idInscription = $sql-> fetchColumn();
        

        return $idInscription;
    }

}
