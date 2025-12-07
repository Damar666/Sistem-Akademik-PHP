<?php
// ua/models/Mahasiswa.php

// Panggil file koneksi
require_once(__DIR__ . "/../../sistem/koneksi.php");

// MENGAMBIL SEMUA mhs BERDASARKAN PRODI ADMIN (READ)
function getAllMahasiswaByProdi($idprodi_admin) {
    $hub = open_connection();
    $query = mysqli_query($hub, "SELECT * FROM MAHASISWA WHERE idprodi = $idprodi_admin ORDER BY idmhs ASC");
    $mahasiswa = [];
    while ($m = mysqli_fetch_array($query)) {
        $mahasiswa[] = $m;
    }
    mysqli_close($hub);
    return $mahasiswa;
}

// MENGAMBIL SATU mhs BERDASARKAN PRODI ADMIN (READ by ID)
function getMahasiswaById($id, $idprodi_admin) {
    $hub = open_connection();
    $query = mysqli_query($hub, "SELECT * FROM MAHASISWA WHERE idmhs = $id AND idprodi = $idprodi_admin");
    $mhs = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $mhs;
}
// FUNGSI UPDATE: Ambil data mahasiswa LENGKAP dengan nama PRODI
function getMahasiswaByNpm($npm) {
    $hub = open_connection();
    
    // Kita gunakan JOIN agar dapat 'nama_prodi'
    // m.* artinya ambil semua data mahasiswa
    // p.nama_prodi artinya ambil kolom nama dari tabel prodi
    $sql = "SELECT m.*, p.nama_prodi 
            FROM MAHASISWA m 
            LEFT JOIN prodi p ON m.idprodi = p.idprodi 
            WHERE m.npm = '$npm'";
            
    $query = mysqli_query($hub, $sql);
    $data = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $data;
}
// MEMBUAT mhs baru (CREATE)
function createMahasiswa($data, $idprodi_admin) {
    $hub = open_connection();
    
    $npm  = $data['npm'];
    $nama = $data['nama'];
    // idprodi diambil dari session admin, bukan dari form
    
    $sql = "INSERT INTO MAHASISWA (npm, nama, idprodi) 
            VALUES ('$npm', '$nama', '$idprodi_admin')";
    
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

// MENGUPDATE mhs (UPDATE)
function updateMahasiswaInDatabase($id, $data, $idprodi_admin) {
    $hub = open_connection();
    
    $npm  = $data['npm'];
    $nama = $data['nama'];

    // Admin hanya bisa update mhs di prodinya sendiri
    $sql = "UPDATE MAHASISWA SET 
                npm='$npm', 
                nama='$nama'
            WHERE idmhs='$id' AND idprodi='$idprodi_admin'";
            
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

// MENGHAPUS mhs (DELETE)
function deleteMahasiswaById($id, $idprodi_admin) {
    $hub = open_connection();
    // Admin hanya bisa delete mhs di prodinya sendiri
    $result = mysqli_query($hub, "DELETE FROM MAHASISWA WHERE idmhs = $id AND idprodi = $idprodi_admin");
    mysqli_close($hub);
    return $result;
}
// FUNGSI BARU: Ambil data mahasiswa LENGKAP dengan nama PRODI
function getProfilLengkap($npm) {
    $hub = open_connection();
    // Kita gunakan JOIN agar dapat nama_prodi, bukan cuma idprodi
    $sql = "SELECT m.*, p.nama_prodi 
            FROM MAHASISWA m 
            JOIN prodi p ON m.idprodi = p.idprodi 
            WHERE m.npm = '$npm'";
            
    $query = mysqli_query($hub, $sql);
    $data = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $data;
}
?>