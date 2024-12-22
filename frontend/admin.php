<?php
include('components/header.php');
include('backend/functions.php');

// Define base URL to avoid hardcoding
$baseUrl = "http://localhost:90/UNIBOOKSTORE/index.php?page=admin";
?>

<div class="container">
    <br>
    <!-- Tombol Kelola Penerbit dan Kelola Buku -->
    <div class="d-flex justify-content-center mb-4">
        <a class="btn btn-primary me-2" href="<?= $baseUrl ?>&menu=penerbit">Kelola Penerbit</a>
        <a class="btn btn-primary" href="<?= $baseUrl ?>&menu=buku">Kelola Buku</a>
    </div>

    <?php
    // Check the menu parameter and include the corresponding page
    $menu = $_GET['menu'] ?? 'penerbit';  // Default to 'penerbit' if no menu is set
    $page = ($menu === 'buku') ? 'buku.php' : 'penerbit.php';
    include($page);
    ?>
</div>