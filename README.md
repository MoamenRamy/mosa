MOSA — Hotel Supply Management System

A Laravel-based business management system designed to manage hotel supplies, products, categories, hotels, suppliers, employees, job titles, and orders through a centralized administrative platform.

The system is designed to organize the workflow between hotels, suppliers, products, and internal employees using a structured relational database and role-based access control.

---

📌 Project Overview

MOSA is a business management application built with Laravel, MySQL, Blade, Bootstrap, JavaScript, and AJAX.

The system provides an administrative platform for managing:

- 📦 Products & Supplies
- 🗂️ Product Categories
- 🏨 Hotels
- 🚚 Suppliers
- 🧾 Orders
- 📋 Supplier Orders
- 👥 Employees
- 💼 Job Titles
- 🔐 Users & Roles

---

✨ Features

📦 Products & Supplies

Manage the products and goods supplied to hotels.

- Create products
- Update products
- Delete products
- View product information
- Assign products to categories
- Manage product-related information

---

🗂️ Categories

Organize products and supplies into categories.

- Create categories
- Update categories
- Delete categories
- View categories
- Associate products with categories

---

🏨 Hotels

Manage hotels that receive products and supplies.

- Add hotels
- Update hotel information
- Delete hotels
- View hotel information
- Manage hotel-related orders

---

🚚 Suppliers

Manage suppliers and their related supply operations.

- Add suppliers
- Update supplier information
- Delete suppliers
- View supplier information
- Manage supplier orders

---

🧾 Orders

Manage hotel supply orders through a centralized workflow.

Orders can be associated with:

- Hotels
- Suppliers
- Products
- Employees

---

📋 Supplier Orders

Supplier orders provide a separate workflow for managing products received from suppliers.

Hotel
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

---

👥 Employees

Manage employees within the organization.

Employee information can be associated with:

- Job titles
- Roles
- Organizational information

---

💼 Job Titles

Manage job titles used throughout the organization.

- Create job titles
- Update job titles
- Delete job titles
- Assign job titles to employees

---

🔐 Authentication & Authorization

The application uses role-based access control to restrict access to administrative functionality.

Different roles can access different areas of the system.

Protected sections can include:

- User management
- Product management
- Category management
- Hotel management
- Supplier management
- Order management
- Employee management
- Job title management

This helps ensure that administrative operations are only available to authorized users.

---

🖥️ Admin Dashboard

The application provides a centralized dashboard for managing the main business entities.

                         MOSA
                          │
          ┌───────────────┼───────────────┐
          │               │               │
       Products         Hotels        Suppliers
          │               │               │
      Categories        Orders      Supplier Orders
          │               │               │
          └───────────────┼───────────────┘
                          │
                      Employees
                          │
                      Job Titles

---

⚡ AJAX & Dynamic Operations

The application uses AJAX for selected administrative operations.

This allows specific data to be updated dynamically without requiring a full page reload.

Examples include:

- Inline updates
- Dynamic data changes
- Asynchronous CRUD operations
- Administrative interactions

---

🗄️ Database Structure

The system is based on a relational database structure connecting the main business entities.

Roles
  │
  └── Users

Job Titles
  │
  └── Employees

Categories
  │
  └── Products

Hotels
  │
  └── Orders

Suppliers
  │
  └── Supplier Orders

Orders
  │
  ├── Hotels
  ├── Products
  └── Employees

Laravel Eloquent ORM is used to manage the relationships between these entities.

---

🔄 Business Workflow

A typical hotel supply workflow:

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

---

🛠️ Tech Stack

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

🏗️ Project Architecture

The project follows the Laravel MVC architecture.

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

⚙️ Installation

1. Clone the repository

git clone https://github.com/MoamenRamy/mosa.git

cd mosa

2. Install PHP dependencies

composer install

3. Create the environment file

Copy ".env.example" to ".env".

On Linux/macOS:

cp .env.example .env

On Windows:

.env.example → .env

4. Generate the application key

php artisan key:generate

5. Configure the database

Update the following values in ".env":

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

6. Run migrations

php artisan migrate

If seeders are available:

php artisan db:seed

Or:

php artisan migrate --seed

7. Start the application

php artisan serve

The application will be available at:

http://127.0.0.1:8000

---

🔒 Security

Never commit sensitive credentials to GitHub.

Keep sensitive configuration inside ".env":

APP_KEY=
DB_PASSWORD=
MAIL_PASSWORD=
API_KEY=

Make sure ".env" is included in ".gitignore".

---

🧠 Laravel Concepts Demonstrated

This project demonstrates practical experience with:

- Laravel MVC
- Eloquent ORM
- Database relationships
- CRUD operations
- Middleware
- Role-based authorization
- Blade templates
- Form handling
- Validation
- MySQL
- Database migrations
- Database seeders
- AJAX
- DataTables
- Administrative dashboards
- Business workflow modeling
- Relational database design
- Git & GitHub

---

🎯 Project Goals

MOSA was developed to demonstrate how Laravel can be used to build a real-world business management system rather than a simple CRUD application.

The project focuses on:

- Translating business requirements into software
- Designing relational database structures
- Connecting multiple business entities
- Implementing role-based access control
- Building administrative workflows
- Managing structured business data
- Creating reusable CRUD interfaces
- Improving the admin experience with AJAX

---

📈 Future Improvements

Possible future improvements include:

- 📊 Advanced business reports
- 📦 Inventory tracking
- ⚠️ Low-stock notifications
- 📑 PDF invoice generation
- 📧 Email notifications
- 📋 Activity logs
- 🔐 Advanced permissions
- 🔌 REST API
- 📈 Dashboard analytics
- 📤 Excel export
- 🧪 Automated feature testing

---

👨‍💻 Author

Moamen Ramy

Backend Developer | PHP & Laravel

Focused on building backend systems, REST APIs, database-driven applications, and business management platforms.

Technical Skills

PHP
Laravel
MySQL
Python
Django
REST APIs
Eloquent ORM
Blade
JavaScript
Git
GitHub

Connect With Me

- GitHub: "MoamenRamy" (https://github.com/MoamenRamy)
- LinkedIn: "Moamen Ramy" (https://www.linkedin.com/in/moamen-ramy-492a8b212/)

---

⭐ Support

If you find this project useful or interesting, consider giving the repository a ⭐ on GitHub.