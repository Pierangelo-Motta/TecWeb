-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Jan  3 17:36:45 2024 
-- * LUN file: C:\Users\jacop\source\repos\progetti_vsunibo_elaborati\3_anno\web\proggg\prog\TecWeb\MATERIALE\ddl\PROJECT.lun 
-- * Schema: letturePremiateChecked1/10-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database letturePremiateChecked1;
use letturePremiateChecked1;


-- Tables Section
-- _____________ 

create table AUTORE (
     Id int not null,
     Nome varchar(255) not null,
     constraint ID_AUTORE_ID primary key (Id));

create table COMMENTI (
     UtenteIdPost int not null,
     DataOraPost date not null,
     UtenteIdComm int not null,
     DataOraComm date not null,
     Commento varchar(1023) not null,
     constraint ID_COMMENTI_ID primary key (UtenteIdPost, DataOraPost, UtenteIdComm, DataOraComm));

create table Compone (
     MedagliereId int not null,
     LibroId int not null,
     constraint ID_Compone_ID primary key (LibroId, MedagliereId));

create table LIBRO (
     Id int not null,
     Titolo varchar(255) not null,
     constraint ID_LIBRO_ID primary key (Id));

create table MEDAGLIERE (
     Id int not null,
     Titolo varchar(255) not null,
     constraint ID_MEDAGLIERE_ID primary key (Id));

create table NOTIFICA (
     Id int not null,
     DataOra date not null,
     Descrizione varchar(255) not null,
     Tipo ENUM("Like", "Love", "Commento", "Follow"),
     UtenteId char(1) not null,
     UtenteIdPost char(1),
     DataOraPost date,
     constraint ID_NOTIFICA_ID primary key (Id, DataOra));

create table POST (
     UtenteId int not null,
     DataOra date not null,
     CitazioneTestuale varchar(255),
     FotoCitazione varchar(127),
     Riflessione varchar(2047) not null,
     CounterMiPiace int not null,
     CounterAdoro int not null,
     LibroId int not null,
     constraint ID_POST_ID primary key (UtenteId, DataOra));

create table ScrittoDa (
     LibroId int not null,
     AutoreId int not null,
     constraint ID_ScrittoDa_ID primary key (AutoreId, LibroId));

create table Segue (
     SeguitoId char(1) not null,
     SeguenteId char(1) not null,
     constraint ID_Segue_ID primary key (SeguitoId, SeguenteId));

create table Sottoscrive (
     UtenteId char(1) not null,
     MedagliereId int not null,
     constraint ID_Sottoscrive_ID primary key (MedagliereId, UtenteId));

create table TAGPERPOST (
     UtenteIdPost char(1) not null,
     DataOraPost date not null,
     TagId char(1) not null,
     constraint ID_TAGPERPOST_ID primary key (UtenteIdPost, DataOraPost, TagId));

create table TAGS (
     Id int not null,
     Testo char(1) not null,
     constraint ID_TAGS_ID primary key (Id));

create table UTENTE (
     Id int not null,
     Email varchar(80) not null,
     Password varchar(120) not null,
     ImmagineProfilo varchar(255) not null,
     IsAdmin char not null,
     Descrizione varchar(150),
     Stato ENUM("Attivo", "Disabilitato", "Bannato"),
     NumeroFollow int not null,
     constraint ID_UTENTE_ID primary key (Id));


-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table AUTORE add constraint ID_AUTORE_CHK
--     check(exists(select * from ScrittoDa
--                  where ScrittoDa.AutoreId = Id)); 

alter table COMMENTI add constraint REF_COMME_UTENT_FK
     foreign key (UtenteIdComm)
     references UTENTE (Id);

alter table COMMENTI add constraint REF_COMME_POST
     foreign key (UtenteIdPost, DataOraPost)
     references POST (UtenteId, DataOra);

alter table Compone add constraint REF_Compo_LIBRO
     foreign key (LibroId)
     references LIBRO (Id);

alter table Compone add constraint EQU_Compo_MEDAG_FK
     foreign key (MedagliereId)
     references MEDAGLIERE (Id);

-- Not implemented
-- alter table LIBRO add constraint ID_LIBRO_CHK
--     check(exists(select * from ScrittoDa
--                  where ScrittoDa.LibroId = Id)); 

