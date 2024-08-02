Steps to install tasks management app

    1. create 'management' database, or any name, but you must to change the database name in .env file
    2. php artisan migrate
    3. php artisan db:seed 
        3.1 User test credentials:
            email: testuser@develop.com
            pass: testuser
    3. npm install & npm run build
    4. php artisan serve
    5. Enjoy :)
