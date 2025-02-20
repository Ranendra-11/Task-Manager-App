# Laravel Task Manager

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Overview

The Laravel Task Manager is a web-based task management application that allows users to create, view, edit, and delete tasks. Built using Laravel and Bootstrap 4, the application provides a clean UI and a seamless user experience.

## Assumptions
- The application does not require user authentication.
- Tasks consist of a title, description, and status (Pending/Completed).
- Bootstrap 4 is used for styling.
- The API follows RESTful principles.

## Setup Instructions

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/Ranendra-11/Task-Manager-App.git
cd Task-Manager-App
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
```

### 3️⃣ Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Set Up Database
```bash
php artisan migrate
```

### 5️⃣ Start the Application
```bash
php artisan serve
```
Your application should now be running at **http://127.0.0.1:8000/**.

## Bonus Features
- Used **AJAX** for smooth task operations.
- **Modal-based editing** for better user experience.
- Implemented **soft deletes** to allow task recovery.
- Added **creation date** column for better task tracking.

