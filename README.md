# DeskLite

DeskLite adalah aplikasi web modern menggunakan PHP 8.2+ dengan Custom MVC tanpa framework yang berat.

## Tech Stack
- **Backend**: PHP 8.2+ (Custom MVC)
- **Database**: SQLite (Development) / MySQL (Production)
- **Frontend**: Tailwind CSS v4, Alpine.js, htmx

## Setup & Instalasi
1. Clone repository ini.
2. Salin `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
3. Sesuaikan konfigurasi di `.env` (default dev menggunakan SQLite di `database/database.sqlite`).
4. Jalankan aplikasi menggunakan local server pilihan Anda (misal: XAMPP) atau jalankan built-in server PHP:
   ```bash
   php -S localhost:8000
   ```

## Fitur Utama & Arsitektur
- Menggunakan ULID untuk identitas publik (URL aman) dan Auto-increment untuk pivot internal.
- Dilengkapi dengan *Core Model helpers* bawaan (`exists`, `insert`, `buildWhere`, dll) untuk interaksi database yang cepat dan tanpa *overhead* ORM eksternal.

---
*Catatan Developer: File README ini hanya akan diperbarui jika ada penambahan fitur besar, perubahan cara setup/install, variabel `.env` baru, atau perubahan standar PHP.*
