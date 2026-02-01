# Test Credentials untuk Sistem MinjemAja

Berikut adalah akun yang tersedia untuk testing setelah menjalankan seeder:

## Akun Guru (Teacher)
- **Email**: `guru@test.com`
- **Password**: `password`
- **Role**: Teacher
- **Akses**: Dashboard Guru, Manajemen Buku, Pengarang, Kategori, Penerbit, Peminjaman

## Akun Siswa (Student)
- **Email**: `siswa@test.com`
- **Password**: `password`
- **Role**: Student
- **Akses**: Dashboard Siswa, Daftar Buku, Peminjaman, Download

## Troubleshooting

### Jika Login Tidak Berfungsi
1. **Reset Database**: 
   ```bash
   php artisan migrate:refresh --seed
   ```
   Pastikan seeder berhasil membuat user baru.

2. **Bersihkan Cache**:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

3. **Periksa Database**:
   - Buka phpMyAdmin atau MySQL client
   - Pastikan tabel `users` memiliki data dengan email: `guru@test.com` dan `siswa@test.com`
   - Pastikan kolom `password` sudah ter-hash

4. **Periksa .env**:
   - Pastikan `APP_URL=http://127.0.0.1:8000` (atau sesuai dengan setup Anda)
   - Pastikan `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` benar

### Form Registrasi Tidak Bisa Diklik
- Gunakan akun test yang sudah tersedia di atas
- Atau buat akun baru melalui form registrasi

## Testing Login di Laravel
Untuk testing dari command line:
```bash
php artisan tinker
```

Kemudian jalankan:
```php
Auth::attempt(['email' => 'guru@test.com', 'password' => 'password'])
// Should return true
```
