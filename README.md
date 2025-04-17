
# CUHK IERG4210 Web Programming and Security (Spring 2021)

This is a PHP-based board game e-commerce site built for the [CUHK IERG4210](https://www.ie.cuhk.edu.hk/courses/ierg4210-web-programming-and-security/) course by Li Chun Ngai, Alex (SID: 1155110647).  
It includes a basic admin panel, product management, shopping cart with localStorage, and optional static export.

## 🧩 Features

### 🛍️ Frontend

- Product listing by categories
- Shopping cart (stored in `localStorage`)
- Checkout interface (non-functional for demo purposes)
- Info and News sections
- Responsive image display using Flexbox

### 🛠️ Admin Panel

- Add new product (with image upload)
- Edit existing products
- Delete products and related images
- Admin-only view with easy navigation

### 🗃️ Backend

- PHP (no frameworks)
- SQLite for database
- PDO prepared statements for DB interaction
- Image uploads stored in `medias/` folder
- Form validation and file type/size checks

## 📦 Static Demo

We demostrated the site as static HTML using `wget`:

```bash
wget --mirror --convert-links --adjust-extension --page-requisites --no-parent http://localhost:8000
```

## 📁 Folder Structure

```bash

.
├── admin                           
├── index.html  # Entry point of the static web demo 
├── medias                          
├── php_code    # Actual PHP source code
├── src                             
└── static-src                         
```

## PHP Project Structure

```bash
php_code
├── admin-edit.php              # Admin panel for editing
├── admin-process.php           # Admin process functions
├── admin.php                   # Admin control panel
├── cart.db                     # SQLite database
├── index.php                   # Main site
├── lib                         # Webpage components
├── medias                      # Image for the layout and products
└── src
    ├── StyleSheet.css
    ├── cart.js                 # All DB functions and actions
    ├── db.inc.php              # All DB functions
    └── item.php                # Products display and details
```

## ⚠️ Security Notes

- Do not expose this to production as-is.
- No login/authentication is implemented.
- Use only for academic/demo purposes.

## 👨‍💻 Developer

Li Chun Ngai, Alex  
CUHK IERG4210 Project  
SID: 1155110647
