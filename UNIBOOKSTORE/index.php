<?php error_reporting(E_ALL); ?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="UNIBOOKSTORE - Your Favorite Bookstore">
    <meta name="theme-color" content="#712cf9">
    <title>UNIBOOKSTORE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <?php
    // Get the page parameter from the URL or set default as 'index'
    $page = $_GET['page'] ?? 'index';

    // Switch case to include different pages based on the 'page' parameter
    $pages = ['index', 'admin', 'pengadaan'];

    if (in_array($page, $pages)) {
        if($page == 'index'){
            include("frontend/home.php");
        }else{
            include("frontend/{$page}.php");
        }
    } else {
        include('frontend/home.php');
    }
    ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gyb6Bze2zAnj5u6En8ddg8ksd4pDXluZIl5k55wFv5RaZ6X7nFu"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0Wr8ZzFWvRdi1Y7kAEXxl94ZlfrZm0jmYWEI75t+2KM2Oq9G"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>