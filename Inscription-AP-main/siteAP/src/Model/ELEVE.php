<?php

/**************************************************************************
* Source File	:  ELEVE.php
* Author                   :  Deduyer
* Project name         :  Non enregistr�* Created                 :  21/01/2021
* Modified   	:  21/01/2021
* Description	:  Definition of the class ELEVE
**************************************************************************/


class ELEVE 			
{
	//Attributes
			 
	var $id_eleve; // type : int
	var $nom_eleve; // type : string
	var $prenom_eleve; // type : string
	var $login_eleve; // type : string
	var $mdp_eleve; // type : string
	var $mail_eleve; // type : string
	var $id_classe; // type : integer
 
	//Operations

	public function __construct($donnees)
    {
        $this->setId_eleve($donnees['ID_ELEVE']);
        $this->setNom_eleve($donnees['NOM_ELEVE']);
        $this->setPrenom_eleve($donnees['PRENOM_ELEVE']);
		$this->setLogin_eleve($donnees['LOGIN_ELEVE']);
		$this->setMdp_eleve($donnees['MDP_ELEVE']);
		$this->setMail_eleve($donnees['MAIL_ELEVE']);
		$this->setId_classe($donnees['ID_CLASSE']);    
	}

	public function __construct($oEleve)
    {
        $this->setId_eleve($oEleve->getId_eleve());
        $this->setNom_eleve($oEleve->getNom_eleve());
        $this->setPrenom_eleve($oEleve->getPrenom_eleve());
		$this->setLogin_eleve($oEleve->getLogin_eleve());
		$this->setMdp_eleve($oEleve->getMdp_eleve());
		$this->setMail_eleve($oEleve->getMail_eleve());
		$this->setId_classe($oEleve->getId_classe());    
	}

	function getId_eleve() { 
 		return $this->id_eleve; 
	} 

	function setId_eleve($idEleve) {  
		$this->id_eleve = $idEleve; 
	} 

		function getNom_eleve() { 
 		return $this->nom_eleve; 
	} 

	function setNom_eleve($nomEleve) {  
		$this->nom_eleve = $nomEleve; 
	} 

	function getPrenom_eleve() { 
 		return $this->prenom_eleve; 
	} 

	function setPrenom_eleve($prenomEleve) {  
		$this->prenom_eleve = $prenomEleve; 
	} 

	function getLogin_eleve() { 
 		return $this->login_eleve; 
	} 

	function setLogin_eleve($loginEleve) {  
		$this->login_eleve = $loginEleve; 
	} 

	function getMdp_eleve() { 
 		return $this->mdp_eleve; 
	} 

	function setMdp_eleve($mdpEleve) {  
		$this->mdp_eleve = $mdpEleve; 
	} 

	function getMail_eleve() { 
 		return $this->mail_eleve; 
	} 

	function setMail_eleve($mailEleve) {  
		$this->mail_eleve = $mailEleve; 
	} 

	function getId_classe() { 
		return $this->id_classe; 
   } 

   function setId_classe($idClasse) {  
	   $this->id_classe = $idClasse; 
   } 

} // End Class ELEVE


?>




