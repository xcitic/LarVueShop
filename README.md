<p align="center">
  VueShop
</p>

<p align="center">
  <a href="https://github.com/laravel/laravel">
    <img src="https://img.shields.io/badge/Laravel-5.8-brightgreen.svg" alt="laravel">
  </a>
  <a href="https://github.com/vuejs/vue">
    <img src="https://img.shields.io/badge/vue-2.6.10-brightgreen.svg" alt="vue">
  </a>
  <a href="https://github.com/ElemeFE/element">
    <img src="https://img.shields.io/badge/element--ui-2.7.0-brightgreen.svg" alt="element-ui">
  </a>
  <a href="https://github.com/xcitic/LarVueShop/blob/master/LICENSE">
    <img src="https://img.shields.io/github/license/mashape/apistatus.svg" alt="license">
  </a>
</p>

## Introduction

[VueShop](https://github.com/xcitic/LarVueShop) is a complete webshop with authentication, dashboard, admin site and all the goodies of VueJS (vuex, vue-router etc.). </br>
Uses [Laravel](https://laravel.com) as backend and [VueJS](https://github.com/vuejs/vue) as frontend.
Authorization is handled by Passport with JWT token.

Don't wast too much time setting up the initial stack.
With VueShop you get a good setup to keep building out new functionality.

- [Preview](https://xcitic.github.io/LarVueShop)

- [Documentation] Coming soon.

## Preparation

Local Project requirements are: Having installed [composer](https://getcomposer.org) [node](https://nodejs.org/), [git](https://git-scm.com/).

Docker build is coming soon, which requires only [docker-compose](https://docs.docker.com/compose/install/)


## Features

```
# Application Features
- Laravel backend for DB, API and ORM
- VueJS Single Page Application Setup
- VueRouter for clientside routing
- Vuex for statemanagement
- Vuetify for UI library
- ElementUI for Dashboard library

# Views
- Landing
- Login
- Register
- Products
- Dashboard


- Authentication
  - Laravel Passport to handle JWT token issuing and checking.
  - API Middleware to intercept and check JWT token.
  - Clientside Router authentication check on routes that require authentication.

- Build system
  - Webpack with versioning.
    - Browsersyn in the webpack pipe to auto refresh browser on code changes.

```

## Setting up the project

```bash
# clone the project
git clone https://github.com/xcitic/LarVueShop.git

# enter the project directory
cd LarVueShop

# install backend dependencies
composer install

# install frontend dependencies
npm install

# Setting up environment variables
cp .env-example .env

# Setup a sqlite database (temporary, coming a better database setup soon)
touch database/database.sqlite

# Make salt key for laravel
php artisan key:generate

# Migrate database
php artisan migrate

# Generate key-pair for Passport
php artisan passport:install

# Start backend services listning on port 8000
php artisan serve --port 8000

# Start frontend services
npm run watch

### PROJECT IS RUNNING AT http://localhost:8000

```


## License

[MIT](https://github.com/xcitic/LarVueShop/blob/master/LICENSE)

Copyright (c) 2019 [Sami T. Lazreg](https://samilazreg.com)
