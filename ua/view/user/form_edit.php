<?php
// ua/view/user/form_edit.php

// Set judul halaman
$judul_halaman = "Edit User";

// Include header
include __DIR__ . '/../layout/_header.php';
?>

<!-- KONTEN HALAMAN FORM EDIT USER -->
<div class="form-container">
    <div class="form-header">
        <h2>
            <i class="fas fa-user-edit"></i> Edit User: 
            <span style="color: #667eea;"><?php echo htmlspecialchars($user['username']); ?></span>
        </h2>
    </div>
    
    <a href="index.php?page=user" class="form-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
    </a>
    
    <form action="index.php?page=user_update" method="POST">
        
        <input type="hidden" name="iduser" value="<?php echo $user['iduser']; ?>">
        
        <div class="form-group">
            <label for="username">
                <i class="fas fa-user"></i> Username <span style="color: red;">*</span>
            </label>
            <input type="text" id="username" name="username" 
                   value="<?php echo htmlspecialchars($user['username']); ?>" 
                   placeholder="Masukkan username" required>
        </div>
        
        <div class="form-group">
            <label for="password">
                <i class="fas fa-lock"></i> Password <span style="color: red;">*</span>
            </label>
            <input type="password" id="password" name="password" 
                   value="<?php echo htmlspecialchars($user['password']); ?>" 
                   placeholder="Masukkan password" required>
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Password disimpan dalam plain text (sesuai BPP)
            </small>
        </div>
        
        <div class="form-group">
            <label for="jenisuser">
                <i class="fas fa-tag"></i> Jenis User
            </label>
            <select id="jenisuser" name="jenisuser" required>
                <option value="0" <?php if($user['jenisuser'] == '0') echo 'selected'; ?>>
                    0 - Client (User Biasa)
                </option>
                <option value="1" <?php if($user['jenisuser'] == '1') echo 'selected'; ?>>
                    1 - Admin
                </option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="level">
                <i class="fas fa-layer-group"></i> Level Akses
            </label>
            <select id="level" name="level" required>
                <option value="00" <?php if($user['level'] == '00') echo 'selected'; ?>>
                    00 - Client (User Biasa)
                </option>
                <option value="10" <?php if($user['level'] == '10') echo 'selected'; ?>>
                    10 - Super Admin
                </option>
                <option value="11" <?php if($user['level'] == '11') echo 'selected'; ?>>
                    11 - Admin Prodi
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">
                <i class="fas fa-toggle-on"></i> Status
            </label>
            <select id="status" name="status" required>
                <option value="F" <?php if($user['status'] == 'F') echo 'selected'; ?>>
                    F - Offline (Nonaktif)
                </option>
                <option value="T" <?php if($user['status'] == 'T') echo 'selected'; ?>>
                    T - Online (Aktif)
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="idprodi">
                <i class="fas fa-university"></i> ID Prodi
            </label>
            <input type="number" id="idprodi" name="idprodi" 
                   value="<?php echo htmlspecialchars($user['idprodi']); ?>" 
                   min="0" placeholder="0 = Tidak ada prodi">
            <small style="color: #6b7280; display: block; margin-top: 5px;">
                <i class="fas fa-info-circle"></i> Isi dengan 0 jika user tidak terikat dengan prodi tertentu
            </small>
        </div>

        <div class="form-actions">
            <input type="submit" value="💾 Update User">
            <a href="index.php?page=user" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

<?php
// Include footer
include __DIR__ . '/../layout/_footer.php';
?>