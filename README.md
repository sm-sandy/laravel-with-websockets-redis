<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Laravel Sanctum WebSocket Server with Redis

This repository contains a Laravel application that utilizes Sanctum authentication for API endpoints, integrates a WebSocket server using Laravel WebSockets, and leverages Redis as both a queue driver and caching mechanism.

## Prerequisites

Ensure the following prerequisites are met before setting up the project:

-   PHP 8.1 and upper
-   Composer installed
-   Redis server set up and accessible (https://redis.io/docs/install/install-redis)

## Installation

1. Clone the repository: `git clone https://github.com/sm-sandy/laravel-with-websockets-redis.git`
2. Install dependencies: `composer install`
3. Set up .env file: ` cp .env.example .env`

4. Set up the database with data: `php artisan migrate --seed` (it will take some time for seeding 20k user data)
5. Run the development server: `php artisan serve`
6. Run the websockets server: `php artisan websockets:serve`
7. Run the websockets server: `php artisan queue:work`

8. Run the redis server (On your OS): `sudo service redis-server start`

## Usage

## Development Server

    Visit `http://localhost:8000` to access the Laravel development server.

    Access the WebSocket Dashboard at `http://localhost:8000/websockets-dashboard` and connect to the WebSocket server.

## User Authentication

    Log in with Postman using the following endpoint: `http://localhost:8000/api/login`

    Use the default credentials:

    Email: `sandy@gmail.com`
    Password: `12345678`
    OR

    Choose any email from the database and use the password `12345678`.

    If the credentials are valid, the API will return an authentication token.

## Retrieve User Data

    With the obtained token, make a GET request to `http://localhost:8000/api/users`.

    The response will include a dataset of 20,000 user records with caching applied.

## WebSocket Server

    The WebSocket server will broadcast the dataset to connected clients in real-time.
    By following these steps, you can explore the Laravel development server, authenticate users, retrieve user data, and experience real-time updates through the WebSocket server.
