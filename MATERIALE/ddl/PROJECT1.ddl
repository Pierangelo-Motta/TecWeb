-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Tue Jan  2 19:35:28 2024 
-- * LUN file: C:\Users\jacop\source\repos\progetti_vsunibo_elaborati\3_anno\web\proggg\prog\TecWeb\MATERIALE\ddl\PROJECT.lun 
-- * Schema: letturePremiateLog10/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

create database letturePremiate;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table AUTORE (
     IdIncrementale numeric(8) not null,
     Nome varchar(255) not null,
     constraint ID_AUTORE_ID primary key (IdIncrementale));

create table COMMENTI (
     Post_DataOra date not null,
     UIdIncrementale char(1) not null,
     DataOra date not null,
     Commento varchar(1023) not null,
     constraint ID_COMMENTI_ID primary key (Post_DataOra, UIdIncrementale, DataOra));

create table Compone (
     MIdIncrementale numeric(8) not null,
     LIdIncrementale numeric(8) not null,
     constraint ID_Compone_ID primary key (LIdIncrementale, MIdIncrementale));

create table LIBRO (
     IdIncrementale numeric(8) not null,
     Titolo varchar(255) not null,
     constraint ID_LIBRO_ID primary key (IdIncrementale));

create table MEDAGLIERE (
     IdIncrementale numeric(8) not null,
     Titolo varchar(255) not null,
     constraint ID_MEDAGLIERE_ID primary key (IdIncrementale));

create table NOTIFICA (
     IdIncrementale char(1) not null,
     DataOra date not null,
     Descrizione varchar(255) not null,
     Tipo char(1) not null,
     Ric_IdIncrementale char(1) not null,
     Rif_DataOra date,
     constraint ID_NOTIFICA_ID primary key (IdIncrementale, DataOra));

create table POST (
     DataOra date not null,
     CitazioneTestuale varchar(255),
     FotoCitazione varchar(127),
     Riflessione varchar(2047) not null,
     CounterMiPiace numeric(6) not null,
     CounterAdoro numeric(6) not null,
     LIdIncrementale numeric(8) not null,
     UIdIncrementale char(1) not null,
     constraint ID_POST_ID primary key (DataOra));

create table ScrittoDa (
     LIdIncrementale numeric(8) not null,
     AIdIncrementale numeric(8) not null,
     constraint ID_ScrittoDa_ID primary key (AIdIncrementale, LIdIncrementale));

create table Segue (
     IdIncrementaleSeguito char(1) not null,
     IdIncrementaleSeguente char(1) not null,
     constraint ID_Segue_ID primary key (IdIncrementaleSeguito, IdIncrementaleSeguente));

create table Sottoscrive (
     UIdIncrementale char(1) not null,
     MIdIncrementale numeric(8) not null,
     constraint ID_Sottoscrive_ID primary key (MIdIncrementale, UIdIncrementale));

create table TAGPERPOST (
     DataOra date not null,
     Id char(1) not null,
     constraint ID_TAGPERPOST_ID primary key (DataOra, Id));

create table TAGS (
     Id char(1) not null,
     Testo char(1) not null,
     constraint ID_TAGS_ID primary key (Id));

create table UTENTE (
     IdIncrementale char(1) not null,
     E_mail char(1) not null,
     Password char(1) not null,
     ImmagineProfilo char(1) not null,
     IsAdmin char(1) not null,
     Descrizione varchar(150),
     Stato char(1) not null,
     NumeroFollow numeric(8) not null,
     constraint ID_UTENTE_ID primary key (IdIncrementale));


-- Constraints Section
-- ___________________ 

alter table AUTORE add constraint ID_AUTORE_CHK
     check(exists(select * from ScrittoDa
                  where ScrittoDa.AIdIncrementale = IdIncrementale)); 

alter table COMMENTI add constraint REF_COMME_UTENT_FK
     foreign key (UIdIncrementale)
     references UTENTE;

alter table COMMENTI add constraint REF_COMME_POST
     foreign key (Post_DataOra)
     references POST;

alter table Compone add constraint REF_Compo_LIBRO
     foreign key (LIdIncrementale)
     references LIBRO;

alter table Compone add constraint EQU_Compo_MEDAG_FK
     foreign key (MIdIncrementale)
     references MEDAGLIERE;

