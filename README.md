# 🎓 Sistem Informasi Akademik (SIAKAD) Tier-3

Aplikasi manajemen akademik kampus yang dirancang dengan arsitektur **3-Tier** untuk keamanan dan skalabilitas tinggi. Proyek ini memisahkan *Application Server* (PHP) dan *Database Server* (MySQL via Docker).

## 🚀 Fitur Unggulan
* **Arsitektur MVC:** Kode terstruktur rapi (Model, View, Controller), bukan *spaghetti code*.
* **Keamanan:**
    * Cegah *SQL Injection* dengan *Prepared Statements*.
    * *Session Timeout* otomatis (1 menit) untuk mencegah akses tidak sah.
    * Pencegahan akses URL langsung (*Direct Access Protection*).
* **Multi-Level User:**
    * 👑 **Super Admin:** Kelola User & Prodi.
    * 👨‍💼 **Admin Prodi:** Input Nilai & Kelola Mahasiswa (Data terisolasi per prodi).
    * 🎓 **Mahasiswa:** Isi KRS (Filter mata kuliah otomatis sesuai jurusan) & Lihat KHS/IPK.

## 🛠️ Teknologi
* **Backend:** PHP Native (No Framework) - 
* **Database:** MySQL 8.0 (Containerized via Docker).
* **Frontend:** HTML5, CSS3 (Custom Dashboard Styling).
* **Server:** Apache (Laragon).


