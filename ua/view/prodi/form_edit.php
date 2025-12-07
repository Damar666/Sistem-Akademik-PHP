<?php
// ua/view/prodi/form_edit.php

// Set judul halaman
$judul_halaman = "Edit Prodi";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN FORM EDIT PRODI -->
<div class="form-container">
    <div class="form-header">
        <h2>
            <i class="fas fa-edit"></i> Edit Program Studi: 
            <span style="color: #667eea;"><?php echo htmlspecialchars($prodi['nama_prodi']); ?></span>
        </h2>
    </div>
    
    <a href="index.php?page=prodi" class="form-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Prodi
    </a>
    
    <form action="index.php?page=prodi_update" method="POST">
        
        <input type="hidden" name="idprodi" value="<?php echo $prodi['idprodi']; ?>">
        
        <div class="form-group">
            <label for="nama_prodi">
                <i class="fas fa-graduation-cap"></i> Nama Program Studi <span style="color: red;">*</span>
            </label>
            <input type="text" id="nama_prodi" name="nama_prodi" 
                   value="<?php echo htmlspecialchars($prodi['nama_prodi']); ?>" 
                   placeholder="Masukkan nama program studi" 
                   required autofocus>
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Masukkan nama lengkap program studi
            </small>
        </div>
        
        <div class="form-actions">
            <input type="submit" value="💾 Update Prodi">
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