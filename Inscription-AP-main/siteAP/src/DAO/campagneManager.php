<?php
class campagneManager {
    
    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }
    
    public function setDB(PDO $db) {
        $this-> db = $db;
    }
    
    public function getCampagne($id) {
        $str = 'SELECT * FROM CAMPAGNE WHERE id_campagne = '.$id.';';
        ecritRequeteSQL($str);
        $sql = $this-> db-> query($str);
        $campagne = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new CAMPAGNE($campagne);
    }

    public function getCampagneCourante($idEleve) {
        $str = 'SELECT * FROM CAMPAGNE, ELEVE, AUTORISER 
        WHERE ELEVE.id_classe = AUTORISER.id_classe
        AND AUTORISER.id_campagne = CAMPAGNE.id_campagne
        AND ELEVE.id_eleve = '.$idEleve.' 
        AND datefin_campagne >= NOW() 
        AND datedebut_campagne <= NOW()
        ORDER BY datedebut_campagne DESC
        LIMIT 1'; 
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        $campagne = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new CAMPAGNE($campagne);
    }
    
    public function getAllCampagne() {
        $str = 'SELECT * FROM CAMPAGNE;';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        
        $i = 0;
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $campagne = new CAMPAGNE($ligne);
            $mesCampagnes [$i] = $campagne;
            $i = $i + 1;
        }
        
        return $mesCampagnes;
    }
    
    public function creerCampagne($donnees) {
        //pour contourner l'id d'auto increment qui sera incr�ment� par le SGBD
        $donnees['ID_CAMPAGNE'] = -1;
        $oCampagne = new CAMPAGNE($donnees);
        
        $str = 'INSERT INTO CAMPAGNE (nom_campagne, dateDebut_campagne, dateFin_campagne)
        Values ("'.$oCampagne->getNom_campagne().'", "'.$oCampagne->getDateDebut_campagne().'", "'.$oCampagne->getDateFin_campagne().'");';
        ecritRequeteSQL($str);
        $sql = $this-> db-> query($str);
        
        // recup�ration de l'auto increment
        $id_campagne = $this-> db->lastInsertId();
        $retour = $oCampagne -> setId_campagne($id_campagne);
        
        return $oCampagne;
    }
    
    public function supprCampagne(CAMPAGNE $campagne) {
        $str = 'DELETE FROM CAMPAGNE WHERE ID_CAMPAGNE = '.$campagne->getId_campagne().';';
        ecritRequeteSQL($str);
        $sql = $this-> db-> query($str);
    }
    
    public function modifCampagne($donnees) {
        $oCampagne = new CAMPAGNE($donnees);
        
        $str = 'UPDATE CAMPAGNE
                SET nom_campagne = "'.$oCampagne->getNom_campagne().'", dateDebut_campagne = "'.$oCampagne->getDateDebut_campagne().'", dateFin_campagne = "'.$oCampagne->getDateFin_campagne().'"
                WHERE id_campagne = '.$oCampagne->getId_campagne().';';
        ecritRequeteSQL($str);
        $sql = $this-> db-> query($str);
    }
    
    public function copyCampagne($idCampagne) 
    {
        // Copie de la campagne $idCampagne
        $str = 'INSERT INTO CAMPAGNE (nom_campagne, dateDebut_campagne, dateFin_campagne)
        SELECT " Copie de la campagne '.$idCampagne.' ", now(), now() FROM CAMPAGNE WHERE id_campagne = '.$idCampagne.';';
        ecritRequeteSQL($str);
        $sql = $this-> db-> query($str);

        // Copie des ateliers de la campagne $idCampagne
        $id_copie = $this-> db->lastInsertId();
        $requete = 'INSERT INTO ATELIER (ID_CAMPAGNE, id_professeur, id_matiere, nom_atelier, dateDebut_atelier, dateFin_atelier, capacite_atelier)
                    SELECT '.$id_copie.', id_professeur, id_matiere, nom_atelier, now(), now(), capacite_atelier 
                    FROM ATELIER WHERE id_campagne = '.$idCampagne.';';
        $execute = $this-> db-> query($requete);

        // Copie des autorisations pour les classes de la campagne $idCampagne
        $requete = 'INSERT INTO AUTORISER (ID_CAMPAGNE, ID_CLASSE)
                    SELECT '.$id_copie.', id_classe
                    FROM AUTORISER WHERE id_campagne = '.$idCampagne.';';
        $execute = $this-> db-> query($requete);

    }
    
    public function getElevesNonInscrits($idCampagne) 
    {
        $str = 'SELECT *  FROM ELEVE, AUTORISER
               WHERE ELEVE.ID_CLASSE =  AUTORISER.ID_CLASSE
               AND AUTORISER.ID_CAMPAGNE = '.$idCampagne.'
               AND id_eleve NOT IN (SELECT id_eleve FROM INSCRIPTION, ATELIER 
               WHERE ATELIER.id_atelier = INSCRIPTION.id_atelier AND ATELIER.id_campagne = '.$idCampagne.');';
        ecritRequeteSQL($str);        
        $sql = $this-> db-> query($str);
        
        $lesEleves = array();
        $i = 0;
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $eleve = new ELEVE($ligne);
            $lesEleves[$i] = $eleve;
            $i = $i + 1;
        }
        
        return $lesEleves;
    }

    function getCapaciteTotale($idCampagne) {

        $str ='SELECT SUM(capacite_atelier) FROM ATELIER 
        WHERE ID_CAMPAGNE = ' .$idCampagne.';';
        ecritRequeteSQL($str);


        $sql = $this-> db-> query($str);
        $CapaciteTotale = $sql-> fetchColumn();
 
        return $CapaciteTotale;
   }

   public function getNbInscrits($idCampagne) 
   {

    $str ='SELECT COUNT(*) FROM INSCRIPTION, ATELIER
    WHERE INSCRIPTION.ID_ATELIER =  ATELIER.ID_ATELIER
    AND ID_CAMPAGNE = ' .$idCampagne.';';
    ecritRequeteSQL($str);

    $sql = $this-> db-> query($str);
    $NbInscrits = $sql-> fetchColumn();

    return $NbInscrits;
   }

   public function getNbTotalEleve($idCampagne) 
   {

    $str ='SELECT COUNT(*) FROM ELEVE, GROUPECLASSE, AUTORISER
    WHERE ELEVE.id_classe = GROUPECLASSE.id_classe
    AND GROUPECLASSE.id_classe = AUTORISER.id_classe
    AND ID_CAMPAGNE = ' .$idCampagne.';';
    ecritRequeteSQL($str);  

    $sql = $this-> db-> query($str);
    $NbInscrits = $sql-> fetchColumn();

    return $NbInscrits;
   }

}



