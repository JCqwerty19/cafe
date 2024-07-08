# Laravel Pet Project

Laravel Pet Project is a comprehensive web application designed for managing deliveries and administration, tailored specifically for a coffee shop.

## Features

### MAIN
- **Homepage**: View the main page with a list of products and posts.

### USERS
- **User Creation**:
  - Registration page.
  - Email uniqueness check.
- **User Login**:
  - Login page.
  - Password verification.
- **Password Reset**:
  - Email address submission page.
  - Send reset link with token to the email.
  - Password update page.
- **User Information Update**:
  - Settings page.
  - Check for email uniqueness in the database.
- **User Logout**:
  - Logout button for user logout.
- **User Deletion**:
  - Deletion is not possible if there are active orders.
  - Soft delete implementation.

### ORDERS (USER DASHBOARD)
- **Order Creation**:
  - Order creation page.
  - List of products on the page.
  - Table with selected products and their quantities.
  - Buttons for incrementing and decrementing product quantities in the table.
  - Button to clear the table (cart).
  - User information form.
  - Address field appears if delivery is selected.
  - Phone number (mandatory field).
  - If phone number and address were not filled during registration, they are saved in settings when creating an order.
  - Display of order price.
  - Display of additional service prices (delivery/waiter service).
  - Button to create order and send it to the kitchen.
- **Order Viewing**:
  - Page with a list of orders.
  - Button to delete orders (deletion is not possible if the order is already prepared).
  - Order details (name, method of receipt, delivery address, courier phone number, order price, additional cost, total price, product table).

### COURIERS
- **Courier Creation**:
  - Registration page.
  - Email uniqueness check.
- **Courier Login**:
  - Login page.
  - Password verification.
- **Password Reset**:
  - Email address submission page.
  - Send reset link with token to the email.
  - Password update page.
- **Courier Information Update**:
  - Settings page.
  - Check for email uniqueness in the database.
- **Courier Logout**:
  - Logout button for courier logout.
- **Courier Deletion**:
  - Deletion of all assigned deliveries and status update.
  - Soft delete implementation.

### KITCHEN
- **Order List**:
  - List of all orders with details (name, method of receipt, delivery address, courier phone number, order price, additional cost, total price, product table).
  - `Issued` button.
- **Order Processing**:
  - After clicking `Issued`, the order is moved to either delivery, hall, or pickup list.

### DELIVERY (COURIER DASHBOARD)
- **Delivery Orders**:
  - Page showing all orders with delivery method that are ready after the kitchen.
  - Order details (address, delivery service, `Deliver` button).
- **Assigned Orders**:
  - Page with a list of orders the courier needs to deliver.
  - Order details (name, method of receipt, delivery address, courier phone number, order price, additional cost, total price, product table).
  - `Delivered` button.

### HALL & PICKUP
- **Order List**:
  - Page with a list of orders and buttons to mark them as `Served` or `Picked Up` for the corresponding department.

### HALL INDEX
- **Hall Orders**:
  - Page with a list of orders to be consumed in the hall.
  - Order ID.
  - Order status.

### ADMIN
- **Admin Dashboard**:
  - Links to departments (kitchen, hall, pickup, delivery).
  - Link to the page with a list of users.
  - Link to the page with a list of couriers.
  - Link to the page with a list of posts.
  - Link to the page with a list of products.
- **Users/Couriers List**:
  - List with basic information and delete button.
- **Posts/Products List**:
  - List with basic information (photo, title, description, price).
  - `Update` button for posts and products.
  - General button to create a post or product.
  - `Delete` button for posts and products.
- **Create/Update Post/Product Pages**:
  - Options for selecting a photo (insert a link or upload an image).

---

Best regards,  
Ulugbek Kozimov
