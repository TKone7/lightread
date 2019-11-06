CREATE TABLE tbl_Purpose (
  fld_PURP_ID SERIAL  NOT NULL ,
  fld_PURP_Key VARCHAR(255)    ,
  fld_PURP_Name VARCHAR(255)      ,
PRIMARY KEY(fld_PURP_ID));




CREATE TABLE tbl_Logs (
  fld_LOGS_ID SERIAL  NOT NULL ,
  fld_LOGS_RefID INT    ,
  fld_LOGS_RefField VARCHAR(255)    ,
  fld_LOGS_Memo VARCHAR(255)    ,
  fld_LOGS_CreationPIT TIMESTAMP      ,
PRIMARY KEY(fld_LOGS_ID));




CREATE TABLE tbl_StatusContent (
  fld_SCON_ID SERIAL  NOT NULL ,
  fld_SCON_Key VARCHAR(255)    ,
  fld_SCON_Name VARCHAR(255)      ,
PRIMARY KEY(fld_SCON_ID));




CREATE TABLE tbl_User (
  fld_USER_ID SERIAL  NOT NULL ,
  fld_USER_Email VARCHAR(255)    ,
  fld_USER_PWhash VARCHAR(255)    ,
  fld_USER_CreationPIT TIMESTAMP    ,
  fld_USER_FirstName VARCHAR(255)    ,
  fld_USER_LastName VARCHAR(255)    ,
  fld_USER_NickName VARCHAR(255)    ,
  fld_USER_Picture BYTEA    ,
  fld_USER_Description VARCHAR(255)    ,
  fld_USER_Locked BOOL    ,
  fld_USER_DeletionPIT TIMESTAMP      ,
PRIMARY KEY(fld_USER_ID));








CREATE TABLE tbl_StatusInvoice (
  fld_SINV_ID SERIAL  NOT NULL ,
  fld_SINV_Key VARCHAR(255)    ,
  fld_SINV_Name VARCHAR(255)      ,
PRIMARY KEY(fld_SINV_ID));




CREATE TABLE tbl_Keyword (
  fld_KEYW_ID SERIAL  NOT NULL ,
  fld_KEYW_Name VARCHAR(255)      ,
PRIMARY KEY(fld_KEYW_ID));




CREATE TABLE tbl_AccessContraint (
  fld_ACCC_ID SERIAL  NOT NULL ,
  fld_ACCC_Key VARCHAR(255)    ,
  fld_ACCC_Name VARCHAR(255)      ,
PRIMARY KEY(fld_ACCC_ID));




CREATE TABLE tbl_Content (
  fld_CONT_ID SERIAL  NOT NULL ,
  fld_USER_ID INT   NOT NULL ,
  fld_ACCC_ID INT   NOT NULL ,
  fld_SCON_ID INT   NOT NULL ,
  fld_CONT_Title VARCHAR(255)    ,
  fld_CONT_SubTitle VARCHAR(255)    ,
  fld_CONT_Body TEXT    ,
  fld_CONT_CreationPIT TIMESTAMP    ,
  fld_CONT_Satoshis INT      ,
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







CREATE INDEX IFK_provides ON tbl_Content (fld_USER_ID);
CREATE INDEX IFK_indicates2 ON tbl_Content (fld_SCON_ID);
CREATE INDEX IFK_restricts ON tbl_Content (fld_ACCC_ID);


CREATE TABLE tbl_Invoice (
  fld_INVC_ID SERIAL  NOT NULL ,
  fld_USER_ID1 INT    ,
  fld_USER_ID2 INT    ,
  fld_CONT_ID INT    ,
  fld_PURP_ID INT   NOT NULL ,
  fld_SINV_ID INT   NOT NULL ,
  fld_INVC_Rhash VARCHAR(255)    ,
  fld_INVC_PayReq VARCHAR(255)    ,
  fld_INVC_Memo VARCHAR(255)    ,
  fld_INVC_Satoshis INT    ,
  fld_INVC_CreationPIT TIMESTAMP    ,
  fld_INVC_SettlePIT TIMESTAMP    ,
  fld_INVC_Expiry INT      ,
PRIMARY KEY(fld_INVC_ID)          ,
  FOREIGN KEY(fld_USER_ID1)
    REFERENCES tbl_User(fld_USER_ID),
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID),
  FOREIGN KEY(fld_SINV_ID)
    REFERENCES tbl_StatusInvoice(fld_SINV_ID),
  FOREIGN KEY(fld_PURP_ID)
    REFERENCES tbl_Purpose(fld_PURP_ID),
  FOREIGN KEY(fld_USER_ID2)
    REFERENCES tbl_User(fld_USER_ID));


CREATE INDEX tbl_Invoice_FKIndex1 ON tbl_Invoice (fld_USER_ID1);
CREATE INDEX tbl_Invoice_FKIndex2 ON tbl_Invoice (fld_CONT_ID);
CREATE INDEX tbl_Invoice_FKIndex3 ON tbl_Invoice (fld_PURP_ID);
CREATE INDEX tbl_Invoice_FKIndex4 ON tbl_Invoice (fld_SINV_ID);
CREATE INDEX tbl_Invoice_FKIndex5 ON tbl_Invoice (fld_USER_ID2);








CREATE INDEX IFK_pays ON tbl_Invoice (fld_USER_ID1);
CREATE INDEX IFK_causes ON tbl_Invoice (fld_CONT_ID);
CREATE INDEX IFK_indicates1 ON tbl_Invoice (fld_SINV_ID);
CREATE INDEX IFK_reasons ON tbl_Invoice (fld_PURP_ID);
CREATE INDEX IFK_receives ON tbl_Invoice (fld_USER_ID2);


CREATE TABLE tbl_Attachment (
  fld_ATTC_ID SERIAL  NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_ATTC_File BYTEA   NOT NULL ,
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
  fld_VIEW_TimeStamp TIMESTAMP      ,
PRIMARY KEY(fld_VIEW_ID)  ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID));


CREATE INDEX tbl_Views_FKIndex1 ON tbl_Views (fld_CONT_ID);


CREATE INDEX IFK_counts ON tbl_Views (fld_CONT_ID);


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


CREATE INDEX IFK_has ON tbl_ContentKeyword (fld_CONT_ID);
CREATE INDEX IFK_describes ON tbl_ContentKeyword (fld_KEYW_ID);


