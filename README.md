# FreeAds
Create a free-publishing ads website usign :

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Our Project

## Missions

• Create a model, a CRUD, some controller(s) and view(s) for users’ profiles.  
• Create a model, a CRUD, some controller(s) and view(s) for ads’ system.  
• Create an authentication system to sign-up and login to your website.  
• Implement some basic features, such as a search bar or some filters to browse content.  

## Requirements

• The User model must have at least: login, password, email, phone number, nickname.  
• A confirmation mail must be sent to newly registered users.  
• The Ads model must have at least: title, category, description, picture(s), price, location.  
• Some views will allow to display/add/edit one or more ads.  

## Bonus

• Create a model, a CRUD, some controller(s) and view(s) for categories’ system.  

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone git@github.com:ManonVioleau/CodingAcademy_LaravelProject_AdsWebSite.git

Switch to the repo folder

    cd CodingAcademy_LaravelProject_AdsWebSite

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:ManonVioleau/CodingAcademy_LaravelProject_AdsWebSite.git
    cd CodingAcademy_LaravelProject_AdsWebSite
    composer install
    cp .env.example .env
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the AdSeeder, CategorySeeder and DatabaseSeeder and set the property values as per your requirement

    database/seeders/AdSeeder.php
    database/seeders/CategorySeeder.php
    database/seeders/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
# Code overview

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `app/Http/Middleware` - Contains the auth middleware
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory the models concerned  
- `database/migrations` - Contains all the database migrations
- `database/seeders` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------
