
--------------------- KURULUM ADIMLARI ---------------------
composer i
env.example dosyasını kopyalayarak .env dosyasını oluşturunuz.
php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan db:seed ___
                       |___ Eğer bu komut çalıştırılırsa mail: user@yengec.com şifre: 123456 kullanıcısı oluşur.


--------------------- COMMAND ---------------------
php artisan integration:list {user_id} 
php artisan integration:save {user_id} 
php artisan integration:update {integration_id} 
php artisan integration:delete {integration_id} 

--------------------- TEST ---------------------
php artisan test

--------------------- POSTMAN ---------------------
https://api.postman.com/collections/12977146-98237944-ae1d-46d3-a68b-11a30f1be60d?access_key=PMAT-01HXWFWH85MTJWYW4NC50A4W5H

