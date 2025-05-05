# Laravel System with Redis, Livewire, Vite, and Laravel Excel

A Laravel 12+ system designed for file uploads, background processing, and dynamic UI using Laravel Livewire, Redis, Laravel Excel, MySQL, job queues, and Vite.

## ⚙️ Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL
- Redis via `predis/predis`
- Laravel Excel (`maatwebsite/excel`)
- Laravel Livewire
- Vite (frontend asset bundler)
- Laravel Queues (Redis driver)

## 📦 Installation

Clone the repository and install dependencies:

```bash
git clone https://github.com/quezera97/yoprint_uploader.git
cd yoprint_uploader
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
```

Update .env:

```bash
APP_NAME=YoPrint
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yoprint_upload
DB_USERNAME=root
DB_PASSWORD=

REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

QUEUE_CONNECTION=redis
```

Run command

```bash
php artisan migrate
php artisan serve
php artisan queue:work
```
