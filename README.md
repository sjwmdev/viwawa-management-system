# Viwawa Management System

## Introduction

Welcome to the Viwawa Management System (VMS), specially designed for managing the activities and members of the Viwawa youth group in the community of Mt. Zita, which belongs to the parish of Saint Mark the Evangelist.

## Features

VMS comes with the following pre-implemented modules:

1. **Authentication Module**:

    - Enables users to register and log in using their email and password.
    - Allows users to update their profiles after logging in.

2. **User Management Module**:

    - Manages users, roles, and permissions.
    - Users: Contains a list of users stored in the database.
    - Roles: Defines roles such as admin, leader, and member.
    - Permissions: Stores permissions necessary for specific roles, based on routes defined in `web.php`.
    - Access restricted to admin role.

3. **System Monitoring Module**:

    - Tracks events performed in the system, including CRUD (Create, Read, Update, Delete) operations.
    - Logs events in the database and displays them in the admin dashboard for system monitoring.

4. **Contribution Management Module**:

    - Records and tracks monthly contributions, pledges, and other donations from members.
    - Displays contribution summaries and individual member contributions.

5. **Income and Expenditure Management Module**:

    - Handles different types of income and tracks expenditures.
    - Automatically calculates balances and provides financial reports.

6. **Attendance System**:
    - Records and monitors attendance of members for Saturday gatherings and other events.
    - Displays attendance summaries to identify active and inactive members.

## Integration

-   Integrated with AdminLTE layout for a user-friendly interface.
-   Utilizes Laravel Sail for Docker container usage, simplifying the development environment setup.

## Getting Started

To get started with the VMS template, follow these steps:

1. **Setup Development Environment**:

    - Install XAMPP, Composer, and a text editor like VSCode or Sublime.

2. **Configure Database**:

    - Open the `.env` file in the project.
    - Locate the `DB_DATABASE=` section and set the database name. By default, it's set to `vms`. You can change it to your preferred name or create the database with the provided name in your database engine (e.g., phpMyAdmin).

3. **Run Commands**:

    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan permission:create-permission-routes
    php artisan db:seed --class=DatabaseSeeder
    php artisan storage:link
    php artisan serve --port=8081

    ```

4. **Login Credentials**:

-   Email: admin@vms.com
-   Password: admin123

5. **Explore and Enjoy**:

-   After logging in with the provided credentials, you'll be redirected to the admin dashboard. Start exploring and managing the Viwawa group!

## Troubleshooting

If you encounter any errors, try running the following commands:

```bash
 php artisan cache:clear
 php artisan config:clear
 php artisan route:clear
 php artisan view:clear
```

If you're using Laravel Sail, replace `php` with `sail` in the commands.

AMA: sjwmatiko.dev@gmail.com

Happy coding with VMS! 😊🚀
