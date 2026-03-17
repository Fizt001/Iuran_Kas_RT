@echo off
title Running Kas RT - Development Mode
echo ===========================================
echo   MEMULAI SERVER LARAVEL DAN VITE...
echo ===========================================

:: Membuka jendela baru untuk Laravel Server (dan otomatis buka browser)
start cmd /k "php artisan dev"

:: Membuka jendela baru untuk Vite (Frontend/Tailwind)
start cmd /k "npm run dev"

echo.
echo [OK] Kedua server sedang berjalan di jendela terpisah.
echo Jangan tutup jendela ini jika ingin mematikan keduanya sekaligus, 
echo atau tutup jendela CMD satu per satu.
echo ===========================================
pause