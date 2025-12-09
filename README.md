⭐ ImpactGuru Mini CRM

A lightweight Customer Management System (Mini CRM) built with Laravel, featuring role-based access control, authentication, email notifications, and customer + order management.

✨ Features

Role-Based Access Control

Admin → Create, View, Edit, Delete all records

Staff → Create, View, Edit (No Delete access)

Authentication

Login

Registration

Forgot Password (Email Reset Link)

Email Notifications

Password Reset Emails

Order Confirmation Emails

Customer Management

Add Customers

Add & Manage Orders

🚀 Quick Start
1️⃣ Clone & Install

git clone https://github.com/Yadnesh022/Customer_Management_System

cd impactguru-mini-crm

cp .env.example .env

composer install

npm install

2️⃣ Database Setup

Create a database:

CMS
Import the provided database.sql file into it.

3️⃣ Configure .env

Update the DB credentials:

DB_DATABASE=CMS

DB_USERNAME=root

DB_PASSWORD=your_password

4️⃣ Run the Application

php artisan key:generate

php artisan storage:link

terminal - 1 php artisan serve

terminal - 2 npm run dev

Access the app at:

👉 http://127.0.0.1:8000

👨‍💼 Demo Login Credentials
Role	Email	             Password

Admin	admin12@gmail.com    Admin@12345

Staff	staff@gmail.com      staff@12345

🧰 Troubleshooting

If you face any errors, run:

php artisan optimize:clear
