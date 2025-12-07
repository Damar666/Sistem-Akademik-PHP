<?php
// ua/view/krs/input_nilai.php
$judul_halaman = "Input Nilai Mahasiswa";

// PERBAIKAN: Cukup naik satu level (../) dari folder 'krs' ke folder 'view'
require_once(__DIR__ . "/../layout/_header.php");
?>

<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-pen-nib"></i> Input Nilai</h2>
        <a href="index.php?page=mahasiswa" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #3498db; margin-bottom: 20px;">
        <strong>Nama:</strong> <?php echo htmlspecialchars($mhs['nama']); ?> <br>
        <strong>NPM:</strong> <?php echo htmlspecialchars($mhs['npm']); ?>
    </div>

    <form action="index.php?page=krs_simpan_nilai" method="POST">
        <input type="hidden" name="idmhs" value="<?php echo $mhs['idmhs']; ?>">
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai Saat Ini</th>
                        <th>Input Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($krs_data)) : ?>
                        <?php foreach ($krs_data as $row) : 
    // Amankan variabel nilai di sini
    // Jika 'nilai' tidak ada, gunakan string kosong
    $nilai_sekarang = $row['nilai'] ?? ''; 
?>
<tr>
    <td><?php echo htmlspecialchars($row['nama_mk']); ?></td>
    <td><?php echo htmlspecialchars($row['sks']); ?></td>
    <td>
        <strong><?php echo $nilai_sekarang ?: '-'; ?></strong>
    </td>
    <td>
        <select name="nilai[<?php echo $row['idkrs']; ?>]" style="padding: 5px; width: 60px;">
            <option value=""  <?php if($nilai_sekarang == '') echo 'selected'; ?>>-</option>
            <option value="A" <?php if($nilai_sekarang == 'A') echo 'selected'; ?>>A</option>
            <option value="B" <?php if($nilai_sekarang == 'B') echo 'selected'; ?>>B</option>
            <option value="C" <?php if($nilai_sekarang == 'C') echo 'selected'; ?>>C</option>
            <option value="D" <?php if($nilai_sekarang == 'D') echo 'selected'; ?>>D</option>
            <option value="E" <?php if($nilai_sekarang == 'E') echo 'selected'; ?>>E</option>
        </select>
    </td>
</tr>
<?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="4" class="empty-state">Mahasiswa ini belum mengambil KRS.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-submit">Simpan Semua Nilai</button>
        </div>
    </form>
</div>

<?php 
// PERBAIKAN: Cukup naik satu level (../)
require_once(__DIR__ . "/../layout/_footer.php"); 
?>