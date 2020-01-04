---
layout: default
title: Deployment / Hosting
has_children: true
nav_order: 90
---
# Hosting
We chose to host our web application on [**LunaNode**](https://www.lunanode.com/). This is a VPS provider who serves various virtual machines with snapshot functionality.

We are running a **Ubuntu 18.04 64-bit** virtual machine with **apache2** web server and **PHP 7.2.24**. We use **PostgreSQL 10.10** as database and **phpPgAdmin 5.6** to administer the database.

The domain `lightread.ch` is registered and managed at Hoststar. We used Let's Encrypt and their `certbot` tool to request a certificate.  

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
