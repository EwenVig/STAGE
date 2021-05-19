DROP DATABASE IF EXISTS AP2DB;
CREATE DATABASE IF NOT EXISTS AP2DB;

USE AP2DB;

# -----------------------------------------------------------------------------
#       TABLE : GROUPECLASSE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS GROUPECLASSE
 (
   ID_CLASSE VARCHAR(5) NOT NULL  ,
   ID_NIVEAU INTEGER(2) NOT NULL  ,
   NOM_CLASSE CHAR(32) NULL  ,
   NBRELEVE_CLASSE INTEGER(2) NULL  
   , PRIMARY KEY (ID_CLASSE) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE GROUPECLASSE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_GROUPECLASSE_NIVEAU
     ON GROUPECLASSE (ID_NIVEAU ASC);

# -----------------------------------------------------------------------------
#       TABLE : MATIERE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MATIERE
 (
   ID_MATIERE INTEGER(2) NOT NULL AUTO_INCREMENT,
   NOM_MATIERE VARCHAR(32) NULL  
   , PRIMARY KEY (ID_MATIERE) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ATELIER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ATELIER
 (
   ID_ATELIER INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_CAMPAGNE INTEGER(2) NOT NULL  ,
   ID_PROFESSEUR INTEGER(2) ,
   ID_MATIERE INTEGER(2) NOT NULL  ,
   NOM_ATELIER VARCHAR(60) NOT NULL  ,
   DATEDEBUT_ATELIER DATE NULL  ,
   DATEFIN_ATELIER DATE NULL  ,
   CAPACITE_ATELIER INTEGER(2) NOT NULL,
   SALLE VARCHAR(30) NULL  ,  
   PRIMARY KEY (ID_ATELIER) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ATELIER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ATELIER_CAMPAGNE
     ON ATELIER (ID_CAMPAGNE ASC);

CREATE  INDEX I_FK_ATELIER_PROFESSEUR
     ON ATELIER (ID_PROFESSEUR ASC);

CREATE  INDEX I_FK_ATELIER_MATIERE
     ON ATELIER (ID_MATIERE ASC);

# -----------------------------------------------------------------------------
#       TABLE : INSCRIPTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INSCRIPTION
 (
   ID_INSCRIPTION INTEGER(2) NOT NULL AUTO_INCREMENT,
   ID_ATELIER INTEGER(2) NOT NULL  ,
   ID_ELEVE INTEGER(2) NOT NULL  ,
   DATE_INSCRIPTION DATE NULL  
   , PRIMARY KEY (ID_INSCRIPTION) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE INSCRIPTION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_INSCRIPTION_ATELIER
     ON INSCRIPTION (ID_ATELIER ASC);

CREATE  INDEX I_FK_INSCRIPTION_ELEVE
     ON INSCRIPTION (ID_ELEVE ASC);

# -----------------------------------------------------------------------------
#       TABLE : PROFESSEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROFESSEUR
 (
   ID_PROFESSEUR INTEGER(2) NOT NULL AUTO_INCREMENT ,
   NOM_PROFESSEUR VARCHAR(60) NOT NULL  ,
   PRENOM_PROFESSEUR VARCHAR(60) NOT NULL  ,
   LOGIN_PROFESSEUR VARCHAR(60) NOT NULL  ,
   MDP_PROFESSEUR VARCHAR(32) NOT NULL  ,
   MAIL_PROFESSEUR VARCHAR(60) NOT NULL,
   ADMIN VARCHAR(30) NULL,  
   PRIMARY KEY (ID_PROFESSEUR) ,
   UNIQUE KEY MAIL_PROFESSEUR (MAIL_PROFESSEUR),
   UNIQUE KEY LOGIN_PROFESSEUR (LOGIN_PROFESSEUR)
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ELEVE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ELEVE
 (
   ID_ELEVE INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_CLASSE VARCHAR(5) NOT NULL  ,
   NOM_ELEVE VARCHAR(60) NOT NULL  ,
   PRENOM_ELEVE VARCHAR(60) NOT NULL  ,
   LOGIN_ELEVE VARCHAR(60) NOT NULL  ,
   MDP_ELEVE VARCHAR(32) NOT NULL  ,
   MAIL_ELEVE VARCHAR(60) NOT NULL  
   , PRIMARY KEY (ID_ELEVE) ,
   UNIQUE KEY MAIL_ELEVE (MAIL_ELEVE),
   UNIQUE KEY LOGIN_ELEVE (LOGIN_ELEVE)

 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ELEVE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ELEVE_GROUPECLASSE
     ON ELEVE (ID_CLASSE ASC);

# -----------------------------------------------------------------------------
#       TABLE : NIVEAU
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NIVEAU
 (
   ID_NIVEAU INTEGER(2) NOT NULL  ,
   NOM_NIVEAU CHAR(32) NULL  
   , PRIMARY KEY (ID_NIVEAU) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CAMPAGNE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CAMPAGNE
 (
   ID_CAMPAGNE INTEGER(2) NOT NULL AUTO_INCREMENT,
   DATEDEBUT_CAMPAGNE DATE NOT NULL  ,
   DATEFIN_CAMPAGNE DATE NOT NULL  ,
   NOM_CAMPAGNE VARCHAR(128) NOT NULL  
   , PRIMARY KEY (ID_CAMPAGNE) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       TABLE : AUTORISER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AUTORISER
 (
   ID_CAMPAGNE INTEGER(2) NOT NULL  ,
   ID_CLASSE VARCHAR(5) NOT NULL  
   , PRIMARY KEY (ID_CAMPAGNE,ID_CLASSE) 
 ) engine = innoDB  comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE AUTORISER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_AUTORISER_ATELIER
     ON AUTORISER (ID_CAMPAGNE ASC);

CREATE  INDEX I_FK_AUTORISER_GROUPECLASSE
     ON AUTORISER (ID_CLASSE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE GROUPECLASSE 
  ADD FOREIGN KEY FK_GROUPECLASSE_NIVEAU (ID_NIVEAU)
      REFERENCES NIVEAU (ID_NIVEAU) ;


ALTER TABLE ATELIER 
  ADD FOREIGN KEY FK_ATELIER_CAMPAGNE (ID_CAMPAGNE)
      REFERENCES CAMPAGNE (ID_CAMPAGNE) ON DELETE CASCADE;


ALTER TABLE ATELIER 
  ADD FOREIGN KEY FK_ATELIER_PROFESSEUR (ID_PROFESSEUR)
      REFERENCES PROFESSEUR (ID_PROFESSEUR) ;


ALTER TABLE ATELIER 
  ADD FOREIGN KEY FK_ATELIER_MATIERE (ID_MATIERE)
      REFERENCES MATIERE (ID_MATIERE) ;


ALTER TABLE INSCRIPTION 
  ADD FOREIGN KEY FK_INSCRIPTION_ATELIER (ID_ATELIER)
      REFERENCES ATELIER (ID_ATELIER) ON DELETE CASCADE ;


ALTER TABLE INSCRIPTION 
  ADD FOREIGN KEY FK_INSCRIPTION_ELEVE (ID_ELEVE)
      REFERENCES ELEVE (ID_ELEVE) ON DELETE CASCADE ;


ALTER TABLE ELEVE 
  ADD FOREIGN KEY FK_ELEVE_GROUPECLASSE (ID_CLASSE)
      REFERENCES GROUPECLASSE (ID_CLASSE) ;


ALTER TABLE AUTORISER 
  ADD FOREIGN KEY FK_AUTORISER_CAMPAGNE (ID_CAMPAGNE)
      REFERENCES CAMPAGNE (ID_CAMPAGNE) ON DELETE CASCADE;


ALTER TABLE AUTORISER 
  ADD FOREIGN KEY FK_AUTORISER_GROUPECLASSE (ID_CLASSE)
      REFERENCES GROUPECLASSE (ID_CLASSE) ;

