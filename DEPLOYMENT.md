# Panduan Deploy Sistem Klinik ke Render + Neon PostgreSQL

## 🎯 Stack Deployment
- **Web Service**: Render (Free Tier)
- **Database**: Neon PostgreSQL (Free Tier)

---

## 📋 Langkah 1: Setup Neon PostgreSQL

1. **Buat Akun Neon**
   - Kunjungi: https://neon.tech
   - Sign up dengan GitHub atau email
   - Gratis tanpa kartu kredit

2. **Buat Database Baru**
   - Klik "Create Project"
   - Project name: `sistem-klinik`
   - Region: Pilih terdekat (Singapore/Asia)
   - PostgreSQL version: Latest (16)
   - Klik "Create Project"

3. **Copy Connection String**
   Setelah project dibuat, kamu akan dapat connection string seperti:
   ```
   postgresql://username:password@ep-xxxxx.region.aws.neon.tech/neondb?sslmode=require
   ```
   
   **SIMPAN INI! Kamu akan butuh:**
   - `DB_HOST`: ep-xxxxx.region.aws.neon.tech
   - `DB_DATABASE`: neondb
   - `DB_USERNAME`: username dari connection string
   - `DB_PASSWORD`: password dari connection string
   - `DB_PORT`: 5432

---

## 📋 Langkah 2: Setup Render

1. **Buat Akun Render**
   - Kunjungi: https://render.com
   - Sign up dengan GitHub (recommended)
   - Connect repository GitHub kamu: `wildhanry/sistem-klinik`

2. **Buat Web Service Baru**
   - Klik "New +" → "Web Service"
   - Pilih repository: `sistem-klinik`
   - Konfigurasi:

   **Basic Settings:**
   ```
   Name: sistem-klinik
   Region: Singapore (atau terdekat)
   Branch: main
   Root Directory: (kosongkan)
   Runtime: PHP
   ```

   **Build & Deploy:**
   ```
   Build Command: bash build.sh
   Start Command: bash deploy.sh && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

3. **Environment Variables**
   Klik "Environment" tab, tambahkan variable berikut:

   ```bash
   # App Settings
   APP_NAME="Sistem Klinik"
   APP_ENV=production
   APP_KEY=base64:GENERATE_NANTI
   APP_DEBUG=false
   APP_URL=https://sistem-klinik.onrender.com
   
   # Database (dari Neon)
   DB_CONNECTION=pgsql
   DB_HOST=ep-xxxxx.region.aws.neon.tech
   DB_PORT=5432
   DB_DATABASE=neondb
   DB_USERNAME=username_dari_neon
   DB_PASSWORD=password_dari_neon
   
   # Session & Cache
   SESSION_DRIVER=database
   SESSION_LIFETIME=120
   CACHE_DRIVER=database
   QUEUE_CONNECTION=sync
   
   # Log
   LOG_CHANNEL=stack
   LOG_LEVEL=error
   ```

4. **Generate APP_KEY**
   Setelah deploy pertama kali gagal (normal), kamu perlu generate APP_KEY:
   - Buka Shell di Render dashboard
   - Jalankan: `php artisan key:generate --show`
   - Copy hasilnya (format: base64:xxxxx)
   - Update ENV variable `APP_KEY` dengan value tersebut
   - Redeploy

---

## 📋 Langkah 3: Deploy!

1. **Manual Deploy**
   - Di Render dashboard, klik "Manual Deploy" → "Deploy latest commit"
   - Tunggu build process (~5-10 menit)
   - Cek logs untuk memastikan tidak ada error

2. **Auto Deploy**
   - Setelah berhasil, setiap push ke GitHub main branch akan otomatis deploy

---

## 🔐 Langkah 4: Login Pertama Kali

Setelah deploy berhasil, buka URL Render kamu (contoh: `https://sistem-klinik.onrender.com`)

**Default User:**
```
Pimpinan: pimpinan@klinik.com / password
Dokter: dokter@klinik.com / password
Apotek: apotek@klinik.com / password
Pendaftaran: pendaftaran@klinik.com / password
```

⚠️ **PENTING**: Setelah login, segera ganti password default!

---

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"
**Solusi:**
```bash
# Di Render Shell
php artisan key:generate --show
# Copy hasilnya dan masukkan ke ENV APP_KEY
```

### Error: Database connection failed
**Cek:**
- DB_HOST harus lengkap dengan domain Neon (ep-xxxxx.region.aws.neon.tech)
- DB_USERNAME dan DB_PASSWORD harus sesuai dengan Neon
- DB_PORT harus 5432
- Connection string harus include `?sslmode=require`

### Build Failed
**Cek:**
- File `build.sh` harus executable
- Node.js dan npm terinstall di Render (default ada)
- Composer dependencies tidak ada yang conflict

### Migration Failed
**Solusi:**
```bash
# Di Render Shell
php artisan migrate:fresh --force
php artisan db:seed --force
```

---

## 📊 Monitoring

**Render Dashboard:**
- Cek logs realtime
- Monitor resource usage (Free tier: 512MB RAM)
- Lihat deployment history

**Neon Dashboard:**
- Monitor database size (Free tier: 3GB)
- Cek query performance
- Manage backups

---

## 💰 Biaya

**Render Free Tier:**
- ✅ 750 jam/bulan (cukup untuk 24/7)
- ✅ Auto-sleep setelah 15 menit tidak aktif
- ✅ Wake up otomatis saat ada request (~30 detik)

**Neon Free Tier:**
- ✅ 3GB storage
- ✅ 1 project
- ✅ Unlimited queries

**Total: Rp 0 / bulan** 🎉

---

## 🔄 Update Aplikasi

Untuk update code:
```bash
git add .
git commit -m "Update: deskripsi perubahan"
git push origin main
```

Render akan otomatis detect dan deploy!

---

## 📝 Catatan Penting

1. **Free tier Render akan sleep setelah 15 menit idle**
   - Cold start ~30 detik saat pertama diakses
   - Untuk production, upgrade ke paid tier ($7/bulan)

2. **Backup Database**
   - Neon free tier tidak include automated backup
   - Export manual: `pg_dump` dari Neon dashboard

3. **Custom Domain**
   - Bisa pakai domain sendiri di Render (gratis)
   - Setting CNAME record ke Render

4. **SSL/HTTPS**
   - Otomatis aktif di Render (Let's Encrypt)
   - Tidak perlu konfigurasi tambahan

---

## ✅ Checklist Deploy

- [ ] Database Neon sudah dibuat
- [ ] Connection string Neon sudah dicopy
- [ ] Repository GitHub sudah connected ke Render
- [ ] Environment variables sudah diisi semua
- [ ] APP_KEY sudah digenerate
- [ ] Build berhasil
- [ ] Migration berhasil
- [ ] Bisa login dengan user default
- [ ] Password default sudah diganti

---

**Selamat! Sistem Klinik kamu sudah live di internet! 🚀**

Support: Jika ada masalah, cek logs di Render dashboard atau hubungi support Neon/Render.
