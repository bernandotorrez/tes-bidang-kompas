Berikut adalah Project Tes Bidang Software Engineer di Kompas

Nama : Bernand Dayamuntari Hermawan

Teknologi yang saya pakai :

1. PHP Framework (Laravel 8)
2. Docker (Using Laravel Sail)

Informasi Login :

1. Admin :
    1.1 username    : admin
        password    : admin
        
2. Reporter :
    1.1 username    : reporter
        password    : reporter

3. Editor :
    1.1 username    : editor
        password    : editor
        
Setelah aplikasi dijalankan melalui docker, silahkan untuk melakukan migrasi dan seeding.

Fitur :

1. Login
2. User Management (Admin), disini Admin bisa Menambah, Mengubah, Menghapus User Login
3. Write Article, disini Reporter bisa Menambah, Mengubah, Menghapus Article / Berita
4. Approve Article, disini Editor bisa Mempublish Article / Berita yang sudah di tulis oleh Reporter

Note :

1. Setelah melakukan docker-compose, harap masuk ke terminal Image nya, lalu ubah permission di folder Storage menjadi 775 / 777
2. Lakukan perintah : php artisan optimize:clear | php artisan config:cache | php artisan migrate | php artisan db:seed
