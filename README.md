# TextMyGov Application

A simple user management system built with Laravel that allows users to register and view a list of users.

## Requirements

Before you begin, ensure you have met the following requirements:

- PHP >= 8.0
- Composer
- MySQL or another database system
- A web server (e.g., Apache, Nginx)

## Installation

To set up the project on a new machine, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/bsponny/textMyGov.git
   cd textMyGov
	 ```
2. Install dependencies: Make sure you have Composer installed.
	```bash
	sudo apt-get install composer
	```
3. Install PHP
	```bash
	sudo apt-get update
	sudo apt-get install php php-cli php-mysql php-curl php-mbstring php-xml php-zip
	```
4. Install mysql
	```bash
	sudo apt-get install mysql-server
	```
5. Start mysql
	```bash
	sudo service mysql start
	```
6. Set Root Password
	```bash
	sudo mysql
	ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your_new_password';
	FLUSH PRIVILEGES;
	EXIT;
	```
	Test the connection by running this command and entering that new password
	```bash
	mysql -u root -p
	```
7. Run migrations
	```bash
	php artisan migrate
	```
8. Run server
	```bash
	php artisan serve
	```
	The server is now running on [http://localhost:8000/users](http://localhost:8000/users)