-- Not implemented
-- alter table MEDAGLIERE add constraint ID_MEDAGLIERE_CHK
--     check(exists(select * from Compone
--                  where Compone.MedagliereId = Id)); 

alter table NOTIFICA add constraint REF_NOTIF_UTENT_FK
     foreign key (UtenteId)
     references UTENTE (Id);

alter table NOTIFICA add constraint REF_NOTIF_POST_FK
     foreign key (UtenteIdPost, DataOraPost)
     references POST (UtenteId, DataOra);

alter table NOTIFICA add constraint REF_NOTIF_POST_CHK
     check((UtenteIdPost is not null and DataOraPost is not null)
           or (UtenteIdPost is null and DataOraPost is null)); 

alter table POST add constraint REF_POST_LIBRO_FK
     foreign key (LibroId)
     references LIBRO (Id);

alter table POST add constraint REF_POST_UTENT
     foreign key (UtenteId)
     references UTENTE (Id);

alter table POST add constraint GRPOST
     check(CitazioneTestuale is not null or FotoCitazione is not null); 

alter table ScrittoDa add constraint EQU_Scrit_AUTOR
     foreign key (AutoreId)
     references AUTORE (Id);

alter table ScrittoDa add constraint EQU_Scrit_LIBRO_FK
     foreign key (LibroId)
     references LIBRO (Id);

alter table Segue add constraint REF_Segue_UTENT_1_FK
     foreign key (SeguenteId)
     references UTENTE (Id);

alter table Segue add constraint REF_Segue_UTENT
     foreign key (SeguitoId)
     references UTENTE (Id);

alter table Sottoscrive add constraint REF_Sotto_MEDAG
     foreign key (MedagliereId)
     references MEDAGLIERE (Id);

alter table Sottoscrive add constraint REF_Sotto_UTENT_FK
     foreign key (UtenteId)
     references UTENTE (Id);

alter table TAGPERPOST add constraint REF_TAGPE_TAGS_FK
     foreign key (TagId)
     references TAGS (Id);

alter table TAGPERPOST add constraint REF_TAGPE_POST
     foreign key (UtenteIdPost, DataOraPost)
     references POST (UtenteId, DataOra);


-- Index Section
-- _____________ 

create unique index ID_AUTORE_IND
     on AUTORE (Id);

create unique index ID_COMMENTI_IND
     on COMMENTI (UtenteIdPost, DataOraPost, UtenteIdComm, DataOraComm);

create index REF_COMME_UTENT_IND
     on COMMENTI (UtenteIdComm);

create unique index ID_Compone_IND
     on Compone (LibroId, MedagliereId);

create index EQU_Compo_MEDAG_IND
     on Compone (MedagliereId);

create unique index ID_LIBRO_IND
     on LIBRO (Id);

create unique index ID_MEDAGLIERE_IND
     on MEDAGLIERE (Id);

create unique index ID_NOTIFICA_IND
     on NOTIFICA (Id, DataOra);

create index REF_NOTIF_UTENT_IND
     on NOTIFICA (UtenteId);

create index REF_NOTIF_POST_IND
     on NOTIFICA (UtenteIdPost, DataOraPost);

create index REF_POST_LIBRO_IND
     on POST (LibroId);

create unique index ID_POST_IND
     on POST (UtenteId, DataOra);

create unique index ID_ScrittoDa_IND
     on ScrittoDa (AutoreId, LibroId);

create index EQU_Scrit_LIBRO_IND
     on ScrittoDa (LibroId);

create unique index ID_Segue_IND
     on Segue (SeguitoId, SeguenteId);

create index REF_Segue_UTENT_1_IND
     on Segue (SeguenteId);

create unique index ID_Sottoscrive_IND
     on Sottoscrive (MedagliereId, UtenteId);

create index REF_Sotto_UTENT_IND
     on Sottoscrive (UtenteId);

create unique index ID_TAGPERPOST_IND
     on TAGPERPOST (UtenteIdPost, DataOraPost, TagId);

create index REF_TAGPE_TAGS_IND
     on TAGPERPOST (TagId);

create unique index ID_TAGS_IND
     on TAGS (Id);

create unique index ID_UTENTE_IND
     on UTENTE (Id);

