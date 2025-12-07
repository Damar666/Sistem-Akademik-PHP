<?php
// ua/models/Matakuliah.php
require_once(__DIR__ . "/../../sistem/koneksi.php");

// Ambil semua matkul SESUAI PRODI (Read)
function getMatkulByProdi($idprodi) {
    $hub = open_connection();
    $query = mysqli_query($hub, "SELECT * FROM matakuliah WHERE idprodi = '$idprodi' ORDER BY nama_mk ASC");
    $data = [];
    while ($row = mysqli_fetch_array($query)) {
        $data[] = $row;
    }
    mysqli_close($hub);
    return $data;
}

// Ambil 1 matkul (untuk Edit)
function getMatkulById($id, $idprodi) {
    $hub = open_connection();
    // Kita pastikan idprodi-nya cocok biar admin lain gak bisa ngintip
    $query = mysqli_query($hub, "SELECT * FROM matakuliah WHERE idmatakuliah = '$id' AND idprodi = '$idprodi'");
    $data = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $data;
}

// Tambah Matkul (Create)
function createMatkul($data, $idprodi) {
    $hub = open_connection();
    $kode = $data['kode_mk'];
    $nama = $data['nama_mk'];
    $sks  = $data['sks'];
    
    // idprodi otomatis dimasukkan di sini
    $sql = "INSERT INTO matakuliah (kode_mk, nama_mk, sks, idprodi) 
            VALUES ('$kode', '$nama', '$sks', '$idprodi')";
            
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

// Update Matkul (Update)
function updateMatkul($id, $data, $idprodi) {
    $hub = open_connection();
    $kode = $data['kode_mk'];
    $nama = $data['nama_mk'];
    $sks  = $data['sks'];
    
    $sql = "UPDATE matakuliah SET kode_mk='$kode', nama_mk='$nama', sks='$sks' 
            WHERE idmatakuliah='$id' AND idprodi='$idprodi'";
            
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

// Hapus Matkul (Delete)
function deleteMatkul($id, $idprodi) {
    $hub = open_connection();
    $result = mysqli_query($hub, "DELETE FROM matakuliah WHERE idmatakuliah='$id' AND idprodi='$idprodi'");
    mysqli_close($hub);
    return $result;
}
?>