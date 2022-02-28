<p align="center"><img src="public/images/logo.svg" width="400"></p>

# About PISCO CRM

PISCO is a micro-CRM system (_still in early stages_) for personal, freelance and small businesses.  It can be customized very quickly for Customer Relationship Management, Lead Management System, Project Management or any other usage.


### Tecnologies

- **[Laravel](https://laravel.com/)**
- **[Filament](https://filamentphp.com/)**

### How to Install

01. Clone the repo : `git clone https://github.com/e-evaristo/pisco-crm.git`
02. `$ cd pisco-crm`
03. `$ composer install`
04. `$ cp .env.example .env`
05. `$ php artisan key:generate`
06. `$ php artisan storage:link`
07. Create new MySQL database for this application
08. Set database credentials on .env file
09. `$ php artisan migrate --seed`
10. `$ php artisan serve`
11. Access: http://127.0.0.1:8000/admin
12. Login with :
    - email : `admin@admin.com`
    - password : `password`

### Screenshots
![Login](screenshots/screen-1.png)
![Companies List](screenshots/screen-2.png)
![Employees List](screenshots/screen-3.png)
![Edit Transaction](screenshots/screen-4.png)

### License

The Pisco CRM is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
