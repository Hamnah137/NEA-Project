<!-- Readme -->

# The Wardrobe Vault - README

## 📌 Introduction
Welcome to the **The Wardrobe Vault**, an e-commerce website designed to provide users with a seamless shopping experience. This platform allows users to browse, search, filter, and purchase clothing items while also supporting features like user authentication, product reviews, and an admin dashboard for product management.

## ✨ Features
- **User Registration & Authentication**: Secure user login and registration with email verification.
- **Product Browsing**: View, search, and filter clothing items based on categories.
- **Shopping Cart & Wishlist**: Users can add products to the cart and wishlist for future purchases.
- **Order Processing**: Users can place orders, and admins can manage them.
- **Product & Site Reviews**: Users can leave reviews for products and the website.
- **Profile Management**: Users can upload a profile picture and manage their details.
- **Admin Panel**: Manage products, users, and orders.
- **Security Features**: Password hashing, session management, and CSRF protection.

## 📂 Folder Structure
```
root/
│── images/              # Stores product and profile images                 
│── includes/            # Common backend files (header, footer, database connection)
│── admin/               # Admin dashboard functionalities
│── user/                # User-related functionalities (profile, orders, wishlist)
│── index.php            # Homepage
│── shop.php             # Product listing page
│── product_details.php  # Product details page
│── cart.php             # Shopping cart page
│── checkout.php         # Order checkout page
│── login.php            # User login page
│── register.php         # User registration page
│── db.php               # Database connection file
│── README.md            # Documentation
```

## 🛠️ Technologies Used
- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP (server-side scripting)
- **Database**: MySQL (Relational Database)
- **Version Control**: Git & GitHub
- **Hosting**: (Specify your hosting platform, e.g., UwAmp for local or live server)

## 📌 Installation & Setup
### Prerequisites
- UwAmp (for local development)
- PHP 7+ and MySQL
- Git installed on your system

### Steps to Run the Project
1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/The Wardrobe Vault.git
   cd shopping-platform
   ```
2. **Setup the database:**
   - Import the `database.sql` file into MySQL.
   - Configure `db.php` with your database credentials.
3. **Start the server:**
   - If using UwAmp.exe, start Apache and MySQL.
   - Navigate to `http://localhost/The Wardrobe Vault` in your browser.
   - 
**Database Credentials**
   - Username: root
   - Password: root

**Admin Login Credentials**
   - Username: Tara
   - Password: house

**Customer Login Credentials**
   - Username: robyn_.
   - Password: hail

## 🔑 Security Measures
- **Password Hashing**: User passwords are hashed using bcrypt.
- **Session Management**: Secure session handling.
- **SQL Injection Prevention**: Using prepared statements in queries.
- **CSRF Protection**: Ensuring form submissions are secure.

## 🚀 Deployment
- Host the website on a live server (e.g., AWS, DigitalOcean, Hostinger, etc.).
- Use **GitHub** for version control and backup.
- Configure a **domain name** and set up SSL for security.

## 📧 Contact & Support
For any issues or contributions, feel free to open an issue on GitHub or contact at **22129890@cambria.ac.uk**.

## 📝 License
This project is licensed under the **MIT License** – feel free to modify and distribute it.



