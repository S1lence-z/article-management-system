# Article Management System
This main objective of this project was to develop a simple article management system in PHP and JavaScript for editing and displaying articles. This project was developed as a credit program for my university course [Programming of Web Applications](https://webik.ms.mff.cuni.cz/nswi142/).

## Database Setup
You may find the used database scheme in the database folder where you can find [init.sql](/db/init.sql) file which serves as a starter for creating your database.

### Connect to your database
For the application to connect to your database, you have to create a ```db_config.php``` file in the root of the cloned repository. The file should look like this:

```
<?php
$db_login_credentials = [
    'server'   => 'custom_db_name',
    'login'    => 'custom_db_username',
    'password' => 'custom_db_password',
    'database' => 'custom_db_name'
];
```
The last is to replace custom_db_server, custom_db_username, custom_db_password, and custom_db_name with your actual database server address, username, password, and database name.