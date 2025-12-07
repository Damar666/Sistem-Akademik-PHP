<?php
// ua/view/layout/_header.php

// Deteksi base path secara otomatis
$script_path = dirname($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul_halaman ?? 'Sistem Akademik'; ?></title>
    
    <link rel="stylesheet" href="<?php echo $script_path; ?>/view/assets/dashboard.css">
    <link rel="stylesheet" href="<?php echo $script_path; ?>/view/assets/crud.css">
    <link rel="stylesheet" href="<?php echo $script_path; ?>/view/assets/login.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Fallback CSS untuk memastikan layout benar */
        body { 
            margin: 0; 
            padding: 0; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar { 
            width: 100%; 
            position: relative;
        }
        .main-content { 
            flex: 1; 
            width: 100%;
        }
        .footer { 
            width: 100%; 
            margin-top: auto;
        }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-left">
                <p class="logo">Sistem Akademik</p>
            </div>
            <div class="navbar-right">
                <span class="user-info">
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </span>
                <a href="sistem.php?op=out" class="logout-button">Log Out</a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="content-container">