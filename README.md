MitraBuana.id
 About The Project

MitraBuana.id adalah aplikasi web penjualan berbasis Laravel Framework yang dikembangkan sebagai proyek Ujian Akhir Semester (UAS) dengan mengintegrasikan konsep Web Framework dan Rekayasa Perangkat Lunak (RPL).

Proyek ini menekankan penerapan arsitektur MVC, pengelolaan pengembangan berbasis tim, serta proses CI/CD hingga aplikasi berhasil dideploy dan dapat diakses secara publik.

 Project Objectives

Menerapkan konsep Web Framework (Laravel)
Menerapkan prinsip Rekayasa Perangkat Lunak dalam kerja tim
Menggunakan branching strategy (feature, staging, production)
Mengimplementasikan CI/CD dan deployment aplikasi

Built With

Laravel (PHP)
Blade Template
HTML, CSS, Bootstrap
MySQL
Git & GitHub
GitHub Actions
Railway

Live Demo

Production URL
https://loyal-mindfulness-production-1b96.up.railway.app/

 CI/CD & Branching Strategy
feature/frontend
feature/backend
        ↓
      staging
        ↓
       main

feature/* : pengembangan fitur oleh masing-masing anggota tim
staging : integrasi dan pengujian
main : production release

 Getting Started (Local Setup)
Prerequisites
PHP >= 8.x
Composer
MySQL

Installation
git clone https://github.com/alishazaharani/mb-uas.git
cd mb-uas
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

Authors (Tim Pengembang)

Proyek ini dikembangkan secara berkelompok oleh:
Muhammad Erdi Khatami (2310120009)
Mutiara Savitrie (2310120028)
Alisha Zaharani (2310120015)

Setiap anggota berkontribusi dalam pengembangan backend, frontend, serta pengelolaan proses rekayasa perangkat lunak.

GitHub Repository:
https://github.com/alishazaharani/mb-uas.git

Conclusion

Proyek MitraBuana.id menunjukkan penerapan konsep Web Framework dan Rekayasa Perangkat Lunak dalam konteks kerja tim, mulai dari pengembangan fitur, integrasi sistem, hingga deployment aplikasi ke lingkungan production.
