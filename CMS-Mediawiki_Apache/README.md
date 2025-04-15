# PHP Web Server and Mediawiki Setup

A simple, modern and most current method to set up [Apache](https://httpd.apache.org/) PHP Web Server and run [MediaWiki](https://www.mediawiki.org/).

## Install Web Server and PHP
Install Apache Web Server, PHP and some modules needed by MediaWiki:  
`sudo apt install apache2 libapache2-mod-php php php-apcu php-igbinary php-mysql php-mbstring php-xml php-intl php-gd`
<details>
   <summary>Package Explaination</summary>

   `apache2`, `libapache2-mod-php` = Apache Webserver and the module to support PHP language.  
   `php` = PHP language  
   `php-apcu php-mysql php-mbstring php-xml php-intl php-gd` = PHP Modules without Mediawiki wouldn work.
</details>

Enable the core module for SSL (https):  
`a2enmod ssl`

Create a Apache Virtual Host for MediaWiki:
```
[/etc/apache2/sites-available/mediawiki.conf]

<VirtualHost *:443>
   DocumentRoot /var/www/mediawiki
   SSLEngine on
   SSLCertificateFile /etc/ssl/certs/ssl-cert-snakeoil.pem
   SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key
   <FilesMatch "\.(?:cgi|shtml|phtml|php)$">
		SSLOptions +StdEnvVars
	</FilesMatch>
	<Directory /usr/lib/cgi-bin>
		SSLOptions +StdEnvVars
	</Directory>
</VirtualHost>
```
Disable the default Virtual Host:  
`a2dissite 000-default`  

Enable the new Virtual Host:  
`a2ensite mediawiki`

*[(Read more about the Apache Config system below.)](#apache-config-system)*

## Database
Install MySQL:  
`sudo apt install mysql-server`

Get into mysql:  
`mysql`

Create a Database (mediawiki) and User (mediawiki):
```sql
CREATE DATABASE mediawiki;
CREATE USER 'mediawiki'@'localhost' IDENTIFIED BY RANDOM PASSWORD;
GRANT ALL PRIVILEGES ON mediawiki.* TO 'mediawiki'@'localhost' WITH GRANT OPTION;
```

## Get Mediawiki

1. Find the actual [direct download](https://www.mediawiki.org/wiki/Download#Download_via_command_line) link.

2. Download the archive, extract and delete the archive file:  
```shell
# Go to the Apache default site location
cd /var/www
# Download the archive
wget https://releases.wikimedia.org/mediawiki/1.43/mediawiki-1.43.0.tar.gz
# Create a directory
mkdir mediawiki
# Extract the archive in the new directory
tar -xzf mediawiki-*.tar.gz --strip-components 1 --directory mediawiki
# Delete the extracted archive
rm mediawiki-*.tar.gz
```
## Fix directory permission

`chown -R www-data:www-data images`

## Install Mediawiki

1. Restart the Apache Web Server:  
`systemctl restart apache2`

2. If everything is set correctly you should reach your Webseite:  
`https://localhost/` *(or with your Domain / Server IP)*

3. Fellow the GUI Installer

4. Copy the downloaded "LocalSettings.php" into "/var/www/mediawiki"

## Multiple MediaWiki's

If you want to make a Multilingual Wiki for example, every language will theoretical run a own MediaWiki Site and linked together by "Interwiki Links" exactly how [wikipedia](https://www.wikipedia.org/) host multiple wikis.

But we could do this without running multiple Web Server, Mediawiki Directorys and we even can share some Database tables so User accounts are shared. There are <ins>2 common ways</ins> and in both cases we only need to change the `LocalSettings.php` for Mediawiki.

### 1. Same Mediawiki Directory but multiple Domains or Sub-Domains

Imagine your Apache Web Server DocumentRoot is reachable with different Domains or Subdomains  
`example.com`, `de.example.com`, `fr.example.com` 

we could detect this by adding these lines in your `LocalSettings.php`:

```php
$wikis = [
   'example.com' => 'en',
   'de.example.com' => 'de',
   'fr.example.com' => 'fr',
];
if ( defined( 'MW_DB' ) ) {
   $wikiID = MW_DB;
} else {
   $wikiID = $_SERVER['MW_DB'] ?? $wikis[ $_SERVER['SERVER_NAME'] ?? '' ] ?? null;
   if ( !$wikiID ) {
      $wikiID = 'en';
   }
}
```
Now we have a Variable `$wikiID` with the value `de` if we reached the site through `de.example.com`.
<details>
   <summary>More Code Explaination</summary>

   This code will also cover the cases when MediaWiki is run by a maintenance scripts (`MW_DB`).
   But normaly it will get the server name (your domain) the site was reached from with `$_SERVER['SERVER_NAME']`, looks if you defined the possibility in `$wikis` and stores the variable in `$wikiID`. Otherwise it will simple use the default `$wikiID = "en";`.
</details>

### 2. Multiple Mediawiki Directory paths but one Domain

Imagine we have 3 directorys under the DocumentRoot  
`example.com/en`, `example.com/de`, `example.com/fr`

Either faked with some Apache Web Server magic or simple by creating symbolig links of the directorys:
```
ln -s /var/www/mediawiki/en /var/www/mediawiki/de
ln -s /var/www/mediawiki/en /var/www/mediawiki/fr
```
we could detect this by adding these lines in your `LocalSettings.php`:
```php
$wikis = [
    'en' => 'en',
    'de' => 'de',
    'fr' => 'fr',
];
if ( defined( 'MW_DB' ) ) {
    $wikiID = MW_DB;
} else {
    $wikiID = $_SERVER['MW_DB'] ?? $wikis[ explode( '/', $_SERVER['REQUEST_URI'] ?? '', 3)[1] ?? '' ] ?? null;
	if ( !$wikiID ) {
        $wikiID = 'en';
    }
}
```
Now we have a Variable `$wikiID` with the value `de` if we reached the site through `example.com/de`.
<details>
   <summary>More Code Explaination</summary>

   This code will also cover the cases when MediaWiki is run by a maintenance scripts (`MW_DB`).
   But normaly it will get the path (URI) the site was reached from with `$_SERVER['REQUEST_URI']`, looks if you defined the possibility in `$wikis` and stores the variable in `$wikiID`. Otherwise it will simple use the default `$wikiID = "en";`.
</details>

### Variable Configs and shared Database Tables

Now we can use the `$wikiID` to dynamical change some settings below.
```php
$wgLanguageCode = '{$wikiID}';
$wgDBprefix = '{$wikiID}_';
$wgServer = 'https://{$wikiID}.localhost'; # If you use Multiple Sub-Domains.
$wgScriptPath = '/{$wikiID}'; # If you use Multiple Mediawiki Directorys.
```
In this case we used one databases with different databases prefixes `en_`, `de_`, `fr_`.
But its also possiple for different Databases by changing `$wgDBname` instead of `$wgDBprefix`.

And we even could share possible Databases with a selected main Wiki.
```php
$wgSharedDB = 'mediawiki';
$wgSharedPrefix = 'en_';
$wgSharedTables = [
	'actor',
	'block',
	'block_target',
	'bot_passwords',
	'interwiki',
	'module_deps',
	'user',
	'user_autocreate_serial',
	'user_former_groups',
	'user_groups',
	'user_newtalk',
	'user_properties',
	'site_stats',
];
```

### Creating the Database entrys for your Wikis

Unfortunately there is no solution to only create Database entrys of a wiki.

We need to rename the `LocalSettings.php` to start a new Mediawiki install for every Wiki we need.

But we could [Install Mediawiki via Command Line.](#install-mediawiki-via-command-line) and [delete shared Databases](#delete-shared-databases).


## More side informations

### Apache Config System
Ubuntu has its own static configuration system for apache. `a2enmod` or `a2ensite` does nothing more than creating a symbolic from available into enabled.
```
/etc/apache2
├── /conf-available
│   └── config1.conf
├── /conf-enabled
│   └── config1.conf (symbolic link)
├── /mods-available
│   └── mod1
├── /mods-enabled
│   └── mod1 (symbolic link)
├── /sites-available
│   └── site1.conf
├── /sites-enabled
│   └── site1.conf (symbolic link)
└── apache2.conf
```

### Install Mediawiki via Command Line
Instead running the Browser Install its also possible to do it via Command Line:
```console
php /var/www/mediawiki/en/maintenance/run.php install \
--dbname='mediawiki' \
--dbprefix 'en_' \
--dbserver='localhost' \
--installdbuser='mediawiki' \
--installdbpass='DATABASE PASSWORD' \
--dbuser='mediawiki' \
--dbpass='DATABASE PASSWORD' \
--server='https://localhost/' \
--scriptpath='/en' \
--lang='en' \
--pass='ADMIN PASSWORD' "Wiki Name" "Admin"
```

### Delete shared Databases
It simple means all your Wikis use the same database tables you set in `$wgSharedTables`.
Its even possible to clear the tables in mysql to remove the admin account you need to set up in every wiki:
```console
mysql

USE mediawiki;
TRUNCATE de_actor;
TRUNCATE de_block;
TRUNCATE de_block_target;
TRUNCATE de_bot_passwords;
TRUNCATE de_interwiki;
TRUNCATE de_module_deps;
TRUNCATE de_user;
TRUNCATE de_user_autocreate_serial;
TRUNCATE de_user_former_groups;
TRUNCATE de_user_groups;
TRUNCATE de_user_newtalk;
TRUNCATE de_user_properties;
TRUNCATE de_site_stats;
```
