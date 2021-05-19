<?php
class matiereManager {

    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }

    public function setDB(PDO $db) {
        $this-> db = $db;
    }
    
    public function getMatiere($id) {
        $str = 'SELECT * FROM MATIERE WHERE ID_matiere = "'.$id.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $matiere = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new MATIERE($matiere);
    }
    
    public function getAllMatiere() {
        $str = 'SELECT * FROM MATIERE;';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        
        $i = 0;
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $matiere = new MATIERE($ligne);
            $mesMatieres [$i] = $matiere;
            $i = $i + 1;
        }
        
        return $mesMatieres;
    }
    
    public function creerMatiere($donnees) {
        //pour contourner l'id d'auto increment qui sera incr�ment� par le SGBD
        $donnees['ID_MATIERE'] = -1;
        $oMatiere = new MATIERE($donnees);
        
        $str = 'INSERT INTO MATIERE (nom_matiere)
        Values ("'.$oMatiere->getNom_matiere().'");';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        
        // recup�ration de l'auto increment
        $id_matiere = $this-> db->lastInsertId();
        $retour = $oMatiere -> setId_matiere($id_matiere);
        
        return $oMatiere;
    }
    
    public function supprMatiere(MATIERE $matiere) {
        $str = 'DELETE FROM MATIERE WHERE ID_MATIERE = '.$matiere->getId_matiere().';';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
    }
    
    public function modifMatiere($donnees) {
        $oMatiere = new MATIERE($donnees);
        
        $str = 'UPDATE MATIERE
                SET nom_matiere = "'.$oMatiere->getNom_matiere().'"
                WHERE id_matiere = '.$oMatiere->getId_matiere().';';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);      
    }
    
    public function getSelectMatiere($idSelect) {
        // retourne la chaine de <option value HTML> pour tous les Matieres
        $mesMatieres = $this->getAllMatiere();
            
        $i = 0;
        $strOptionValue = '';
        while ($i < count($mesMatieres)) 
        {
            $unMatiere = $mesMatieres[$i];
            $id = $unMatiere->getId_Matiere();
            $nom = $unMatiere->getNom_Matiere();

            if ($id == $idSelect)
            {
                $strOptionValue = $strOptionValue."<option value=".$id." selected>".$nom."</option>" ; 
            }
            else
            {
                $strOptionValue = $strOptionValue."<option value=".$id.">".$nom."</option>" ; 
            }

            $i = $i + 1;
        }      
        return $strOptionValue;
    }  
      

}
