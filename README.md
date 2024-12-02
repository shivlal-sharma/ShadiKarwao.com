# Shadi Karwao - Wedding Location Booking System

Shadi Karwao is a comprehensive web application designed for booking wedding locations. This platform allows users to easily browse locations, make bookings, process payments, and generate invoices. It also provides an admin dashboard for managing locations, content, and user interactions.

## Features

### User Side

- **Home Page**: View a list of available wedding locations and access other pages.
- **About Us Page**: Information about the platform and its services.
- **Services Page**: Displays a list of wedding locations. Users can click on "View Details" to see more information about a specific location.
- **Location Detail Page**: Displays detailed images of the wedding location, including the appearance of the hall, interior views, photographer services, wedding cake, and catering services, etc.
- **Contact Page**: Contact details for customer inquiries and support.
- **Wishlist Page**: Users can save their favorite locations for future reference and view details on the location page.
- **Login, Register, and Forget Password Pages**: Secure authentication for users.
- **Location Booking**: Users can select a wedding location, proceed to payment, and confirm their booking.
- **Payment Gateway**: Users can make secure payments for location bookings.
- **Payment Done Page**: Displays booking details after successful payment.
- **Invoice Generation**: Users can generate a PDF invoice containing transaction details, the booked location, and transaction ID.

### Admin Dashboard

The admin can manage all aspects of the platform:
- **Navbar Management**: Add, delete, or update links in the site’s navbar.
- **About Us Content Management**: Update or modify the content of the "About Us" page.
- **Footer Content Management**: Modify the footer content of the website.
- **Location Management**: Admin can add, delete, or update wedding locations available for booking.
- **Home Page Content Management**: Admin can edit the content displayed on the home page.
- **User Management**: Admin has control over user accounts and bookings.
- **Payment Management**: Admin can monitor and manage payments made by users.

## Tech Stack

- **Frontend**: HTML, CSS, JavaScript, AJAX
- **Backend**: PHP
- **Database**: MySQL

## Installation

### Prerequisites

Ensure you have the following installed:
- Apache server (XAMPP)
- PHP
- MySQL
- Code editor (e.g., VSCode)

### Clone the repository
    ```bash
    git clone https://github.com/shivlalsharma/shadi-karwao.git
    cd shadi-karwao
    ```
### Set up the Database:

1. **Access phpMyAdmin**: Open `http://localhost/phpmyadmin/` in your browser.
2. **Create a new database**: Create a new database (e.g., `shadi_karwao`).
3. **Import the database schema** (if available) to create the tables.
4. **Update database connection settings** in `connect.php`:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";  // Default MySQL password
   $dbname = "shadi_karwao";  // Name of your database
   ```

### Configure Server:

1. Ensure **Apache** and **MySQL** servers are running in **XAMPP**.
2. Place the project folder (`shadi-karwao`) in the `htdocs` directory of XAMPP.


### Access the Application:

1. Open your browser and go to `http://localhost/shadi-karwao`.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Author

Created and deployed by **Shivlal Sharma**.  
- **GitHub**: [Shivlal Sharma's GitHub](https://github.com/shivlalsharma)
- **LinkedIn**: [Shivlal Sharma's LinkedIn](https://www.linkedin.com/in/shivlal-sharma-56ba5a284/)