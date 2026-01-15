# 📦 Program Stok Barang (FIFO)

<p align="center">
  <img src="https://drive.google.com/uc?export=view&id=1epHHJY8kPLLnfihHwS70ROx2Z4YJeCKK" width="900" alt="Program Stok Barang"/>
</p>

Aplikasi **Program Stok Barang berbasis PHP** yang dibuat sebagai **Tugas Akhir saat Training/Magang**.  
Sistem ini menerapkan **algoritma FIFO (First In First Out)** dalam pengelolaan stok barang.

---

## 🎯 Latar Belakang

Project ini dibuat sebagai tugas akhir pada masa **training/magang**, dengan tujuan:
- Mengelola **stok barang masuk dan keluar**
- Mencatat **riwayat transaksi**
- Menggunakan metode **FIFO** agar barang yang **masuk lebih dulu akan keluar lebih dulu**

---

## 🧠 Konsep Algoritma FIFO

**FIFO (First In First Out)** berarti:
> Barang yang pertama kali masuk ke gudang akan menjadi barang pertama yang dikeluarkan.

### Contoh:
- Barang masuk:
  - Tanggal 1: 50 unit
  - Tanggal 2: 100 unit
- Barang keluar 60 unit →  
  Sistem akan:
  - Mengambil 50 unit dari stok tanggal 1
  - Sisa 10 unit diambil dari stok tanggal 2

Algoritma ini cocok untuk:
✔️ Manajemen gudang  
✔️ Barang yang memiliki masa pakai  
✔️ Sistem inventori

---

## 🛠️ Fitur Utama

- 📥 **Input Barang Masuk**
- 📤 **Transaksi Barang Keluar (FIFO)**
- 📊 **Histori Transaksi**
- 🏢 **Manajemen Lokasi Gudang**
- 📦 **Master Barang**
- 🔍 **Pencarian Data Stok & Transaksi**
- ♻️ **Restore Data Transaksi**


## 🧰 Teknologi yang Digunakan

| Kategori | Teknologi |
|---------|-----------|
| Bahasa | PHP |
| Database | MySQL |
| Frontend | HTML, CSS, Bootstrap |
| Server | XAMPP |
| Tools | phpMyAdmin |

---

## 📦 Cara Menjalankan Project

### 🔧 1. Persiapan

- Install **XAMPP / Laragon**
- Pastikan **Apache & MySQL** berjalan

---

### 📁 2. Letakkan Project

Pindahkan folder project ke:

**XAMPP**
