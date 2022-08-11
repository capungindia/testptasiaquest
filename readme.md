#How to install this apps

ubah isian DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD pada file .env sesuai dengan database yang akan anda gunakan

buka terminal, atur current directory ke directory aplikasi ini

jalankan migrasi database dengan perintah

```
php artisan migrate
```

jalankan seeding data dummy untuk database dengan perintah

```
php artisan db:seed
```

selesai