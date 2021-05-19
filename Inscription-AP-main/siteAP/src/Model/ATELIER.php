<?php

/**************************************************************************
* Source File	:  ATELIER.php
* Author                   :  Deduyer
* Project name         :  Non enregistr�* Created                 :  21/01/2021
* Modified   	:  21/01/2021
* Description	:  Definition of the class ATELIER
**************************************************************************/

class ATELIER 			
{
	//Attributes
		
	 
	var $id_atelier; // type : int
	var $nom_atelier; // type : string
	var $dateDebut_atelier; // type : string
	var $dateFin_atelier; // type : string
	var $capacite_atelier; // type : int
    var $id_campagne;
    var $professeur;
    var $id_matiere;
    var $salle;

    	 
    public function __construct($donnees)
    {
        global $professeurManager;

        $this->setId_atelier($donnees['ID_ATELIER']);
        $this->setNom_atelier($donnees['NOM_ATELIER']);
        $this->setDateDebut_atelier($donnees['DATEDEBUT_ATELIER']);
        $this->setDateFin_atelier($donnees['DATEFIN_ATELIER']);
        $this->setCapacite_atelier($donnees['CAPACITE_ATELIER']);
        $this->setId_campagne($donnees['ID_CAMPAGNE']);
        $this->setId_matiere($donnees['ID_MATIERE']);
        $this->setSalle($donnees['SALLE']);

        if ($donnees['ID_PROFESSEUR'] != '')
        {
            $oProfesseur = $professeurManager->getProfesseur($donnees['ID_PROFESSEUR']);
            $this->setProfesseur($oProfesseur);
        }
        else
        {
            $this->professeur = array();
        }
    }
    
	//Operations

    /**
     * @return mixed
     */
    public function getId_atelier()
    {
        return $this->id_atelier;
    }

    /**
     * @param mixed $id_atelier
     */
    public function setId_atelier($id_atelier)
    {
        $this->id_atelier = $id_atelier;
    }

    /**
     * @return mixed
     */
    public function getNom_atelier()
    {
        return $this->nom_atelier;
    }

    /**
     * @param mixed $nom_atelier
     */
    public function setNom_atelier($nom_atelier)
    {
        $this->nom_atelier = $nom_atelier;
    }

    /**
     * @return mixed
     */
    public function getDateDebut_atelier()
    {
        return $this->dateDebut_atelier;
    }

    /**
     * @param mixed $dateDebut_atelier
     */
    public function setDateDebut_atelier($dateDebut_atelier)
    {
        $this->dateDebut_atelier = $dateDebut_atelier;
    }

    /**
     * @return mixed
     */
    public function getDateFin_atelier()
    {
        return $this->dateFin_atelier;
    }

    /**
     * @param mixed $dateFin_atelier
     */
    public function setDateFin_atelier($dateFin_atelier)
    {
        $this->dateFin_atelier = $dateFin_atelier;
    }

    /**
     * @return mixed
     */
    public function getCapacite_atelier()
    {
        return $this->capacite_atelier;
    }

    /**
     * @param mixed $capacite_atelier
     */
    public function setCapacite_atelier($capacite_atelier)
    {
        $this->capacite_atelier = $capacite_atelier;
    }
	 
	function getId_campagne() { 
 		return $this->id_campagne; 
	} 

	function setId_campagne($idCampagne) {  
		$this->id_campagne = $idCampagne; 
	} 

	function getProfesseur() { 
 		return $this->professeur; 
	} 

	function setProfesseur($oProfesseur) {  
		$this->professeur = $oProfesseur; 
	} 

	function getId_matiere() { 
 		return $this->id_matiere; 
	} 

	function setId_matiere($idmatiere) {  
		$this->id_matiere = $idmatiere; 
	} 

	function getSalle() { 
 		return $this->salle; 
	} 

	function setSalle($salle) {  
		$this->salle = $salle; 
	} 

} // End Class ATELIER
?>