<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project description

Simple booking api with 3 endpoints:
```text
GET /api/locations
GET /api/reservations
POST /api/reservations
```
Application allows you to make a reservation with given data if they satisfy business requirements:
1. Must be from future
1. Location must exists and be active
1. Location needs free vacancies in given period


## Project installation

### Applicaiton
Project is using **Laravel Sail** - install it before -> https://laravel.com/docs/11.x/sail#installation
1. To configure whole project: `sail build --no-cache` & `sail up -d` 
1. To configure database with example data: `sail artisan migrate:fresh & sail artisan db:seed`

### API
Postman collection is located in `/docs` folder

### Testing
To run tests simply call `sail bin phpunit`

## FAQ

* Why application looks as complicated?
> I'm constantly learning new things. Since this api could be overengineered I've tried to use as many new thing as I can

* What you use there?
> I've tried to implement Domain Driven Development (DDD). It's not ideal, but practice makes perfect :)  
> Repository pattern (with dividing it to two different channels - read and write).  
> CQRS - commands for changing system and query for read the data.
> Strategy pattern - for deciding if reservation can be made
> Policies (all *allowed*) to decide if action can be performed

* Commits and branches looks messy, right?
> Right! I've focused on work here. Not all commits messages are meaningful, sorry!  
> Ideally it should have feature/ branches for new things, bugfix/ for fixes and release/ for packages  
> After created some working things I could also tag repository to have versioning

* Why you wrote as little tests?
> It's only to show how to use tests, not to cover whole project

* Did you use any helpers from Internet?
> Yes! My sources are listed below.

## External Sources

* AI (ChatGPT) - for simple functions information after providing description what to achieve
* DDD approach -> https://github.com/Orphail/laravel-ddd/tree/master (mainly for structure)
