<?php
// pbd/sistem/koneksi.php

function open_connection() {
    
    // Mengarah ke Server TIER 3 (Docker)
    $host = "127.0.0.1";     // <-- Gunakan IP, lebih jelas
    $port = 3307;            // <-- Arahkan ke Port Docker
    $username = "root";
    $password = "rahasia";     // <-- Password dari perintah Docker
    $database = "AKADEMIK";
    
    // Tambahkan parameter $port ke fungsi mysqli_connect
    $hub = mysqli_connect($host, $username, $password, $database, $port);

    // Tes koneksi
    if (!$hub) {
        die("KONEKSI GAGAL ke TIER 3 (Port 3307): " . mysqli_connect_error());
    }
    
    return $hub;
}
?>