# Taif University Lost & Found System

## Project Overview
This project is a web-based Lost & Found system specifically designed for Taif University. It aims to help the university community (students and staff) report lost items and find found items, facilitating the process of reuniting owners with their belongings. The system provides a user-friendly interface for managing lost and found records, including image uploads and contact functionalities.

## Features
*   **Report Lost Items:** Users can submit details of items they have lost, including descriptions and potentially images.
*   **Report Found Items:** Users can submit details of items they have found, including descriptions and images.
*   **Browse Lost Items:** View a list of reported lost items.
*   **Browse Found Items:** View a list of reported found items.
*   **Item Management:** Functionality to add, view, and potentially manage (update/delete) lost and found item records.
*   **User Authentication:** Implied user sign-in and sign-up functionality (`SignIn.html`, `SignUp.html`, `process_signin.php`, `process_signup.php`).
*   **Contact Form:** A contact page (`ContactUs.html`, `process_contact.php`) for general inquiries.
*   **Search Functionality:** A search bar to find specific items.
*   **Database Integration:** Utilizes a MySQL database to store all lost and found item details, user information, and contact messages.
*   **Responsive Design:** Integration with Bootstrap for a responsive and modern user interface.

## Technologies Used
*   **Frontend:** HTML, CSS (Bootstrap), JavaScript
*   **Backend:** PHP (using MySQLi for database interaction)
*   **Database:** MySQL (with `taif_lost_and_found.sql` for schema)

## Installation and Setup
To set up and run this project locally, you will need a web server environment with PHP and MySQL (e.g., XAMPP, WAMP, MAMP, or a LAMP/LEMP stack).

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    ```
2.  **Place the project files:** Copy the `LostAndFound` directory into your web server's document root (e.g., `htdocs` for Apache).
3.  **Database Setup:**
    *   Create a new MySQL database (e.g., `taif_lost_and_found_db`).
    *   Import the `taif_lost_and_found.sql` file located in the `sql/` directory into your newly created database. This will set up the necessary tables.
4.  **Configure Database Connection:**
    *   Open `config.php` and update the database connection details (server name, username, password, database name) to match your MySQL setup.
5.  **Configure PHP:** Ensure your web server is configured to process PHP files.
6.  **Uploads Directory:** Ensure the `uploads/` directory has appropriate write permissions for image uploads.

## Usage
1.  Access the application through your web browser (e.g., `http://localhost/LostAndFound/index.html`).
2.  Users can sign up, sign in, report lost or found items, and browse existing listings.
3.  Use the search bar to find specific items.

## Developer
Eng. Yahya Shalf

## License
[Specify your license here, e.g., MIT License]
