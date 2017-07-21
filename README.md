# Trade Union
This is the TradeUnion project. An app to manage trade union and club members.

## Installation Process
### Clone Project and Install third-party packages
First clone the project's code-base locally.
```sh
$ git clone https://github.com/web-ted/trade-union.git
```

Then install the third-party dependencies including Laravel using composer dependency manager.
You need composer installed for this to work.
Learn how to install and use composer from [here.](https://getcomposer.org/)

```sh
$ cd trade-union
$ composer install
```

### Create the Database Schema
The database schema must be created manually and a user that will be able to manage this schema.
For e.g. in case the database server is MySQL you can create a schema like this:

```mysql
CREATE SCHEMA `trade-union`;
```
or 
```mysql
CREATE SCHEMA `schema-name-you-like`;
```

Open a MySQL client connect to the database server and issue the above command replacing the name of the schema you like.
I will use **trade-union** in this example, so replace this with your own.
If you don't have an IDE capable to connect to the database (like MySQL Workbench) you can use the cli client.
For e.g. issue this providing the password:
```sh
$ mysql -u root -h 127.0.0.1 -p
```

### Configure the Database Connection and Structure
You need to configure the app to connect to your database schema. Copy .env.example into .env file in the root
folder/dir of the project:

```sh
$ cp .env.example .env
```
and then edit the .env file with your favorite text editor or IDE.
The conf file is quite self explanatory, so change the mysql user credentials with your own.
 
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trade-union
DB_USERNAME=root
DB_PASSWORD=root
```

After configuring your project's connection to the database run the migrations to create the needed tables.
You need to be inside the project's root dir.

````sh
$ php artisan migrate
````

Migration will create the following tables for **trade-union** schema:

* enterprises
* migrations
* password_resets
* specialties
* users
* workers

If the mysql user cannot connect then the migrations will probably fail. So you need to fix the .env

### Seed Sample Data if you Need
In case you need to see a demo of the app you can seed random data using:
```sh
$ php artisan db:seed
```

### Reset Data and Seed again
In case you need to reset the data and seed them again with random data you need to refresh migrations and seed:
```sh
$ php artisan migrate:refresh --seed
```

### Deploy and run 
To run the app you need to deploy it to a php capable web server like apache or nginx.
The public folder needs to be exposed as a document root. You may find instruction in the Laravel Framework [site.](https://laravel.com/docs/5.4/installation#pretty-urls)

In case you need to run the app locally and only for development you can achieve this using:
```sh
$ php artisan serve
```

This by default will run the app exposing it in <http://localhost:8000>.
