## Movie Catalog Demo Web App built using the [SlimPHP 3 Skeleton MVC App](https://github.com/rotexsoft/slim3-skeleton-mvc-app) 

This repository contains the end result of the 
[Real World Usage: Creating a Movie Catalog application](https://github.com/rotexsoft/slim3-skeleton-mvc-app/blob/master/documentation/MOVIE_CATALOG_APP_WALK_THROUGH.md) 
tutorial for the [SlimPHP 3 Skeleton MVC App](https://github.com/rotexsoft/slim3-skeleton-mvc-app) framework. 

To install this app, change directory into the directory this app was cloned into and run `composer install`

Use `./movie-catalog-db-schema.sql` to create the database tables needed for the application to run. Mysql 5.X is assumed.

Copy `./config/app-settings-dist.php` into `./config/app-settings.php`

Copy `./config/env-dist.php` into `./config/env.php`

Edit `./config/app-settings.php` by assigning the right values to `db_dsn`, `db_uname` and `db_passwd`

Edit `./config/ini-settings.php` by assigning a valid path value to `session.save_path`

Now start the application using the built-in PHP server by running the command below:
    
`php -S 0.0.0.0:8888 -t public`

You can then go on to browse to http://localhost:8888 (the application's default home-page)

To initialize the `admin` user browse to `http://localhost:8888/init-users/{password}`

* Replace `{password}` with the actual password you would like to assign to the `admin` user

At this point you can now click on the `Home` link and then click on the **Log in** button (at the top right) to login to the application with the **User Name** **`admin`** and whatever password you replaced `{password}` with above