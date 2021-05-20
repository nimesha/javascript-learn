# PHP Code Test 

## Requirements
- PHP 7.2 and above.
- MySQL 5.7
- Redis 

## Installation
To run this example, you will need to install `Docker`. Also you can run on your own stack.

##important
csv generation process
    1. Generate by HTTP request (depend on server execution time, data set size) - done
    2. Generate by offline jobs processing useing(Redis). - done
    3. Generate by using mysql Prepared Statements - Not implemented


### 1. Clone the project
```
git clone https://github.com/nimesha/php-app-test
```
Inside the project directory you will find the following file and folder structure.
- app
- public
- composer.json 
- composer.lock
- README.MD
- laradoc
- .env(env file - Because of test project)


### 2. Environment Setup (laradoc setup)

After cloning the repository

```
cd laradoc
```
Run

```
docker-compose up -d nginx mysql phpmyadmin redis workspace 
```

Make sure all the following docker containers running well.
- laradock_nginx prot :80
- laradock_php-fpm
- laradock_phpmyadmin
- laradock_workspace 
- laradock_mysql port :3306
- laradock_redi


### 3.Composer
However, using Composer is recommended as you can easily install dependancies. 
Run the following command and find laradock_workspace in containerid ex-531e32cc0638

```docker
docker ps
```

```docker
docker exec -it <laradock_workspace_id> /bin/bash
```

Now you can access workspace terminal
ex- name@xxxx:/var/www# 
Inside the terminal run composer install command

```php
composer install
```

### 4.Mysql
Using the following url you can have access to mysql server
phpmyadmin

http://localhost:8081/index.php
info | detail
------------ | -------------
server | mysql
user | root
password | server
Create mysql database 'sales' and import sample database
then update .env file inside the project directory

key | value
------------ | -------------
server | mysql
mysql_host | mysql
mysql_port | 3306
mysql_username | root
mysql_password | root
mysql_database | sales


## Usage
You can access the app [http://localhost/](http://localhost/) in your browser.


## Testing