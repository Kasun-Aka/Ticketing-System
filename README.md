# 🎫 OOP RESTful Ticketing System (Laravel)

A clean, lightweight RESTful Ticketing System built with **Laravel**, demonstrating core **Object-Oriented Programming (OOP)** principles alongside **Role-Based Access Control (RBAC)** across three distinct user tiers.

---

## 🚀 Key Features

* **Role-Based Access Control (RBAC):**
  * 👤 **Standard Customer:** Can create and view standard support tickets (24-hour SLA).
  * ⭐ **Premium Customer:** Can create both standard and high-priority tickets (4-hour SLA).
  * 🛡️ **Admin:** Full oversight to view and manage tickets across all user tiers.
* **Core OOP Architecture:** Implements the 4 core pillars of OOP cleanly without excessive boilerplate.
* **Dual Interface:** Separate blade dashboard views tailored for Customers (`/customer`) and Admins (`/admin`).
* **RESTful Endpoints:** Standardized JSON API responses for ticket creation, retrieval, and status updates.

---

## 🛠️ Tech Stack
Backend Framework: Laravel 10 / 11

Language: PHP 8.2+

Database: MySQL

Frontend: Blade Templates + Bootstrap 5 + Vanilla JavaScript (Fetch API)

## ⚙️ Installation & Setup
1. Clone the Repository
```Bash
git clone [https://github.com/your-username/ticketing-system.git](https://github.com/your-username/ticketing-system.git)
cd ticketing-system
```
2. Install Dependencies
```Bash
composer install
```
3. Environment Configuration
Copy the .env.example file to create your .env configuration file:

```Bash
cp .env.example .env
```
Set up your MySQL database credentials inside .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticketing_db
DB_USERNAME=root
DB_PASSWORD=
Generate the Laravel Application Key:
```

```Bash
php artisan key:generate
```
4. Database Setup & Seeding
Run the database migrations and seed the initial users:

```Bash
php artisan migrate --seed
```
This populates sample test accounts for each role:

- Standard Customer: customer@example.com (Password: password)

- Premium Customer: premium@example.com (Password: password)

- Admin: admin@example.com (Password: password)

## 🏃 Running the Application
Start the local Laravel development server:

```Bash
php artisan serve
```
Access the user portals in your browser:

👤 Customer Portal: http://127.0.0.1:8000/customer

🛡️ Admin Dashboard: http://127.0.0.1:8000/admin

Quick Login Testing Routes:

/login-customer — Authenticates automatically as a Standard Customer

/login-premium — Authenticates automatically as a Premium Customer

/login-admin — Authenticates automatically as an Admin