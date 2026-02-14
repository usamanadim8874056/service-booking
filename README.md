# 🧾 Service Booking System

**Service Booking** is an efficient service management system for booking and managing various services such as **Beauty, Health, Fitness, Home, and Pet Care**.
It helps streamline appointments, manage client data, and enhance customer satisfaction through a modern and user-friendly interface.

---

## 🚀 Getting Started

**Service Booking** is a **Service Provider Finder Software**, built on **Laravel (PHP framework)** and **MySQL**.
It’s designed to generate a dynamic and automated system for handling service listings, bookings, and provider management with ease.

### 🧩 Technology Stack

- **Backend:** Laravel 10+, PHP 8.1+
- **Frontend:** Bootstrap 5, jQuery, FontAwesome, Owl Carousel, Summernote, SweetAlert
- **Database:** MySQL
- **Server Requirements:**
  - PHP >= 8.1
  - Laravel >= 10.0
  - MySQL >= 5.7
  - Composer Installed
  - Apache/Nginx Web Server

---

## ⚙️ Features

| Module | Description |
|--------|--------------|
| **Services Management** | Create and manage service listings (beauty, fitness, health, home, pet care, etc.) |
| **Categories Management** | Organize services into categories for better accessibility |
| **Providers Management** | Manage service providers with profiles, ratings, and availability |
| **Users Management** | Manage customers who book services |
| **Service Availability** | Define provider working hours, schedule, and slots |
| **Wallet System** | Built-in wallet management for easy transactions |
| **Payment Gateway Integration** | Supports online payments for booking and wallet top-ups |
| **Payout Requests** | Providers can request payouts; admin manages release |
| **Social Links & Settings** | Manage social media links, branding, and global settings |
| **Profile Settings** | Update personal and business information easily |

---

## 👥 User Roles

The system supports **three main user types**, each with distinct dashboards and permissions.

### 🛠️ **Admin**

- Manage services, categories, users, and providers
- Approve or reject provider accounts
- Manage payout requests and transactions
- Control application settings (social links, general configurations, etc.)

**Login URL:**
[BASE_URL]/admin

**Credentials:**
- Username: `admin`
- Password: `123456`

---

### 💼 **Provider**

- Register as a service provider
- Manage personal services and availability
- Accept and manage customer bookings
- View wallet balance and request payouts

**Login URL:**
[BASE_URL]/login

**Credentials:**
- Email: `abdul@gmail.com`
- Password: `123456`

---

### 👤 **User (Customer)**

- Register and browse available services
- Book appointments and view booking history
- Top up wallet and make payments
- Rate services and view provider details

**Login URL:**
[BASE_URL]/login

**Credentials:**
- Email: `noman@gmail.com`
- Password: `123456`

---

## ⚡ Installation Guide

1. Clone the repository
   ```bash
   git clone https://github.com/yourusername/service-booking.git
   cd service-booking
   ```

2. Install dependencies
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and configure your database
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations and seeders
   ```bash
   php artisan migrate --seed
   ```

5. Serve the application
   ```bash
   php artisan serve
   ```

6. Visit the app
   Open [http://localhost:8000](http://localhost:8000)

---

**Developed with ❤️ using Laravel**
