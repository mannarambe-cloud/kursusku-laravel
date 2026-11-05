No.	Skenario	Input	Hasil yang Diharapkan	Status
1	Simpan data valid	Semua field benar	Data tersimpan dan pesan sukses tampil	Belum diuji
2	Kode kosong	code kosong	Validasi gagal	Belum diuji
3	Kode duplikat	WEB-101	Ditolak karena kode sudah ada	Belum diuji
4	Nama kosong	name kosong	Validasi gagal	Belum diuji
5	Biaya negatif	fee = -1000	Ditolak oleh validasi	Belum diuji
6	Kuota nol	quota = 0	Ditolak oleh validasi	Belum diuji
7	Status tidak valid	status = active	Ditolak oleh validasi	Belum diuji
8	Daftar tampil ulang	Reload /courses	Data tetap tampil	Belum diuji