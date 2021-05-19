<?php

/**************************************************************************
 * Source File	:  MATIERE.php
 * Author                   :  Deduyer
 * Project name         :  Non enregistré* Created                 :  21/01/2021
 * Modified   	:  21/01/2021
 * Description	:  Definition of the class MATIERE
 **************************************************************************/




class MATIERE
{
    //Attributes
    
    
    var $id_matiere; // type : int
    var $nom_matiere; // type : string
    
    //Operations
    
    public function __construct($donnees)
    {
        $this->setId_matiere($donnees['ID_MATIERE']);
        $this->setNom_matiere($donnees['NOM_MATIERE']);
    }
    
    /**
     * @return mixed
     */
    public function getId_matiere()
    {
        return $this->id_matiere;
    }
    
    /**
     * @param mixed $id_matiere
     */
    public function setId_matiere($id_matiere)
    {
        $this->id_matiere = $id_matiere;
    }
    
    /**
     * @return mixed
     */
    public function getNom_matiere()
    {
        return $this->nom_matiere;
    }
    
    /**
     * @param mixed $nom_matiere
     */
    public function setNom_matiere($nom_matiere)
    {
        $this->nom_matiere = $nom_matiere;
    }
    
    
    
    
} // End Class MATIERE


?>

