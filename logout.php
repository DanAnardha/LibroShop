<?php
    session_start(); // Mulai sesi
    // Hapus semua data sesi
    session_unset();
    // Hancurkan sesi
    session_destroy();
    // Alihkan pengguna kembali ke halaman login atau halaman lain jika diperlukan
    header("Location: index.php"); // Gantilah "login.php" dengan halaman tujuan Anda
    exit();
?>