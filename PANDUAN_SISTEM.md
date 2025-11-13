# SISTEM INFORMASI KESEHATAN (SIK) - KLINIK PRATAMA

## 🚀 Sistem Sudah Berjalan!

### 📋 Akun Login untuk Testing

#### 1️⃣ **Pendaftaran** (Bagian Front Office)
- **Email:** pendaftaran@klinik.com
- **Password:** password
- **Akses:**
  - Dashboard kunjungan hari ini
  - CRUD Data Pasien
  - Daftar kunjungan baru

#### 2️⃣ **Dokter** (Pemeriksaan Pasien)
- **Email:** dokter@klinik.com
- **Password:** password
- **Akses:**
  - Lihat antrean pasien
  - Form pemeriksaan (anamnesis, diagnosis, tindakan)
  - Buat resep obat

#### 3️⃣ **Apotek** (Farmasi)
- **Email:** apotek@klinik.com
- **Password:** password
- **Akses:**
  - Antrean resep
  - Proses resep & serahkan obat (otomatis kurangi stok)
  - CRUD Data Obat

#### 4️⃣ **Pimpinan** (Monitoring)
- **Email:** pimpinan@klinik.com
- **Password:** password
- **Akses:**
  - Dashboard statistik
  - Total kunjungan & pasien
  - 10 obat paling banyak diresepkan
  - Grafik kunjungan 6 bulan terakhir

---

## 🔄 Alur Kerja Sistem

### Langkah 1: Pendaftaran Pasien
1. Login sebagai **Pendaftaran**
2. Tambah data pasien baru (jika belum ada)
3. Daftar kunjungan untuk pasien
4. Pasien masuk antrean dengan status **"Antri"**

### Langkah 2: Pemeriksaan Dokter
1. Login sebagai **Dokter**
2. Lihat daftar antrean pasien
3. Klik "Periksa" pada pasien
4. Isi form:
   - Anamnesis/Keluhan
   - Diagnosis
   - Tindakan Medis (opsional)
   - Tambah resep obat (opsional, bisa multiple)
5. Simpan → Status berubah ke **"Tunggu Obat"** (jika ada resep) atau **"Selesai"** (jika tidak ada resep)

### Langkah 3: Penyerahan Obat (Apotek)
1. Login sebagai **Apotek**
2. Lihat antrean resep
3. Klik "Lihat & Proses"
4. Cek detail resep dan stok obat
5. Klik "Proses & Serahkan Obat"
   - Stok obat otomatis berkurang
   - Status kunjungan berubah ke **"Selesai"**

### Langkah 4: Monitoring (Pimpinan)
1. Login sebagai **Pimpinan**
2. Lihat statistik:
   - Total pasien & kunjungan
   - Kunjungan hari ini & bulan ini
   - Top 10 obat yang paling banyak diresepkan
   - Grafik tren kunjungan
   - Daftar kunjungan terakhir

---

## 🎨 Fitur UI/UX

✅ **Dark Mode** - Tampilan gelap modern dan profesional
✅ **Sidebar Navigation** - Menu berbeda untuk setiap role
✅ **Status Badge** - Warna berbeda untuk setiap status kunjungan
✅ **Responsive Design** - Menggunakan Tailwind CSS
✅ **Real-time Stats** - Statistik otomatis update
✅ **Form Validation** - Validasi input yang ketat

---

## 📊 Data Sample

Sistem sudah memiliki data sample:
- ✅ 4 User (1 per role)
- ✅ 10 Obat dengan stok

---

## 🔧 URL Akses

**Login:** http://localhost:8000/login
**Dashboard:** Otomatis redirect ke dashboard sesuai role setelah login

---

## 🎯 Testing Flow yang Disarankan

1. **Login sebagai Pendaftaran**
   - Buat pasien baru
   - Daftar kunjungan untuk pasien tersebut

2. **Login sebagai Dokter**
   - Lihat pasien dalam antrean
   - Lakukan pemeriksaan
   - Berikan resep obat (pilih 2-3 obat)

3. **Login sebagai Apotek**
   - Lihat resep yang masuk
   - Proses dan serahkan obat
   - Cek stok obat berkurang

4. **Login sebagai Pimpinan**
   - Lihat statistik update
   - Cek obat yang diresepkan muncul di top 10

---

## ✨ Fitur Utama

### 🔐 Authentication & Authorization
- Laravel Breeze
- Role-based access control (4 roles)
- Middleware protection

### 👥 Modul Pendaftaran
- CRUD Pasien lengkap
- Search & pagination
- History kunjungan pasien
- Daftar kunjungan baru

### 👨‍⚕️ Modul Dokter
- Antrean pasien real-time
- Form pemeriksaan lengkap
- Resep obat dinamis (multiple items)
- Auto-update status kunjungan

### 💊 Modul Apotek
- Antrean resep otomatis
- Detail resep dengan stok checker
- Proses resep dengan auto-deduct stok
- CRUD Master Obat
- Stock alert (low stock indicator)

### 📈 Modul Pimpinan
- Dashboard statistik lengkap
- Top 10 obat paling banyak diresepkan
- Grafik kunjungan 6 bulan terakhir
- Kunjungan terakhir

---

## 🗄️ Database

**DBMS:** MySQL
**Database Name:** sistem_klinik
**Connection:** localhost (default Laragon)

### Tables:
- users (dengan role enum)
- pasiens
- obats
- kunjungans
- rekam_medis
- reseps
- resep_details

---

## 🚀 Selamat Mencoba!

Sistem Informasi Kesehatan Klinik Pratama sudah siap digunakan dengan full fitur dark mode! 🎉
