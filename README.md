# 🧹 BersihinAja

BersihinAja is a **cleaning service web platform** built with **CodeIgniter 3** and **MySQL**.  
The platform serves as a bridge between **customers** who need cleaning services and **workers** who are ready to offer them.  

Anyone can **register** either as a **Customer** or a **Worker**, making it easy to book or offer cleaning services online.

---

## 🚀 Features

✅ **User Registration & Login** – Sign up as either a **Customer** or **Worker**  
✅ **Role-Based Access** – Different dashboards for Customers and Workers  
✅ **Booking System** – Customers can request cleaning services easily  
✅ **Worker Listing** – Customers can browse available workers  
✅ **Database-Driven** – MySQL handles all user and booking data  
✅ **CodeIgniter 3 Framework** – Lightweight, fast, and reliable  
✅ **Midtrans API Integration** – Secure online payment handling for cleaning service transactions  

---

## 🛠️ Tech Stack

- **Backend Framework**: [CodeIgniter 3](https://codeigniter.com/userguide3/)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **API Integration**: Midtrans (Payment Gateway)
- **Server Requirements**: PHP 7.2+ (with extensions: mysqli, mbstring, intl)

---

## ⚙️ Installation & Setup

1️⃣ **Clone the repository**
```bash
git clone https://github.com/kayrinth/BersihinAja.git
```

---

2️⃣ Move to your local server directory
# For XAMPP (Windows)
C:/xampp/htdocs/BersihinAja

# For Linux/Mac
/var/www/html/BersihinAja

---

3️⃣ Setup Database
- Create a new MySQL database (e.g., bersihinaja_db)
- Import the provided .sql file (if available) into the database

---
4️⃣ Configure CodeIgniter
- Open application/config/config.php and set the base URL:
  ```$config['base_url'] = 'http://localhost/BersihinAja/';```
- Open application/config/database.php and configure your database credentials:
  ```
  'username' => 'root',
  'password' => '',
  'database' => 'bersihinaja_db',
  ```
5️⃣ Run the project
- Start your local server (XAMPP/Laragon/etc.)
- Open browser:
```👉 http://localhost/BersihinAja```

## 👥 User Roles
- Customer: Can browse workers, request cleaning services, and manage bookings.
- Worker: Can register to offer services, manage requests, and update availability.

## 📌 Roadmap (Future Improvements) 
- Add online payment integration (Midtrans/Xendit)
- Add service rating & review system
- Add admin dashboard for platform management
- Implement email verification & password recovery

## 🤝 Contributing
Contributions are welcome!
To contribute:
  1. Fork this repository
  2. Create a feature branch (feature/your-feature)
  3. Commit changes (git commit -m 'Add new feature')
  4. Push to branch and open a Pull Request
