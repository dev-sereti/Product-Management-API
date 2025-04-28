# Laravel Product Management API

A simple Laravel API for managing products in a local shop. This API provides endpoints for creating, reading, updating, and deleting products, along with a custom search functionality.

## Features

- Product CRUD operations
- Custom search functionality
- Form request validation with custom error messages
- Authorization policies
- Business logic: When price > 1000, description becomes required
- API Resource for consistent responses



## Installation

1. Clone the repository:

   git clone https://github.com/dev-sereti/Product-Management-API.git
   cd product-management-api


2. Install dependencies:
   
   composer install


3. Copy the environment file:

   cp .env.example .env
   

4. Configure your database connection in the `.env` file:
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=product_management
   DB_USERNAME=root
   DB_PASSWORD=
   

5. Generate application key:
   
   php artisan key:generate
   

6. Install Laravel Sanctum:
   composer require laravel/sanctum
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   

7. Run migrations:
   
   php artisan migrate
   

8. Configure Sanctum in your `.env` file (if using frontend):

   SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,127.0.0.1,127.0.0.1:8000
   

## Running the Application

1. Start the development server:
   
   php artisan serve
   

2. The API will be accessible at: `http://localhost:8000/api`



## Authentication

This API uses Laravel Sanctum for authentication. To access protected endpoints, you need to:

1. Create a user:
 
   php artisan tinker
   User::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => Hash::make('password')]);
   

2. Generate a token:
   
   php artisan tinker
   $user = User::first();
   $token = $user->createToken('api-token')->plainTextToken;
   echo $token;
   

3. Include the token in your API requests:
   
   Authorization: Bearer {your-token}
   
