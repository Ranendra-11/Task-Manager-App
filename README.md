# Task Manager

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://images-platform.99static.com/8mc2pZDV0s_nXHMZOF--H-QhZzY=/500x500/top/smart/99designs-contests-attachments/20/20319/attachment_20319607" width="400" alt="Laravel Logo"></a></p>



## Overview

The Laravel Task Manager is a web-based task management application that allows users to create, view, edit, and delete tasks. Built using Laravel and Bootstrap 4, the application provides a clean UI and a seamless user experience.

## Assumptions
- The application does not require user authentication.
- Tasks consist of a title, description, and status (Pending/Completed).
- Bootstrap 4 is used for styling.
- The API follows RESTful principles.

## Setup Instructions

### 1️ Clone the Repository
```bash
git clone https://github.com/Ranendra-11/Task-Manager-App.git
cd Task-Manager-App
```

### 2️ Install Dependencies
```bash
composer install
npm install
```

### 3️ Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4️ Set Up Database
```bash
php artisan migrate
```

### 5️ Start the Application
```bash
php artisan serve
```
Your application should now be running at **http://127.0.0.1:8000/**.

## Bonus Features
- Used **AJAX** for smooth task operations.
- **Modal-based editing** for better user experience.
- Implemented **soft deletes** to allow task recovery.
- Added **creation date** column for better task tracking.p.

