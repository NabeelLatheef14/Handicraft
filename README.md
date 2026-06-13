# 🎨 Handicraft Selling Platform

An elegant and responsive e-commerce web application dedicated to showcasing and selling authentic, handmade crafts. Built with a robust PHP backend and a dynamic frontend using HTML, CSS, and JavaScript, this platform connects artisans directly with customers.

## ✨ Features

* **User Authentication:** Secure login and registration for both buyers and sellers/admins.
* **Product Catalog:** Dynamic display of handicrafts with categories, descriptions, and high-quality images.
* **Shopping Cart:** Seamless cart management using JavaScript for a smooth user experience.
* **Checkout System:** Streamlined order processing and summary generation.
* **Admin Dashboard:** A dedicated space to manage inventory, add/remove products, and view incoming orders.
* **Responsive Design:** Fully styled with custom CSS to ensure a beautiful experience across desktop, tablet, and mobile devices.

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3, Vanilla JavaScript
* **Backend:** PHP (Core)
* **Database:** MySQL
* **Server:** Apache (via XAMPP/WAMP/MAMP)

## 🚀 Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

You will need a local server environment to run PHP and MySQL. We recommend installing:
* [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/) for Windows
* [MAMP](https://www.mamp.info/en/) for macOS
* LAMP stack for Linux

### Installation

1. **Clone the repository:**
```bash
   git clone [https://github.com/NabeelLatheef14/Handicraft.git](https://github.com/NabeelLatheef14/Handicraft.git)
```
2. **Move the project files:**

Move the cloned folder into your local server's root directory:

* **XAMPP:** C:\xampp\htdocs\

* **WAMP:** C:\wamp\www\

* **MAMP:** /Applications/MAMP/htdocs/

3. **Database Setup:**

* Open your web browser and navigate to http://localhost/phpmyadmin.

* Create a new database named handicraft_db.

* Import the provided SQL database file (if included in your project) to set up the necessary tables.

4. **Configure Database Connection:**

* Open the project directory in your preferred code editor.

* Locate your database configuration PHP file (e.g., config.php).

* Update the credentials to match your local database:
  
```php
     $servername = "localhost";
     $username = "root";
     $password = ""; // Default is usually empty in XAMPP
     $dbname = "handicraft_db"; 
```

5. **Launch the Application:**
* Open your web browser and go to: `http://localhost/Handicraft/`

## 📁 Folder Structure

```text
├── assets/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   └── images/       # Product and UI images
├── includes/         # Reusable PHP components (header, footer, nav)
├── admin/            # Admin panel pages and scripts
├── config.php        # Database connection settings
├── index.php         # Homepage
├── shop.php          # Product listing page
├── cart.php          # Shopping cart page
└── README.md         # Project documentation
```
## 🤝 Contributing
Contributions, issues, and feature requests are welcome!
Feel free to check the issues page.

1. Fork the Project
2. Create your Feature Branch (git checkout -b feature/AmazingFeature)
3. Commit your Changes (git commit -m 'Add some AmazingFeature')
4. Push to the Branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

## 👤 Author
Nabeel Latheef

GitHub: @NabeelLatheef14

## 📄 License
This project is licensed under the MIT License - see the LICENSE file for details.

**Quick Checklist Before Committing:**
* Update the `your-username` and `your-repo-name` URLs in the clone and contributing sections.
* Verify the database name (`handicraft_db`) and SQL import file name match your actual project structure.
* Adjust the folder structure section if your directory setup differs.
