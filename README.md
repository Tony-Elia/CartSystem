# 🛒 Laravel Shopping Cart System

A lightweight shopping cart system built with **Laravel**, **Alpine.js**, and **Tailwind CSS**.

---

## 🚀 Features

- Product listing with images and details
- Modal-based quantity selection
- Add, update, and remove items from cart
- Flash message system for real-time feedback
- Alpine.js reactive frontend
- Tailwind CSS UI
- Blade components for reusable UI pieces

---

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- Node.js + NPM
- MySQL / MariaDB
- Laravel >= 10.x

---

## 📦 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/Tony-Elia/CartSystem.git
cd CartSystem
```

### 2. Install PHP Dependencies
```bash
composer install
```
### 3. Install JavaScript Dependencies
```bash
npm install
```
### 4. Configure the Environment
```bash
cp .env.example .env
```
Update your .env with proper database credentials and settings:
env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cart_system
DB_USERNAME=root
DB_PASSWORD=
```
### 5. Generate Application Key
```bash
php artisan key:generate
```
### 6. Run Database Migrations
```bash
php artisan migrate
```
Optionally, seed demo data:

```bash
php artisan db:seed
```
### 7. Compile Frontend Assets
```bash
npm run dev
```
For production:
```bash
npm run build
```
### 8. Serve the Application
```bash
php artisan serve
```
Open your browser: http://localhost:8000
