<?php

/**************************************************************************
 * Source File	:  CAMPAGNE.php
 * Author                   :  Deduyer
 * Project name         :  Non enregistr�* Created                 :  21/01/2021
 * Modified   	:  21/01/2021
 * Description	:  Definition of the class CAMPAGNE
 **************************************************************************/

class CAMPAGNE
{
    //Attributes
    
    var $id_campagne; // type : int
    var $dateDebut_campagne; // type : string
    var $dateFin_campagne; // type : string
    var $nom_campagne; // type : string
    var $lesAteliers; // collection ATELIER
    var $lesClasses;  // collection de GROUPECLASSE autorisés
    
    //Operations
    
    public function __construct($donnees)
    {
        global $atelierManager;
        global $groupeClasseManager;
        
        $this->setId_campagne($donnees['ID_CAMPAGNE']);
        $this->setDateDebut_campagne($donnees['DATEDEBUT_CAMPAGNE']);
        $this->setDateFin_campagne($donnees['DATEFIN_CAMPAGNE']);
        $this->setNom_campagne($donnees['NOM_CAMPAGNE']);

        $lesAteliers = $atelierManager->getAtelierByCampagne($this->id_campagne);
        $this->setLesAteliers($lesAteliers); 

        $lesClasses = $groupeClasseManager->getGroupeClasseByCampagne($this->id_campagne);
        $this->setlesClasses($lesClasses); 
    }
    
   
    /**
     * @return mixed
     */
    public function getId_campagne()
    {
        return $this->id_campagne;
    }
    
    /**
     * @param mixed $id_campagne
     */
    public function setId_campagne($id_campagne)
    {
        $this->id_campagne = $id_campagne;
    }
    
    /**
     * @return mixed
     */
    public function getDateDebut_campagne()
    {
        return $this->dateDebut_campagne;
    }
    
    /**
     * @param mixed $dateDebut_campagne
     */
    public function setDateDebut_campagne($dateDebut_campagne)
    {
        $this->dateDebut_campagne = $dateDebut_campagne;
    }
    
    /**
     * @return mixed
     */
    public function getDateFin_campagne()
    {
        return $this->dateFin_campagne;
    }
    
    /**
     * @param mixed $dateFin_campagne
     */
    public function setDateFin_campagne($dateFin_campagne)
    {
        $this->dateFin_campagne = $dateFin_campagne;
    }
    
    /**
     * @return mixed
     */
    public function getNom_campagne()
    {
        return $this->nom_campagne;
    }
    
    /**
     * @param mixed $nom_campagne
     */
    public function setNom_campagne($nom_campagne)
    {
        $this->nom_campagne = $nom_campagne;
    }
   
    function getLesAteliers() {
        return $this->lesAteliers;
    }
    
    function setLesAteliers($lesAteliers) {
        $this->lesAteliers = $lesAteliers;
    } 

    function getlesClasses() {
        return $this->lesClasses;
    }
    
    function setlesClasses($lesClasses) {
        $this->lesClasses = $lesClasses;
    } 


} // End Class CAMPAGNE


?>