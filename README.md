# 🚀 Instalasi Proyek CheckIN GO

## 1. Clone Projek

```
git clone https://github.com/ronisurya15/checkin-go.git

cd checkin-go
```

## 2. Install dependensi dengan Composer

```
composer install
```

## 3. Salin file .env

```
cp .env.example .env
```

## 4. Atur koneksi database di file .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_checkin_go
DB_USERNAME=root
DB_PASSWORD=
```

## 5. Generate application key

```
php artisan key:generate
```

## 6. Buat symbolic link untuk storage

```
php artisan storage:link
```

## 7. Jalankan migrasi dan seeder database

```
php artisan migrate --seed
```
