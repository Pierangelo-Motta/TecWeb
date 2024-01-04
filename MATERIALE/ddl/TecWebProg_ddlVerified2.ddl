-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Thu Jan  4 15:04:04 2024 
-- * LUN file: C:\Users\jacop\source\repos\progetti_vsunibo_elaborati\3_anno\web\proggg\prog\TecWeb\MATERIALE\ddl\PROJECT.lun 
-- * Schema: letturePremiateChecked1/10-1 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database letturePremiateChecked2;
create database letturePremiateChecked2;
use letturePremiateChecked2;


-- Tables Section
-- _____________ 

create table AUTORE (
     id int not null,
     nome varchar(255) not null,
     constraint ID_AUTORE_ID primary key (id));

create table COMMENTI (
     utenteIdPost int not null,
     dataOraPost date not null,
     utenteIdComm int not null,
     dataOraComm date not null,
     commento varchar(1023) not null,
     constraint ID_COMMENTI_ID primary key (utenteIdPost, dataOraPost, utenteIdComm, dataOraComm));

create table Compone (
     medagliereId int not null,
     libroId int not null,
     constraint ID_Compone_ID primary key (libroId, medagliereId));

create table LIBRO (
     id int not null,
     titolo varchar(255) not null,
     constraint ID_LIBRO_ID primary key (id));

create table MEDAGLIERE (
     id int not null,
     titolo varchar(255) not null,
     constraint ID_MEDAGLIERE_ID primary key (id));

create table NOTIFICA (
     id int not null,
     dataOra date not null,
     descrizione varchar(255) not null,
     tipo ENUM("Like", "Love", "Commento", "Follow"),
     utenteId char(1) not null,
     utenteIdPost char(1),
     dataOraPost date,
     constraint ID_NOTIFICA_ID primary key (id, dataOra));

create table POST (
     utenteId int not null,
     dataOra date not null,
     citazioneTestuale varchar(255),
     fotoCitazione varchar(127),
     riflessione varchar(2047) not null,
     counterMiPiace int not null,
     counterAdoro int not null,
     libroId int not null,
     constraint ID_POST_ID primary key (utenteId, dataOra));

create table ScrittoDa (
     libroId int not null,
     autoreId int not null,
     constraint ID_ScrittoDa_ID primary key (autoreId, libroId));

create table Segue (
     seguitoId char(1) not null,
     seguenteId char(1) not null,
     constraint ID_Segue_ID primary key (seguitoId, seguenteId));

create table Sottoscrive (
     utenteId char(1) not null,
     medagliereId int not null,
     constraint ID_Sottoscrive_ID primary key (medagliereId, utenteId));

create table TAGPERPOST (
     utenteIdPost char(1) not null,
     dataOraPost date not null,
     tagId char(1) not null,
     constraint ID_TAGPERPOST_ID primary key (utenteIdPost, dataOraPost, tagId));

create table TAGS (
     id int not null,
     testo char(1) not null,
     constraint ID_TAGS_ID primary key (id));

create table UTENTE (
     id int not null,
     username char(1) not null,
     email varchar(80) not null,
     password varchar(120) not null,
     immagineProfilo varchar(255) not null,
     isAdmin char not null,
     descrizione varchar(150),
     stato ENUM("Attivo", "Disabilitato", "Bannato"),
     numeroFollow int not null,
     constraint ID_UTENTE_ID primary key (id));



-- Index Section
-- _____________ 

create unique index ID_AUTORE_IND
     on AUTORE (id);

create unique index ID_COMMENTI_IND
     on COMMENTI (utenteIdPost, dataOraPost, utenteIdComm, dataOraComm);

create index REF_COMME_UTENT_IND
     on COMMENTI (utenteIdComm);

create unique index ID_Compone_IND
     on Compone (libroId, medagliereId);

create index EQU_Compo_MEDAG_IND
     on Compone (medagliereId);

create unique index ID_LIBRO_IND
     on LIBRO (id);

create unique index ID_MEDAGLIERE_IND
     on MEDAGLIERE (id);

create unique index ID_NOTIFICA_IND
     on NOTIFICA (id, dataOra);

create index REF_NOTIF_UTENT_IND
     on NOTIFICA (utenteId);

