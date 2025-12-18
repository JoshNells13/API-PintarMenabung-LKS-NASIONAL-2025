# 💰 PintarMenabung – REST API

> **MASIH DALAM PENGEMBANGAN 🚧**

Backend **PintarMenabung** dikembangkan sebagai **Soal LKS Nasional 2025** bidang **Web Technologies**. Aplikasi ini mensimulasikan sistem **manajemen keuangan pribadi** berbasis REST API yang aman, terstruktur, dan siap diintegrasikan dengan frontend modern.

PintarMenabung berfokus pada pengelolaan **dompet digital**, **pencatatan transaksi**, serta **laporan keuangan** untuk membantu pengguna mengatur keuangan secara cerdas dan terukur.

---

## 🏆 Konteks LKS Nasional 2025

Proyek **PintarMenabung** dirancang sesuai standar penilaian **LKS Nasional 2025 – Web Technologies**, dengan fokus utama:

* Desain REST API yang konsisten dan scalable
* Implementasi autentikasi berbasis token
* Relasi data keuangan yang realistis
* Dukungan filtering, pagination, dan reporting
* Kesiapan integrasi frontend (SPA / Mobile)

---

## 🔑 Authentication

Menggunakan **Laravel Sanctum** untuk autentikasi user.

### Register User

```http
POST /api/auth/register
```

### Login User

```http
POST /api/auth/login
```

Generate access token.

### Logout User *(Auth Required)*

```http
POST /api/auth/logout
```

Revoke token aktif.

---

## 💱 Currency & Category

### Get All Currencies

```http
GET /api/currencies
```

### Get All Categories

```http
GET /api/categories
```

Kategori mencakup **Income** dan **Expense**.

---

## 👛 Wallet

### Create Wallet

```http
POST /api/wallets
```

### Update Wallet

```http
PUT /api/wallets/{walletId}
```

### Delete Wallet

```http
DELETE /api/wallets/{walletId}
```

### Get All Wallets

```http
GET /api/wallets
```

### Get Wallet Detail

```http
GET /api/wallets/{walletId}
```

---

## 💸 Transaction

### Create Transaction

```http
POST /api/transactions
```

Digunakan untuk transaksi **income** atau **expense**.

### Delete Transaction

```http
DELETE /api/transactions/{transactionId}
```

### Get Transactions

```http
GET /api/transactions
```

Mendukung:

* Pagination
* Filter bulan
* Filter tahun

---

## 📊 Financial Reports

### Expense Summary by Category

```http
GET /api/reports/summary-by-category/expense
```

### Income Summary by Category

```http
GET /api/reports/summary-by-category/income
```

---

## 🛡 Middleware & Security

Seluruh endpoint (kecuali register & login) dilindungi oleh:

```
auth:sanctum
```

---

## 🧠 Tech Stack

* **Laravel** (REST API)
* **Laravel Sanctum** (Authentication)
* **MySQL / PostgreSQL**
* **RESTful Architecture**
* **Financial Domain Modeling**

---

## 📌 Catatan Pengembangan

* Proyek ini **belum final** dan masih terus dikembangkan
* Struktur API disiapkan untuk role **User** (dan opsional Admin)
* Sangat cocok untuk pengujian kemampuan backend pada kompetisi nasional

---

## 📚 Referensi Resmi

* Dokumentasi Laravel
* Dokumentasi Laravel Sanctum
* REST API Best Practices
* Pedoman LKS Web Technologies Nasional

---

✨ *Smart money needs smart API.*

Kalau uang bisa ngomong, dia bakal bilang: **"tolong pakai PintarMenabung."** 😄
