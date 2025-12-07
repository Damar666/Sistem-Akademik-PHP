<?php
$judul_halaman = "Kelola Mata Kuliah";
require_once(__DIR__ . "/../layout/_header.php");
?>

<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-book"></i> Manajemen Mata Kuliah</h2>
        <a href="index.php?page=dashboard" class="btn-back"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <a href="index.php?page=matkul_tambah" class="btn btn-add">
        <i class="fas fa-plus-circle"></i> Tambah Matkul Baru
    </a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($matkul)) : ?>
                    <?php $no = 1; foreach ($matkul as $row) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['kode_mk']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                        <td><?php echo htmlspecialchars($row['sks']); ?></td>
                        <td>
                            <a href="index.php?page=matkul_edit&id=<?php echo $row['idmatakuliah']; ?>" class="btn-aksi btn-edit">Edit</a>
                            <a href="index.php?page=matkul_hapus&id=<?php echo $row['idmatakuliah']; ?>" class="btn-aksi btn-delete" 
                               onclick="return confirm('Hapus matkul ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="5" class="empty-state">Belum ada mata kuliah.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once(__DIR__ . "/../layout/_footer.php"); ?>