# Cookbook (Laravel 5.6)
Little university project about a social platform which create and share recipes of users.

## How to Install?

Git pull/clone the package to the machine and install the packages.: 
```
git clone https://github.com/Antoine60/cookbook.git
composer install
cp .env.example .env
php artisan key:generate
composer dump-autoload
```

## Documentation

### Seed Migration data

```
php artisan migrate:fresh --seed
```

#### Login

login : user@email.com / password : user
