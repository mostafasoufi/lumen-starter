# Lumen Starer
Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

# Features
* Simple classes for starting with Lumen
* User authentication base on JWT
* User Account and User Profile controllers
* Two Mailable class
* A Resource class to get profile response
* Support a Helper class
* Test cases class for all endpoints
* English language files
* Packages
  * [Lumen Generator](https://github.com/flipboxstudio/lumen-generator)
  * [Guzzle, PHP HTTP client](https://github.com/guzzle/guzzle)
  * [Illuminate Mail component](https://github.com/illuminate/mail)
  * [JWT Auth](https://github.com/tymondesigns/jwt-auth)

# Requirements
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* [Composer](https://getcomposer.org/) dependency manager

# Installation
To install the Lumen Starter you should take a clone from the repository in your local with below command:
```
git clone https://github.com/mostafasoufi/lumen-starter.git
```

Then go to project with `cd`
```
cd lumen-starter
```

Then try to install all packages with the composer:
```
composer install
```

### Configuration
All of the configuration options for the Lumen framework are stored in the .env file. take a copy from `.env.example` to `.env`.
```
cp .env.example .env
```
You should also configure your local environment in this file.

### Generate secret key
This will update your `.env` file with something like `JWT_SECRET=foobar`
```
php artisan jwt:secret
```

### Serving Your Application
To serve your project locally, you can use the built-in PHP development server:
```
php -S localhost:8000 -t public
```

# Unit Test
```
vendor\bin\phpunit
```