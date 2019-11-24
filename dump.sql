--
-- PostgreSQL database dump
--

-- Dumped from database version 10.10
-- Dumped by pg_dump version 10.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tbl_accesscontraint; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_accesscontraint (
    fld_accc_id integer NOT NULL,
    fld_accc_key character varying(255),
    fld_accc_name character varying(255)
);


ALTER TABLE public.tbl_accesscontraint OWNER TO postgres;

--
-- Name: tbl_accesscontraint_fld_accc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_accesscontraint_fld_accc_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_accesscontraint_fld_accc_id_seq OWNER TO postgres;

--
-- Name: tbl_accesscontraint_fld_accc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_accesscontraint_fld_accc_id_seq OWNED BY public.tbl_accesscontraint.fld_accc_id;


--
-- Name: tbl_attachment; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_attachment (
    fld_attc_id integer NOT NULL,
    fld_cont_id integer NOT NULL,
    fld_attc_file bytea NOT NULL,
    fld_attc_description character varying(255)
);


ALTER TABLE public.tbl_attachment OWNER TO postgres;

--
-- Name: tbl_attachment_fld_attc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_attachment_fld_attc_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_attachment_fld_attc_id_seq OWNER TO postgres;

--
-- Name: tbl_attachment_fld_attc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_attachment_fld_attc_id_seq OWNED BY public.tbl_attachment.fld_attc_id;


--
-- Name: tbl_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_category (
    fld_cate_id integer NOT NULL,
    fld_cate_name character varying(255)
);


ALTER TABLE public.tbl_category OWNER TO postgres;

--
-- Name: tbl_category_fld_cate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_category_fld_cate_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_category_fld_cate_id_seq OWNER TO postgres;

--
-- Name: tbl_category_fld_cate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_category_fld_cate_id_seq OWNED BY public.tbl_category.fld_cate_id;


--
-- Name: tbl_content; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_content (
    fld_cont_id integer NOT NULL,
    fld_user_id integer NOT NULL,
    fld_accc_id integer NOT NULL,
    fld_scon_id integer NOT NULL,
    fld_cont_title character varying(255),
    fld_cont_subtitle character varying(255),
    fld_cont_body text,
    fld_cont_creationpit timestamp without time zone,
    fld_cont_satoshis integer
);


ALTER TABLE public.tbl_content OWNER TO postgres;

--
-- Name: tbl_content_fld_cont_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_content_fld_cont_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_content_fld_cont_id_seq OWNER TO postgres;

--
-- Name: tbl_content_fld_cont_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_content_fld_cont_id_seq OWNED BY public.tbl_content.fld_cont_id;


--
-- Name: tbl_contentkeyword; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_contentkeyword (
    fld_coke_id integer NOT NULL,
    fld_cont_id integer NOT NULL,
    fld_keyw_id integer NOT NULL
);


ALTER TABLE public.tbl_contentkeyword OWNER TO postgres;

--
-- Name: tbl_contentkeyword_fld_coke_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_contentkeyword_fld_coke_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_contentkeyword_fld_coke_id_seq OWNER TO postgres;

--
-- Name: tbl_contentkeyword_fld_coke_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_contentkeyword_fld_coke_id_seq OWNED BY public.tbl_contentkeyword.fld_coke_id;


--
-- Name: tbl_invoice; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_invoice (
    fld_invc_id integer NOT NULL,
    fld_user_id1 integer,
    fld_user_id2 integer,
    fld_cont_id integer,
    fld_purp_id integer NOT NULL,
    fld_sinv_id integer NOT NULL,
    fld_invc_rhash character varying(255),
    fld_invc_payreq character varying(255),
    fld_invc_memo character varying(255),
    fld_invc_satoshis integer,
    fld_invc_creationpit timestamp without time zone,
    fld_invc_settlepit timestamp without time zone,
    fld_invc_expiry integer
);


ALTER TABLE public.tbl_invoice OWNER TO postgres;

