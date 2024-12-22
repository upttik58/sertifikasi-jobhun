<?php
// Database connection function
function getDBConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "data";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Show data function
function show($query)
{
    $conn = getDBConnection();
    $result = $conn->query($query);
    $rows = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    return $rows;
}

// Add data function
function addData($data, $table, $url)
{
    // Mendapatkan koneksi database
    $conn = getDBConnection();
    $fields = [];
    $values = [];

    // Menyusun field dan value untuk query
    foreach ($data as $key => $value) {
        // Menghindari field yang tidak diperlukan
        if (!in_array($key, ['submit', 'id', 'submitBuku', 'submitPenerbit'])) {
            $fields[] = $key;
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }
    }

    // Menyusun query SQL untuk menambahkan data
    $sql = "INSERT INTO $table (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $values) . ")";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        echo '<script>
            alert("Data Berhasil Ditambahkan");
            location.href = "' . $url . '";  // Redirect ke URL yang diberikan
        </script>';
    } else {
        echo '<script>
            alert("Data Gagal Ditambahkan");
            location.href = "' . $url . '";  // Redirect ke URL yang diberikan jika gagal
        </script>';
    }
}

// Edit data function
function editData($data, $table, $url)
{
    $conn = getDBConnection();
    $setValues = [];

    foreach ($data as $key => $value) {
        if (!in_array($key, ['submit', 'id', 'submitBuku', 'submitPenerbit'])) {
            $setValues[] = "$key = '" . $conn->real_escape_string($value) . "'";
        }
    }

    $id = (int)$data['id'];  // Ensure ID is an integer for security
    $sql = "UPDATE $table SET " . implode(", ", $setValues) . " WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
            alert("Data Berhasil Diperbarui");
            location.href = "' . $url . '";  // Redirect to dashboard
        </script>';
    } else {
        echo '<script>
            alert("Data Gagal Diperbarui");
            location.href = "' . $url . '";  // Redirect back to edit form
        </script>';
    }
}

// Delete data function
function deleteData($id, $table, $url)
{
    $conn = getDBConnection();
    $id = (int)$id;  // Ensure ID is an integer for security
    $sql = "DELETE FROM $table WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
            alert("Data Berhasil Dihapus");
            location.href = "' . $url . '";  // Redirect to dashboard after delete
        </script>';
    } else {
        echo '<script>
            alert("Data Gagal Dihapus");
            location.href = "' . $url . '";  // Redirect back to dashboard if deletion fails
        </script>';
    }
}
