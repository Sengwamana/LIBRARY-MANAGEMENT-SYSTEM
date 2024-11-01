
# Library Management System

## Introduction

This is a simple **Library Management System** built using PHP, MySQL, HTML, and CSS. The system allows the management of books, users (students and staff), and borrowing/lending operations. It is designed for a small library and includes basic functionalities like adding books, viewing available books, issuing books to users, and returning books.

## Features

- **Book Management:**
  - Add new books.
  - View, edit, or delete existing books.
  - Search for books by title, author, or genre.

- **User Management:**
  - Add new users (students or staff).
  - View and edit user details.
  - Search for users by name or ID.

- **Borrowing and Returning Books:**
  - Issue books to registered users.
  - Track due dates for borrowed books.
  - Process the return of books and update availability.

- **Login and User Roles:**
  - Admin can manage books, users, and transactions.
  - Users can view available books and their borrowing history.

## Technologies Used

- **PHP:** Backend logic and server-side scripting.
- **MySQL:** Database management for storing user, book, and transaction data.
- **HTML/CSS:** Frontend design and user interface.
- **JavaScript (optional):** Enhancing user experience (form validation, etc.).

## Requirements

- **XAMPP or LAMP stack** for running the PHP server and MySQL database.
- **PHP 7.0+**
- **MySQL 5.7+**
- **Web Browser:** Any modern browser (Chrome, Firefox, Edge, etc.).

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Sengwamana/library-management-system.git
   ```

2. **Set up the database**:
   - Import the `library.sql` file into MySQL using PHPMyAdmin or command line:
     ```bash
     mysql -u root -p library_db < library.sql
     ```

3. **Configure database connection**:
   - Open `config.php` and configure the database credentials:
     ```php
     $host = "localhost";
     $username = "root";
     $password = "";
     $dbname = "library_db";
     ```

4. **Run the application**:
   - Place the project folder inside the `htdocs` directory (if using XAMPP).
   - Open `http://localhost/library-management-system` in your browser.

## Usage

### Admin Panel
1. **Login** as an admin user:
   - Username: `admin`
   - Password: `admin123`

2. **Manage Books**:
   - Navigate to the "Books" section to add, edit, or delete books.

3. **Manage Users**:
   - In the "Users" section, you can add new users, edit existing user details, and search for users.

4. **Issue/Return Books**:
   - In the "Transactions" section, issue books to users by selecting a user and available book.
   - Process book returns and check due dates.

### User Panel
1. **Login** as a user:
   - Users can view available books and their borrowing history after logging in.

## File Structure

```
library-management-system/
├── css/
│   └── style.css           # CSS styles for the system
├── db/
│   └── library.sql         # Database schema
├── img/
│   └── logo.png            # Library logo
├── includes/
│   ├── config.php          # Database configuration
│   └── functions.php       # Reusable functions
├── index.php               # Home page and login form
├── admin/
│   ├── dashboard.php       # Admin dashboard
│   ├── books.php           # Manage books
│   └── users.php           # Manage users
├── transactions/
│   ├── issue.php           # Issue books to users
│   └── return.php          # Process book returns
└── README.md               # Documentation file
```

## Screenshots

![Library Management System - Dashboard](screenshot1.png)
![Library Management System - Book Management](screenshot2.png)

## Future Improvements

- Add a search filter for transactions.
- Implement overdue book alerts.
- Add email notifications for overdue books and reminders.

## License

This project is licensed under the MIT License - see the [LICENSE](EMERAN TECH) file for details.

## Author

Developed by [SENGWAMANA EMERAN].

---

Feel free to adjust the file structure, features, or other content according to your actual project setup!