alter table LIBRO add constraint ID_LIBRO_CHK
     check(exists(select * from ScrittoDa
                  where ScrittoDa.LIdIncrementale = IdIncrementale)); 

alter table MEDAGLIERE add constraint ID_MEDAGLIERE_CHK
     check(exists(select * from Compone
                  where Compone.MIdIncrementale = IdIncrementale)); 

alter table NOTIFICA add constraint REF_NOTIF_UTENT_1
     foreign key (IdIncrementale)
     references UTENTE;

alter table NOTIFICA add constraint REF_NOTIF_UTENT_FK
     foreign key (Ric_IdIncrementale)
     references UTENTE;

alter table NOTIFICA add constraint REF_NOTIF_POST_FK
     foreign key (Rif_DataOra)
     references POST;

alter table POST add constraint REF_POST_LIBRO_FK
     foreign key (LIdIncrementale)
     references LIBRO;

alter table POST add constraint REF_POST_UTENT_FK
     foreign key (UIdIncrementale)
     references UTENTE;

alter table ScrittoDa add constraint EQU_Scrit_AUTOR
     foreign key (AIdIncrementale)
     references AUTORE;

alter table ScrittoDa add constraint EQU_Scrit_LIBRO_FK
     foreign key (LIdIncrementale)
     references LIBRO;

alter table Segue add constraint REF_Segue_UTENT_1_FK
     foreign key (IdIncrementaleSeguente)
     references UTENTE;

alter table Segue add constraint REF_Segue_UTENT
     foreign key (IdIncrementaleSeguito)
     references UTENTE;

alter table Sottoscrive add constraint REF_Sotto_MEDAG
     foreign key (MIdIncrementale)
     references MEDAGLIERE;

alter table Sottoscrive add constraint REF_Sotto_UTENT_FK
     foreign key (UIdIncrementale)
     references UTENTE;

alter table TAGPERPOST add constraint REF_TAGPE_TAGS_FK
     foreign key (Id)
     references TAGS;

alter table TAGPERPOST add constraint REF_TAGPE_POST
     foreign key (DataOra)
     references POST;


-- Index Section
-- _____________ 

create unique index ID_AUTORE_IND
     on AUTORE (IdIncrementale);

create unique index ID_COMMENTI_IND
     on COMMENTI (Post_DataOra, UIdIncrementale, DataOra);

create index REF_COMME_UTENT_IND
     on COMMENTI (UIdIncrementale);

create unique index ID_Compone_IND
     on Compone (LIdIncrementale, MIdIncrementale);

create index EQU_Compo_MEDAG_IND
     on Compone (MIdIncrementale);

create unique index ID_LIBRO_IND
     on LIBRO (IdIncrementale);

create unique index ID_MEDAGLIERE_IND
     on MEDAGLIERE (IdIncrementale);

create unique index ID_NOTIFICA_IND
     on NOTIFICA (IdIncrementale, DataOra);

create index REF_NOTIF_UTENT_IND
     on NOTIFICA (Ric_IdIncrementale);

create index REF_NOTIF_POST_IND
     on NOTIFICA (Rif_DataOra);

create index REF_POST_LIBRO_IND
     on POST (LIdIncrementale);

create unique index ID_POST_IND
     on POST (DataOra);

create index REF_POST_UTENT_IND
     on POST (UIdIncrementale);

create unique index ID_ScrittoDa_IND
     on ScrittoDa (AIdIncrementale, LIdIncrementale);

create index EQU_Scrit_LIBRO_IND
     on ScrittoDa (LIdIncrementale);

create unique index ID_Segue_IND
     on Segue (IdIncrementaleSeguito, IdIncrementaleSeguente);

create index REF_Segue_UTENT_1_IND
     on Segue (IdIncrementaleSeguente);

create unique index ID_Sottoscrive_IND
     on Sottoscrive (MIdIncrementale, UIdIncrementale);

create index REF_Sotto_UTENT_IND
     on Sottoscrive (UIdIncrementale);

create unique index ID_TAGPERPOST_IND
     on TAGPERPOST (DataOra, Id);

create index REF_TAGPE_TAGS_IND
     on TAGPERPOST (Id);

create unique index ID_TAGS_IND
     on TAGS (Id);

create unique index ID_UTENTE_IND
     on UTENTE (IdIncrementale);

