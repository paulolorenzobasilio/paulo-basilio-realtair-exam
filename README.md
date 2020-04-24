# REALTAIR EXAM

Senior PHP Developer Exam

## Getting Started

### Prerequisites

What things you need to install the software and how to install them

* composer
* npm
* PHP 7.2

### Installing
1. Clone the project
`git clone git@github.com:paulolorenzobasilio/paulo-basilio-realtair-exam.git`
2. `cd paulo-basilio-realtair-exam`
3. Copy environment details
`mv .env.example .env`
4. `composer install`
5. `touch database/db.sqlite`
6. `php artisan migrate`
7. `php artisan db:seed`
8. `npm install`
9. `npm run dev`

## Usage
Start the local web server
```
php artisan serve
```
access your http://localhost:8000


Default users:
1. **email**: johndoe@realtair.com <br>
**password**: password 
2. **email**: juancruz@realtair.com <br>
**password**: password

## Running the tests
```
php artisan test
```

## Authors
* **Paulo Basilio**

## Acknowledgments
* REALTAIR exam

