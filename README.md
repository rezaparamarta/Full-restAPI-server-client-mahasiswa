# REST API Server - CodeIgniter 4

A secure RESTful API built with CodeIgniter 4 implementing:

- JWT Authentication
- Authorization Layer (Role-based access)
- Security Middleware (Custom Filter)
- Stateless API Architecture
- MySQL Database Integration

---

## 🔐 Authentication System

Login endpoint generates JWT token:

POST /login

Use Bearer Token to access protected routes.

---

## 🛡 Authorization Layer

Custom JWT Filter:
- Validates token
- Checks expiration
- Validates user role
- Blocks unauthorized access

---

## ⚙ Protected Endpoints

GET /mahasiswa
GET /mahasiswa/{id}

---

## 🗄 Database

MySQL database:
- Database: rest_api
- Table: mahasiswa

---

## 🚀 How to Run

1. Clone repo
2. Copy `.env.example` to `.env`
3. Set JWT_SECRET
4. Configure database in `Database.php`
5. Run server
