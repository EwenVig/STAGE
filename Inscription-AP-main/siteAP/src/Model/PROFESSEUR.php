<?php

/**************************************************************************
* Source File	:  PROFESSEUR.php
* Author                   :  Deduyer
* Project name         :  Non enregistr�* Created                 :  21/01/2021
* Modified   	:  21/01/2021
* Description	:  Definition of the class PROFESSEUR
**************************************************************************/

class PROFESSEUR 			
{
	//Attributes
		
	 
	var $id_professeur; // type : int
	var $nom_professeur; // type : string
	var $prenom_professeur; // type : string
	var $login_professeur; // type : string
	var $mdp_professeur; // type : string
	var $mail_professeur; // type : string

	//Operations
	 	
	public function __construct($donnees)
    {
        $this->setId_professeur($donnees['ID_PROFESSEUR']);
        $this->setNom_professeur($donnees['NOM_PROFESSEUR']);
        $this->setPrenom_professeur($donnees['PRENOM_PROFESSEUR']);
		$this->setLogin_professeur($donnees['LOGIN_PROFESSEUR']);
		$this->setMdp_professeur($donnees['MDP_PROFESSEUR']);
		$this->setMail_professeur($donnees['MAIL_PROFESSEUR']);
	}
	
	function getId_professeur() { 
 		return $this->id_professeur; 
	} 

	function setId_professeur($idProf) {  
		$this->id_professeur = $idProf; 
	} 

	function getNom_professeur() { 
 		return $this->nom_professeur; 
	} 

	function setNom_professeur($nomProf) {  
		$this->nom_professeur = $nomProf; 
	} 

	function getPrenom_professeur() { 
 		return $this->prenom_professeur; 
	} 

	function setPrenom_professeur($prenomProf) {  
		$this->prenom_professeur = $prenomProf; 
	} 

	function getLogin_professeur() { 
 		return $this->login_professeur; 
	} 

	function setLogin_professeur($loginProf) {  
		$this->login_professeur = $loginProf; 
	} 

	function getMdp_professeur() { 
 		return $this->mdp_professeur; 
	} 

	function setMdp_professeur($mdpProf) {  
		$this->mdp_professeur = $mdpProf; 
	} 

	function getMail_professeur() { 
 		return $this->mail_professeur; 
	} 

	function setMail_professeur($mailProf) {  
		$this->mail_professeur = $mailProf; 
	} 
	
} // End Class PROFESSEUR


?>

