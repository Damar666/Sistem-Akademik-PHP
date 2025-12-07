<?php
// ua/view/krs/khs.php
$judul_halaman = "Kartu Hasil Studi (KHS)";

// PERBAIKAN: Cukup naik satu level (../)
require_once(__DIR__ . "/../layout/_header.php");

// Fungsi Sederhana: Konversi Huruf ke Angka (Bobot)
function hitungBobot($huruf) {
    switch (strtoupper($huruf)) {
        case 'A': return 4.0;
        case 'B': return 3.0;
        case 'C': return 2.0;
        case 'D': return 1.0;
        default: return 0.0;
    }
}
?>

<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-book-open"></i> Kartu Hasil Studi (Nilai)</h2>
        <a href="index.php?page=dashboard" class="btn-back"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-left: 5px solid #2ecc71;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 150px; font-weight: bold; padding: 5px; color: #555;">Nama</td>
                <td>: <strong><?php echo htmlspecialchars($mhs['nama']); ?></strong></td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 5px; color: #555;">NPM</td>
                <td>: <?php echo htmlspecialchars($mhs['npm']); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 5px; color: #555;">Prodi</td>
                <td>: <?php echo htmlspecialchars($mhs['nama_prodi'] ?? '-'); ?></td>
            </tr>
        </table>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Bobot</th>
                    <th>Mutu (SKS x Bobot)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_sks = 0;
                $total_mutu = 0;
                $no = 1;
                
                if (!empty($krs_data)) : 
                    foreach ($krs_data as $row) : 
                        $nilai_huruf = $row['nilai'] ?? '-'; 
                        $bobot = ($nilai_huruf == '-') ? 0 : hitungBobot($nilai_huruf);
                        $mutu = $row['sks'] * $bobot;
                        
                        if ($nilai_huruf != '-' && $nilai_huruf != '') {
                            $total_sks += $row['sks'];
                            $total_mutu += $mutu;
                        }
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['kode_mk']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                    <td><?php echo htmlspecialchars($row['sks']); ?></td>
                    
                    <td style="font-weight: bold; color: #2ecc71; font-size: 1.1em;">
                        <?php echo $nilai_huruf; ?>
                    </td>
                    
                    <td><?php echo $bobot; ?></td>
                    <td><?php echo $mutu; ?></td>
                </tr>
                <?php endforeach; ?>
                
                <tr style="background-color: #f8f9fa; font-weight: bold; border-top: 2px solid #ddd;">
                    <td colspan="3" style="text-align: right;">Total:</td>
                    <td style="color: #2c3e50;"><?php echo $total_sks; ?></td>
                    <td></td>
                    <td></td>
                    <td style="color: #2c3e50;"><?php echo $total_mutu; ?></td>
                </tr>
                
                <tr style="background-color: #2c3e50; color: white;">
                    <td colspan="6" style="text-align: right; padding: 15px; font-size: 1.2rem;">Indeks Prestasi (IP):</td>
                    <td style="padding: 15px; font-size: 1.5rem; font-weight: bold; color: #2ecc71;">
                        <?php 
                        $ipk = ($total_sks > 0) ? ($total_mutu / $total_sks) : 0;
                        echo number_format($ipk, 2); 
                        ?>
                    </td>
                </tr>

                <?php else : ?>
                <tr>
                    <td colspan="7" class="empty-state">
                        <i class="fas fa-file-alt" style="font-size: 40px; color: #ddd; margin-bottom: 10px;"></i>
                        <p>Belum ada mata kuliah yang diambil atau dinilai.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
// PERBAIKAN: Cukup naik satu level (../)
require_once(__DIR__ . "/../layout/_footer.php"); 
?>