CREATE TABLE tbl_Price (
  fld_PRIC_ID SERIAL  NOT NULL ,
  fld_PRIC_Sym1 VARCHAR(20)   NOT NULL ,
  fld_PRIC_Sym2 VARCHAR(20)   NOT NULL ,
  fld_PRIC_Value DOUBLE PRECISION   NOT NULL ,
  fld_PRIC_PIT TIMESTAMP      ,
PRIMARY KEY(fld_PRIC_ID));





CREATE TABLE tbl_Node (
  fld_NODE_ID SERIAL  NOT NULL ,
  fld_NODE_TLS TEXT    ,
  fld_NODE_Macaroon TEXT    ,
  fld_NODE_IP VARCHAR(255)    ,
  fld_NODE_active BOOL  DEFAULT false    ,
PRIMARY KEY(fld_NODE_ID));




CREATE TABLE tbl_Logs (
  fld_LOGS_ID SERIAL  NOT NULL ,
  fld_LOGS_RefID INT    ,
  fld_LOGS_RefField VARCHAR(255)    ,
  fld_LOGS_Memo VARCHAR(255)    ,
  fld_LOGS_CreationPIT TIMESTAMP      ,
PRIMARY KEY(fld_LOGS_ID));




CREATE TABLE tbl_Purpose (
  fld_PURP_ID INT   NOT NULL ,
  fld_PURP_Key VARCHAR(255)    ,
  fld_PURP_Name VARCHAR(255)      ,
PRIMARY KEY(fld_PURP_ID));




CREATE TABLE tbl_StatusInvoice (
  fld_SINV_ID INT   NOT NULL ,
  fld_SINV_Key VARCHAR(255)    ,
  fld_SINV_Name VARCHAR(255)      ,
PRIMARY KEY(fld_SINV_ID));




CREATE TABLE tbl_StatusContent (
  fld_SCON_ID INT   NOT NULL ,
  fld_SCON_Key VARCHAR(255)    ,
  fld_SCON_Name VARCHAR(255)      ,
PRIMARY KEY(fld_SCON_ID));




CREATE TABLE tbl_Role (
  fld_ROLE_ID INT   NOT NULL ,
  fld_ROLE_Key VARCHAR(255)    ,
  fld_ROLE_Name VARCHAR(255)      ,
PRIMARY KEY(fld_ROLE_ID));




CREATE TABLE tbl_Category (
  fld_CATE_ID SERIAL  NOT NULL ,
  fld_CATE_Name VARCHAR(255)      ,
PRIMARY KEY(fld_CATE_ID));




CREATE TABLE tbl_AccessContraint (
  fld_ACCC_ID INT   NOT NULL ,
  fld_ACCC_Key VARCHAR(255)    ,
  fld_ACCC_Name VARCHAR(255)      ,
PRIMARY KEY(fld_ACCC_ID));




CREATE TABLE tbl_Keyword (
  fld_KEYW_ID SERIAL  NOT NULL ,
  fld_KEYW_Name VARCHAR(255)      ,
PRIMARY KEY(fld_KEYW_ID));




CREATE TABLE tbl_User (
  fld_USER_ID SERIAL  NOT NULL ,
  fld_ROLE_ID INT   NOT NULL ,
  fld_USER_Email VARCHAR(255)    ,
  fld_USER_PWhash VARCHAR(255)    ,
  fld_USER_CreationPIT TIMESTAMP    ,
  fld_USER_Verified BOOL    ,
  fld_USER_FirstName VARCHAR(255)    ,
  fld_USER_LastName VARCHAR(255)    ,
  fld_USER_NickName VARCHAR(255)    ,
  fld_USER_Picture BYTEA    ,
  fld_USER_Description VARCHAR(255)    ,
  fld_USER_Locked BOOL    ,
  fld_USER_DeletionPIT TIMESTAMP    ,
  fld_USER_isAdmin BOOL      ,
PRIMARY KEY(fld_USER_ID)  ,
  FOREIGN KEY(fld_ROLE_ID)
    REFERENCES tbl_Role(fld_ROLE_ID));


