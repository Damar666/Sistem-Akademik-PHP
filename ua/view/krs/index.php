<?php
// ua/view/krs/index.php
$judul_halaman = "Kartu Rencana Studi";
require_once(__DIR__ . "/../layout/_header.php");
?>

<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-calendar-alt"></i> Kartu Rencana Studi (KRS)</h2>
        <a href="index.php?page=dashboard" class="btn-back"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div class="form-container" style="margin-bottom: 2rem;">
        <form action="index.php?page=krs_simpan" method="POST" style="display: flex; gap: 10px; align-items: flex-end;">
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label>Pilih Mata Kuliah:</label>
                <select name="idmatakuliah" required>
                    <option value="">-- Pilih Matkul --</option>
                    <?php foreach ($daftar_matkul as $mk) : ?>
                        <option value="<?php echo $mk['idmatakuliah']; ?>">
                            <?php echo $mk['kode_mk'] . " - " . $mk['nama_mk'] . " (" . $mk['sks'] . " SKS)"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-submit" style="padding: 0.8rem 1.5rem; height: 46px;">
                <i class="fas fa-plus"></i> Ambil
            </button>
        </form>
    </div>

    <div class="table-container">
        <h3>Mata Kuliah yang Diambil</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_sks = 0;
                $no = 1;
                if (!empty($krs_data)) : 
                    foreach ($krs_data as $row) : 
                        $total_sks += $row['sks'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['kode_mk']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                    <td><?php echo htmlspecialchars($row['sks']); ?></td>
                    <td>
                        <a href="index.php?page=krs_hapus&id=<?php echo $row['idkrs']; ?>" class="btn-aksi btn-delete" 
                           onclick="return confirm('Batalkan mata kuliah ini?')">
                           <i class="fas fa-trash"></i> Batal
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr style="background-color: #eef2f7; font-weight: bold;">
                    <td colspan="3" style="text-align: right;">Total SKS:</td>
                    <td colspan="2" style="color: #2c3e50;"><?php echo $total_sks; ?></td>
                </tr>
                
                <?php else : ?>
                <tr>
                    <td colspan="5" class="empty-state">Belum ada mata kuliah yang diambil.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once(__DIR__ . "/../layout/_footer.php"); ?>