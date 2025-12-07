<?php
// ua/models/Prodi.php

// Panggil file koneksi
require_once(__DIR__ . "/../../sistem/koneksi.php");

function getAllProdi() {
    $hub = open_connection();
    $query = mysqli_query($hub, "SELECT * FROM prodi ORDER BY idprodi ASC");
    $prodi = [];
    while ($p = mysqli_fetch_array($query)) {
        $prodi[] = $p;
    }
    mysqli_close($hub);
    return $prodi;
}

function getProdiById($id) {
    $hub = open_connection();
    $query = mysqli_query($hub, "SELECT * FROM prodi WHERE idprodi = $id");
    $prodi = mysqli_fetch_array($query);
    mysqli_close($hub);
    return $prodi;
}

function createProdi($data) {
    $hub = open_connection();
    $nama_prodi = $data['nama_prodi'];
    $sql = "INSERT INTO prodi (nama_prodi) VALUES ('$nama_prodi')";
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

function updateProdiInDatabase($id, $data) {
    $hub = open_connection();
    $nama_prodi = $data['nama_prodi'];
    $sql = "UPDATE prodi SET nama_prodi='$nama_prodi' WHERE idprodi='$id'";
    $result = mysqli_query($hub, $sql);
    mysqli_close($hub);
    return $result;
}

function deleteProdiById($id) {
    $hub = open_connection();
    $result = mysqli_query($hub, "DELETE FROM prodi WHERE idprodi = $id");
    mysqli_close($hub);
    return $result;
}
?>