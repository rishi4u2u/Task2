# CRUD Application with User Authentication and Database Schema Documentation

## 📌 Project Overview

This is a PHP-based CRUD (Create, Read, Update, Delete) web application developed as part of an internship project. The application includes user authentication, session handling. It connects to a MySQL database, with all interactions handled through secure PHP scripts. The project also features comprehensive documentation for the database schema.

## 👨‍💻 Developed By

**Intern Name**: *Rishikant Yadav*  
**Role**: Project Intern  
**Supervised By**: *[Apex Planet]*  
**Duration**: *[45 Days]*  
**Organization/Institution**: *[GGSIPU]*

---

## 🧰 Technologies Used

- **Frontend**: HTML, CSS, JavaScript, Bootstrap  
- **Backend**: PHP (Core PHP, no frameworks)  
- **Database**: MySQL  
- **Server**: Apache (XAMPP/WAMP recommended)

---

## 🔐 Features

- User Registration & Login
- Include Searching and Pagination
- Password Hashing (using `password_hash`)
- Session Management
- Role-Based Access Control
- CRUD Operations:
  - Create new records
  - Read/display existing records
  - Update records
  - Delete records
- Basic input validation
- User-friendly UI

---

## 🗃️ Database Schema

### Database Name: `crud_app`

#### 1. `users` Table

| Field       | Type         | Description                    |
|-------------|--------------|--------------------------------|
| id          | INT (PK, AI) | Unique identifier              |
| username    | VARCHAR(50)  | User's login name              |
| email       | VARCHAR(100) | User's email address           |
| password    | VARCHAR(255) | Hashed password                |
| role        | ENUM('user', 'admin') | User role           |
| created_at  | TIMESTAMP    | Record creation time           |

#### 2. `records` Table

| Field       | Type         | Description                      |
|-------------|--------------|----------------------------------|
| id          | INT (PK, AI) | Unique record ID                 |
| title       | VARCHAR(100) | Title of the record              |
| content     | TEXT         | Main content of the record       |
| user_id     | INT (FK)     | Foreign key referencing `users`  |
| created_at  | TIMESTAMP    | Record creation timestamp        |

> **Note**: Foreign keys and indexes are used where appropriate.

---

## 🚀 How to Run the Project

1. **Clone the repository**  
   ```bash
   git clone https://github.com/yourusername/crud-auth-php.git

2. **Import the SQL file**

Open phpMyAdmin

Create a new database: crud_app

Import database.sql file (included in the repo)

3. **Set up the project**

Place the project folder in htdocs (XAMPP) or www (WAMP)

Update db_config.php with your database credentials

4. **Start the server**

Start Apache and MySQL via XAMPP/WAMP

Navigate to http://localhost/crud-auth-php   
