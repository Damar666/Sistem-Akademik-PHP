<?php
$judul_halaman = "Tambah Mata Kuliah";
require_once(__DIR__ . "/../layout/_header.php");
?>

<div class="form-container">
    <form action="index.php?page=matkul_simpan" method="POST">
        <h2 class="form-title">Tambah Matkul</h2>
        
        <div class="form-group">
            <label>Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" required placeholder="Contoh: HOTEL01">
        </div>
        
        <div class="form-group">
            <label>Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" required placeholder="Contoh: Housekeeping">
        </div>
        
        <div class="form-group">
            <label>SKS</label>
            <input type="number" name="sks" required min="1" max="6">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="index.php?page=matkul" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

<?php require_once(__DIR__ . "/../layout/_footer.php"); ?>