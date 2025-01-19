# PHP Web Development Boilerplate

## About

This repo contains some starter code for new PHP projects.

What's included:

- Docker setup including:
  - PHP interpreter
  - NGINX server
  - MySQL (MariaDB) database
  - PHP MyAdmin
- A directory structure organized around the MVC pattern
- A locally included routing utility: [https://github.com/steampixel/simplePHPRouter](https://github.com/steampixel/simplePHPRouter)
- Bootstrap JS and CSS included in the header: [https://getbootstrap.com/](https://getbootstrap.com/)

## Usage

- Start local

In a terminal, from the cloned/forked/download project folder, run:

```bash
docker compose up
```

NGINX will now serve files in the app/public folder. Visit localhost in your browser to check.
PHPMyAdmin is accessible on localhost:8080

If you want to stop the containers, press Ctrl+C.

Or run:

```bash
docker compose down
```

## Important files and directories

_The directory that contains all relevant back end code is in the `app/public` directory. Files and directories listed below are relative to that folder._

- `index.php` - this it the starting point of the application. Any URL requested that is not a direct link (i.e. to a CSS file, image asset, etc.) is is handled by this file. This file handles setup and loading the application routes.
- `/routes` - this directory contains files which create route handlers.
- `/controllers` - controllers should contain the logic of your application. They are also responsible for getting data from potentially multiple models, performing logic and preparing data to be presented to the view layer.
- `models` - models handle database CRUD operations.
  - `models/BaseModel.php` - contains a base class for other models. Currently, the base class handles retrieving the database credentials fron env variables and creating a new PDO instance.
  - `models/UserModel.php` - example model with dummy data for retrieving all users and a single user. This class contains commented out code to demonstrate use of the base model's PDO instance.
- `view` - views handle the display layer of the application. They should not contain logic or direct database/model access.
  - `view/pages` - organizing your front end code is important. Keeping minimal page-level views in this directory is a good idea.
  - `view/partials` - you should break up your front end to small, modular pieces so they can be organized and reused. Keeping small reusable front end pieces in these files is a good idea.
- `dto` - PHP supports the use of classes. We want to follow object oriented principles and, as much as possible, have data move throughout our system in well defined structures. We can define shared class meant for only modelling data as DTO classes. It's a good idea to have our model methods always return dto objects.
- `assets` - the assets directory should contain all are static public assets including CSS and JS files, images and other media.
- `lib` - the lib directory contains reused modules and utility files.
  - `lib/env.php` - defines global environment variables accessible throughout the application.
  - `lib/error_reporting.php` - contains a small bit of startup code to enable error messages in the local environment.
  - `lib/Route.php` - includes a routing utility class.

## Good patterns

For most layers of the application, it is a good idea to have a single file per entity type. I.e., currently there is a `routes/user.php` to handle user routes. If you add routes for products, adding it to `routes/product.php` would be a good idea. Similarly, there is a single file and class for the user controller and user model. New entities should generally get their own route, controller and model files.
