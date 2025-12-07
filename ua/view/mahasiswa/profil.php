<?php
// ua/view/mahasiswa/profil.php
$judul_halaman = "Profil Saya";
require_once(__DIR__ . "/../layout/_header.php");
?>

<div class="crud-container" style="max-width: 800px; margin: 0 auto;">
    
    <div class="crud-header">
        <h2><i class="fas fa-id-card"></i> Biodata Mahasiswa</h2>
        <a href="index.php?page=dashboard" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="form-container" style="display: flex; gap: 2rem; align-items: start; margin-top: 0;">
        
        <div style="flex: 1; text-align: center;">
            <div style="width: 150px; height: 150px; background-color: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto; border: 5px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <i class="fas fa-user" style="font-size: 80px; color: #cbd5e1;"></i>
            </div>
            <h3 style="margin-bottom: 5px; color: #2c3e50;"><?php echo htmlspecialchars($mhs['nama']); ?></h3>
            <span class="badge status-aktif" style="font-size: 0.9rem;">Mahasiswa Aktif</span>
        </div>

        <div style="flex: 2; border-left: 1px solid #eee; padding-left: 2rem;">
            
            <div class="form-group">
                <label style="color: #64748b; font-size: 0.9rem;">Nomor Pokok Mahasiswa (NPM)</label>
                <div style="font-size: 1.1rem; font-weight: bold; color: #334155;">
                    <?php echo htmlspecialchars($mhs['npm']); ?>
                </div>
            </div>

            <div class="form-group">
                <label style="color: #64748b; font-size: 0.9rem;">Nama Lengkap</label>
                <div style="font-size: 1.1rem; font-weight: bold; color: #334155;">
                    <?php echo htmlspecialchars($mhs['nama']); ?>
                </div>
            </div>

            <div class="form-group">
                <label style="color: #64748b; font-size: 0.9rem;">Program Studi</label>
                <div style="font-size: 1.1rem; font-weight: bold; color: #334155;">
                    <i class="fas fa-graduation-cap" style="color: #3b82f6;"></i> 
                    <?php echo htmlspecialchars($mhs['nama_prodi']); ?>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px dashed #ddd; margin: 1.5rem 0;">

            <button class="btn-submit" onclick="alert('Fitur Edit Profil belum tersedia.')" style="background-color: #64748b;">
                <i class="fas fa-cog"></i> Pengaturan Akun
            </button>

        </div>
    </div>

</div>

<?php require_once(__DIR__ . "/../layout/_footer.php"); ?>