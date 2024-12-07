
# Online Shop

An online shop web application built with PHP and MySQL, featuring user authentication, product management, and a shopping cart system. This project provides functionality for both users and admins.

---

## Features

### User Functionality
- **Login & Registration**: Users can log in or create an account to access their personalized shopping experience.
- **Shopping Cart**: 
  - Users can add products to their cart.
  - Specify product quantities.
  - View the total cost for each product and the overall cart.
- **Responsive Design**: The site is accessible and optimized for various devices.

### Admin Functionality
- **Product Management**:
  - Add new products with a name, price, and image.
  - Edit or delete existing products.
- **Admin Panel**: A dedicated page for managing product details efficiently.

---

## Installation and Setup

### Prerequisites
- PHP (Version 7.4 or later)
- MySQL
- Apache Server (e.g., XAMPP, WAMP, or LAMP)
- A browser for testing

### Steps
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/online-shop.git
   cd online-shop
   ```

### Database Setup
1. **Open phpMyAdmin**:
   - Navigate to [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/) in your browser.

2. **Create a New Database**:
   - Click on the **New** button on the left sidebar.
   - Enter a name for your database (e.g., `online_shop`) in the "Database name" field.
   - Choose `utf8mb4_general_ci` as the collation for better compatibility.
   - Click **Create**.

3. **Import the `online_shop.sql` File**:
   - Select the database you just created from the left sidebar.
   - Go to the **Import** tab in the top navigation.
   - Click the **Choose File** button, and select the `online_shop.sql` file from the project directory.
   - Click **Go** to import the database structure and data.

4. **Verify the Import**:
   - After the import is complete, you should see tables like `user`, `product`, and `add_to_cart` in the database.


3. **Configure the Project**:
   - Update the `config.php` file with your database credentials:
     ```php
     <?php
     $con = new mysqli("localhost", "username", "password", "database_name");
     if ($con->connect_error) {
         die("Connection failed: " . $con->connect_error);
     }
     ?>
     ```

4. **Start the Server**:
   - Place the project files in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Start Apache and MySQL using your server's control panel.

5. **Access the Application**:
   - Navigate to [http://localhost/online-shop/](http://localhost/online-shop/) in your browser.

---

## Project Structure
```
project/
│
├── admin/
│   ├── insert.php         # Admin: Add products
│   ├── update.php         # Admin: Edit products
│   ├── delete.php         # Admin: Delete products
│   ├── products.php       # Admin: View products
│   ├── index.php          # Admin: Admin panel (dashboard)
│   
├── user/
│   ├── index2.php         # User: Homepage
│   ├── register.php       # User: Registration page
│   ├── login.php          # User: Login page
│   ├── shop.php           # User: View products/shop
│   ├── cart.php           # User: View cart
│   ├── insert_cart.php    # User: Add to cart
│   ├── delete_cart.php    # User: Remove items from cart
│
├── assets/
│   ├── css/
│   │   ├── styles.css      # Styles specific to the admin panel
│   │── css2/
│   │   ├── style.css      # Styles specific to the user pages
|   |
│   ├── img/               # Images folder for the project
│
├── Database_File/
│   ├── online_shop.sql       # SQL script to set up the database
│
├── config.php             # Common configuration file (e.g., database connection)
├── README.md              # Project documentation

```
---
## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
---

## Contact
- **Author**: Ahmed M. Saad  
- **Email**: [ahmedm.saad005@gmail.com](mailto:ahmedm.saad005@gmail.com)

