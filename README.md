# Laravel Pet Project

Laravel pet project is a comprehensive web application designed for managing deliveries and administration, tailored specifically for a coffee shop.

## Functional Capabilities

- **User Accounts**: Users can create accounts and log into their personal dashboard, where they can view and delete their orders.
- **Courier Dashboards**: Couriers have their own dedicated dashboards displaying a collective list of delivery tasks and their personal assignments.

## Key Features

- **CRUD Operations**: Comprehensive CRUD operations for users and couriers, including login, logout, and password recovery functionalities.
- **Order Management**: Order creation with automatic distribution across departments, starting with the kitchen, based on selected delivery methods.
- **Administrative Panel**: An administrative panel granting full access to manage users, couriers, posts, and products.

## Installation

To get started with the project, follow these steps:

1. **Clone the repository**:
    ```sh
    git clone https://github.com/yourusername/laravel-pet-project.git
    cd laravel-pet-project
    ```

2. **Install dependencies**:
    ```sh
    composer install
    npm install
    ```

3. **Set up environment variables**:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure your database** in the `.env` file.

5. **Run migrations and seed the database**:
    ```sh
    php artisan migrate --seed
    ```

6. **Start the development server**:
    ```sh
    php artisan serve
    npm run dev
    ```

## Usage

Once the server is running, you can access the application at `http://localhost:8000`. Log in or create a new account to start managing deliveries and administrative tasks.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

---

Best regards,  
Ulugbek Kozimov