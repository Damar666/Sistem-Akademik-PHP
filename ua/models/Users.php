<?php
// ua/models/User.php

// Panggil file koneksi
// Kita naik 2 level (dari models/ -> ua/ -> pbd/) lalu masuk ke sistem/
require_once(__DIR__ . "/../../sistem/koneksi.php");

// Fungsi untuk MENGAMBIL SEMUA user (READ)
function getAllUsers() {
    $hub = open_connection();
    $query = mysqli_query($hub, "SELECT * FROM user ORDER BY iduser ASC");
    $users = [];
    while ($user = mysqli_fetch_array($query)) {
        $users[] = $user;
    }
    mysqli_close($hub);
    return $users;
}

// Fungsi untuk MENGAMBIL SATU user (READ by ID)
function getUserById($id) {
    $hub = open_connection();
    // PERINGATAN: Ini masih rentan SQL Injection
    $query = mysqli_query($hub, "SELECT * FROM user WHERE iduser = $id");
    $user = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $user;
}

// Fungsi untuk MEMBUAT user baru (CREATE)
function createUser($data) {
    $hub = open_connection();
    
    // Ambil data dari array
    $username  = $data['username'];
    $password  = $data['password']; // Masih plain text sesuai kode lama
    $jenisuser = $data['jenisuser'];
    $level     = $data['level'];
    $status    = $data['status'];
    $idprodi   = $data['idprodi'];

    // Kueri insert
    // PERINGATAN: Ini masih rentan SQL Injection
    $sql = "INSERT INTO user (username, password, jenisuser, level, status, idprodi) 
            VALUES ('$username', '$password', '$jenisuser', '$level', '$status', '$idprodi')";
    
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

// Fungsi untuk MENGUPDATE user (UPDATE)
function updateUserInDatabase($id, $data) {
    // SEMUA KODE HARUS ADA DI DALAM SINI
    $hub = open_connection();
    
    // Ambil data dari array
    $username  = $data['username'];
    $password  = $data['password'];
    $jenisuser = $data['jenisuser'];
    $level     = $data['level'];
    $status    = $data['status'];
    $idprodi   = $data['idprodi'];

    // Kueri update
    // PERINGATAN: Ini masih rentan SQL Injection
    $sql = "UPDATE user SET 
                username='$username', 
                password='$password', 
                jenisuser='$jenisuser', 
                level='$level', 
                status='$status', 
                idprodi='$idprodi' 
            WHERE iduser='$id'";
            
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
} // <-- FUNGSI SEHARUSNYA DITUTUP DI SINI
// Fungsi untuk MENGHAPUS user (DELETE)
function deleteUserById($id) {
    $hub = open_connection();
    // PERINGATAN: Ini masih rentan SQL Injection
    $result = mysqli_query($hub, "DELETE FROM user WHERE iduser = $id");
    mysqli_close($hub);
    return $result;
}
?>