<?php
// ua/controllers/UserController.php

// Panggil file Model yang kita butuhkan
require_once(__DIR__ . "/../models/Users.php");

// OTORISASI: Fungsi ini akan kita panggil di router (index.php)
function checkUserAccess() {
    if (!isset($_SESSION['level']) || $_SESSION['level'] != '10') {
        die("Akses Ditolak. Anda bukan Super Admin. 
             <br><a href='index.php'>Kembali ke Halaman Utama</a>");
    }
}

// Fungsi ini akan MENAMPILKAN DAFTAR user
function listUsers() {
    // 1. Minta data ke Model (Koki)
    $users = getAllUsers();
    
    // 2. Tampilkan datanya ke View (Tampilan)
    require(__DIR__ . "/../view/user/list.php");
}

// Fungsi ini akan MENAMPILKAN FORM TAMBAH
function showAddUserForm() {
    // Tampilkan View form tambah
    require(__DIR__ . "/../view/user/form_tambah.php");
}

// Fungsi ini akan MENYIMPAN user baru
function saveUser() {
    // Ambil semua data dari form
    $data = [
        'username'  => $_POST['username'],
        'password'  => $_POST['password'], // Masih plain text
        'jenisuser' => $_POST['jenisuser'],
        'level'     => $_POST['level'],
        'status'    => $_POST['status'],
        'idprodi'   => $_POST['idprodi']
    ];
    
    // Kirim data ke Model untuk disimpan
    createUser($data);
    
    // Arahkan kembali ke halaman daftar user
   header("Location: index.php?page=user");
}

// Fungsi ini akan MENAMPILKAN FORM EDIT
function showEditUserForm($id) {
    // 1. Minta data 1 user ke Model
    $user = getUserById($id);
    
    // 2. Tampilkan View form edit (dan kirim data $user ke view)
    require(__DIR__ . "/../view/user/form_edit.php");
}

// Fungsi ini akan MENGUPDATE user
function updateUser() {
    $id = $_POST['iduser'];
    
    // KITA HARUS MENGISI $data DARI FORM (SEPERTI FUNGSI saveUser)
    $data = [
        'username'  => $_POST['username'],
        'password'  => $_POST['password'], // Masih plain text
        'jenisuser' => $_POST['jenisuser'],
        'level'     => $_POST['level'],
        'status'    => $_POST['status'],
        'idprodi'   => $_POST['idprodi']
    ];
    
    // Kirim data ke Model untuk diupdate
    updateUserInDatabase($id, $data); 

    header("Location: index.php?page=user");
}

// Fungsi ini akan MENGHAPUS user
function deleteUser($id) {
    // 1. Minta Model untuk menghapus data
    deleteUserById($id);
    
    // 2. Setelah selesai, arahkan kembali ke daftar user
header("Location: index.php?page=user");
}
?>