<?php
// ua/controllers/MatakuliahController.php
require_once(__DIR__ . "/../models/Matakuliah.php");

// CEK KEAMANAN: Cuma Admin Prodi (Level 11) yang boleh masuk
function checkMatkulAccess() {
    if (!isset($_SESSION['level']) || $_SESSION['level'] != '11') {
        die("Akses Ditolak. Menu ini khusus Admin Prodi.");
    }
}

// Tampilkan Daftar
function indexMatkul() {
    $idprodi = $_SESSION['idprodi']; // <-- INI KUNCINYA (Otomatis deteksi prodi)
    $matkul = getMatkulByProdi($idprodi);
    require(__DIR__ . "/../view/matakuliah/list.php");
}

// Tampilkan Form Tambah
function createMatkulForm() {
    require(__DIR__ . "/../view/matakuliah/form_tambah.php");
}

// Simpan Data
function storeMatkul() {
    $idprodi = $_SESSION['idprodi']; // Ambil prodi admin yang sedang login
    $data = [
        'kode_mk' => $_POST['kode_mk'],
        'nama_mk' => $_POST['nama_mk'],
        'sks'     => $_POST['sks']
    ];
    createMatkul($data, $idprodi);
    header("Location: index.php?page=matkul");
    exit;
}

// Form Edit
function editMatkulForm($id) {
    $idprodi = $_SESSION['idprodi'];
    $mk = getMatkulById($id, $idprodi);
    if (!$mk) die("Data tidak ditemukan atau bukan milik prodi Anda.");
    require(__DIR__ . "/../view/matakuliah/form_edit.php");
}

// Update Data
function updateMatkulProcess() {
    $idprodi = $_SESSION['idprodi'];
    $id = $_POST['idmatakuliah'];
    $data = [
        'kode_mk' => $_POST['kode_mk'],
        'nama_mk' => $_POST['nama_mk'],
        'sks'     => $_POST['sks']
    ];
    updateMatkul($id, $data, $idprodi);
    header("Location: index.php?page=matkul");
    exit;
}

// Hapus Data
function destroyMatkul($id) {
    $idprodi = $_SESSION['idprodi'];
    deleteMatkul($id, $idprodi);
    header("Location: index.php?page=matkul");
    exit;
}
?>