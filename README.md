# A Movie Catalog Web App 

A Movie Catalog Web App built with the [SlimPHP 4 Skeleton MVC App Framework](https://github.com/rotexsoft/slim-skeleton-mvc-app)

The tutorial containing detailed steps explaining how this application was built can be found [here](https://github.com/rotexsoft/slim-skeleton-mvc-app/blob/master/documentation/MOVIE_CATALOG_APP_WALK_THROUGH.md) for those looking to learn how to build applications with the [SlimPHP 4 Skeleton MVC App Framework](https://github.com/rotexsoft/slim-skeleton-mvc-app).

## Installation Instructions

Clone the repository

```
git clone https://github.com/rotexsoft/movie-catalog-web-app.git
```

Change directory into the app's folder

```
cd movie-catalog-web-app/
```

Use **./movie-catalog-db-schema.sql** to create the needed db tables (Works with Mysql 5.7 & 8)

Install composer dependencies

```
composer install
```

Edit the `db_*` settings in **./config/app-settings.php** to point to the db you just created

Run the dev web-server

```
php -S 0.0.0.0:8888 -t public
```

Browse to http://localhost:8888/users to initiate the admin user

No browse to http://localhost:8888/movie-listings to start adding movies

Enjoy!

