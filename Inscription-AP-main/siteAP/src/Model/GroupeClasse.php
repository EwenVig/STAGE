<?php

/**************************************************************************
* Source File	:  GroupeClasse.php
* Author                   :  Deduyer
* Project name         :  Non enregistr�* Created                 :  21/01/2021
* Modified   	:  21/01/2021
* Description	:  Definition of the class GroupeClasse
**************************************************************************/




class GroupeClasse 			
{
	//Attributes
		
	 
	var $id_classe;
	var $id_niveau; 
	var $nom_classe; 
	var $nbrEleve_classe;

	//Operations

	public function __construct($donnees)
    {
        $this->setId_Classe($donnees['ID_CLASSE']);
        $this->setIdNiveau_Classe($donnees['ID_NIVEAU']);
        $this->setNom_Classe($donnees['NOM_CLASSE']);
		$this->setNbrEleve_Classe($donnees['NBRELEVE_CLASSE']);
		  
	}

	function getId_Classe() { 
 		return $this->id_classe; 
	} 

	function setId_Classe($idClasse) {  
		$this->id_classe = $idClasse; 
	} 

	function getIdNiveau_Classe() { 
 	return $this->id_niveau; 
	} 

	function setIdNiveau_Classe($idNiveau) {  
		$this->id_niveau = $idNiveau; 
	} 

	function getNom_Classe() { 
 		return $this->nom_classe; 
	} 

	function setNom_Classe($nomClasse) {  
		$this->nom_classe = $nomClasse; 
	} 

	function getNbrEleve_Classe() { 
 		return $this->nbrEleve_classe; 
	} 

	function setNbrEleve_Classe($nbrEleveClasse) {  
		$this->nbrEleve_classe = $nbrEleveClasse; 
	} 



} // End Class GroupeClasse



?>

