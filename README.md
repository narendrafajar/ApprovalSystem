# API Documentation

## Pengantar
Dokumentasi API untuk sistem approval transaksi pengeluaran.

## Database
1. MySql /xampp
2. database_name : DB_DATABASE=approval_system

## Laravel Plugin
1. Laravel Breeze
2. Laravel Spatie

## user login & status
- **user login menggunakan Seeder, jalankan seeder untuk user dan Status**

## Endpoint

1. **POST /approvers**
   - **Deskripsi**: Menambahkan approver baru.
   - **Parameter**:
     - `name` (string, required) - Nama approver.
   - **Respons**:
     - `200 OK`: Approver berhasil ditambahkan.
     - `400 Bad Request`: Jika permintaan tidak valid.

2. **POST /approval-stages**
   - **Deskripsi**: Menambahkan tahap approval.
   - **Parameter**:
     - `approver_id` (integer, required) - ID approver yang ditunjuk untuk tahap ini.
   - **Respons**:
     - `200 OK`: Tahap approval berhasil ditambahkan.
     - `400 Bad Request`: Jika ID approver tidak valid.

3. **POST /expense**
   - **Deskripsi**: Menambahkan pengeluaran.
   - **Parameter**:
     - `amount` (integer, required) - Jumlah pengeluaran.
     - `Description` (string, required) - Deskripsi pengeluaran.
   - **Respons**:
     - `200 OK`: Pengeluaran berhasil ditambahkan.
     - `400 Bad Request`: Jika nilai amount tidak valid.

## Dokumentasi API
Dokumentasi lengkap API dapat diakses melalui [Swagger UI](http://your-app-url/api/documentation).