<p align="center"><img src="https://i.imgur.com/taSLpYM.png" width="400" alt="Timmsy Logo"></a></p>

# TimmsyCMS Showcase

The TimmsyCMS Showcase is a web application built using the Laravel framework that allows users to create, manage, and search articles. The project serves as a showcase of my skills in Laravel development, including implementing CRUD operations, complex database relationships, user authentication, and activity logging.

## Tech Stack

- Laravel 10: A server-side PHP MVC framework for building web applications
- MySQL: A relational database management system (RDBMS) for storing and retrieving data
- Bootstrap 5: A frontend framework for building responsive and mobile-friendly layouts

## Key Features

- User Authentication: The system includes built-in user authentication using Laravel's native auth scaffolding. Users can register, log in, and manage their accounts.

- Article Management: Authenticated users can create new articles, edit existing articles, and delete articles they own. Articles can have a title, content, and are associated with categories and tags.

- Activity Logging: The system logs activities such as article creation, updating, and deletion, along with timestamps and the user responsible for the action.

- Dashboard: Each user has a personal dashboard where they can view their activities and manage their content.

## Installation

Pull the project to your local machine using your method of choice, then run the following in your bash terminal

```bash
  composer install
  npm install
  cp .env.example .env
  php artisan key:generate
```

Fill in the database credentials within the .env file. This is important for specific features to work.

Then Migrate the Database

```bash
    php artisan migrate
```
    
## Screenshots

<img src="https://i.imgur.com/ZUENNu8.png" alt="Login Page" width="468" height="300">
<img src="https://i.imgur.com/X7oox5E.png" alt="Registration Page" width="468" height="300">
<img src="https://i.imgur.com/VnRYjyI.png" alt="User Dashboard" width="468" height="300">
<img src="https://i.imgur.com/RCIaTZ8.png" alt="Articles 1" width="468" height="300">
<img src="https://i.imgur.com/8FARTo3.png" alt="Articles 2" width="468" height="300">
