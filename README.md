# Attendance Management System

*** Create Migration for Tables ***
```bash
php artisan migrate


*** Create Seeder for Tables ***
```bash
php artisan db:seed


*** Create Model for Tables ***
```bash
php artisan make:model YourModelName

php artisan make:model Subject

php artisan make:model Subject -m


*** Create Controller for Tables ***
```bash
php artisan make:controller YourControllerName --resource

e.g: php artisan make:controller SubjectController -r
e.g: php artisan make:controller Admin/SubjectController -r
