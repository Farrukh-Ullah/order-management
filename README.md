
# Order Management System (Laravel + Vue.js)

A complete Order Management System with **Laravel** backend and **Vue.js** frontend. This project allows users to manage customers and orders efficiently through a responsive and interactive interface.

---

## 📁 Project Structure

```
order-management-system/
├── backend/     # Laravel REST API
└── frontend/    # Vue.js SPA
```

---

## ✨ Features

- View, create, and update orders
- Filter orders by status and customer
- Customer and item management
- Modern UI for forms and order summary
- RESTful API architecture

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/order-management-system.git
cd order-management-system
```

---

## ⚙️ Backend Setup (Laravel)

```bash
cd backend

# Install dependencies
composer install

# Copy .env file and configure DB
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start the server
php artisan serve
```

By default, Laravel runs at: `http://localhost:8000`

---

## 🌐 Frontend Setup (Vue.js)

```bash
cd ../frontend

# Install dependencies
npm install

# Start the dev server
npm run serve
```

Vue frontend typically runs at: `http://localhost:8080`

---

## 🔗 API Endpoints

| Method | Endpoint                         | Description                 |
|--------|----------------------------------|-----------------------------|
| GET    | `/api/orders`                    | List all orders             |
| GET    | `/api/orders?status=pending`     | Filter by status            |
| GET    | `/api/orders?customer_id=1`      | Filter by customer          |
| GET    | `/api/orders/{id}`               | Get order details           |
| POST   | `/api/orders`                    | Create new order            |
| PUT    | `/api/orders/{id}`               | Update order                |
| GET    | `/api/customers`                 | List customers              |
| GET    | `/api/items`                     | List available items        |


---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
