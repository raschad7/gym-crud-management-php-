# Gym Management System (CRUD)

This project is a web-based Gym Management System built with PHP and MySQL. It provides a CRUD (Create, Read, Update, Delete) interface for managing gym members and classes, along with admin authentication.

## Features

- **Admin Authentication**: Secure login and registration for admins.
- **Member Management**:
  - Register new members
  - View, update, and delete member records
  - Search members by name, surname, phone number, or program
- **Class Management**:
  - Register new classes
  - View, update, and delete class records
  - Search classes by name, instructor, or date/time
- **Responsive UI**: Modern, responsive design using Bootstrap and custom CSS.
- **Navigation**: Easy navigation between landing page, member table, class table, and logout.

## Project Structure

```
CRUD/
├── index.php                # Admin login and registration
├── land.php                 # Landing page after login
├── header.php               # Navigation bar (included in most pages)
├── config.php               # Database connection settings
├── membersTable.php         # List, search, and delete members
├── memberRegistration.php   # Register a new member
├── updateMem.php            # Update member details
├── readMember.php           # View member details
├── classesTable.php         # List, search, and delete classes
├── classRegistration.php    # Register a new class
├── updateClass.php          # Update class details
├── readClass.php            # View class details
├── delete.php               # (Used for class deletion via POST)
```

## Database

- The system uses a MySQL database named `webgym`.
- Tables:
  - `Admins`: Stores admin credentials (username, email, password)
  - `Members`: Stores member details (name, surname, phone, DOB, gender, height, weight, experience, program)
  - `Classes`: Stores class details (classType, trainerName, dateTime, classDescription)

> **Note:** Table creation is handled automatically in the registration scripts if the tables do not exist.

## Setup Instructions

1. **Clone or Download** this repository to your local machine.
2. **Set up a local web server** (e.g., XAMPP, WAMP, MAMP) with PHP and MySQL.
3. **Create the database**:
   - Open phpMyAdmin or use the MySQL CLI.
   - Create a database named `webgym`.
4. **Configure Database Credentials**:
   - Edit `config.php` if your MySQL username or password is different from the default (`root`/no password).
5. **Start the server** and navigate to `index.php` in your browser to access the login/registration page.

## Usage

- **Login/Register** as an admin on the main page (`index.php`).
- After login, use the landing page (`land.php`) to navigate to Members or Classes tables.
- Use the navigation bar (from `header.php`) to switch between pages or log out.
- Add, view, update, or delete members and classes as needed.

## Dependencies

- PHP 7+
- MySQL
- Bootstrap (via CDN)
- Google Fonts (Raleway, Poppins, Jost)

## Security Notes

- Passwords are hashed using PHP's `password_hash`.
- Some SQL queries are not parameterized—**for production use, always use prepared statements to prevent SQL injection**.

## Customization

- You can modify the styles in the inline `<style>` tags or add your own CSS files.
- To change the database, update `config.php` accordingly.

## License

This project is for educational purposes. You may modify and use it as needed.
