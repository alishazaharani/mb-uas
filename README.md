# MitraBuana.id

 ## About The Project
MitraBuana.id adalah aplikasi web penjualan berbasis Laravel Framework yang dikembangkan sebagai proyek Ujian Akhir Semester (UAS) dengan mengintegrasikan konsep Web Framework dan Rekayasa Perangkat Lunak (RPL).

Proyek ini menekankan penerapan arsitektur MVC, pengelolaan pengembangan berbasis tim, serta proses CI/CD hingga aplikasi berhasil dideploy dan dapat diakses secara publik.

 ## Project Objectives
- Menerapkan konsep Web Framework (Laravel)
- Menerapkan prinsip Rekayasa Perangkat Lunak dalam kerja tim
- Menggunakan branching strategy (feature, staging, production)
- Mengimplementasikan CI/CD dan deployment aplikasi

## Built With
- Laravel (PHP)
- Blade Template
- HTML, CSS, Bootstrap
- MySQL
- Git & GitHub
- GitHub Actions
- Railway

## Live Demo

**Production URL**
https://loyal-mindfulness-production-1b96.up.railway.app/

## CI/CD & Branching Strategy
feature/frontend
feature/backend
        ↓
      staging
        ↓
       main

feature/* : pengembangan fitur oleh masing-masing anggota tim
staging : integrasi dan pengujian
main : production release

## Getting Started (Local Setup)
- Prerequisites
- PHP >= 8.x
- Composer
- MySQL

## Deployment Laravel ke Railway

Project Laravel dideploy ke Railway dengan cara menghubungkan repository GitHub ke Railway melalui fitur Deploy from GitHub Repo. Setelah service Laravel dibuat, ditambahkan database MySQL dari Railway dan dihubungkan ke service Laravel tersebut. Konfigurasi environment dilakukan melalui Variables di Railway dengan mengatur APP_ENV ke production, menambahkan APP_KEY, serta menggunakan variabel bawaan Railway untuk koneksi database (MYSQLHOST, MYSQLPORT, MYSQLDATABASE, MYSQLUSER, MYSQLPASSWORD).

Setelah konfigurasi selesai, dilakukan pembersihan cache dan migrasi database menggunakan Railway CLI agar aplikasi dapat berjalan dengan benar di environment production. Asset frontend seperti CSS dan JavaScript dibuild dari folder resources menggunakan npm run build, lalu hasil build di folder public dipush ke GitHub agar dapat dimuat di website live.

File gambar dan asset statis dipastikan berada di dalam folder public karena hanya folder tersebut yang dapat diakses langsung di production. Untuk data gambar yang berasal dari database dan storage, digunakan symbolic link storage:link agar file dapat diakses melalui public/storage.

Website dapat diakses melalui Public Domain yang disediakan oleh Railway. Link tersebut berfungsi sebagai link staging maupun link publik untuk pengumpulan tugas. Konsep staging yang digunakan adalah website hasil deploy di Railway, bukan berdasarkan nama branch di GitHub. Dengan konfigurasi ini, aplikasi Laravel berhasil berjalan secara online meskipun pengembangan masih dapat dilanjutkan melalui update kode dan database di kemudian hari.

**Installation**
git clone https://github.com/alishazaharani/mb-uas.git
cd mb-uas
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

## Authors (Tim Pengembang)
Proyek ini dikembangkan secara berkelompok oleh:
- Muhammad Erdi Khatami (2310120009)
- Mutiara Savitrie (2310120028)
- Alisha Zaharani (2310120015)

Setiap anggota berkontribusi dalam pengembangan backend, frontend, serta pengelolaan proses rekayasa perangkat lunak.

## GitHub Repository:
https://github.com/alishazaharani/mb-uas.git

## Conclusion
Proyek MitraBuana.id menunjukkan penerapan konsep Web Framework dan Rekayasa Perangkat Lunak dalam konteks kerja tim, mulai dari pengembangan fitur, integrasi sistem, hingga deployment aplikasi ke lingkungan production.

![Backend CI](https://github.com/alishazaharani/mb-uas/actions/workflows/backend-ci.yml/badge.svg)

