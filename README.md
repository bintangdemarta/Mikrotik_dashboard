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

