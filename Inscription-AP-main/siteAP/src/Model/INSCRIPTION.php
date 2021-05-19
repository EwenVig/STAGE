<?php

/**************************************************************************
 * Source File	:  INSCRIPTION.php
 * Author                   :  Deduyer
 * Project name         :  Non enregistr�* Created                 :  21/01/2021
 * Modified   	:  21/01/2021
 * Description	:  Definition of the class INSCRIPTION
 **************************************************************************/

class INSCRIPTION
{
    //Attributes
    
    var $id_inscription; // type : int
    var $oEleve;            // objet ELEVE
    var $oAtelier;          // objet ATELIER
    var $date_inscription; // type : string
    
    //Operations
    
    /**
     * @return mixed
     */
    public function getId_inscription()
    {
        return $this->id_inscription;
    }
    
    /**
     * @param mixed $id_inscription
     */
    public function setId_inscription($id_inscription)
    {
        $this->id_inscription = $id_inscription;
    }
    
    /**
     * @return mixed
     */
    public function getDate_inscription()
    {
        return $this->date_inscription;
    }
    
    /**
     * @param mixed $date_inscription
     */
    public function setDate_inscription($dte)
    {
        $this->date_inscription = $dte;
    }
    
    public function __construct($donnees)
    {
        global $atelierManager, $eleveManager;

        $this->setId_inscription($donnees['ID_INSCRIPTION']);
        $this->setDate_inscription($donnees['DATE_INSCRIPTION']);
 
        $oAtelier = $atelierManager->getAtelier($donnees['ID_ATELIER']);
        $oEleve = $eleveManager->getEleve($donnees['ID_ELEVE']);

        $this->setOAtelier($oAtelier);
        $this->setOEleve($oEleve);
    }
    
	function getOEleve() { 
 		return $this->oEleve; 
	} 

	function setOEleve($oEleve) {  
		$this->oEleve = $oEleve; 
	} 

	function getOAtelier() { 
 		return $this->oAtelier; 
	} 

	function setOAtelier($oAtelier) {  
		$this->oAtelier = $oAtelier; 
	} 

} // End Class INSCRIPTION


?>