## D ` Cafe
Aplikasi sederhana menggunakan laravel 7 dan mysql dengan template dari AdminLTE

## Installation

### `composer install`
install semua dependency

### cp .env.example .env
membuat file .env

### php artisan key:generate
generate key env

### php artisan jwt:secret
generate key jwt untuk keperluan API

### setting file .env
setting database

### php artisan migrate
migration database

### php artisan serve
akses ke [http://127.0.0.1:8080]

## Role
Terdapat 3 Role berikut :
1. admin
2. kasir
3. waiter

Login awal bisa menggunakan
email : admin@gmail.com
pass : 123456
role : admin

email : kasir@gmail.com
pass : 123456
role : kasir

email : waiter@gmail.com
pass : 123456
role : waiter

### API 
- Api Login/Get Token dapat di akses di http://127.0.0.1:8080/api/login

- Api list menu diakses di http://127.0.0.1:8080/api/list-menu harus input token

### PWA
bisa di akses melalui android dan bisa menambahkan add to home screen