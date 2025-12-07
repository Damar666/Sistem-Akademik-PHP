<?php
// ua/controllers/KrsController.php
require_once(__DIR__ . "/../models/Krs.php");
// PENTING: Kita butuh model Mahasiswa untuk mengambil data profil ($mhs)
require_once(__DIR__ . "/../models/Mahasiswa.php"); 

// Halaman Utama KRS (Isi KRS)
function indexKrs() {
    $npm = $_SESSION['username'];
    
    $mhs = getMahasiswaByNpm($npm);
    if (!$mhs) {
        die("Error: Data Mahasiswa tidak ditemukan. Pastikan NPM Anda terdaftar.");
    }

    $idmhs = $mhs['idmhs'];
    $idprodi = $mhs['idprodi'];

    $krs_data = getKrsByMhs($idmhs);
    $daftar_matkul = getAllMatakuliahByProdi($idprodi);

    require(__DIR__ . "/../view/krs/index.php");
}

// Proses Tambah KRS
function simpanKrs() {
    $npm = $_SESSION['username'];
    $mhs = getMahasiswaByNpm($npm);
    $idmhs = $mhs['idmhs'];
    
    $idmatakuliah = $_POST['idmatakuliah'];

    tambahKrs($idmhs, $idmatakuliah);
    
    header("Location: index.php?page=krs");
    exit;
}

// Proses Hapus KRS
function deleteKrs($id) {
    hapusKrs($id);
    header("Location: index.php?page=krs");
    exit;
}

// ---------------------------------------------------------
// BAGIAN INI YANG KEMARIN KURANG/SALAH
// ---------------------------------------------------------

// MENAMPILKAN HALAMAN NILAI (KHS)
function viewKhs() {
    $npm = $_SESSION['username'];
    
    // 1. Ambil Data Mahasiswa (INI YANG TADINYA HILANG)
    // Variabel $mhs ini yang akan dipakai di view khs.php
    $mhs = getMahasiswaByNpm($npm); 
    
    if (!$mhs) {
        die("Error: Data Mahasiswa tidak ditemukan.");
    }
    
    $idmhs = $mhs['idmhs'];

    // 2. Ambil data KRS beserta NILAI-nya
    $krs_data = getKrsByMhs($idmhs);

    // 3. Tampilkan View KHS
    require(__DIR__ . "/../view/krs/khs.php");
}

// MENAMPILKAN FORM INPUT NILAI (Khusus Admin)
function formInputNilai($idmhs) {
    if ($_SESSION['level'] != '11') { die("Akses Ditolak"); }

    // Kita butuh data mahasiswa untuk judul
    // Gunakan fungsi getMahasiswaById dari model Mahasiswa
    // Pastikan session idprodi admin sesuai
    $mhs = getMahasiswaById($idmhs, $_SESSION['idprodi']);
    
    if (!$mhs) {
        die("Data mahasiswa tidak ditemukan.");
    }
    
    $krs_data = getKrsByMhs($idmhs);

    require(__DIR__ . "/../view/krs/input_nilai.php");
}

// MENYIMPAN NILAI KE DATABASE
function prosesInputNilai() {
    $nilai_array = $_POST['nilai']; 
    $idmhs = $_POST['idmhs'];

    foreach ($nilai_array as $idkrs => $nilai) {
        updateNilaiKrs($idkrs, $nilai);
    }

    // Redirect kembali ke form input nilai mahasiswa tersebut
    header("Location: index.php?page=krs_input&id=$idmhs"); 
    exit;
}
?>