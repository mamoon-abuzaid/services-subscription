This app will represent serveices subscription integration APIs. please follow the below steps to run project:

1- On your server run a composer install command as below, then composer will recreate the vendor folder with all the packages that are used in
#composer install

2- Creat the the database with mentioned DB name in .env file "laravel" 

3- note there is no .sql file uploaded with this project, due I used migration style, which it's will create the DB tables, just run the below gommand to migrate
# php artisan migrate


Now you are ready  

- Notes:
 we have 4 APIs: 
 1- user Subscribe  (/api/user/subscribe)
 2- user unsubscribe (/api/user/unsubscribe)
 3- server subscribe (/api/server/subscribe)
 4- server unsbscribe (/api/server/unsubscribe)
 
 
 Name : Mamoon Abuzaid