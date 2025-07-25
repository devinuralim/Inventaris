
# Manajemen Inventaris

Aplikasi manajemen inventaris berbasis Laravel. Dibuat untuk mengelola data barang.

## Fitur Utama

- Login & Logout
- CRUD Barang
- Dashboard Ringkasan Barang
- Tabel dengan fitur pecarian, filter kategori dan paginasi
- Mode tampilan bersih & UI responsif (Bootstrap)

## Tech Stack

- Laravel 12
- PHP 8.x
- MySQL
- Bootstrap 5
- Laravel Breeze (Auth)
- GitHub & Git
- VSCode
- XAMPP

## Run Locally

Clone the project

```bash
  git clone https://github.com/devinuralim/Inventaris
```

Go to the project directory

```bash
  cd Inventaris
```

Install dependencies

```bash
  npm install
```

Run Vite

```bash
  npm run dev
```


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`DB_CONNECTION=mysql`

`DB_HOST=127.0.0.1`

`DB_PORT=3306`

`DB_DATABASE=Inventaris`

`DB_USERNAME=root`

`DB_PASSWORD=`

💡 Jangan lupa nyalakan XAMPP (Apache & MySQL) dan buat database baru di phpMyAdmin dengan nama Inventaris.

Jalankan Migrasi Database
```bash
  php artisan migrate
```
Jalankan Server
```bash
  php artisan serve
```
## Demo
http://127.0.0.1:8000
## Screenshots
Dashboard
![Dashboard](public/images/1.png)

CRUD Barang
![Dashboard](public/images/2.png)