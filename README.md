# Simple-Blog-Website

## Clone and Run on Local Machine

1. Run `git clone <git-link>` or manually download the zip project
2. Run `composer install`
3. Run `npm install`
4. Run `npm run build`
5. Make a duplicate of **_.env.example_** file using `cp .env.example .env` and set the values according to your preference/local machine values.
6. Generate an app key using `php artisan key:generate`
7. Migrate a database using `php artisan migrate`
8. Run `php artisan serve` and open the generated url on your preferred browser

- Create a link of storage folder to public folder using `php artisan storage:link`
- Run database seeder using the command `php artisan db:seed`
  
:camera: [Snapshots](https://drive.google.com/drive/folders/12dcmlWm50xbYkubJrmahOrdLJCKKMphU?usp=drive_link)
___
### Add-ons
- **[Toastr.js](https://github.com/yoeunes/toastr)**
- **[Laravel Jetstream](https://jetstream.laravel.com)**
