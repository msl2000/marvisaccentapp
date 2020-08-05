# Marvis AccentGroup Tech Test (BACKEND LARAVEL)


The application has a frontend and backend instance running and is built with the following frameworks

  - NuxtJS (VueJS Framework) - Front End
  - Laravel - Backend

# About the task!

Create a web application containing 2 pages. A dashboard page displaying sales in a chart with days total with a date range element where the values default to sales last month.

My approach to this task is to separate the frontend layer into it's own instance for better project management and providing a Single Page Application (SPA) solution for the project. We will be leveraging a RESTful approach by requesting and consuming all out data layer from the backend repositories.

### Tech

The backend application uses a number of open source projects to work properly:

* [Laravel] - Laravel is a free, open-source PHP web framework that provides an MVC approach to building applications. Laravel is a complete web solution for building RESTful APIs provide resource and route management with ease.
* [MySQL] - An open-source relational database management system.

### Installation of the Backend

For installation on a test invironment running an Linux/Windows or Mac machine, please refer to the following build setup

## Build Setup

```bash
# Install vendor dependencies
$ composer install

# Migrate database migration
$ php artisan migrate

# You are now free to start your Laravel application, recommended to use Valet if using a UNIX system for ease of implmentation. (https://laravel.com/docs/7.x/valet)

If using Windows, please use Homestead (https://laravel.com/docs/7.x/homestead)

```

For production environments, in this case Heroku, please use the following build set up

## Build Setup

```bash
# on the project, we need to create a Profile to point the document root to the /public folder as Laravel's document root is the public/ subdirectory. 

$ echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile

# The application’s encryption key is used by Laravel to encrypt user sessions and other information. Its value will be read from the APP_KEY environment variable. You can simply set environment variables using the heroku config command, so run a heroku config:set as the last step before deploying your app for the first time:

$ heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show).

# Heroku uses a Procfile (name the file Procfile with no file extension) that specifies the commands that are executed by the apps dynos. To start the Procfile will be very simple, and needs to contain the following line:

#Finally, we can push the app on Heroku with:

$git push heroku master

#To deploy a non-master branch to Heroku use:

$git push heroku develop:master

# Now we need to map the application to run a MySQL Instance. To do this, ensure ClearDB is installed as an add-on on the Heroku application. We can configure the Environment Files through the dashboard with the correct DB host and authentication information

# For more information, please find 
https://mattstauffer.com/blog/laravel-on-heroku-using-a-mysql-database/

#where develop is the name of your branch.
```