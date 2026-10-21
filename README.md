# Website tin tức (Laravel + MySQL)
Thư mục này là phần mã nguồn chép đè lên dự án Laravel mới.
1. Cài Laragon (Full), Start All. Tạo CSDL trống `newsdb` (HeidiSQL, utf8mb4).
2. `composer create-project laravel/laravel doanwebsitetintuc`
3. Chép đè toàn bộ thư mục này vào dự án (app, routes, resources, database).
4. Sửa `.env`: DB_CONNECTION=mysql, DB_DATABASE=newsdb, DB_USERNAME=root, DB_PASSWORD= (trống)
5. `php artisan migrate --seed` rồi `php artisan storage:link` rồi `php artisan serve` -> http://localhost:8000
Tài khoản: admin@news.test / Admin@123 ; editor@news.test / Editor@123
