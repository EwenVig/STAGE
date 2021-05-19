<?php

class atelierManager {

    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }
    
    public function setDB(PDO $db) {
        $this-> db = $db;
    }
        
    public function getAtelier($id) 
    {
        $str = 'SELECT * FROM ATELIER WHERE ID_ATELIER = "'.$id.'";';
        
        $sql = $this-> db-> query($str);
        $atelier = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new ATELIER($atelier);
    }
    
    public function getAllAtelier() {
        $str = 'SELECT * FROM ATELIER ORDER BY DATEFIN_ATELIER;';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        $mesAteliers = array();
        $i = 0;
        
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $atelier = new ATELIER($ligne);
            $mesAteliers [$i] = $atelier;
            $i = $i + 1;
        }
        
        return $mesAteliers;
    }


    public function creerAtelier($donnees) {
        //pour contourner l'id d'auto increment qui sera incr�ment� par le SGBD
        $donnees['ID_ATELIER'] = -1;
        $oAtelier = new ATELIER($donnees);
        
        $str = 'INSERT INTO ATELIER (id_campagne, id_professeur, id_matiere, salle, nom_atelier, dateDebut_atelier, dateFin_atelier, capacite_atelier)
        Values ('.$donnees['ID_CAMPAGNE'].', '.$donnees['ID_PROFESSEUR'].', '.$donnees['ID_MATIERE'].', "'.$oAtelier->getSalle().'", "'.$oAtelier->getNom_atelier().'", "'.$oAtelier->getDateDebut_atelier().'", "'.$oAtelier->getDateFin_atelier().'", '.$oAtelier->getCapacite_atelier().');';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        
        // recup�ration de l'auto increment
        $id_atelier = $this-> db->lastInsertId();
        $retour = $oAtelier -> setId_atelier($id_atelier);
        
        return $oAtelier;
    }
    
    public function supprAtelier(ATELIER $atelier) {
        $str = 'DELETE FROM ATELIER WHERE ID_ATELIER = '.$atelier->getId_atelier().';';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
    }
    
    public function modifAtelier($donnees) {
        $oAtelier = new ATELIER($donnees);
        
        $str = 'UPDATE ATELIER
                SET nom_atelier = "'.$oAtelier->getNom_atelier().'", 
                    dateDebut_atelier = "'.$oAtelier->getDateDebut_atelier().'", 
                    dateFin_atelier = "'.$oAtelier->getDateFin_atelier().'", 
                    capacite_atelier = '.$oAtelier->getCapacite_atelier().', 
                    salle = "'.$oAtelier->getSalle().'",
                    id_professeur = '.$oAtelier->getProfesseur()->getId_professeur().',
                    id_matiere = '.$oAtelier->getId_Matiere().' 
                WHERE id_atelier = '.$oAtelier->getId_atelier().';';
        ecritRequeteSQL($str); 
        $sql = $this-> db-> query($str);
    }
    
    public function getCapaciteRestante($oAtelier) {
        
        $str = 'SELECT count(*) FROM INSCRIPTION WHERE ID_ATELIER = "'.$oAtelier->getId_atelier().'";';     
        ecritRequeteSQL($str);
        $sqlIns = $this-> db-> query($str);
        $count = $sqlIns-> fetchColumn();
        
        $capacite = $oAtelier->getCapacite_atelier();
        
        $nbCapaciteRestante = $capacite - $count;
        
        return $nbCapaciteRestante;
    }
   

    public function GetAtelierByCampagne($idCampagne) {
        
        $str = 'SELECT * FROM ATELIER WHERE id_campagne = '.$idCampagne.';';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        $mesAteliers = array();
        $i = 0;
        
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $atelier = new ATELIER($ligne);
            $mesAteliers [$i] = $atelier;
            $i = $i + 1;
        }
        
        return $mesAteliers;
    }
}


