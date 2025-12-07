<?php
// ua/controllers/MahasiswaController.php

// Panggil file Model yang kita butuhkan
require_once(__DIR__ . "/../models/Mahasiswa.php");

// OTORISASI: (Hanya level 11)
function checkMahasiswaAccess() {
    if (!isset($_SESSION['level']) || $_SESSION['level'] != '11') {
        die("Akses Ditolak. Anda bukan Admin Prodi. 
             <br><a href='index.php'>Kembali ke Halaman Utama</a>");
    }
    // Pastikan admin ini punya idprodi di session
    if (!isset($_SESSION['idprodi']) || $_SESSION['idprodi'] == 0) {
        die("Error: Akun Admin Anda tidak terhubung ke Prodi manapun. 
             <br><a href='index.php'>Kembali</a>");
    }
}

// MENAMPILKAN DAFTAR
function listMahasiswa() {
    $idprodi_admin = $_SESSION['idprodi']; // Ambil idprodi admin
    $mahasiswa = getAllMahasiswaByProdi($idprodi_admin); // Kirim ke model
    require(__DIR__ . "/../view/mahasiswa/list.php");
}

// MENAMPILKAN FORM TAMBAH
function showAddMahasiswaForm() {
    require(__DIR__ . "/../view/mahasiswa/form_tambah.php");
}

// MENYIMPAN DATA BARU
function saveMahasiswa() {
    $idprodi_admin = $_SESSION['idprodi'];
    $data = [
        'npm'  => $_POST['npm'],
        'nama' => $_POST['nama']
    ];
    createMahasiswa($data, $idprodi_admin); // Kirim data & idprodi ke model
 header("Location: index.php?page=mahasiswa");
    exit;
}

// MENAMPILKAN FORM EDIT
function showEditMahasiswaForm($id) {
    $idprodi_admin = $_SESSION['idprodi'];
    $mhs = getMahasiswaById($id, $idprodi_admin); // Cek data + prodi
    if (!$mhs) {
        die("Error: Data mahasiswa tidak ditemukan atau bukan dari prodi Anda.");
    }
    require(__DIR__ . "/../view/mahasiswa/form_edit.php");
}

// MENGUPDATE DATA
function updateMahasiswa() {
    $idprodi_admin = $_SESSION['idprodi'];
    $id = $_POST['idmhs'];
    $data = [
        'npm'  => $_POST['npm'],
        'nama' => $_POST['nama']
    ];
    updateMahasiswaInDatabase($id, $data, $idprodi_admin); // Kirim data & idprodi
  header("Location: index.php?page=mahasiswa");
    exit;
}

// MENGHAPUS DATA
function deleteMahasiswa($id) {
    $idprodi_admin = $_SESSION['idprodi'];
    deleteMahasiswaById($id, $idprodi_admin); // Kirim id & idprodi
 header("Location: index.php?page=mahasiswa");
    exit;
}
// MENAMPILKAN HALAMAN PROFIL SAYA (Untuk Client/Mahasiswa)
function myProfile() {
    // Ambil NPM dari session login
    $npm = $_SESSION['username'];
    
    // Ambil data lengkap dari Model
    $mhs = getProfilLengkap($npm);
    
    // Tampilkan View
    require(__DIR__ . "/../view/mahasiswa/profil.php");
}
?>