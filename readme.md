#To install an app
Be sure you have installed LAMP, composer, git, nodejs,

###After cloning app please run next commands:
```
composer install
npm i
php artisan migrate --seed
npm run dev
```

####If migration was made without seeding please run
```
php artisan db:seed
```
This command will create base configs and admin user

#### Admin user:
login: admin@admin.com
pw: qweqwe

#### To get to admin panel please add '/admin' to home url (without quotes)

### console command to send money
```
php /path/to/prroject artisann money:send
```