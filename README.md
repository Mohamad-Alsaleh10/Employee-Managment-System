
#Mohammed Alsaleh 

#System for Managing Employees 
This is a straightforward system designed to facilitate the management of departments and the employees within them. It boasts a user authentication mechanism, the ability to perform CRUD operations for department and employee management, establishment of relationships between departments and employees, soft deletion of records, and an API for seamless interaction with the system.

To begin testing, follow these steps in your terminal:

First, clone the repository:https://github.com/Mohamad-Alsaleh10/Employee-Managment-System

After cloning the repository, proceed with the following steps:

cd <project folder-name>
composer install
make the .env file and update it with your environment information (your database name )
php artisan key:generate


Ensure that you migrate the database:
php artisan migrate

With the database migrated, you are now prepared to initiate testing. Start the project:
php artisan serve


Follow These Steps Due to the Complexity of Relationships
To effectively navigate the system's intricate relationships, adhere to the following steps:

1-Begin by creating an admin account through user registration. Authentication is necessary, and you must carry the token with you for testing purposes.
2-Add a department. You can utilize the pre-made seeder by executing the following command:
php artisan db:seed --class=DepartmentSeeder

3-Proceed to add employees.
4-Lastly, add projects and notes.



