
# 🛒 Groceryz – Grocery List Organizer Web App

Groceryz is a lightweight, user-friendly web application designed to simplify grocery list management for individuals, families, and shared households. The app allows users to create, update, share, and manage grocery lists seamlessly across devices.

## 🚀 Features

- 🔐 **User Authentication** – Secure login/signup with role-based access (Admin/User)
- 📋 **Grocery List Management** – Create, edit, delete, and mark items as completed
- 🔗 **Real-time Sharing** – Share lists with view or edit permissions
- 💾 **List History** – Automatically stores your last 5 lists
- 📱 **Responsive UI** – Works on desktop, tablet, and mobile
- 📤 **List Download** – Export grocery lists as TXT, PDF, or Excel
- 🔒 **Secure Password Storage** – Hashed with `password_hash()` (BCrypt)

## 🧑‍💻 Tech Stack

**Frontend:**
- HTML5, CSS3
- Vanilla JavaScript (ES6+)
- Fetch API for asynchronous operations

**Backend:**
- PHP (Procedural)
- MySQL Database

**Development Tools:**
- Visual Studio Code, XAMPP
- DB Browser for SQLite/MySQL
- Git & GitHub

## 🗂️ Folder Structure

```
/groceryz-app/
├── css/
├── js/
├── includes/
├── uploads/
├── views/
├── index.php
├── login.php
├── signup.php
├── dashboard.php
└── ...
```

## ⚙️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/groceryz.git
   ```
2. Start your local server (XAMPP/LAMP).
3. Import the provided `.sql` file into your MySQL database.
4. Update DB connection in `includes/db.php`.
5. Run `localhost/groceryz` in your browser.

## 📌 Future Enhancements

- Real-time notifications (WebSocket)
- Mobile app version
- Analytics-based shopping insights

## 📜 License

This project is submitted as part of the final semester for BCA under **Kavikulaguru Kalidas Sanskrit University**. All rights reserved © 2025 Kalpesh Talesha.
