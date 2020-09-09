# Car Share Web Application

This assignment is for COSC2408(Programming Project 1) Our team was requested to build an online car share system that shows the locations of cars and parking spaces for users to rent and return. In this car share web application, users and the manager are the main two types of users. User can book cars and returns cars. Manager can add cars, remove cars and track every cars’ location.



## Table of contents
* [Group Infor](#group-infor)
* [Technologies](#technologies)
* [Launch](#launch)
* [Set up](#set-up)
* [Directory structure](#directory-structure)
* [Contribution](#contribution)


## Group Infor
__Team members__    


| Name         | Student Number |
| :----------- | -------------- |
| Xinghao Li   |    s3666770    |
| Ziqi Huang   |    s3644269    |   
| Jia Hui Liou |    s3687233    |
| Jinglai Li   |    s3626967    |

## Technologies
Project is created with:

* HTML
* PHP 
* Javascript


## Launch
This project will run on Laravel Homestead virtual machine. 

Required minimum hardware requirements:
* PHP >= 7.2.5
* BCMath PHP Extension
* Ctype PHP Extension
* Fileinfo PHP extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension


## Set up

To run this project, install Lavarel installer locally using Composer:

```
composer global require laravel/instaler
```
```
Composer update
```
```
php artisan serve
```


## Contribution  
| Name         | Contribution |
| :----------- | ------------ |
| Xinghao Li   |      25%     |
| Ziqi Huang   |      25%     |   
| Jia Hui Liou |      25%     |
| Jinglai Li   |      25%     |



## Directory structure
├── Readme.md                                          
├── config                      
│   ├── credentials.json  
│   ├── MasterIP.json      
│   ├── token.json      
├── app   
│   ├── Console
│   ├── Exceptions 
│   ├── Http   
│   ├── Providers
│   ├── Car.php          
│   ├── User.php 
├── bootstrap 
│   ├── cache
│   ├── app.php                                               
├── database                      
│   ├── factories
│   ├── migrations    
│   ├── seeds   
│   ├── .gitignore
├── public 
│   ├── css
│   ├── js
│   ├── libs/FarhanWazir/GMap  
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   ├── robots.txt
│   ├── web.config
├── resources
│   ├── js
│   ├── lang/en
│   ├── sass
│   ├── views
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   ├── web.php                                          
├── storage                     
│   ├── app
│   ├── framework
│   ├── logs
├── tests
│   ├── Feature
│   ├── Unit
│   ├── CreatesApplication.php
│   ├── TestCase.php
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── .styleci.yml
├── artisan
├── composer.json
├── composer.lock
├── package-lock.json
├── package.json
├── phpunit.xml
├── server.php
├── webpack.mix.js
