CREATE INDEX tbl_User_FKIndex1 ON tbl_User (fld_ROLE_ID);








CREATE INDEX IFK_defines ON tbl_User (fld_ROLE_ID);


CREATE TABLE tbl_Content (
  fld_CONT_ID SERIAL  NOT NULL ,
  fld_USER_ID INT   NOT NULL ,
  fld_CATE_ID INT   ,
  fld_ACCC_ID INT   NOT NULL ,
  fld_SCON_ID INT   NOT NULL ,
  fld_CONT_Title VARCHAR(255)    ,
  fld_CONT_SubTitle VARCHAR(255)    ,
  fld_CONT_Body TEXT    ,
  fld_CONT_CreationPIT TIMESTAMP    ,
  fld_CONT_Satoshis INT    ,
  fld_CONT_ETR INT      ,
PRIMARY KEY(fld_CONT_ID)        ,
  FOREIGN KEY(fld_USER_ID)
    REFERENCES tbl_User(fld_USER_ID),
  FOREIGN KEY(fld_SCON_ID)
    REFERENCES tbl_StatusContent(fld_SCON_ID),
  FOREIGN KEY(fld_ACCC_ID)
    REFERENCES tbl_AccessContraint(fld_ACCC_ID),
  FOREIGN KEY(fld_CATE_ID)
    REFERENCES tbl_Category(fld_CATE_ID));


CREATE INDEX tbl_Content_FKIndex1 ON tbl_Content (fld_USER_ID);
CREATE INDEX tbl_Content_FKIndex2 ON tbl_Content (fld_SCON_ID);
CREATE INDEX tbl_Content_FKIndex3 ON tbl_Content (fld_ACCC_ID);
CREATE INDEX tbl_Content_FKIndex4 ON tbl_Content (fld_CATE_ID);








CREATE INDEX IFK_provides ON tbl_Content (fld_USER_ID);
CREATE INDEX IFK_indicates2 ON tbl_Content (fld_SCON_ID);
CREATE INDEX IFK_restricts ON tbl_Content (fld_ACCC_ID);
CREATE INDEX IFK_specifies ON tbl_Content (fld_CATE_ID);


CREATE TABLE tbl_Invoice (
  fld_INVC_ID SERIAL  NOT NULL ,
  fld_USER_ID1 INT    ,
  fld_USER_ID2 INT    ,
  fld_CONT_ID INT    ,
  fld_PURP_ID INT   NOT NULL ,
  fld_SINV_ID INT   NOT NULL ,
  fld_INVC_Rhash VARCHAR(255)    ,
  fld_INVC_PayReq VARCHAR(510)    ,
  fld_INVC_Memo VARCHAR(510)    ,
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
  fld_ATTC_URI VARCHAR(255)   NOT NULL ,
  fld_ATTC_AltText VARCHAR(255)      ,
PRIMARY KEY(fld_ATTC_ID)  ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID));


CREATE INDEX tbl_Attachment_FKIndex1 ON tbl_Attachment (fld_CONT_ID);





CREATE INDEX IFK_includes ON tbl_Attachment (fld_CONT_ID);


CREATE TABLE tbl_ContentKeyword (
  fld_COKE_IT SERIAL  NOT NULL ,
  fld_CONT_ID INT   NOT NULL ,
  fld_KEYW_ID INT   NOT NULL   ,
PRIMARY KEY(fld_COKE_IT)    ,
  FOREIGN KEY(fld_KEYW_ID)
    REFERENCES tbl_Keyword(fld_KEYW_ID),
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID));


CREATE INDEX tbl_ContentKeyword_FKIndex1 ON tbl_ContentKeyword (fld_KEYW_ID);
CREATE INDEX tbl_ContentKeyword_FKIndex2 ON tbl_ContentKeyword (fld_CONT_ID);


