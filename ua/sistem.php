<?php
session_start();
// Sesuaikan path koneksi Anda
require("../sistem/koneksi.php"); 

$hub = open_connection();
if (!$hub) { die("KONEKSI GAGAL: Cek koneksi.php"); }

$op = $_GET['op'];

if ($op == "in") {
    $usr = $_POST['usr'];
    $psw = $_POST['psw'];

    // 1. Cek Username dan Password
    $cek = mysqli_query($hub, "SELECT * FROM user WHERE username='$usr' AND password='$psw'");
    
    if (mysqli_num_rows($cek) == 1) {
        $c = mysqli_fetch_array($cek);
        
        // ========================================================
        // LOGIKA BARU: CEK STATUS & WAKTU (1 MENIT)
        // ========================================================
        
        // Hitung selisih waktu dari login terakhir
        $waktu_terakhir = strtotime($c['last_login']); 
        $waktu_sekarang = time(); 
        $selisih_detik  = $waktu_sekarang - $waktu_terakhir;

        $izinkan_masuk = false;

        // KONDISI 1: Jika status 'F' (Offline), pasti boleh masuk
        if ($c['status'] == 'F') {
            $izinkan_masuk = true;
        } 
        // KONDISI 2: Jika status 'T' TAPI sudah lewat 60 detik (1 menit)
        // (Ini pengaman biar ga nyangkut selamanya kalau lupa logout)
        else if ($selisih_detik > 60) {
            $izinkan_masuk = true; 
        }

        if ($izinkan_masuk) {
            // --- PROSES LOGIN SUKSES ---
            $_SESSION['username'] = $c['username'];
            $_SESSION['jenisuser'] = $c['jenisuser'];
            $_SESSION['level'] = $c['level'];
            $_SESSION['idprodi'] = $c['idprodi'];

            // Update status jadi 'T' DAN update waktu login (PENTING!)
            mysqli_query($hub, "UPDATE user SET status='T', last_login=NOW() WHERE iduser=" . $c['iduser']);
            
            mysqli_close($hub);
            header("location:index.php"); 

        } else {
            // --- PROSES LOGIN DITOLAK ---
            // Jika status 'T' dan belum lewat 1 menit
            mysqli_close($hub);
            $sisa_waktu = 60 - $selisih_detik;
            die("<div style='font-family: sans-serif; padding: 20px; text-align: center; margin-top: 50px;'>
                    <h3 style='color: #e74c3c;'>Login Gagal!</h3>
                    <p>Akun ini sedang aktif di perangkat lain.</p>
                    <p>Mohon tunggu <b>$sisa_waktu detik</b> lagi agar sesi otomatis kadaluarsa.</p>
                    <a href=\"javascript:history.back()\" style='padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px;'>Kembali</a>
                 </div>");
        }

    } else {
        // Username/Password Salah
        mysqli_close($hub);
        die("<div style='font-family: sans-serif; padding: 20px; text-align: center; margin-top: 50px;'>
                <h3 style='color: #e74c3c;'>Login Gagal!</h3>
                <p>Username atau Password salah.</p>
                <a href=\"javascript:history.back()\" style='padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px;'>Kembali</a>
             </div>");
    }

} else if ($op == "out") {
    
    // Saat Logout, kembalikan status jadi 'F'
    if (isset($_SESSION['username'])) {
        $usr_logout = $_SESSION['username'];
        mysqli_query($hub, "UPDATE user SET status='F' WHERE username='$usr_logout'");
    }
    
    // Hapus sesi
    session_unset();
    session_destroy();
    
    mysqli_close($hub);
    header("location:login.php");
}
?>