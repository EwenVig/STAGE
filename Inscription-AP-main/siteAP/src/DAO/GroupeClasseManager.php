<?php
class GroupeClasseManager {
    
    private $db;
    
    public function __construct($db) {
        $this->setDB($db);
    }
    
    public function setDB(PDO $db) {
        $this-> db = $db;
    }
    
    public function getGroupeClasse($id) {
        $str = 'SELECT * FROM GROUPECLASSE WHERE ID_GroupeClasse = "'.$id.'";';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        $GroupeClasse = $sql-> fetch(PDO::FETCH_ASSOC);
        
        return new GroupeClasse($GroupeClasse);
    }

    
    public function getAllGroupeClasse() {
        $str = 'SELECT * FROM GROUPECLASSE;';
        ecritRequeteSQL($str);

        $sql = $this-> db-> query($str);
        
        $i = 0;
        $mesGroupeClasses = array();
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $GroupeClasse = new GroupeClasse($ligne);
            $mesGroupeClasses [$i] = $GroupeClasse;
            $i = $i + 1;
        }
        
        return $mesGroupeClasses;
    }

    public function getGroupeClasseByCampagne($idCampagne) {
        $str = 'SELECT * FROM GROUPECLASSE, AUTORISER, CAMPAGNE 
                WHERE GROUPECLASSE.id_classe = AUTORISER.id_classe
                AND AUTORISER.id_campagne = CAMPAGNE.id_campagne
                AND  CAMPAGNE.id_campagne = '.$idCampagne.';';
        ecritRequeteSQL($str);
      
        $sql = $this-> db-> query($str);
        
        $i = 0;
        $mesGroupeClasses = array();
        while ($ligne = $sql -> fetch(PDO::FETCH_ASSOC)) {
            $unGroupeClasse = new GroupeClasse($ligne);
            $mesGroupeClasses[$i] = $unGroupeClasse;
            $i = $i + 1;
        }
        
        return $mesGroupeClasses;
    }

    public function creerGroupeClasse($donnees) {

        $oClasse = new GroupeClasse($donnees);
        
        $str = 'INSERT INTO GROUPECLASSE (id_classe, id_niveau, nom_Classe, nbreleve_Classe)
        Values ("'.$oClasse->getId_Classe().'", '.$oClasse->getIdNiveau_Classe().', "'.$oClasse->getNom_Classe().'", '.$oClasse->getNbrEleve_Classe().');';
        ecritRequeteSQL($str);
        
        $sql = $this-> db-> query($str);
        
        return $oClasse;
    }
    
    public function importGroupeClasse($nomFichier) {
            // retourne une collection de classe à insérer dans la base de données
            // Lire le fichier $nomFichier
            $fichier_ligne = file($nomFichier);
            $nbClasse = count($fichier_ligne); // $i compte le nombre de ligne dans le fichier
            // On boucle
            $n = 1;
            while ($n < $nbClasse) {
                //print_r($fichier_ligne[$n]);
                list($classe, $nom, $prenom, $mail) = explode(";", $fichier_ligne[$n]);
                print_r($nom);
                
                $donnees['ID_CLASSE'] = $classe;
                $donnees['ID_NIVEAU'] = $classe[0];
                $donnees['NOM_CLASSE'] = $classe;
                $donnees['NBRClasse_CLASSE'] = 0;
        
               
                $this -> creerGroupeClasse($donnees);
                $n = $n +1;
            }
    
            return $n;
        }

    
    }
    
    
