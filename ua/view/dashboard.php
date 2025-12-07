<?php
// ua/view/dashboard.php
$judul_halaman = "Dashboard"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul_halaman; ?></title>
    
    <link rel="stylesheet" href="view/assets/dashboard.css">
    <link rel="stylesheet" href="view/assets/crud.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-left">
                <p class="logo">Sistem Akademik</p>
            </div>
            <div class="navbar-right">
                <span class="user-info">
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </span>
                <a href="sistem.php?op=out" class="logout-button">Log Out</a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="content-container">

            <h1 class="dashboard-title">Selamat Datang di Dashboard</h1>
            <p class="dashboard-subtitle">
                Anda login sebagai: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> 
                (Level: <?php echo htmlspecialchars($_SESSION['level']); ?>)
            </p>

            <div class="menu-grid">

                <?php
                if (isset($_SESSION['level'])) :
                    
                    // --- 1. MENU SUPER ADMIN (Level 10) ---
                    if ($_SESSION['level'] == '10') :
                ?>
                        <div class="menu-card">
                            <i class="fas fa-users-cog card-icon" style="color: #3498db;"></i>
                            <h3>Kelola User</h3>
                            <p>Tambah, edit, atau hapus akun user dan admin.</p>
                            <a href="index.php?page=user" class="card-button">Pergi</a>
                        </div>
                        
                        <div class="menu-card">
                            <i class="fas fa-school card-icon" style="color: #e67e22;"></i>
                            <h3>Kelola Prodi</h3>
                            <p>Mengatur daftar program studi di sistem.</p>
                            <a href="index.php?page=prodi" class="card-button">Pergi</a>
                        </div>

                <?php 
                    // --- 2. MENU ADMIN PRODI (Level 11) ---
                    elseif ($_SESSION['level'] == '11') : 
                ?>
                        <div class="menu-card">
                            <i class="fas fa-user-graduate card-icon" style="color: #2ecc71;"></i>
                            <h3>Kelola Mahasiswa</h3>
                            <p>Mengelola data mahasiswa untuk prodi Anda.</p>
                            <a href="index.php?page=mahasiswa" class="card-button">Pergi</a>
                        </div>

                        <div class="menu-card">
                            <i class="fas fa-book card-icon" style="color: #9b59b6;"></i>
                            <h3>Kelola Mata Kuliah</h3>
                            <p>Tambah, edit, dan hapus mata kuliah untuk prodi ini.</p>
                            <a href="index.php?page=matkul" class="card-button">Pergi</a>
                        </div>

                <?php 
                    // --- 3. MENU USER CLIENT / MAHASISWA (Level 00) ---
                    else : 
                        // PANGGIL MODEL MAHASISWA (Untuk ambil nama asli)
                        require_once(__DIR__ . "/../models/Mahasiswa.php");
                        
                        // Cari data mahasiswa berdasarkan NPM (username session)
                        $data_mhs = getMahasiswaByNpm($_SESSION['username']);
                        $nama_lengkap = $data_mhs['nama'] ?? "Mahasiswa";
                ?>
                        <div class="menu-card">
                            <i class="fas fa-user-circle card-icon" style="color: #3498db;"></i>
                            <h3>Profil Saya</h3>
                            
                            <div style="text-align: left; width: 100%; padding: 0 10px;">
                                <p style="margin-bottom: 5px;">
                                    <strong>Nama:</strong> <br> 
                                    <?php echo htmlspecialchars($nama_lengkap); ?>
                                </p>
                                <p style="margin-bottom: 5px;">
                                    <strong>NPM:</strong> <br> 
                                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                                </p>
                                <p>
                                    <strong>Status:</strong> <span style="color: #27ae60; font-weight: bold;">● Aktif</span>
                                </p>
                            </div>
                            
                           <a href="index.php?page=profil" class="card-button">Lihat Detail</a>
                        </div>

                        <div class="menu-card">
                            <i class="fas fa-calendar-alt card-icon" style="color: #e67e22;"></i>
                            <h3>Jadwal & KRS</h3>
                            <p>Lihat jadwal kuliah semester ini dan rencana studi Anda.</p>
                            <a href="index.php?page=krs" class="card-button">Isi KRS</a>
                        </div>

                        <div class="menu-card">
                            <i class="fas fa-book-open card-icon" style="color: #2ecc71;"></i>
                            <h3>Nilai (KHS)</h3>
                            <p>Lihat riwayat nilai dan indeks prestasi (IPK) Anda.</p>
                         <a href="index.php?page=khs" class="card-button">Lihat Nilai</a>
                        </div>

                        <div class="menu-card" style="grid-column: 1 / -1; align-items: flex-start; text-align: left;">
                            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 10px; width: 100%; margin-bottom: 15px;">
                                <i class="fas fa-bullhorn" style="color: #e74c3c; margin-right: 10px;"></i> Pengumuman Terbaru
                            </h3>
                            
                            <div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #3498db; width: 100%; margin-bottom: 10px;">
                                <h4 style="margin: 0 0 5px 0;">📅 Jadwal Ujian Akhir Semester</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #555;">Ujian Akhir Semester (UAS) akan dilaksanakan mulai tanggal 20 Desember. Harap lunasi administrasi.</p>
                            </div>

                            <div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #2ecc71; width: 100%;">
                                <h4 style="margin: 0 0 5px 0;">📢 Libur Perkuliahan</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #555;">Perkuliahan ditiadakan pada hari Jumat dikarenakan hari libur nasional.</p>
                            </div>
                        </div>

                <?php 
                    endif; 
                endif; 
                ?>

            </div> </div> </main> 

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; <?php echo date("Y"); ?> - PBD (Pemrograman Basis Data)</p>
        </div>
    </footer>

</body>
</html>