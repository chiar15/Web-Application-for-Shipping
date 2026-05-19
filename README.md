<div align="center">
  <h1>Web Application for Shipping</h1>

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

*A web application for shipping management, developed with PHP, JavaScript, HTML, CSS, and MySQL, supporting user authentication, shipment booking, courier selection, package tracking, and profile management.*

[📚 Overview](#-overview) • [✨ Main Functionalities](#-main-functionalities) • [👥 User Roles](#-user-roles) • [🧰 Tech Stack](#-tech-stack) • [🛠️ Setup](#️-setup) • [🗄️ Database](#️-database) • [📄 Documentation](#-documentation)
</div>

---

## 📚 Overview

Web Application for Shipping is a server-side web platform designed to manage shipment booking and tracking through a simple and interactive interface. The application allows users to register, log in, manage their profile, create new shipments, and monitor package status updates.

The system also supports courier-related operations and package status management, making it suitable for a small shipping service scenario. The application combines PHP for backend logic, MySQL for persistent data storage, and JavaScript for client-side interactivity and form validation.

---

## ✨ Main Functionalities

The platform includes user authentication features such as sign up, login, logout, and session handling. Registered users can access dedicated pages to manage their personal information and interact with shipping services.

A shipment booking page allows users to enter addressee details, parcel dimensions, and delivery notes, then select a courier from the available options. The application computes the total shipping price dynamically based on the courier’s tariffs, parcel weight, and dimensions.

The system also provides package tracking and shipment status updates. In addition, both client-side and server-side validation are used to improve usability and preserve data consistency during the booking flow.

---

## 👥 User Roles

The application is designed around two main types of users.

**Standard users** can create and track shipments, view their packages, and update their profile information.

**Company-related users** or courier-side operations are supported through dedicated pages for shipment retrieval and package status updates, enabling delivery management from the service side.

---

## 🧰 Tech Stack

The project is built using a classic web stack focused on simplicity and direct integration between frontend and backend components.

- **PHP** for server-side logic and page rendering
- **MySQL** for database storage
- **HTML5** for page structure
- **CSS3** for styling
- **JavaScript** for dynamic interactions and form validation

No external frontend framework is required, making the project lightweight and easy to run in a local environment.

---

## 🛠️ Setup

To run the project locally, install a web server environment such as XAMPP, WAMP, or MAMP with PHP and MySQL support. Then clone or download the repository and place it inside your server root directory.

Import the `db_backup.sql` file into MySQL to create and populate the database. After that, update the database connection parameters inside `code/set_db.php` with your local credentials.

Finally, start Apache and MySQL from your local environment and open the project in the browser through your local host path.

---

## 🗄️ Database

The project relies on a MySQL relational database used to store users, couriers, shipments, and related package information. A ready-to-import backup is included in the repository as `db_backup.sql`.

This makes the application easier to test locally, since the initial database structure and sample content can be restored directly without recreating the schema manually.

---

## 📄 Documentation

Additional project documentation is included in the repository as `Report.pdf`, which can be used to better understand the design choices, implemented functionalities, and overall structure of the application.

---
