<?php
// ua/view/mahasiswa/form_tambah.php

// Set judul halaman
$judul_halaman = "Tambah Mahasiswa Baru";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN FORM TAMBAH MAHASISWA -->
<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-user-graduate"></i> Tambah Mahasiswa Baru</h2>
    </div>
    
    <a href="index.php?page=mahasiswa" class="form-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Mahasiswa
    </a>
    
    <form action="index.php?page=mahasiswa_simpan" method="POST">
        <div class="form-group">
            <label for="npm">
                <i class="fas fa-id-card"></i> NPM (Nomor Pokok Mahasiswa) <span style="color: red;">*</span>
            </label>
            <input type="text" id="npm" name="npm" 
                   placeholder="Contoh: 2110631170001" 
                   required autofocus>
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Masukkan NPM mahasiswa tanpa spasi
            </small>
        </div>
        
        <div class="form-group">
            <label for="nama">
                <i class="fas fa-user"></i> Nama Lengkap Mahasiswa <span style="color: red;">*</span>
            </label>
            <input type="text" id="nama" name="nama" 
                   placeholder="Contoh: Ahmad Fauzi" 
                   required>
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Masukkan nama lengkap sesuai KTP/KK
            </small>
        </div>
        
        <div class="form-actions">
            <input type="submit" value="💾 Simpan Mahasiswa">
            <a href="index.php?page=mahasiswa" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

<?php
// Include footer
include __DIR__ . '/../layout/_footer.php';
?>