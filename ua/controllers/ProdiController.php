<?php
// ua/controllers/ProdiController.php

// Panggil file Model yang kita butuhkan
require_once(__DIR__ . "/../models/Prodi.php");

// OTORISASI: (Sama seperti User, hanya level 10)
function checkProdiAccess() {
    if (!isset($_SESSION['level']) || $_SESSION['level'] != '10') {
        die("Akses Ditolak. Anda bukan Super Admin. 
             <br><a href='index.php'>Kembali ke Halaman Utama</a>");
    }
}

// MENAMPILKAN DAFTAR
function listProdi() {
    $prodi = getAllProdi();
    require(__DIR__ . "/../view/prodi/list.php");
}

// MENAMPILKAN FORM TAMBAH
function showAddProdiForm() {
    require(__DIR__ . "/../view/prodi/form_tambah.php");
}

// MENYIMPAN DATA BARU
function saveProdi() {
    $data = ['nama_prodi'  => $_POST['nama_prodi']];
    createProdi($data);
    header("Location: index.php?page=prodi");
    exit;
}

// MENAMPILKAN FORM EDIT
function showEditProdiForm($id) {
    $prodi = getProdiById($id);
    require(__DIR__ . "/../view/prodi/form_edit.php");
}

// MENGUPDATE DATA
function updateProdi() {
    $id = $_POST['idprodi'];
    $data = ['nama_prodi'  => $_POST['nama_prodi']];
    updateProdiInDatabase($id, $data);
header("Location: index.php?page=prodi");
}

// MENGHAPUS DATA
function deleteProdi($id) {
    deleteProdiById($id);
header("Location: index.php?page=prodi");
}
?>