# Snippets
---------------
Snippets is small project to save or share your small code, snippets and instructions
### Requirment
1- PHP 5.4 or greater (It works best with PHP 7)
2- web server (apache2 or nginx)
3- mariadb
### Installation
1- repository cloning
```
git clone https://github.com/vahidvalian/snippets.git
#or
git clone git@github.com:vahidvalian/snippets.git
```
2- install php library dependency
```
composer update
```
4- create mariadb database and config db file
```
mv config/db.php.sample config/db.php
vi config/db.php
#set your database configuration in this file
```
5- execute database migration files
```
php yii migrate
```
6- submit issues

