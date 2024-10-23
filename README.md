Symfony Web Application
This is a Symfony web application that provides a role-based user management system. The application includes authentication, role-based access control, and other essential features such as login, logout, and user dashboards.

Features
Authentication: Secure login and logout functionality using Symfony's security system.
Role-Based Access Control: Users are assigned one of three roles: Super Admin, Admin, or User. Each role has different access permissions.
User Dashboards: Redirect users to different dashboards based on their role.
Form-based Login: Custom login form for authentication.
Bootstrap Integration: Application is styled using Bootstrap.


Requirements
PHP 8.0 or higher
Symfony 6.x or higher
Composer
MySQL (or any other supported database)
Apache or Nginx web server
Installation
Clone the repository:

bash
Copy code
git clone https://github.com/itsxahidkhan/UserAccessSymfony.git
cd your-project
Install dependencies: Run the following command to install the required PHP dependencies using Composer:

bash
Copy code
composer install
Configure environment variables: Copy the .env file and adjust the database credentials and other environment settings:

bash
Copy code
cp .env .env.local
Edit .env.local to match your local configuration (e.g., database credentials):

ini
Copy code
DATABASE_URL="mysql://username:password@127.0.0.1:3306/your_database"
Set up the database: Run the following commands to create the database and execute migrations:

bash
Copy code
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
Run the Symfony server: You can use Symfony’s built-in server to run the application locally:

bash
Copy code
symfony server:start
Alternatively, if using Apache or Nginx, configure your virtual host to point to the /public directory.


Usage
Authentication
Users can log in using the /login route. The application will redirect users to different dashboards based on their roles:

Super Admin: /superadmin_dashboard
Admin: /admin_dashboard
User: /user_dashboard


Logout
Users can log out using the /logout route, and they will be redirected back to the login page.

File Structure
Controller: The authentication logic is handled in AuthController.php.
Entity: User entity and other related entities are in src/Entity.
Form: Login form is configured in LoginFormType.php.
Security: Role-based access control and firewall configurations are defined in config/packages/security.yaml.
Security Configuration
In config/packages/security.yaml, the security setup includes:

Role Hierarchy: Super Admin has full access, Admin has access to admin-specific routes, and User has access to user-specific routes.
Form Login: Authentication is handled via form login, with the user redirected based on their role after login.
Access Control: Specific routes are restricted based on the user role.



