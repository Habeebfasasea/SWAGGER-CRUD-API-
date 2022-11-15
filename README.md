# Laravel API with Swagger Open API Documentation
This is a full CRUD API with an Open API documentation. This is an API for document management.

Only registered users are allowed to perform CRUD operations such as uploading, editing, viewing and deleting documents.
Documents can be viewed, edited and deleted by the user that uploaded such ducument. 

A user does not have access to documents uploaded by other users.

# Quick Start
### Setup database
For MySQL, add

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rimsyscrud
DB_USERNAME=root
DB_PASSWORD=""
```
### Install Dependencies
```
composer install
```
### If there is an error about an app encription key
```
php artisan key:generate
```
### Run Migrations
```
php artisan migrate
```
## Populate Database with fake data
### run the command below in your git bash terminal
```
php artisan tinker
```
#### For the Users table type the command below(this will create 25 users):
```
User::factory()->times(25)->create();
```
##### The password for each dummy user is "password"

#### For the Documents table, type the command below(this will create 250 documents and randomly link them to the users in the users table):
```
Document::factory()->times(250)->create();
````
## Run the webserver on port 8000
```
php artisan serve
```
# Endpoints
### Swagger Documentation
/api/documentation

### Public
POST  /api/v1/register

POST  /api/v1/login

### Protected
GET /api/v1/documents

POST /api/v1/documents

GET /api/v1/documents/{id}

PATCH /api/v1/documents/{id}

DELETE /api/v1/documents/{id}
