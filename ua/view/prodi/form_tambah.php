<?php
// ua/view/prodi/form_tambah.php

// Set judul halaman
$judul_halaman = "Tambah Prodi Baru";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN FORM TAMBAH PRODI -->
<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-university"></i> Tambah Program Studi Baru</h2>
    </div>
    
    <a href="index.php?page=prodi" class="form-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Prodi
    </a>
    
    <form action="index.php?page=prodi_simpan" method="POST">
        <div class="form-group">
            <label for="nama_prodi">
                <i class="fas fa-graduation-cap"></i> Nama Program Studi <span style="color: red;">*</span>
            </label>
            <input type="text" id="nama_prodi" name="nama_prodi" 
                   placeholder="Contoh: Teknik Informatika, Sistem Informasi, dll." 
                   required autofocus>
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Masukkan nama lengkap program studi
            </small>
        </div>
        
        <div class="form-actions">
            <input type="submit" value="💾 Simpan Prodi">
            <a href="index.php?page=prodi" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

<?php
// Include footer
include __DIR__ . '/../layout/_footer.php';
?>