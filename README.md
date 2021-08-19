## Project configuration

The following instructions are how to set up the project on Ubuntu. The setup assumes that the following software is already installed:

* Docker
* GIT
* Composer
* PhpStorm

#### The project was created by using the following steps:

* Executed the following commands:

```sh
composer create-project --prefer-dist laravel/laravel:^7.0 WaterdropTask
cd WaterdropTask
git init
git remote add origin git@github.com:NKozhuharov/WaterdropTask.git
```

* After adding the Docker image and `.yml` file to the project:

```sh
cd docker/images
docker build --tag waterdrop/php-apache:latest .
```

#### To deploy the project locally (on Ubuntu)

* Navigate to desired folder and execute

  ```sh
  git clone https://github.com/NKozhuharov/WaterdropTask.git
  cd WaterdropTask/docker/images
  docker build --tag waterdrop/php-apache:latest .
  ```

* Add `127.0.0.1       local.waterdrop.com` to **etc/hosts**

* Open PhpStorm, create a project from the existing files

* Run the run configuration **Waterdrop**.  Enter inside the container with the run configuration **Container console**.

* Create `.env` file, copying the contents of `.env.example`

* From inside the container, execute:

  ```sh
  cd /var/www/waterdrop
  composer install
  php artisan key:generate
  php artisan migrate:fresh
  php artisan db:seed
  ```

* In order to make the inserting of **Dogs** asynchronous, a Laravel Queue is used, run the following command inside the container to enable it:

  ```sh
  php artisan queue:work --queue=dogs
  ```

## Postman Collection

A list of the sample requests is available here - https://documenter.getpostman.com/view/8850308/TzzANGwa

## Assumptions

#### Dog object structure

There is no explanation how exactly a **Dog** object should look like. I've taken the liberty to make up a simple object:

```json
{
    "name": "My awesome Dog", //The name of the dog
    "weight": 5, //The weight of the dog
    "age": 3 //The age of the dog
}
```

I've also created a database table, `dogs` to store the objects, with columns matching the object structure. To add some dogs to the database, I've created a **Laravel Seeder**. It uses `Faker` library to generate random dog names :)

#### Laravel Queue usage

The task is to create an asynchronous request, after some digging, I've found out that this could be done by using **Laravel Queue** - https://laravel.com/docs/7.x/queues. My setup is using the `database` driver. I'm sending all **POST** requests to the queue `dogs` and the background process is handling them.

## Additional Information

#### Docker image and container

I've used my standard Docker image for PHP 7.4 along with my standard `.yml` file. The setup has two containers, one with the web server and one with the database. I've also included two of my standard shell scripts and crated PhpStorm Run Configurations from them:

* `container-console` - allows executing commands inside the web server container
* `stop-containers` - stops all running Docker containers. Allows to easily switch between projects

#### Dingo API

In all projects, where I've participated, which are using Laravel to implement an API, I've used the Dingo API add-on, so I've decided to use it again. https://github.com/dingo/api

#### NetworkController

In my previous assignments, I came up with the idea to create a generic package for Laravel, which helps to create API resources easily. It introduces several cool features, like a standard controller, which I've called `NetworkController`, few validations, standard authentication and seeder improvements. The usage here is little, only the `BaseSeeder` is used, but I've decided it's a great opportunity to show it to you. The package is public - https://github.com/NKozhuharov/NetworkController. 
