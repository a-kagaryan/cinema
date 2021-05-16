For install project in local plaese do following steps

1. Crete database and fill  variables 
copy .env.exampl content in .env file and fill db conection parameters

2. install php  dependencies

composer install 

3. Install node modules and build js files 

npm install && npm run build


4. Run migrations

php artisan migrate 


5. Create admin user for access to admin dashboard

php artisan db:seed 

6. run  project on local

php artisan serve

USING APPLICATION 

1. login to admin dashboard using following username/password

username admin@gmail.com

password 12345678

2. Create Halls 

3. Create Film 

4. Create seances for each hall and film 

If that time period already in use for that hall seance will not be created. 

5. Go to home select hall , date , film and do order

