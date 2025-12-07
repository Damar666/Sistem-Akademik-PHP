<?php
// ua/view/mahasiswa/list.php

// Set judul halaman
$judul_halaman = "Kelola Data Mahasiswa";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-user-graduate"></i> Manajemen Data Mahasiswa</h2>
    </div>
    
    <div class="crud-info">
        <i class="fas fa-info-circle"></i>
        Kelola data mahasiswa di prodi Anda. |
        <a href="index.php?page=dashboard"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>

    <a href="index.php?page=mahasiswa_tambah" class="btn btn-add">
        <i class="fas fa-user-plus"></i> Tambah Mahasiswa Baru
    </a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mahasiswa)) : ?>
                    <?php foreach ($mahasiswa as $m) : ?>
                    <tr>
                        <td>
                            <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                #<?php echo htmlspecialchars($m['idmhs']); ?>
                            </span>
                        </td>
                        <td>
                            <strong style="color: #667eea; font-family: monospace;">
                                <?php echo htmlspecialchars($m['npm']); ?>
                            </strong>
                        </td>
                        <td>
                            <strong style="color: #1f2937;">
                                <i class="fas fa-user" style="color: #10b981; margin-right: 5px;"></i>
                                <?php echo htmlspecialchars($m['nama']); ?>
                            </strong>
                        </td>
                        <td>
                            <a href="index.php?page=krs_input&id=<?php echo $m['idmhs']; ?>" 
                               class="btn-aksi" style="background-color: #9b59b6;">
                                <i class="fas fa-star"></i> Nilai
                            </a>

                            <a href="index.php?page=mahasiswa_edit&id=<?php echo $m['idmhs']; ?>" class="btn-aksi btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <a href="index.php?page=mahasiswa_hapus&id=<?php echo $m['idmhs']; ?>" class="btn-aksi btn-delete" 
                               onclick="return confirm('⚠️ Yakin ingin menghapus mahasiswa <?php echo htmlspecialchars($m['nama']); ?> (NPM: <?php echo htmlspecialchars($m['npm']); ?>)?\n\nData yang dihapus tidak dapat dikembalikan!')">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="empty-state" style="text-align: center; padding: 60px 20px;">
                            <i class="fas fa-user-graduate" style="font-size: 48px; color: #d1d5db; margin-bottom: 10px; display: block;"></i>
                            <p style="color: #6b7280; margin: 0;">Belum ada data mahasiswa. Silakan tambah mahasiswa baru.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div> </div>

<?php
// Include footer
include __DIR__ . '/../layout/_footer.php';
?>