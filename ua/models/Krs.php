<?php
// ua/models/Krs.php
require_once(__DIR__ . "/../../sistem/koneksi.php");

// Fungsi Bantuan: Cari ID Mahasiswa berdasarkan Username (NPM)
function getIdMhsByUsername($username) {
    $hub = open_connection();
    // Asumsi: username di tabel user SAMA DENGAN npm di tabel mahasiswa
    $query = mysqli_query($hub, "SELECT idmhs FROM MAHASISWA WHERE npm = '$username'");
    $result = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $result['idmhs'] ?? null;
}

// Ambil mata kuliah KHUSUS PRODI TERTENTU (Untuk Dropdown)
function getAllMatakuliahByProdi($idprodi) {
    $hub = open_connection();
    
    // Filter: Hanya ambil matkul yang idprodi-nya sama dengan mahasiswa
    $query = mysqli_query($hub, "SELECT * FROM matakuliah WHERE idprodi = '$idprodi' ORDER BY nama_mk ASC");
    
    $data = [];
    while ($row = mysqli_fetch_array($query)) {
        $data[] = $row;
    }
    mysqli_close($hub);
    return $data;
}

// Ambil KRS milik mahasiswa tertentu (READ & KHS)
function getKrsByMhs($idmhs) {
    $hub = open_connection();
    
    // PENTING: Tambahkan 'krs.nilai' di sini agar muncul di KHS
    $sql = "SELECT krs.idkrs, krs.nilai, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks 
            FROM krs 
            JOIN matakuliah ON krs.idmatakuliah = matakuliah.idmatakuliah 
            WHERE krs.idmhs = '$idmhs'";
            
    $query = mysqli_query($hub, $sql);
    $data = [];
    while ($row = mysqli_fetch_array($query)) {
        $data[] = $row;
    }
    mysqli_close($hub);
    return $data;
}

// Tambah KRS (CREATE)
function tambahKrs($idmhs, $idmatakuliah) {
    $hub = open_connection();
    // Cek dulu biar ga ambil matkul yang sama 2 kali
    $cek = mysqli_query($hub, "SELECT * FROM krs WHERE idmhs='$idmhs' AND idmatakuliah='$idmatakuliah'");
    if (mysqli_num_rows($cek) > 0) {
        return false; // Gagal, sudah ambil
    }

    $sql = "INSERT INTO krs (idmhs, idmatakuliah) VALUES ('$idmhs', '$idmatakuliah')";
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

// Hapus KRS (DELETE)
function hapusKrs($idkrs) {
    $hub = open_connection();
    $result = mysqli_query($hub, "DELETE FROM krs WHERE idkrs = '$idkrs'");
    mysqli_close($hub);
    return $result;
}

// Update Nilai Mahasiswa (Input Nilai Admin)
function updateNilaiKrs($idkrs, $nilai) {
    $hub = open_connection();
    $sql = "UPDATE krs SET nilai = '$nilai' WHERE idkrs = '$idkrs'";
    mysqli_query($hub, $sql);
    mysqli_close($hub);
}
?>