create index REF_NOTIF_POST_IND
     on NOTIFICA (utenteIdPost, dataOraPost);

create index REF_POST_LIBRO_IND
     on POST (libroId);

create unique index ID_POST_IND
     on POST (utenteId, dataOra);

create unique index ID_ScrittoDa_IND
     on ScrittoDa (autoreId, libroId);

create index EQU_Scrit_LIBRO_IND
     on ScrittoDa (libroId);

create unique index ID_Segue_IND
     on Segue (seguitoId, seguenteId);

create index REF_Segue_UTENT_1_IND
     on Segue (seguenteId);

create unique index ID_Sottoscrive_IND
     on Sottoscrive (medagliereId, utenteId);

create index REF_Sotto_UTENT_IND
     on Sottoscrive (utenteId);

create unique index ID_TAGPERPOST_IND
     on TAGPERPOST (utenteIdPost, dataOraPost, tagId);

create index REF_TAGPE_TAGS_IND
     on TAGPERPOST (tagId);

create unique index ID_TAGS_IND
     on TAGS (id);

create unique index ID_UTENTE_IND
     on UTENTE (id);





-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table AUTORE add constraint ID_AUTORE_CHK
--     check(exists(select * from ScrittoDa
--                  where ScrittoDa.autoreId = id)); 

alter table COMMENTI add constraint REF_COMME_UTENT_FK
     foreign key (utenteIdComm)
     references UTENTE (id);

alter table COMMENTI add constraint REF_COMME_POST
     foreign key (utenteIdPost, dataOraPost)
     references POST (utenteId, dataOra);

alter table Compone add constraint REF_Compo_LIBRO
     foreign key (libroId)
     references LIBRO (id);

alter table Compone add constraint EQU_Compo_MEDAG_FK
     foreign key (medagliereId)
     references MEDAGLIERE (id);

-- Not implemented
-- alter table LIBRO add constraint ID_LIBRO_CHK
--     check(exists(select * from ScrittoDa
--                  where ScrittoDa.libroId = id)); 

-- Not implemented
-- alter table MEDAGLIERE add constraint ID_MEDAGLIERE_CHK
--     check(exists(select * from Compone
--                  where Compone.medagliereId = id)); 

alter table NOTIFICA add constraint REF_NOTIF_POST_FK
     foreign key (utenteIdPost, dataOraPost)
     references POST (utenteId, dataOra);

alter table NOTIFICA add constraint REF_NOTIF_UTENT_FK
     foreign key (utenteId)
     references UTENTE (id);

alter table NOTIFICA add constraint REF_NOTIF_POST_CHK
     check((utenteIdPost is not null and dataOraPost is not null)
           or (utenteIdPost is null and dataOraPost is null)); 

alter table POST add constraint REF_POST_LIBRO_FK
     foreign key (libroId)
     references LIBRO (id);

alter table POST add constraint REF_POST_UTENT
     foreign key (utenteId)
     references UTENTE (id);

alter table POST add constraint GRPOST
     check(citazioneTestuale is not null or fotoCitazione is not null); 

alter table ScrittoDa add constraint EQU_Scrit_AUTOR
     foreign key (autoreId)
     references AUTORE (id);

alter table ScrittoDa add constraint EQU_Scrit_LIBRO_FK
     foreign key (libroId)
     references LIBRO (id);

alter table Segue add constraint REF_Segue_UTENT_1_FK
     foreign key (seguenteId)
     references UTENTE (id);

alter table Segue add constraint REF_Segue_UTENT
     foreign key (seguitoId)
     references UTENTE (id);

alter table Sottoscrive add constraint REF_Sotto_MEDAG
     foreign key (medagliereId)
     references MEDAGLIERE (id);

alter table Sottoscrive add constraint REF_Sotto_UTENT_FK
     foreign key (utenteId)
     references UTENTE (id);

alter table TAGPERPOST add constraint REF_TAGPE_TAGS_FK
     foreign key (tagId)
     references TAGS (id);

alter table TAGPERPOST add constraint REF_TAGPE_POST
     foreign key (utenteIdPost, dataOraPost)
     references POST (utenteId, dataOra);

