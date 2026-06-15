# AnimeWorld 🎌

A full-stack PHP web application for browsing, searching, and purchasing anime films. Users can explore a catalogue of anime titles organized by category, manage a shopping cart, and check out — while admins have a dedicated panel to manage content and users.

---

## Features

- **Anime Catalogue** — Browse anime films with descriptions, images, and external links
- **Categories** — Filter anime by genre/category
- **Characters Page** — Dedicated page for anime characters
- **Search** — Search across the anime catalogue
- **User Authentication** — Register, login, and logout with session management
- **User Profile & Account** — View and manage personal account details
- **Shopping Cart** — Add/remove anime items and manage quantities
- **Checkout** — Order summary and payment flow (integration-ready)
- **Admin Panel** — CRUD operations on anime products, user management, and role assignment

---

## Tech Stack

| Layer     | Technology                          |
|-----------|-------------------------------------|
| Backend   | PHP 8.x                             |
| Database  | MySQL 5.7 (via MySQLi)              |
| Frontend  | HTML, CSS, JavaScript, Bootstrap 5  |
| Local Dev | MAMP (macOS) / XAMPP (Windows)      |

---

## Project Structure

```
Anime-Films-Site/
├── home.php              # Landing page with latest anime
├── films.php             # Full anime film listing
├── single_anime.php      # Individual anime detail page
├── characters.php        # Characters page
├── category.php          # Browse by category
├── search.php            # Search results
├── about.php             # About page
│
├── login.php             # User login
├── register.php          # User registration
├── logout.php            # Session logout
├── profile.php           # User profile
├── myaccount.php         # Account settings
├── account.php           # Admin: manage users
│
├── cart.php              # Shopping cart
├── checkout.php          # Checkout & payment
│
├── Admin_Panel.php       # Admin dashboard
├── admin_action.php      # Admin CRUD actions (products)
├── admin_create.php      # Admin: create anime entry
├── admin_update.php      # Admin: update anime entry
│
├── products.php          # Products model/class
├── products_update.php   # Products update logic
├── product_action.php    # Product action handler
├── data.php              # Global data / configuration
├── db.php                # Database connection class
├── navbar.php            # Shared navigation component
├── check_session.php     # Session validation helper
├── check_my_admin.php    # Admin access guard
│
├── css.css/              # Stylesheets per page
│   ├── anime.css
│   ├── films.css
│   ├── characters.css
│   ├── login.css
│   ├── register.css
│   ├── about.css
│   └── finishregist.css
│
├── anime.js              # Client-side JavaScript
└── ang5lboyy.sql         # Database dump (schema + seed data)
```

---

## Database Setup

The database is named `ang5lboyy` and contains two tables:

**`products`** — Anime catalogue entries
| Column      | Type          | Description              |
|-------------|---------------|--------------------------|
| id          | INT (PK)      | Auto-increment           |
| title       | VARCHAR(255)  | Anime title              |
| description | TEXT          | Full description         |
| image       | VARCHAR(500)  | Poster image URL         |
| link        | VARCHAR(500)  | External link (e.g. IMDb)|
| category    | VARCHAR(100)  | Genre/category           |

**`users`** — Registered users
| Column    | Type         | Description                    |
|-----------|--------------|--------------------------------|
| id        | INT (PK)     | Auto-increment                 |
| firstname | TEXT         | First name                     |
| lastname  | TEXT         | Last name                      |
| email     | TEXT         | Email address                  |
| password  | TEXT         | Hashed password                |
| username  | TEXT         | Display username               |
| is_admin  | TINYINT(1)   | Admin flag (0 = user, 1 = admin)|

---

## Getting Started

### Prerequisites

- [MAMP](https://www.mamp.info/) (macOS) or [XAMPP](https://www.apachefriends.org/) (Windows/Linux)
- PHP 8.x
- MySQL 5.7+

### Installation

1. **Clone the repository** into your local server's web root:
   ```bash
   # MAMP
   cp -r Anime-Films-Site /Applications/MAMP/htdocs/

   # XAMPP
   cp -r Anime-Films-Site /opt/lampp/htdocs/
   ```

2. **Import the database:**
   - Open phpMyAdmin at `http://localhost/phpmyadmin`
   - Create a new database named `ang5lboyy`
   - Import `ang5lboyy.sql`

3. **Configure the database connection** in `db.php`:
   ```php
   $this->host     = '127.0.0.1';
   $this->username = 'root';
   $this->password = 'root';   // Change to your MySQL password
   $this->db       = 'ang5lboyy';
   $this->port     = 3306;
   ```

4. **Start your local server** and navigate to:
   ```
   http://localhost/Anime-Films-Site/home.php
   ```

---

## Admin Access

To grant admin privileges to a user, you can use one of the included utility scripts (run once, then remove or restrict):

- `make_admin.php` — Promote a specific user to admin
- `make_me_admin.php` — Promote the currently logged-in user to admin

Admin users gain access to:
- 👑 **Manage Users** (`account.php`)
- 📊 **Admin Panel** (`Admin_Panel.php`) — add, edit, and delete anime entries

---

## Notes

- Passwords should be stored using `password_hash()` — verify this is enforced in `register.php` before deploying.
- The checkout flow in `checkout.php` is stubbed and ready for a payment gateway integration (e.g. Stripe, PayPal).
- Debug/utility files (`test_db.php`, `debug_admin_action.php`, `make_all_users_admin.php`, etc.) should be removed before any production deployment.
- The `add_is_admin_column.php` migration script is a one-time migration and can be deleted after use.