CREATE INDEX IFK_describes ON tbl_ContentKeyword (fld_KEYW_ID);
CREATE INDEX IFK_has ON tbl_ContentKeyword (fld_CONT_ID);


CREATE TABLE tbl_Views (
  fld_VIEW_ID SERIAL  NOT NULL ,
  fld_USER_ID INT    ,
  fld_CONT_ID INT   NOT NULL ,
  fld_VIEW_SessionID VARCHAR(255)    ,
  fld_VIEW_IP VARCHAR(255)    ,
  fld_VIEW_City VARCHAR(255)    ,
  fld_VIEW_Country VARCHAR(255)    ,
  fld_VIEW_OS VARCHAR(255)    ,
  fld_VIEW_Browser VARCHAR(255)    ,
  fld_VIEW_ScreenSize VARCHAR(255)    ,
  fld_VIEW_SearchEng VARCHAR(255)    ,
  fld_VIEW_PIT TIMESTAMP      ,
PRIMARY KEY(fld_VIEW_ID)    ,
  FOREIGN KEY(fld_CONT_ID)
    REFERENCES tbl_Content(fld_CONT_ID),
  FOREIGN KEY(fld_USER_ID)
    REFERENCES tbl_User(fld_USER_ID));


CREATE INDEX tbl_Views_FKIndex1 ON tbl_Views (fld_CONT_ID);
CREATE INDEX tbl_Views_FKIndex2 ON tbl_Views (fld_USER_ID);




CREATE INDEX IFK_counts ON tbl_Views (fld_CONT_ID);
CREATE INDEX IFK_raises ON tbl_Views (fld_USER_ID);






INSERT INTO public.tbl_accesscontraint (fld_accc_id, fld_accc_key, fld_accc_name) VALUES (1, 'FREE', 'these articles are free');
INSERT INTO public.tbl_accesscontraint (fld_accc_id, fld_accc_key, fld_accc_name) VALUES (2, 'PAID', 'these articles must be paid for');

INSERT INTO public.tbl_purpose (fld_purp_id, fld_purp_key, fld_purp_name) VALUES (1, 'DONATION', 'donation');
INSERT INTO public.tbl_purpose (fld_purp_id, fld_purp_key, fld_purp_name) VALUES (2, 'READ', 'read');
INSERT INTO public.tbl_purpose (fld_purp_id, fld_purp_key, fld_purp_name) VALUES (3, 'WITHDRAWAL', 'withdrawal');

INSERT INTO public.tbl_statuscontent (fld_scon_id, fld_scon_key, fld_scon_name) VALUES (1, 'DRAFT', 'not visible by others');
INSERT INTO public.tbl_statuscontent (fld_scon_id, fld_scon_key, fld_scon_name) VALUES (2, 'PUBLISHED', 'published for everyone');
INSERT INTO public.tbl_statuscontent (fld_scon_id, fld_scon_key, fld_scon_name) VALUES (3, 'DELETED', 'marked as deleted');

INSERT INTO public.tbl_statusinvoice (fld_sinv_id, fld_sinv_key, fld_sinv_name) VALUES (1, 'OPEN', 'open');
INSERT INTO public.tbl_statusinvoice (fld_sinv_id, fld_sinv_key, fld_sinv_name) VALUES (2, 'SETTLED', 'settled');
INSERT INTO public.tbl_statusinvoice (fld_sinv_id, fld_sinv_key, fld_sinv_name) VALUES (3, 'CANCELED', 'canceled');
INSERT INTO public.tbl_statusinvoice (fld_sinv_id, fld_sinv_key, fld_sinv_name) VALUES (4, 'ACCEPTED', 'accepted');

INSERT INTO public.tbl_role (fld_role_id, fld_role_key, fld_role_name) VALUES (1, 'ADMIN', 'admin');
INSERT INTO public.tbl_role (fld_role_id, fld_role_key, fld_role_name) VALUES (2, 'USER', 'user');
