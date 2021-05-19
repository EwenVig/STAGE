
#----------------------------
#  Table CAMPAGNE - Campagne type pour 2nde1 à 2nde4
#----------------------------
INSERT INTO CAMPAGNE (DATEDEBUT_CAMPAGNE, DATEFIN_CAMPAGNE, NOM_CAMPAGNE) VALUES
(now(), now(), 'CAMPAGNE 1 TYPE pour 2nde1...2nde4');


#----------------------------
#  Table ATELIER
#      1 atelier par matière pour la campagne 1
#----------------------------
INSERT INTO ATELIER (NOM_ATELIER, ID_CAMPAGNE, ID_MATIERE, DATEDEBUT_ATELIER, DATEFIN_ATELIER, CAPACITE_ATELIER)
SELECT NOM_MATIERE, 1, ID_MATIERE, now(), now(), 100
   FROM MATIERE;

#----------------------------
#  Table AUTORISER
#      Campagne 1 autorisée pour les classes 1 à 4
#----------------------------

INSERT INTO AUTORISER (ID_CAMPAGNE, ID_CLASSE)
SELECT 1, ID_CLASSE
FROM GROUPECLASSE
WHERE ID_CLASSE <= '2NDE4';


#----------------------------
#  Table CAMPAGNE - Campagne type pour 2nde5 à 2nde7
#----------------------------
INSERT INTO CAMPAGNE (DATEDEBUT_CAMPAGNE, DATEFIN_CAMPAGNE, NOM_CAMPAGNE) VALUES
(now(), now(), 'CAMPAGNE 2 TYPE pour 2nde5...2nde7');

#----------------------------
#  Table ATELIER
#      1 atelier par matière pour la campagne 2
#----------------------------
INSERT INTO ATELIER (NOM_ATELIER, ID_CAMPAGNE, ID_MATIERE, DATEDEBUT_ATELIER, DATEFIN_ATELIER, CAPACITE_ATELIER)
SELECT NOM_MATIERE, 2, ID_MATIERE, now(), now(), 100
   FROM MATIERE;

#----------------------------
#  Table AUTORISER
#      Campagne 1 autorisée pour les classes > 4
#----------------------------

INSERT INTO AUTORISER (ID_CAMPAGNE, ID_CLASSE)
SELECT 2, ID_CLASSE
FROM GROUPECLASSE
WHERE ID_CLASSE > '2NDE4';

#----------------------------
#  Vérification
#      Liste des ateliers de la campagne 1 autorisés pour les classes <= 4
#----------------------------
SELECT CAMPAGNE.id_campagne, nom_campagne, ATELIER.id_atelier, GROUPECLASSE.id_classe
FROM CAMPAGNE, ATELIER, AUTORISER, GROUPECLASSE
WHERE CAMPAGNE.id_campagne = ATELIER.id_Campagne
AND ATELIER.id_Campagne = AUTORISER.id_Campagne 
AND AUTORISER.id_classe = GROUPECLASSE.id_classe
AND CAMPAGNE.id_campagne = 1;

#----------------------------
#  Vérification
#      Liste des ateliers de la campagne 1 autorisés pour les classes > 4
#----------------------------
SELECT CAMPAGNE.id_campagne, nom_campagne, ATELIER.id_atelier, GROUPECLASSE.id_classe
FROM CAMPAGNE, ATELIER, AUTORISER, GROUPECLASSE
WHERE CAMPAGNE.id_campagne = ATELIER.id_Campagne
AND ATELIER.id_Campagne = AUTORISER.id_Campagne 
AND AUTORISER.id_classe = GROUPECLASSE.id_classe
AND CAMPAGNE.id_campagne = 2;