--
-- Name: tbl_invoice_fld_invc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_invoice_fld_invc_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_invoice_fld_invc_id_seq OWNER TO postgres;

--
-- Name: tbl_invoice_fld_invc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_invoice_fld_invc_id_seq OWNED BY public.tbl_invoice.fld_invc_id;


--
-- Name: tbl_keyword; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_keyword (
    fld_keyw_id integer NOT NULL,
    fld_cate_id integer,
    fld_keyw_name character varying(255)
);


ALTER TABLE public.tbl_keyword OWNER TO postgres;

--
-- Name: tbl_keyword_fld_keyw_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_keyword_fld_keyw_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_keyword_fld_keyw_id_seq OWNER TO postgres;

--
-- Name: tbl_keyword_fld_keyw_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_keyword_fld_keyw_id_seq OWNED BY public.tbl_keyword.fld_keyw_id;


--
-- Name: tbl_logs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_logs (
    fld_logs_id integer NOT NULL,
    fld_logs_refid integer,
    fld_logs_reffield character varying(255),
    fld_logs_memo character varying(255),
    fld_logs_creationpit timestamp without time zone
);


ALTER TABLE public.tbl_logs OWNER TO postgres;

--
-- Name: tbl_logs_fld_logs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_logs_fld_logs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_logs_fld_logs_id_seq OWNER TO postgres;

--
-- Name: tbl_logs_fld_logs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_logs_fld_logs_id_seq OWNED BY public.tbl_logs.fld_logs_id;


--
-- Name: tbl_purpose; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_purpose (
    fld_purp_id integer NOT NULL,
    fld_purp_key character varying(255),
    fld_purp_name character varying(255)
);


ALTER TABLE public.tbl_purpose OWNER TO postgres;

--
-- Name: tbl_purpose_fld_purp_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_purpose_fld_purp_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_purpose_fld_purp_id_seq OWNER TO postgres;

--
-- Name: tbl_purpose_fld_purp_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_purpose_fld_purp_id_seq OWNED BY public.tbl_purpose.fld_purp_id;


--
-- Name: tbl_statuscontent; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_statuscontent (
    fld_scon_id integer NOT NULL,
    fld_scon_key character varying(255),
    fld_scon_name character varying(255)
);


ALTER TABLE public.tbl_statuscontent OWNER TO postgres;

--
-- Name: tbl_statuscontent_fld_scon_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_statuscontent_fld_scon_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_statuscontent_fld_scon_id_seq OWNER TO postgres;

--
-- Name: tbl_statuscontent_fld_scon_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_statuscontent_fld_scon_id_seq OWNED BY public.tbl_statuscontent.fld_scon_id;


--
-- Name: tbl_statusinvoice; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_statusinvoice (
    fld_sinv_id integer NOT NULL,
    fld_sinv_key character varying(255),
    fld_sinv_name character varying(255)
);


ALTER TABLE public.tbl_statusinvoice OWNER TO postgres;

--
-- Name: tbl_statusinvoice_fld_sinv_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_statusinvoice_fld_sinv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_statusinvoice_fld_sinv_id_seq OWNER TO postgres;

--
-- Name: tbl_statusinvoice_fld_sinv_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_statusinvoice_fld_sinv_id_seq OWNED BY public.tbl_statusinvoice.fld_sinv_id;


--
-- Name: tbl_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_user (
    fld_user_id integer NOT NULL,
    fld_user_email character varying(255),
    fld_user_pwhash character varying(255),
    fld_user_creationpit timestamp without time zone,
    fld_user_verified boolean,
    fld_user_firstname character varying(255),
    fld_user_lastname character varying(255),
    fld_user_nickname character varying(255),
    fld_user_picture bytea,
    fld_user_description character varying(255),
    fld_user_locked boolean,
    fld_user_deletionpit timestamp without time zone
);


ALTER TABLE public.tbl_user OWNER TO postgres;

