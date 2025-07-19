# QR Code Attendance System

Sistem absensi untuk mencatat jam masuk dan keluar petugas (satpam) menggunakan Scan QR Code dan validasi lokasi saat melakukan absen.

## Tech
-   Laravel (latest)
-   MySQL
-   TailwindCSS
-   NodeJS (untuk npm + vite)

## Third Party / Libraries
- FlowbiteCSS (tailwind component)
- spatie/laravel-permission
- simplesoftwareio/simple-qrcode
- barryvdh/laravel-dompdf

# Instalasi
- Clone repo ini
- jalankan command:
  ``` bash
  > composer install
  > npm install
  ```
- buat **.env** / copy dari **.env.example**
- sesuaikan value credentials database seperti: nama database, username, password
- jalankan command:
  ``` bash
  > php artisan migrate
  > php artisan db:seed
  ```

# Cara Menjalankan di lokal
- jalankan 2 command berikut secara terpisah:
    ```bash
    php artisan serve
    ```

    ```bash
    npm run dev
    ```

# Credential untuk login
Admin:
admin@mail.com
password

Pekerja:
security1@mail.com
security2@mail.com
password

## Notes
terdapat contoh file QR Code untuk melakukan pengetesan scan QR, karena test dilakukan pada device yang sama (laptop)

QRCode Masuk : IN.png
QRCode Keluar : OUT.png 
