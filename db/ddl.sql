CREATE TABLE tbl_Purpose (
  fld_PURP_ID SERIAL  NOT NULL ,
  fld_PURP_Key VARCHAR(255)    ,
  fld_PURP_Name VARCHAR(255)      ,
PRIMARY KEY(fld_PURP_ID));




CREATE TABLE tbl_Keyword (
  fld_KEYW_ID SERIAL  NOT NULL ,
  fld_KEYW_Name VARCHAR(255)      ,
PRIMARY KEY(fld_KEYW_ID));




CREATE TABLE tbl_StatusContent (
  fld_SCON_ID SERIAL  NOT NULL ,
  fld_SCON_Key VARCHAR(255)    ,
  fld_SCON_Name VARCHAR(255)      ,
PRIMARY KEY(fld_SCON_ID));




CREATE TABLE tbl_User (
  fld_USER_ID SERIAL  NOT NULL ,
  fld_USER_PWhash VARCHAR(255)    ,
  fld_USER_Email VARCHAR(255)    ,
  fld_USER_CreationDate DATETIME    ,
  fld_USER_LNinfo VARCHAR(255)      ,
PRIMARY KEY(fld_USER_ID));




CREATE TABLE tbl_StatusInvoice (
  fld_SINV_ID SERIAL  NOT NULL ,
  fld_SINV_Key VARCHAR(255)    ,
  fld_SINV_Name VARCHAR(255)      ,
PRIMARY KEY(fld_SINV_ID));




CREATE TABLE tbl_AccessContraint (
  fld_ACCC_ID SERIAL  NOT NULL ,
  fld_ACCC_Key VARCHAR(255)    ,
  fld_ACCC_Name VARCHAR(255)      ,
PRIMARY KEY(fld_ACCC_ID));




CREATE TABLE tbl_Withdrawal (
  fld_WTDR_ID SERIAL  NOT NULL ,
  fld_USER_ID INT   NOT NULL ,
  fld_SINV_ID INT   NOT NULL ,
  fld_WTDR_TimeStamp DATETIME    ,
  fld_WTDR_Memo VARCHAR(255)    ,
  fld_WTDR_PayReq VARCHAR(255)      ,
PRIMARY KEY(fld_WTDR_ID)  ,
  FOREIGN KEY(fld_USER_ID)
    REFERENCES tbl_User(fld_USER_ID),
  FOREIGN KEY(fld_SINV_ID)
    REFERENCES tbl_StatusInvoice(fld_SINV_ID));


CREATE INDEX tbl_Withdrawal_FKIndex1 ON tbl_Withdrawal (fld_USER_ID);


CREATE INDEX IFK_posts ON tbl_Withdrawal (fld_USER_ID);
CREATE INDEX IFK_indicates ON tbl_Withdrawal (fld_SINV_ID);


CREATE TABLE tbl_Content (
  fld_CONT_ID SERIAL  NOT NULL ,
  fld_USER_ID INT   NOT NULL ,
  fld_ACCC_ID INT   NOT NULL ,
  fld_SCON_ID INT   NOT NULL ,
  fld_CONT_CreationDate DATETIME    ,
  fld_CONT_Title VARCHAR(255)    ,
  fld_CONT_SubTitle VARCHAR(255)    ,
  fld_CONT_Body TEXT    ,
  fld_CONT_Fee INT      ,
PRIMARY KEY(fld_CONT_ID)      ,
  FOREIGN KEY(fld_USER_ID)
    REFERENCES tbl_User(fld_USER_ID),
  FOREIGN KEY(fld_SCON_ID)
    REFERENCES tbl_StatusContent(fld_SCON_ID),
  FOREIGN KEY(fld_ACCC_ID)
    REFERENCES tbl_AccessContraint(fld_ACCC_ID));


CREATE INDEX tbl_Content_FKIndex1 ON tbl_Content (fld_USER_ID);
CREATE INDEX tbl_Content_FKIndex2 ON tbl_Content (fld_SCON_ID);
CREATE INDEX tbl_Content_FKIndex3 ON tbl_Content (fld_ACCC_ID);






CREATE INDEX IFK_publishes ON tbl_Content (fld_USER_ID);
CREATE INDEX IFK_indicates ON tbl_Content (fld_SCON_ID);
CREATE INDEX IFK_restricts ON tbl_Content (fld_ACCC_ID);


CREATE TABLE tbl_Invoice (
  fld_INVC_ID SERIAL  NOT NULL ,
  fld_USER_ID INT   NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_PURP_ID INT   NOT NULL ,
  fld_SINV_ID INT   NOT NULL ,
  fld_INVC_Rhash VARCHAR(255)    ,
  fld_INVC_PayReq VARCHAR(255)      ,
PRIMARY KEY(fld_INVC_ID)      ,
  FOREIGN KEY(fld_USER_ID)
    REFERENCES tbl_User(fld_USER_ID),
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID),
  FOREIGN KEY(fld_SINV_ID)
    REFERENCES tbl_StatusInvoice(fld_SINV_ID),
  FOREIGN KEY(fld_PURP_ID)
    REFERENCES tbl_Purpose(fld_PURP_ID));


CREATE INDEX tbl_Invoice_FKIndex1 ON tbl_Invoice (fld_USER_ID);
CREATE INDEX tbl_Invoice_FKIndex2 ON tbl_Invoice (fld_CONT_ID);
CREATE INDEX tbl_Invoice_FKIndex4 ON tbl_Invoice (fld_PURP_ID);




CREATE INDEX IFK_pays ON tbl_Invoice (fld_USER_ID);
CREATE INDEX IFK_causes ON tbl_Invoice (fld_CONT_ID);
CREATE INDEX IFK_indicates ON tbl_Invoice (fld_SINV_ID);
CREATE INDEX IFK_reasons ON tbl_Invoice (fld_PURP_ID);


CREATE TABLE tbl_Attachment (
  fld_ATTC_ID SERIAL  NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_ATTC_File BLOB   NOT NULL ,
  fld_ATTC_Description VARCHAR(255)      ,
PRIMARY KEY(fld_ATTC_ID)  ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID));


CREATE INDEX tbl_Attachment_FKIndex1 ON tbl_Attachment (fld_CONT_ID);



CREATE INDEX IFK_includes ON tbl_Attachment (fld_CONT_ID);


CREATE TABLE tbl_Views (
  fld_VIEW_ID SERIAL  NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_VIEW_IP VARCHAR(255)    ,
  fld_VIEW_Country VARCHAR(255)    ,
  fld_VIEW_TimeStamp DATETIME      ,
PRIMARY KEY(fld_VIEW_ID)  ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID));


CREATE INDEX tbl_Views_FKIndex1 ON tbl_Views (fld_CONT_ID);


CREATE INDEX IFK_has ON tbl_Views (fld_CONT_ID);


CREATE TABLE tbl_ContentKeyword (
  fld_COKE_ID SERIAL  NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_KEYW_ID INT   NOT NULL   ,
PRIMARY KEY(fld_COKE_ID)    ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID),
  FOREIGN KEY(fld_KEYW_ID)
    REFERENCES tbl_Keyword(fld_KEYW_ID));


CREATE INDEX tbl_ContentKeyword_FKIndex1 ON tbl_ContentKeyword (fld_CONT_ID);
CREATE INDEX tbl_ContentKeyword_FKIndex2 ON tbl_ContentKeyword (fld_KEYW_ID);


CREATE INDEX IFK_refers ON tbl_ContentKeyword (fld_CONT_ID);
CREATE INDEX IFK_refers ON tbl_ContentKeyword (fld_KEYW_ID);