--
-- Name: tbl_user_fld_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_user_fld_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_user_fld_user_id_seq OWNER TO postgres;

--
-- Name: tbl_user_fld_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_user_fld_user_id_seq OWNED BY public.tbl_user.fld_user_id;


--
-- Name: tbl_views; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_views (
    fld_view_id integer NOT NULL,
    fld_cont_id integer NOT NULL,
    fld_view_ip character varying(255),
    fld_view_country character varying(255),
    fld_view_timestamp timestamp without time zone
);


ALTER TABLE public.tbl_views OWNER TO postgres;

--
-- Name: tbl_views_fld_view_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_views_fld_view_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_views_fld_view_id_seq OWNER TO postgres;

--
-- Name: tbl_views_fld_view_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_views_fld_view_id_seq OWNED BY public.tbl_views.fld_view_id;


--
-- Name: tbl_accesscontraint fld_accc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_accesscontraint ALTER COLUMN fld_accc_id SET DEFAULT nextval('public.tbl_accesscontraint_fld_accc_id_seq'::regclass);


--
-- Name: tbl_attachment fld_attc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_attachment ALTER COLUMN fld_attc_id SET DEFAULT nextval('public.tbl_attachment_fld_attc_id_seq'::regclass);


--
-- Name: tbl_category fld_cate_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_category ALTER COLUMN fld_cate_id SET DEFAULT nextval('public.tbl_category_fld_cate_id_seq'::regclass);


--
-- Name: tbl_content fld_cont_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_content ALTER COLUMN fld_cont_id SET DEFAULT nextval('public.tbl_content_fld_cont_id_seq'::regclass);


--
-- Name: tbl_contentkeyword fld_coke_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_contentkeyword ALTER COLUMN fld_coke_id SET DEFAULT nextval('public.tbl_contentkeyword_fld_coke_id_seq'::regclass);


--
-- Name: tbl_invoice fld_invc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice ALTER COLUMN fld_invc_id SET DEFAULT nextval('public.tbl_invoice_fld_invc_id_seq'::regclass);


--
-- Name: tbl_keyword fld_keyw_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_keyword ALTER COLUMN fld_keyw_id SET DEFAULT nextval('public.tbl_keyword_fld_keyw_id_seq'::regclass);


--
-- Name: tbl_logs fld_logs_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_logs ALTER COLUMN fld_logs_id SET DEFAULT nextval('public.tbl_logs_fld_logs_id_seq'::regclass);


--
-- Name: tbl_purpose fld_purp_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_purpose ALTER COLUMN fld_purp_id SET DEFAULT nextval('public.tbl_purpose_fld_purp_id_seq'::regclass);


--
-- Name: tbl_statuscontent fld_scon_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_statuscontent ALTER COLUMN fld_scon_id SET DEFAULT nextval('public.tbl_statuscontent_fld_scon_id_seq'::regclass);


--
-- Name: tbl_statusinvoice fld_sinv_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_statusinvoice ALTER COLUMN fld_sinv_id SET DEFAULT nextval('public.tbl_statusinvoice_fld_sinv_id_seq'::regclass);


--
-- Name: tbl_user fld_user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_user ALTER COLUMN fld_user_id SET DEFAULT nextval('public.tbl_user_fld_user_id_seq'::regclass);


--
-- Name: tbl_views fld_view_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_views ALTER COLUMN fld_view_id SET DEFAULT nextval('public.tbl_views_fld_view_id_seq'::regclass);


--
-- Data for Name: tbl_accesscontraint; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tbl_accesscontraint VALUES (1, 'FREE', 'these articles are free');
INSERT INTO public.tbl_accesscontraint VALUES (2, 'PAID', 'these articles must be paid for');


