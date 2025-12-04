#  Product Inventory System (PHP CRUD Application)

A simple **Product Inventory Management System** built using **PHP**, **MySQL**, and **CSS**.  
This project allows users to:
-  **Create** new products
-  **Read/View** all products in a table
-  **Update** existing product information
-  **Delete** products from inventory

Created as part of my **PHP and MySQL learning journey**.

---

##  Features

✅ Full CRUD functionality (Create, Read, Update, Delete)  
✅ Automatic database and table creation  
✅ Responsive and modern UI design  
✅ Form validation  
✅ Success/Error notifications  
✅ Calculates total price automatically (Quantity × Price)  

---

##  Requirements

Before you start, make sure you have:
- **XAMPP** (or WAMP/MAMP) installed → https://www.apachefriends.org/
  - Includes Apache Server and MySQL
- A web browser (Chrome, Firefox, etc.)
- A code editor (VS Code recommended)

---

##  Installation

### Step 1: Download and Install XAMPP
1. Download XAMPP from https://www.apachefriends.org/
2. Install it on your computer
3. Open **XAMPP Control Panel**
4. Start **Apache** and **MySQL** modules

### Step 2: Clone/Download this Project
```bash
# Clone from GitHub
git clone https://github.com/Riegooo/crud-application

# Or download ZIP and extract
```

### Step 3: Move Project to htdocs Folder
1. Copy the project folder
2. Paste it into `C:\xampp\htdocs\` (Windows) or `/Applications/XAMPP/htdocs/` (Mac)
3. Your folder structure should look like:
```
   xampp/
   └── htdocs/
       └── product-inventory-system/
           ├── config.php
           ├── index.php
           ├── style.css
           └── background.jpg (optional)
```

### Step 4: Configure Database (Optional)
The database creates automatically! But if you need to change settings:

1. Open `config.php`
2. Update these lines if needed:
```php
$host = 'localhost';      // Usually 'localhost'
$dbname = 'crud_db';      // Database name
$username = 'root';       // Default is 'root'
$password = '';           // Default is empty
```

---

##  How to Run

1. **Make sure XAMPP is running:**
   - Apache: ✅ Running
   - MySQL: ✅ Running

2. **Open your browser and visit:**
```
   http://localhost/crud_app/index.php
```

3. **Start using the app!**
   - Add products using the form
   - View all products in the table
   - Click **Edit** to update a product
   - Click **Delete** to remove a product

---

## Project Structure
```
product-inventory-system/
│
├── config.php           # Database connection & auto-setup
├── index.php            # Main application file (CRUD logic + HTML)
├── style.css            # Styling and layout
└── background.jpg       # Background image (optional)
```

---

## Database Structure

**Database Name:** `crud_db`  
**Table Name:** `products`

| Column Name    | Data Type      | Description                    |
|----------------|----------------|--------------------------------|
| id             | INT (Primary)  | Auto-increment product ID      |
| product_code   | VARCHAR(50)    | Unique product code            |
| product_name   | VARCHAR(100)   | Name of the product            |
| quantity       | INT            | Stock quantity                 |
| price          | DECIMAL(10,2)  | Price per unit                 |
| created_at     | TIMESTAMP      | Auto-generated timestamp       |

---

## Technologies Used

- **Frontend:** HTML5, CSS3
- **Backend:** PHP 7.4+
- **Database:** MySQL (via phpMyAdmin)
- **Server:** Apache (XAMPP)
- **Font:** Google Fonts (Poppins)

---

## How It Works

### CREATE (Add Product)
1. Fill in the form with product details
2. Click "Add Product"
3. Product is saved to MySQL database
4. Page redirects with success message

### READ (View Products)
- All products are automatically displayed in a table
- Shows: Product Code, Name, Quantity, Price, Total, Actions

### UPDATE (Edit Product)
1. Click "Edit" button on any product
2. Form auto-fills with product data
3. Modify the information
4. Click "Update Product"
5. Database updates the record

### DELETE (Remove Product)
1. Click "Delete" button
2. Confirm deletion
3. Product is removed from database

---

##  Troubleshooting

### "Connection failed" error?
- Make sure MySQL is running in XAMPP
- Check your database credentials in `config.php`

### Blank page showing?
- Check if Apache is running in XAMPP
- Make sure you're accessing the correct URL
- Check PHP error logs in `xampp/apache/logs/`

### CSS not loading?
- Make sure `style.css` is in the same folder as `index.php`
- Clear your browser cache (Ctrl + F5)

### Database not creating automatically?
- Make sure MySQL is running
- Check if you have proper permissions
- Try creating database manually in phpMyAdmin

---

##  Contributing

Feel free to fork this project and submit pull requests!  
Suggestions and improvements are always welcome.

---

##  Contact

**Your Name**  
GitHub: [Riegoooo](https://github.com/Riegooo)  
Email: christiandanielcagas0@gmail.com

---

##  License

This project is open source and available under the [MIT License](LICENSE).

---

##  Acknowledgments

- Font: [Google Fonts - Poppins](https://fonts.google.com/)
- Inspiration: Learning PHP & MySQL CRUD operations
- Created with ❤️ for learning and practice

---

**⭐ If you found this helpful, please give it a star on GitHub!**