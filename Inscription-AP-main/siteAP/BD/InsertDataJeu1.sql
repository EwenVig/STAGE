#---------------
#  Table MATIERE
#---------------
INSERT INTO MATIERE (ID_MATIERE, NOM_MATIERE) VALUES
(1, 'FRANCAIS'),
(2, 'MATH'),
(3, 'ORIENTATION'),
(4, 'SVT'),
(5, 'ANGLAIS'),
(6, 'PHYSIQUE'),
(7, 'HISTOIRE');

#----------------------------
#  Table NIVEAU
#----------------------------
INSERT INTO NIVEAU (ID_NIVEAU, NOM_NIVEAU) VALUES
(2, 'SECONDE');

#----------------------------
#  Table GROUPECLASSE
#----------------------------
INSERT INTO GROUPECLASSE (ID_CLASSE, ID_NIVEAU, NOM_CLASSE, NBRELEVE_CLASSE) VALUES
('2NDE1', 2, 'SECONDE 1', 36),
('2NDE2', 2, 'SECONDE 2', 36),
('2NDE3', 2, 'SECONDE 3', 36),
('2NDE4', 2, 'SECONDE 4', 36),
('2NDE5', 2, 'SECONDE 5', 36),
('2NDE6', 2, 'SECONDE 6', 36),
('2NDE7', 2, 'SECONDE 7', 36);

#---------------
#  Table ELEVE
#---------------
INSERT INTO ELEVE (ID_ELEVE, NOM_ELEVE, PRENOM_ELEVE, LOGIN_ELEVE, MDP_ELEVE, MAIL_ELEVE, ID_CLASSE ) VALUES
(1, 'DEDUYER', 'EDDY', 'LOGINEDDY', 'MDPEDDY', 'MAILEDDY@estran-brest.education', '2NDE1'),
(2, 'VIGOUROUX', 'EWEN', 'LOGINEWEN', 'MDPEWEN', 'MAILEWEN@estran-brest.education', '2NDE1'),
(3, 'KERNILIS', 'THOMAS', 'LOGINTHOMAS', 'MDPTHOMAS', 'THOMAS@estran-brest.education', '2NDE2'),
(4, 'GEIGER', 'GAETAN', 'LOGINGAETAN', 'MDPGAETAN', 'GAETAN@estran-brest.education', '2NDE2');
#------------------------
#  Table PROFESSEUR
#------------------------
INSERT INTO PROFESSEUR (ID_PROFESSEUR, NOM_PROFESSEUR, PRENOM_PROFESSEUR, LOGIN_PROFESSEUR, MDP_PROFESSEUR, MAIL_PROFESSEUR ) VALUES
(1, 'DANIEL', 'DOMINIQUE', 'LOGINDOM', 'MDPDOM', 'MAILDOM@estran-brest.education'),
(2, 'LE TALLEC', 'ERIC', 'LOGINERIC', 'MDPERIC', 'MAILERIC@estran-brest.education'),
(3, 'LEBRETON', 'MURIEL', 'LOGINMURIEL', 'MDPMURIEL', 'MURIEL@estran-brest.education');

#----------------------------
#  Table CAMPAGNE
#----------------------------
INSERT INTO CAMPAGNE (ID_CAMPAGNE, DATEDEBUT_CAMPAGNE, DATEFIN_CAMPAGNE, NOM_CAMPAGNE) VALUES
(1, '2020-12-10', '2020-12-20', 'CAMPAGNE1'),
(2, '2021-02-10', '2021-02-20', 'CAMPAGNE2');

#----------------------------
#  Table ATELIER
#      3 ateliers passés + 3 ateliers futurs
#----------------------------
INSERT INTO ATELIER (ID_ATELIER, NOM_ATELIER, ID_CAMPAGNE, ID_PROFESSEUR, ID_MATIERE, DATEDEBUT_ATELIER, DATEFIN_ATELIER, CAPACITE_ATELIER) VALUES
(1, 'ATELIER MATH', 1, 1, 2, '2021-01-01', '2021-03-14', 10),
(2, 'ATELIER FRANCAIS', 1, 3, 1, '2021-01-01', '2021-03-14', 10),
(3, 'ATELIER ANGLAIS', 1, 2, 5, '2021-01-01', '2021-03-14', 10),
(4, 'ATELIER MATH', 2, 1, 2, '2021-03-01', '2021-03-14', 10),
(5, 'ATELIER FRANCAIS', 2, 3, 1, '2021-03-01', '2021-03-14', 10),
(6, 'ATELIER ANGLAIS', 2, 2, 5, '2021-03-01', '2021-03-14', 10);

#----------------------------
#  Table INSCRIPTION
#    3 eleves sur la campagne 1 terminée
#    1 eleve sur l'atelier 4 futur
#    2 eleves sur l'atelier 5 futur
#----------------------------
INSERT INTO INSCRIPTION (ID_INSCRIPTION, ID_ATELIER, ID_ELEVE, DATE_INSCRIPTION) VALUES
(1, 1, 1, '2021-01-01'),
(2, 1, 2, '2021-01-01'),
(3, 1, 3, '2021-01-01'),
(4, 4, 1, '2021-01-01'),
(5, 5, 2, '2021-01-01'),
(6, 5, 3, '2021-01-01');

