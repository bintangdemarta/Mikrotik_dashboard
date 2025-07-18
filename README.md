# 📶 Mikrotik Internet Usage Dashboard

**Mikrotik Internet Usage Dashboard** adalah sebuah sistem monitoring berbasis web yang menampilkan **kecepatan internet real-time** dan **penggunaan data harian** dari router Mikrotik kamu. Sistem ini dirancang agar ringan, efisien, dan mudah digunakan bahkan oleh pengguna non-teknis.

> Kompatibel dengan berbagai model Mikrotik, seperti RB942-1nD, RB750Gr3, dll, selama API RouterOS aktif.

---

## 🧠 Latar Belakang

Banyak pengguna Mikrotik membutuhkan cara mudah untuk memantau trafik internet mereka tanpa harus masuk ke Winbox atau mengakses terminal Mikrotik. Dengan dashboard ini, kamu bisa:

- Mengetahui kecepatan upload/download secara **langsung (live)**
- Melihat **rekap penggunaan internet harian** secara otomatis
- Memonitor performa jaringan dari **browser biasa**

---

## 📍 Use Case

- 👨‍💼 Pengusaha warnet atau RT/RW Net
- 🏠 Pengguna rumahan yang ingin tahu pemakaian keluarga
- 🧪 Lab jaringan untuk edukasi
- 📡 Kantor kecil/menengah yang ingin transparansi penggunaan bandwidth

---

## ✨ Fitur Utama

| Fitur                          | Deskripsi                                                                 |
|-------------------------------|--------------------------------------------------------------------------|
| 🔌 Real-time Traffic Monitor   | Menampilkan kecepatan upload/download per detik langsung dari Mikrotik  |
| 📊 Grafik Penggunaan Harian   | Grafik bar interaktif berbasis Chart.js                                  |
| 🔁 Otomatis Konversi Satuan   | Kbps → Mbps secara dinamis                                               |
| 🧮 Rekap Harian Otomatis      | Hitung total data per hari dengan cronjob                                |
| 💾 Efisiensi Penyimpanan      | Data harian disimpan, sisanya dibersihkan otomatis                       |
| 🎨 Desain Minimal & Responsif | Tampilan dashboard modern, warna soft, mudah dibaca                     |

---

## 🧱 Arsitektur Teknis

Arsitektur sistem ini dirancang untuk efisiensi, modularitas, dan kemudahan skalabilitas. Berikut penjelasan singkat mengenai alur teknis proyek ini:

### 🖥️ 1. Frontend (Tampilan Dashboard)
- **Bahasa**: HTML, CSS, JavaScript
- **Framework**: Native (tanpa framework), menggunakan **Chart.js** untuk grafik.
- **Fungsi**: 
  - Menampilkan kecepatan internet secara real-time.
  - Menampilkan total pemakaian harian.
  - Menampilkan grafik jam sibuk berdasarkan data historis.

### ⚙️ 2. Backend (API PHP)
- **routeros_api.class.php**: Library untuk komunikasi ke Mikrotik via API.
- **traffic.php**: Mengambil data kecepatan internet (rx dan tx) dari interface Mikrotik setiap kali diakses.
- **daily.php**: Disarankan dijalankan via cronjob setiap jam → menyimpan total tx/rx ke database.
- **peak_hours.php**: Mengambil data dari MySQL dan mengelompokkan berdasarkan jam untuk ditampilkan dalam grafik.

### 🗄️ 3. Database (MySQL)
- **Tabel: `internet_traffic`**
  - Menyimpan data `timestamp`, `rx`, dan `tx`.
  - Data digunakan untuk menghitung total harian dan analisa jam sibuk.
- **Efisiensi**: Query menggunakan agregasi per jam (`HOUR(timestamp)`) agar ringan dan cepat.

### 🔁 4. Scheduler (Opsional)
- Cron job / Scheduled Task menjalankan `daily.php` tiap jam untuk menyimpan data penggunaan internet ke dalam database.
- Alternatif lain: gunakan Node.js atau Python untuk data collector jika ingin skalabilitas lebih lanjut.

### 📡 5. Mikrotik (RB942-1nD atau lainnya)
- Harus mengaktifkan layanan API:

