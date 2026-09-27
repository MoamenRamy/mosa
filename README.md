###MOSA — Hotel Supply Management System

A Laravel-based business management system built to manage hotel supplies, products, categories, hotels, suppliers, employees, job titles, and orders through a centralized administrative platform.

The system is designed to simplify and organize the workflow between suppliers, products, hotels, and internal employees, replacing manual business processes with a structured database-driven application.

---

📌 Project Overview

MOSA is a business management application developed with Laravel, MySQL, Blade, Bootstrap, JavaScript, and AJAX.

The platform provides an administrative interface for managing the company's core business operations, including:

- Products & supplies
- Product categories
- Hotels
- Suppliers
- Orders
- Supplier orders
- Employees
- Job titles
- User roles
- Administrative data

---

✨ Main Features

📦 Products & Supplies

Manage the products and goods supplied to hotels.

- Create products
- Update products
- Delete products
- View product information
- Organize products by category
- Manage product-related data

---

🗂️ Categories

Products can be organized into categories to make supply management easier.

- Create categories
- Edit categories
- Delete categories
- View category information
- Associate products with categories

---

🏨 Hotels

Manage hotels that receive products and supplies.

The hotel management module allows administrators to maintain hotel records and connect them with their related orders.

---

🚚 Suppliers

Manage the company's suppliers and their related supply operations.

Supplier records can be connected to supplier orders, making it easier to track where products are coming from.

---

🧾 Orders

The application provides order management for the business workflow.

Orders can be associated with the relevant:

- Hotel
- Supplier
- Products
- Employee
- Order information

This creates a structured process for managing hotel supply requests.

---

📋 Supplier Orders

Supplier orders are handled separately to provide better organization of purchasing and supply operations.

Hotel Request
      ↓
Order
      ↓
Supplier
      ↓
Supplier Order
      ↓
Products

---

👥 Employees

The system provides employee management for internal business operations.

Employee information can be organized according to:

- Job title
- Role
- Organizational information

---

💼 Job Titles

Job titles provide an organizational structure for employees.

Administrators can manage available job titles and assign them to employees.

---

🔐 Roles & Access Control

The application uses role-based middleware to control access to administrative sections.

Different roles can be granted access to different parts of the system.

Protected areas can include:

- Products
- Categories
- Hotels
- Suppliers
- Orders
- Employees
- Job titles
- Users
- Administrative operations

This helps prevent unauthorized users from accessing sensitive management functionality.

---

🖥️ Admin Dashboard

The system provides a centralized dashboard where administrators can manage the main business entities.

                    MOSA
                     │
          ┌──────────┴──────────┐
          │                     │
      Products               Hotels
          │                     │
     Categories              Orders
                                │
                         ┌──────┴──────┐
                         │             │
                     Suppliers    Supplier Orders
                         │
                    Products
                         
                    Employees
                         │
                    Job Titles

---

⚡ AJAX & Dynamic Operations

Selected administrative operations use AJAX to update information without requiring a complete page refresh.

This provides a smoother experience when working with management tables and forms.

Examples include:

- Inline updates
- Dynamic data changes
- Asynchronous CRUD operations
- Dashboard interactions

---

📊 Data Management

The application is built around relational database entities and Laravel Eloquent relationships.

The main business entities include:

Users
 │
 └── Roles

Employees
 │
 └── Job Titles

Products
 │
 └── Categories

Hotels
 │
 └── Orders

Suppliers
 │
 └── Supplier Orders

Orders
 │
 ├── Hotels
 │
 ├── Products
 │
 └── Employees

---

🛠️ Technology Stack

Backend

- PHP
- Laravel
- MySQL
- Laravel Eloquent ORM

Frontend

- Blade
- HTML5
- CSS3
- Bootstrap
- JavaScript
- AJAX
- DataTables
- Font Awesome

Development Tools

- Git
- GitHub
- VS Code
- Laragon

---

🏗️ Application Architecture

The application follows the Laravel MVC architecture.

mosa/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   ├── Models/
│   └── ...
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php
│
├── public/
├── storage/
├── tests/
│
├── composer.json
└── artisan

---

🔄 Business Workflow

A typical hotel supply workflow can be represented as:

                    Hotel
                      │
                      ▼
               Supply Request
                      │
                      ▼
                    Order
                      │
                      ▼
                  Supplier
                      │
                      ▼
              Supplier Order
                      │
                      ▼
                  Products
                      │
                      ▼
                 Delivery

The system keeps the different parts of the workflow organized inside a relational database.

---

⚙️ Installation

1. Clone the repository

git clone https://github.com/MoamenRamy/mosa.git

cd mosa

2. Install dependencies

composer install

3. Create ".env"

Copy the example environment file:

cp .env.example .env

On Windows, manually copy:

.env.example

to:

.env

4. Generate application key

php artisan key:generate

5. Configure MySQL

Update your ".env" file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

6. Run migrations

php artisan migrate

If the project contains seeders:

php artisan db:seed

or:

php artisan migrate --seed

7. Start Laravel

php artisan serve

Application:

http://127.0.0.1:8000

---

🔒 Security

Sensitive configuration should never be committed to GitHub.

Keep credentials inside ".env":

APP_KEY=
DB_PASSWORD=
MAIL_PASSWORD=
API_KEY=

Make sure ".env" remains inside ".gitignore".

---

🧠 Laravel Concepts Demonstrated

This project demonstrates practical experience with:

- Laravel MVC
- Eloquent ORM
- Database relationships
- CRUD operations
- Middleware
- Role-based authorization
- Blade
- Form handling
- Validation
- MySQL
- Database migrations
- Seeders
- AJAX
- DataTables
- Administrative dashboards
- Business workflow modeling
- Relational database design
- Git & GitHub

---

🎯 What This Project Demonstrates

MOSA demonstrates how Laravel can be used to build a real-world business application rather than a simple CRUD project.

The project focuses on:

- Translating business requirements into database entities
- Designing relationships between business modules
- Building administrative workflows
- Implementing role-based access
- Managing large amounts of structured business data
- Building reusable CRUD interfaces
- Improving user experience with AJAX
- Connecting multiple business entities through Eloquent relationships

---

📈 Possible Future Improvements

Potential extensions for the system include:

- Advanced reporting
- Sales and purchasing analytics
- Inventory tracking
- Low-stock notifications
- Order status workflow
- PDF invoice generation
- Email notifications
- Activity logs
- Advanced permissions
- REST API
- Dashboard statistics
- Export to Excel
- Automated testing

---

👨‍💻 Author

Moamen Ramy

Backend Developer | PHP & Laravel

Focused on building backend systems, REST APIs, database-driven applications, and business management platforms.

Technologies

PHP
Laravel
MySQL
REST APIs
Eloquent ORM
Blade
JavaScript
Git
GitHub

Links

- GitHub: https://github.com/MoamenRamy
- LinkedIn: https://www.linkedin.com/in/moamen-ramy-492a8b212/

---

⭐ Support

If you find this project useful or interesting, consider giving the repository a ⭐ on GitHub.