This project is a test and practices for CRUD laravel example that represents a simple telco service subscription model "APIs integration". 

please follow the below steps to run the project:

1- On your server run a composer install command as below, then the composer will recreate the vendor folder with all the packages that are used in
    'composer install'

2- Create a database with the mentioned DB name in .env file "laravel" 

3- note that there is no .sql file uploaded with this project, due I used migration style, which it's will create the DB tables, just run the below command to migrate
    'php artisan migrate'


Now you are ready !!  

 The project includes the below APIs: 
 
 1- user Subscribe  (/api/user/subscribe)
 
 2- user unsubscribe (/api/user/unsubscribe)
 
 3- server subscribe (/api/server/subscribe)
 
 4- server unsbscribe (/api/server/unsubscribe)
