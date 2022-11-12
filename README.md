# Laravel API with Swagger Open API Documentation
This is a full CRUD API with an Open API documentation. This is an API for document management.

Only registered users are allowed to perform CRUD operations such as uploading, editing, viewing and deleting documents.
Documents can be viewed, edited and deleted by the user that uploaded such ducument. A user does not have access to documents uploaded by other users.

# Quick Start
### Install Dependencies
composer install

### If there is an error about an application encription key
php artisan key:generate

### Run Migrations
php artisan migrate

### Populate Database with fake data
#### For the Users table run:
User::factory()->times(25)->create();