--
-- Data for Name: tbl_attachment; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_category; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_content; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tbl_content VALUES (4, 1, 1, 2, 'Something Special', 'No one could think of', '## Have you ever

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsu*m has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to mak*e a type specimen book. It has survived not only five centuries, but also the leap i

1. nto electronic
2.  typesetting,
3.   **remaining** essentially unchanged
4.   . It was popularised
5.    in the 1960s
6.     with the release

Pof Letraset sheets containing Lorem Ipsum passages, and more recently with desktop **publishing** software like Aldus PageMaker including versions of Lorem Ipsum.

## Lorem
> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an ***unknown*** printer took a galley of type and scrambled it to make a t

ype specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


* popularised
* in the 1960s w
* ith the release of 
* Letraset sheets containing Lo
* rem Ipsum passages

asdfas', '2019-11-15 17:04:07', 0);
INSERT INTO public.tbl_content VALUES (3, 2, 2, 2, 'Writing in R', 'with a subtitle', '## Have you ever

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsu*m has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to mak*e a type specimen book. It has survived not only five centuries, but also the leap i

1. nto electronic
2.  typesetting,
3.   **remaining** essentially unchanged
4.   . It was popularised
5.    in the 1960s
6.     with the release

Pof Letraset sheets containing Lorem Ipsum passages, and more recently with desktop **publishing** software like Aldus PageMaker including versions of Lorem Ipsum.

## Lorem
> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an ***unknown*** printer took a galley of type and scrambled it to make a t

ype specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


* popularised
* in the 1960s w
* ith the release of 
* Letraset sheets containing Lo
* rem Ipsum passages

asdfas', '2019-11-15 17:03:07', 30);
INSERT INTO public.tbl_content VALUES (1, 1, 2, 2, 'My first story', 'Problems look mighty small from 100050 miles up', '# Let''s put it down

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsu*m has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to mak*e a type specimen book. It has survived not only five centuries, but also the leap i

1. nto electronic
2.  typesetting,
3.   **remaining** essentially unchanged
4.   . It was popularised
5.    in the 1960s
6.     with the release

Pof Letraset sheets containing Lorem Ipsum passages, and more recently with desktop **publishing** software like Aldus PageMaker including versions of Lorem Ipsum.

## Lorem
> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an ***unknown*** printer took a galley of type and scrambled it to make a t

ype specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


* popularised
* in the 1960s w
* ith the release of 
* Letraset sheets containing Lo
* rem Ipsum passages

asdfas', '2019-11-15 15:13:09', 78);
INSERT INTO public.tbl_content VALUES (2, 2, 2, 2, 'Pattern Recognition', 'who knows what will come next', '## Have you ever

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsu*m has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to mak*e a type specimen book. It has survived not only five centuries, but also the leap i

1. nto electronic
2.  typesetting,
3.   **remaining** essentially unchanged
4.   . It was popularised
5.    in the 1960s
6.     with the release

Pof Letraset sheets containing Lorem Ipsum passages, and more recently with desktop **publishing** software like Aldus PageMaker including versions of Lorem Ipsum.

## Lorem
> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an ***unknown*** printer took a galley of type and scrambled it to make a t

ype specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


* popularised
* in the 1960s w
* ith the release of 
* Letraset sheets containing Lo
* rem Ipsum passages

asdfas', '2019-11-15 16:00:24', 1110);


--
-- Data for Name: tbl_contentkeyword; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_invoice; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_keyword; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_logs; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_purpose; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_statuscontent; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tbl_statuscontent VALUES (1, 'DRAFT', 'not visible by others');
INSERT INTO public.tbl_statuscontent VALUES (2, 'PUBLISHED', 'published for everyone');
INSERT INTO public.tbl_statuscontent VALUES (3, 'DELETED', 'marked as deleted');


--
-- Data for Name: tbl_statusinvoice; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tbl_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tbl_user VALUES (20, NULL, '$2y$10$A9C1puSiMX7H11IY7FBk5uOL.FgGN3MiQiYZk4l1M6T2MeL4zGIoS', '2019-11-16 20:51:31', NULL, NULL, NULL, 'LoginLogin', NULL, NULL, false, NULL);
INSERT INTO public.tbl_user VALUES (21, NULL, '$2y$10$i2ZeHnkKiYFgqcrODjToMedGfmEfefeeIKJeiO/ezOkcWDU5nYAy6', '2019-11-16 20:52:44', NULL, NULL, NULL, 'RegisterRegister', NULL, NULL, false, NULL);
INSERT INTO public.tbl_user VALUES (1, 'koller.tobias@gmx.net', '$2y$10$tGCHXQQPQuxwthgwEqOxwOLO/Rfwt6zSF.b2Gkkmo5RkeqDgm8OjS', '2019-11-15 14:51:26', NULL, 'Tobias Peter', 'Kollers', 'tobias', NULL, NULL, false, NULL);
INSERT INTO public.tbl_user VALUES (2, 'RomanBögli', '$2y$10$pIouA1.N8w2gGBXJfAZk..N0fkJO9ys0a7NGzPCMF3v2V72qN7HBC', '2019-11-15 17:02:36', NULL, 'Roman', 'Bögli', 'roman', NULL, NULL, false, NULL);


--
-- Data for Name: tbl_views; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: tbl_accesscontraint_fld_accc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_accesscontraint_fld_accc_id_seq', 2, true);


--
-- Name: tbl_attachment_fld_attc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_attachment_fld_attc_id_seq', 1, false);


--
-- Name: tbl_category_fld_cate_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_category_fld_cate_id_seq', 1, false);


--
-- Name: tbl_content_fld_cont_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_content_fld_cont_id_seq', 7, true);


--
-- Name: tbl_contentkeyword_fld_coke_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_contentkeyword_fld_coke_id_seq', 1, false);


--
-- Name: tbl_invoice_fld_invc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_invoice_fld_invc_id_seq', 1, false);


--
-- Name: tbl_keyword_fld_keyw_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_keyword_fld_keyw_id_seq', 1, false);


--
-- Name: tbl_logs_fld_logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_logs_fld_logs_id_seq', 1, false);


--
-- Name: tbl_purpose_fld_purp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_purpose_fld_purp_id_seq', 1, false);


--
-- Name: tbl_statuscontent_fld_scon_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_statuscontent_fld_scon_id_seq', 3, true);


--
-- Name: tbl_statusinvoice_fld_sinv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_statusinvoice_fld_sinv_id_seq', 1, false);


--
-- Name: tbl_user_fld_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_user_fld_user_id_seq', 21, true);


--
-- Name: tbl_views_fld_view_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_views_fld_view_id_seq', 1, false);


--
-- Name: tbl_accesscontraint tbl_accesscontraint_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_accesscontraint
    ADD CONSTRAINT tbl_accesscontraint_pkey PRIMARY KEY (fld_accc_id);


--
-- Name: tbl_attachment tbl_attachment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_attachment
    ADD CONSTRAINT tbl_attachment_pkey PRIMARY KEY (fld_attc_id);


--
-- Name: tbl_category tbl_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_category
    ADD CONSTRAINT tbl_category_pkey PRIMARY KEY (fld_cate_id);


--
-- Name: tbl_content tbl_content_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_content
    ADD CONSTRAINT tbl_content_pkey PRIMARY KEY (fld_cont_id);


--
-- Name: tbl_contentkeyword tbl_contentkeyword_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_contentkeyword
    ADD CONSTRAINT tbl_contentkeyword_pkey PRIMARY KEY (fld_coke_id);


--
-- Name: tbl_invoice tbl_invoice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice
    ADD CONSTRAINT tbl_invoice_pkey PRIMARY KEY (fld_invc_id);


--
-- Name: tbl_keyword tbl_keyword_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_keyword
    ADD CONSTRAINT tbl_keyword_pkey PRIMARY KEY (fld_keyw_id);


--
-- Name: tbl_logs tbl_logs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_logs
    ADD CONSTRAINT tbl_logs_pkey PRIMARY KEY (fld_logs_id);


--
-- Name: tbl_purpose tbl_purpose_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_purpose
    ADD CONSTRAINT tbl_purpose_pkey PRIMARY KEY (fld_purp_id);


--
-- Name: tbl_statuscontent tbl_statuscontent_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_statuscontent
    ADD CONSTRAINT tbl_statuscontent_pkey PRIMARY KEY (fld_scon_id);


--
-- Name: tbl_statusinvoice tbl_statusinvoice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_statusinvoice
    ADD CONSTRAINT tbl_statusinvoice_pkey PRIMARY KEY (fld_sinv_id);


--
-- Name: tbl_user tbl_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_user
    ADD CONSTRAINT tbl_user_pkey PRIMARY KEY (fld_user_id);


--
-- Name: tbl_views tbl_views_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_views
    ADD CONSTRAINT tbl_views_pkey PRIMARY KEY (fld_view_id);


--
-- Name: ifk_causes; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_causes ON public.tbl_invoice USING btree (fld_cont_id);


--
-- Name: ifk_counts; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_counts ON public.tbl_views USING btree (fld_cont_id);


--
-- Name: ifk_describes; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_describes ON public.tbl_contentkeyword USING btree (fld_keyw_id);


--
-- Name: ifk_groups; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_groups ON public.tbl_keyword USING btree (fld_cate_id);


--
-- Name: ifk_has; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_has ON public.tbl_contentkeyword USING btree (fld_cont_id);


--
-- Name: ifk_includes; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_includes ON public.tbl_attachment USING btree (fld_cont_id);


--
-- Name: ifk_indicates1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_indicates1 ON public.tbl_invoice USING btree (fld_sinv_id);


--
-- Name: ifk_indicates2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_indicates2 ON public.tbl_content USING btree (fld_scon_id);


--
-- Name: ifk_pays; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_pays ON public.tbl_invoice USING btree (fld_user_id1);


--
-- Name: ifk_provides; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_provides ON public.tbl_content USING btree (fld_user_id);


--
-- Name: ifk_reasons; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_reasons ON public.tbl_invoice USING btree (fld_purp_id);


--
-- Name: ifk_receives; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_receives ON public.tbl_invoice USING btree (fld_user_id2);


--
-- Name: ifk_restricts; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ifk_restricts ON public.tbl_content USING btree (fld_accc_id);


--
-- Name: tbl_attachment_fkindex1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_attachment_fkindex1 ON public.tbl_attachment USING btree (fld_cont_id);


--
-- Name: tbl_content_fkindex1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_content_fkindex1 ON public.tbl_content USING btree (fld_user_id);


--
-- Name: tbl_content_fkindex2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_content_fkindex2 ON public.tbl_content USING btree (fld_scon_id);


--
-- Name: tbl_content_fkindex3; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_content_fkindex3 ON public.tbl_content USING btree (fld_accc_id);


--
-- Name: tbl_contentkeyword_fkindex1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_contentkeyword_fkindex1 ON public.tbl_contentkeyword USING btree (fld_cont_id);


--
-- Name: tbl_contentkeyword_fkindex2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_contentkeyword_fkindex2 ON public.tbl_contentkeyword USING btree (fld_keyw_id);


--
-- Name: tbl_invoice_fkindex1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_invoice_fkindex1 ON public.tbl_invoice USING btree (fld_user_id1);


--
-- Name: tbl_invoice_fkindex2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_invoice_fkindex2 ON public.tbl_invoice USING btree (fld_cont_id);


--
-- Name: tbl_invoice_fkindex3; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_invoice_fkindex3 ON public.tbl_invoice USING btree (fld_purp_id);


--
-- Name: tbl_invoice_fkindex4; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_invoice_fkindex4 ON public.tbl_invoice USING btree (fld_sinv_id);


--
-- Name: tbl_invoice_fkindex5; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_invoice_fkindex5 ON public.tbl_invoice USING btree (fld_user_id2);


--
-- Name: tbl_keyword_fkindex1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_keyword_fkindex1 ON public.tbl_keyword USING btree (fld_cate_id);


--
-- Name: tbl_views_fkindex1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX tbl_views_fkindex1 ON public.tbl_views USING btree (fld_cont_id);


--
-- Name: tbl_attachment tbl_attachment_fld_cont_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_attachment
    ADD CONSTRAINT tbl_attachment_fld_cont_id_fkey FOREIGN KEY (fld_cont_id) REFERENCES public.tbl_content(fld_cont_id);


--
-- Name: tbl_content tbl_content_fld_accc_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_content
    ADD CONSTRAINT tbl_content_fld_accc_id_fkey FOREIGN KEY (fld_accc_id) REFERENCES public.tbl_accesscontraint(fld_accc_id);


--
-- Name: tbl_content tbl_content_fld_scon_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_content
    ADD CONSTRAINT tbl_content_fld_scon_id_fkey FOREIGN KEY (fld_scon_id) REFERENCES public.tbl_statuscontent(fld_scon_id);


--
-- Name: tbl_content tbl_content_fld_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_content
    ADD CONSTRAINT tbl_content_fld_user_id_fkey FOREIGN KEY (fld_user_id) REFERENCES public.tbl_user(fld_user_id);


--
-- Name: tbl_contentkeyword tbl_contentkeyword_fld_cont_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_contentkeyword
    ADD CONSTRAINT tbl_contentkeyword_fld_cont_id_fkey FOREIGN KEY (fld_cont_id) REFERENCES public.tbl_content(fld_cont_id);


--
-- Name: tbl_contentkeyword tbl_contentkeyword_fld_keyw_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_contentkeyword
    ADD CONSTRAINT tbl_contentkeyword_fld_keyw_id_fkey FOREIGN KEY (fld_keyw_id) REFERENCES public.tbl_keyword(fld_keyw_id);


--
-- Name: tbl_invoice tbl_invoice_fld_cont_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice
    ADD CONSTRAINT tbl_invoice_fld_cont_id_fkey FOREIGN KEY (fld_cont_id) REFERENCES public.tbl_content(fld_cont_id);


--
-- Name: tbl_invoice tbl_invoice_fld_purp_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice
    ADD CONSTRAINT tbl_invoice_fld_purp_id_fkey FOREIGN KEY (fld_purp_id) REFERENCES public.tbl_purpose(fld_purp_id);


--
-- Name: tbl_invoice tbl_invoice_fld_sinv_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice
    ADD CONSTRAINT tbl_invoice_fld_sinv_id_fkey FOREIGN KEY (fld_sinv_id) REFERENCES public.tbl_statusinvoice(fld_sinv_id);


--
-- Name: tbl_invoice tbl_invoice_fld_user_id1_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice
    ADD CONSTRAINT tbl_invoice_fld_user_id1_fkey FOREIGN KEY (fld_user_id1) REFERENCES public.tbl_user(fld_user_id);


--
-- Name: tbl_invoice tbl_invoice_fld_user_id2_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_invoice
    ADD CONSTRAINT tbl_invoice_fld_user_id2_fkey FOREIGN KEY (fld_user_id2) REFERENCES public.tbl_user(fld_user_id);


--
-- Name: tbl_keyword tbl_keyword_fld_cate_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_keyword
    ADD CONSTRAINT tbl_keyword_fld_cate_id_fkey FOREIGN KEY (fld_cate_id) REFERENCES public.tbl_category(fld_cate_id);


--
-- Name: tbl_views tbl_views_fld_cont_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_views
    ADD CONSTRAINT tbl_views_fld_cont_id_fkey FOREIGN KEY (fld_cont_id) REFERENCES public.tbl_content(fld_cont_id);


--
-- PostgreSQL database dump complete
--

