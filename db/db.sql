CREATE TABLE tbl_User (
  fld_USER_ID SERIAL  NOT NULL ,
  fld_USER_PWhash VARCHAR(255)    ,
  fld_USER_Email VARCHAR(255)    ,
  fld_USER_CreationDate DATETIME    ,
  fld_USER_LNinfo VARCHAR(255)      ,
PRIMARY KEY(fld_USER_ID));




CREATE TABLE tbl_Content (
  fld_CONT_ID SERIAL  NOT NULL ,
  fld_USER_ID INT   NOT NULL ,
  fld_CONT_CreationDate DATETIME    ,
  fld_CONT_Title VARCHAR(255)    ,
  fld_CONT_Body TEXT    ,
  fld_CONT_Keywords VARCHAR(255)    ,
  fld_CONT_AccessContraint INT    ,
  fld_CONT_Fee INT      ,
PRIMARY KEY(fld_CONT_ID)  ,
  FOREIGN KEY(fld_USER_ID)
    REFERENCES tbl_User(fld_USER_ID));


CREATE INDEX tbl_Content_FKIndex1 ON tbl_Content (fld_USER_ID);


CREATE INDEX IFK_Rel_01 ON tbl_Content (fld_USER_ID);


CREATE TABLE tbl_Attachment (
  fld_ATTC_Id SERIAL  NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_ATTC_File BLOB    ,
  fld_ATTC_Description VARCHAR(255)      ,
PRIMARY KEY(fld_ATTC_Id)  ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID));


CREATE INDEX tbl_Attachment_FKIndex1 ON tbl_Attachment (fld_CONT_ID);


CREATE INDEX IFK_Rel_02 ON tbl_Attachment (fld_CONT_ID);



