## Environment Configuration

1. Copy the `.env.example` file to create a new `.env` file:

    ```bash
    cp .env.example .env
    ```

2. Configure the `.env` file with your database credentials:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password
    ```

## Database Setup

 ```
 php artisan migrate
 ```

## start server

 ```
 php artisan serve
 ```
