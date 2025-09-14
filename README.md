# To-Do List Web Application

A complete To-Do List application with three user roles: Admin, User, and Organisation.

## Features

- User authentication (register, login, logout)
- Three user roles with different permissions
- Task management (create, view, edit, delete, mark as complete)
- User profile management
- Organization management (for admins)
- Responsive dark-themed UI

## Setup Instructions

1. **Prerequisites**
   - Web server (Apache, Nginx, etc.)
   - PHP 7.4 or higher
   - MySQL 5.7 or higher

2. **Database Setup**
   - Create a MySQL database named `todo_app`
   - Import the `database.sql` file to create the tables and seed sample data

3. **Configuration**
   - Update the database credentials in `includes/config.php` if needed
   - Ensure the web server has write permissions to the application directory

4. **Default Login Credentials**
   - Admin: admin@example.com / admin123
   - Organization: org@example.com / org123
   - User: user@example.com / user123

## File Structure
todo-app/
├── auth/ # Authentication pages
├── admin/ # Admin panel pages
├── org/ # Organization panel pages
├── user/ # User panel pages
├── includes/ # Configuration and helper files
├── css/ # Stylesheets
├── index.php # Home page
├── README.md # This file
└── database.sql # Database schema and sample data

## User Roles

### Admin
- Manage all users (view, edit, delete, change roles)
- Manage all tasks
- Manage organizations
- View system statistics

### Organization
- View organization details
- View organization members
- View tasks created by organization members

### User
- Manage personal profile
- Create, view, edit, and delete personal tasks
- Mark tasks as completed or pending

## Technologies Used

- HTML5
- CSS3
- PHP 7.4+
- MySQL 5.7+
- PDO for database operations
- MVC architecture pattern

## Security Features

- Password hashing using PHP's password_hash() function
- SQL injection prevention using PDO prepared statements
- XSS prevention using htmlspecialchars()
- Session-based authentication
- Role-based access control

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This project is for educational purposes.
