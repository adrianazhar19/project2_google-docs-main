# 📄 Google Docs Collaboration System

Sistem manajemen dokumen berbasis Laravel yang memungkinkan pengguna membuat, mengedit, membagikan, dan berkolaborasi pada dokumen secara realtime seperti Google Docs.

---

## 🚀 Fitur

- Login & Register
- CRUD Dokumen
- Realtime Update Dokumen
- Realtime Typing Indicator
- Presence User
- Riwayat Perubahan Dokumen
- Share Link Dokumen
- Invite Collaborator
- Role Collaborator
  - Owner
  - Editor
  - Viewer
- Hapus Collaborator

---

## 🛠 Teknologi

- Laravel 12
- PHP 8.2+
- MySQL / MariaDB
- Laravel Reverb
- Laravel Broadcasting
- Tailwind CSS
- Vite

---

## 📂 Struktur Project

```
app
├── Events
│   ├── DocumentUpdated.php
│   └── UserTyping.php
│
├── Http
│   └── Controllers
│       ├── DocumentController.php
│       ├── CollaboratorController.php
│       └── ProfileController.php
│
├── Models
│   ├── Document.php
│   ├── DocumentCollaborator.php
│   ├── DocumentHistory.php
│   ├── DocumentPresence.php
│   └── User.php
```

---

## 📦 Instalasi

Clone project

```bash
git clone https://github.com/username/project-google-docs.git
```

Masuk ke folder project

```bash
cd project-google-docs
```

Install dependency

```bash
composer install
```

Install Node

```bash
npm install
```

Copy file environment

```bash
cp .env.example .env
```

Generate Key

```bash
php artisan key:generate
```

Konfigurasi database pada file

```
.env
```

Lalu jalankan

```bash
php artisan migrate
```

Jalankan Vite

```bash
npm run dev
```

Jalankan Laravel

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

---

## 👥 Role User

### Owner

- Membuat Dokumen
- Mengedit Dokumen
- Menghapus Dokumen
- Mengundang Collaborator
- Menghapus Collaborator
- Mengubah Role

### Editor

- Melihat Dokumen
- Mengedit Dokumen

### Viewer

- Hanya Melihat Dokumen

---

## 📄 Fitur Kolaborasi

### Realtime Editing

Perubahan dokumen akan dikirim secara realtime kepada pengguna lain menggunakan Laravel Broadcasting.

### Presence

Menampilkan jumlah pengguna yang sedang membuka dokumen.

### Typing Indicator

Menampilkan status ketika pengguna sedang mengetik.

### Share Link

Dokumen dapat dibagikan menggunakan URL.

### Invite Collaborator

Owner dapat mengundang pengguna lain menggunakan alamat email.

---

## 📊 Database

Tabel utama

- users
- documents
- document_histories
- document_presences
- document_collaborators

---

## 🔐 Hak Akses

| Fitur | Owner | Editor | Viewer |
|--------|:-----:|:------:|:------:|
| Lihat Dokumen | ✅ | ✅ | ✅ |
| Edit Dokumen | ✅ | ✅ | ❌ |
| Invite Collaborator | ✅ | ❌ | ❌ |
| Ubah Role | ✅ | ❌ | ❌ |
| Hapus Collaborator | ✅ | ❌ | ❌ |
| Hapus Dokumen | ✅ | ❌ | ❌ |

---

## 📷 Tampilan Sistem

- Dashboard Dokumen
- Create Dokumen
- Edit Dokumen
- Detail Dokumen
- Invite Collaborator
- Share Link
- Realtime Collaboration

---

## 👨‍💻 Developer

Nama : M. Adrian Azhar Batubara

Nim  : 240180130

Jurusan : Sistem Informasi

Framework : Laravel 12

Database : MySQL

Bahasa Pemrograman : PHP

Frontend : Blade + Tailwind CSS

---

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan tugas akademik.