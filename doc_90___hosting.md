---
layout: default
title: Deployment / Hosting
has_children: false
nav_order: 90
---
# Hosting
{: .no_toc }
Since, at the moment, Heroku does not support HTTP/2 which is required for gRPC to work, we had to chose a different hosting provider. We decided to install our own web server as this gives us maximum control over the components we want to install. We chose [**LunaNode**](https://www.lunanode.com/) as a VPS provider who serves various virtual machines with snapshot functionality.

We installed a **Ubuntu 18.04 64-bit** virtual machine with **apache2** web server and **PHP 7.2.24**. We use **PostgreSQL 10.10** as database and **phpPgAdmin 5.6** to administer the database.

The domain `lightread.ch` is registered and managed at Hoststar. We used Let's Encrypt and their `certbot` tool to request a certificate.  


## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---




## Automatic deployment
To see and test the current state of our development on the web server we set-up an automatic deployment via `crontab`.  

```
root@lightread:~# crontab -e
```

Between 7 am and 11 pm every 5 minutes the latest commit from the master branch on Github will be pulled with the following command .

```
# For more information see the manual pages of crontab(5) and cron(8)
#
# m h  dom mon dow   command

*/5 7-23 * * * cd /var/www/lightread/ && git checkout master  && git pull
```

## Apache virtual host
We run a virtual host who serves the website from the folder `/var/www/lightread/src/`.
```
<IfModule mod_ssl.c>
<VirtualHost *:443>
    ServerName 51.255.211.144:80
    DocumentRoot /var/www/lightread/src/
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

Include /etc/letsencrypt/options-ssl-apache.conf
ServerAlias lightread.ch
ServerAlias www.lightread.ch
SSLCertificateFile /etc/letsencrypt/live/www.lightread.ch/fullchain.pem
SSLCertificateKeyFile /etc/letsencrypt/live/www.lightread.ch/privkey.pem
</VirtualHost>
</IfModule>
```
## Environment variables
During development we worked with a configuration file `/src/config/config.env` that provided us with the following key-value-pairs:
```
database.dsn="pgsql:host=127.0.0.1;port=5432;dbname=name_of_db"
database.user=username
database.password=xyz

api.key='xxx-yyy-zzz'
price.tolerance=15

email.sendgrid-apikey=XX.abc.def-ghi
```
This file was never shared with the public Github repository and during deployment we switched to environment variables stored in `/etc/apache2/envvars`. The following code shows how the variable are being read and provided in the `Config.php` class.

```
private static function loadENV(){
    if (isset($_ENV["DATABASE_URL"])) {
        $dbopts = parse_url($_ENV["DATABASE_URL"]);
        self::$config["database.dsn"] = "pgsql" . ":host=" . $dbopts["host"] . ";port=" . $dbopts["port"] . "; dbname=" . ltrim($dbopts["path"], '/') ;
        self::$config["database.user"] = $dbopts["user"];
        self::$config["database.password"] = $dbopts["pass"];
        self::$config["database.host"] = $dbopts["host"];
        self::$config["database.port"] = $dbopts["port"];
        self::$config["database.name"] = ltrim($dbopts["path"], '/');
    }
    if (isset($_ENV["CMC_APIKEY"])) {
        self::$config["api.key"] = $_ENV["CMC_APIKEY"] ;
    }
    if (isset($_ENV["PRICETOLERANCE"])) {
        self::$config["price.tolerance"] = $_ENV["PRICETOLERANCE"] ;
    }
    if (isset($_ENV["SENDGRID_APIKEY"])) {
        self::$config["email.sendgrid-apikey"] = $_ENV["SENDGRID_APIKEY"];
    }
}
```
The following lines are added to `envvars` file:
```
export DATABASE_URL=postgres://username:xyz@localhost:5432/name_of_db
export CMC_APIKEY=xxx-yyy-zzz
export PRICETOLERANCE=15
export SENDGRID_APIKEY=XX.abc.def-ghi
```
