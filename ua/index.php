<?php
// ua/index.php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// ==========================================================
// 1. PANGGIL SEMUA CONTROLLER
// ==========================================================
require_once("controllers/UserController.php");
require_once("controllers/ProdiController.php");
require_once("controllers/MahasiswaController.php");
require_once("controllers/KrsController.php"); // <-- Tambahkan ini di atas
require_once("controllers/MatakuliahController.php");


// ==========================================================
// 2. ROUTER SEDERHANA
// ==========================================================
$page = $_GET['page'] ?? 'dashboard'; // Default ke dashboard

// ==========================================================
// 3. OTORISASI (PENJAGA KEAMANAN)
// ==========================================================
// Periksa hak akses SEBELUM menjalankan switch
if (str_starts_with($page, 'user')) {
    checkUserAccess(); // Hanya level 10
}
if (str_starts_with($page, 'prodi')) {
    checkProdiAccess(); // Hanya level 10
}
if (str_starts_with($page, 'mahasiswa')) {
    checkMahasiswaAccess(); // Hanya level 11
}
if (str_starts_with($page, 'matkul')) {
    checkMatkulAccess();
}

// ==========================================================
// 4. SWITCH (PEMBAGI TUGAS)
// --- Rute Mata Kuliah ---

// ==========================================================
switch ($page) {
        case 'matkul': indexMatkul(); break;
    case 'matkul_tambah': createMatkulForm(); break;
    case 'matkul_simpan': storeMatkul(); break;
    case 'matkul_edit': $id=$_GET['id']??0; editMatkulForm($id); break;
    case 'matkul_update': updateMatkulProcess(); break;
    case 'matkul_hapus': $id=$_GET['id']??0; destroyMatkul($id); break;
    // --- Rute User (Level 10) ---
    case 'user':
        listUsers();
        break;
    case 'user_tambah':
        showAddUserForm();
        break;
    case 'user_simpan':
        saveUser();
        break;
    case 'user_edit':
        $id = $_GET['id'] ?? 0;
        showEditUserForm($id);
        break;
    case 'user_update':
        updateUser();
        break;
    case 'user_hapus':
        $id = $_GET['id'] ?? 0;
        deleteUser($id);
        break;
        
    // --- Rute Prodi (Level 10) ---
    case 'prodi':
        listProdi();
        break;
    case 'prodi_tambah':
        showAddProdiForm();
        break;
    case 'prodi_simpan':
        saveProdi();
        break;
    case 'prodi_edit':
        $id = $_GET['id'] ?? 0;
        showEditProdiForm($id);
        break;
    case 'prodi_update':
        updateProdi();
        break;
    case 'prodi_hapus':
        $id = $_GET['id'] ?? 0;
        deleteProdi($id);
        break;

    // --- Rute Mahasiswa (Level 11) ---
    case 'mahasiswa':
        listMahasiswa();
        break;
    case 'mahasiswa_tambah':
        showAddMahasiswaForm();
        break;
    case 'mahasiswa_simpan':
        saveMahasiswa();
        break;
    case 'mahasiswa_edit':
        $id = $_GET['id'] ?? 0;
        showEditMahasiswaForm($id);
        break;
    case 'mahasiswa_update':
        updateMahasiswa();
        break;
    case 'mahasiswa_hapus':
        $id = $_GET['id'] ?? 0;
        deleteMahasiswa($id);
        break;
        // --- Rute Profil (Mahasiswa) ---
    case 'profil':
        myProfile(); // Panggil fungsi di MahasiswaController
        break;
        // --- Rute KRS (Mahasiswa) ---
case 'krs':
    indexKrs();
    break;
case 'krs_simpan':
    simpanKrs();
    break;
case 'krs_hapus':
    $id = $_GET['id'] ?? 0;
    deleteKrs($id);
    break;
// --- Rute Input Nilai (Admin) ---
    case 'krs_input': 
        $id = $_GET['id'];
        formInputNilai($id); // Panggil fungsi Controller
        break;
        
    case 'krs_simpan_nilai':
        prosesInputNilai();
        break;
    // --- Rute KHS (Lihat Nilai) ---
    case 'khs':
        viewKhs(); // Pastikan baris ini ada!
        break;
    // --- Rute Dashboard (Default) ---
   case 'dashboard':
default:
    include 'view/dashboard.php';  // Path ke folder view
    break;
}
?>