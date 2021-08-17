
```shell
composer create-project --prefer-dist laravel/laravel:^7.0 WaterdropTask
cd WaterdropTask
git init
git remote add origin git@github.com:NKozhuharov/WaterdropTask.git
```
```shell
cd docker/images
docker build --tag waterdrop/php-apache:latest .
```

* Add `127.0.0.1       local.waterdrop.com` to **etc/hosts**
* Run the run configuration **Waterdrop**.  Enter inside the container with the run configuration **Container console**.
* Create .env file, copying the contents of `.env.example`
* From inside the container, execute:
```shell
cd /var/www/waterdrop
composer install
php artisan key:generate
php artisan migrate:fresh
``` 
