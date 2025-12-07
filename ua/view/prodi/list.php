<?php
// ua/view/prodi/list.php

// Set judul halaman
$judul_halaman = "Kelola Data Prodi";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN PRODI LIST -->
<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-university"></i> Manajemen Data Prodi</h2>
    </div>
    
    <div class="crud-info">
        <i class="fas fa-info-circle"></i>
        Di sini Anda bisa menambah, mengubah, dan menghapus data program studi. |
        <a href="index.php?page=dashboard"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>

    <a href="index.php?page=prodi_tambah" class="btn btn-add">
        <i class="fas fa-plus-circle"></i> Tambah Prodi Baru
    </a>

    <table>
        <thead>
            <tr>
                <th>ID Prodi</th>
                <th>Nama Program Studi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($prodi)) : ?>
                <?php foreach ($prodi as $p) : ?>
                <tr>
                    <td>
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                            #<?php echo htmlspecialchars($p['idprodi']); ?>
                        </span>
                    </td>
                    <td>
                        <strong style="color: #1f2937;">
                            <i class="fas fa-graduation-cap" style="color: #667eea;"></i>
                            <?php echo htmlspecialchars($p['nama_prodi']); ?>
                        </strong>
                    </td>
                    <td>
                        <a href="index.php?page=prodi_edit&id=<?php echo $p['idprodi']; ?>" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="index.php?page=prodi_hapus&id=<?php echo $p['idprodi']; ?>" class="btn btn-delete" 
                           onclick="return confirm('⚠️ Yakin ingin menghapus prodi <?php echo htmlspecialchars($p['nama_prodi']); ?>?\n\nData yang dihapus tidak dapat dikembalikan!')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3" class="empty-state" style="text-align: center; padding: 60px 20px;">
                        <i class="fas fa-inbox" style="font-size: 48px; color: #d1d5db; margin-bottom: 10px; display: block;"></i>
                        <p style="color: #6b7280; margin: 0;">Belum ada data prodi. Silakan tambah prodi baru.</p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
// Include footer
include __DIR__ . '/../layout/_footer.php';
?>