<?php
// ua/view/user/list.php

// Set judul halaman
$judul_halaman = "Kelola Data User";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN USER LIST -->
<div class="crud-container">
    <div class="crud-header">
        <h2><i class="fas fa-users"></i> Manajemen Data User</h2>
    </div>
    
    <div class="crud-info">
        <i class="fas fa-info-circle"></i>
        <a href="index.php?page=dashboard"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>

    <a href="index.php?page=user_tambah" class="btn btn-add">
        <i class="fas fa-plus-circle"></i> Tambah User Baru
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Jenis User</th>
                <th>Level</th>
                <th>Status</th>
                <th>ID Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['iduser']); ?></td>
                    <td><strong><?php echo htmlspecialchars($user['username']); ?></strong></td>
                    <td>
                        <span style="color: #6b7280; font-family: monospace;">
                            <?php echo str_repeat('•', min(strlen($user['password']), 8)); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($user['jenisuser']); ?></td>
                    <td>
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                            Level <?php echo htmlspecialchars($user['level']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($user['status'] == 'active' || $user['status'] == '1') : ?>
                            <span style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                <i class="fas fa-check-circle"></i> Aktif
                            </span>
                        <?php else : ?>
                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                <i class="fas fa-times-circle"></i> Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($user['idprodi'] ?? '-'); ?></td>
                    <td>
                        <a href="index.php?page=user_edit&id=<?php echo $user['iduser']; ?>" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="index.php?page=user_hapus&id=<?php echo $user['iduser']; ?>" class="btn btn-delete" 
                           onclick="return confirm('⚠️ Yakin ingin menghapus user <?php echo htmlspecialchars($user['username']); ?>?\n\nData yang dihapus tidak dapat dikembalikan!')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="fas fa-inbox" style="font-size: 48px; color: #d1d5db; margin-bottom: 10px;"></i>
                        <p style="color: #6b7280; margin: 0;">Belum ada data user. Silakan tambah user baru.</p>
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