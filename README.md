# TextMyGov Project

This project is a Laravel-based application designed to fulfill a job interview requirement. The task was to create an HTML form that uses jQuery to submit the results to a PHP function, which then uses a SQL query to insert the form data into a fictitious database table.

## Prerequisites

To set up and run this project, you need the following installed on your machine:

- **PHP (v8.x)**: Ensure you have PHP installed. You can check by running `php -v` in your terminal.
- **Composer**: This is required to install Laravel dependencies. Download and install it from [https://getcomposer.org](https://getcomposer.org).
- **MySQL**: Install MySQL to handle the database. You can verify if MySQL is installed by running `mysql --version`.
- **Node.js and npm**: Laravel Mix requires Node.js and npm to compile frontend assets.

## Setting Up the Project

1. **Clone the Repository**:
   Clone the `textMyGov` repository to your local machine:
   ```bash
   git clone https://github.com/bsponny/textMyGov.git
   cd textMyGov
   ```

2. **Install PHP Dependencies**:
   Run the following command to install all PHP dependencies via Composer:
   ```bash
   composer install
   ```

3. **Install Node Dependencies**:
   To install dependencies for Laravel Mix (CSS and JS compilation), run:
   ```bash
   npm install
   ```

4. **Create Environment Configuration**:
   Copy the `.env.example` file to create your environment configuration:
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**:
   Laravel requires an app key for security purposes. Run the following to generate one:
   ```bash
   php artisan key:generate
   ```

6. **Set Up MySQL Database**:
   In your `.env` file, configure your MySQL database details:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```

7. **Run Migrations**:
   Run the migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

8. **Serve the Application**:
   You can serve the Laravel app locally by running:
   ```bash
   php artisan serve
   ```

   Visit [http://127.0.0.1:8000/users](http://127.0.0.1:8000/users) to view your application.

## Features

- **User Registration**: The application has a user registration form that collects `name`, `email`, and `password` fields.
- **User Listing**: It displays a list of registered users in a table.
- **AJAX Submission**: The form uses jQuery for form submission.
- **Data Persistence**: Submitted form data is inserted into the MySQL database.

## Frontend

The project includes minimal styling using CSS.

## Commands to Know

- **Run Laravel Migrations**:
  ```bash
  php artisan migrate
  ```

- **Serve Laravel Application**:
  ```bash
  php artisan serve
  ```
