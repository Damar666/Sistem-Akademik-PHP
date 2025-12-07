<?php
// ua/view/mahasiswa/form_edit.php

// Set judul halaman
$judul_halaman = "Edit Mahasiswa";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN FORM EDIT MAHASISWA -->
<div class="form-container">
    <div class="form-header">
        <h2>
            <i class="fas fa-user-edit"></i> Edit Mahasiswa: 
            <span style="color: #667eea;"><?php echo htmlspecialchars($mhs['nama']); ?></span>
        </h2>
    </div>
    
    <a href="index.php?page=mahasiswa" class="form-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Mahasiswa
    </a>
    
    <form action="index.php?page=mahasiswa_update" method="POST">
        
        <input type="hidden" name="idmhs" value="<?php echo $mhs['idmhs']; ?>">
        
        <div class="form-group">
            <label for="npm">
                <i class="fas fa-id-card"></i> NPM (Nomor Pokok Mahasiswa) <span style="color: red;">*</span>
            </label>
            <input type="text" id="npm" name="npm" 
                   value="<?php echo htmlspecialchars($mhs['npm']); ?>" 
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
                   value="<?php echo htmlspecialchars($mhs['nama']); ?>" 
                   placeholder="Contoh: Ahmad Fauzi" 
                   required>
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Masukkan nama lengkap sesuai KTP/KK
            </small>
        </div>
        
        <div class="form-actions">
            <input type="submit" value="💾 Update Mahasiswa">
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