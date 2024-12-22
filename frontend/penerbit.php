<?php
// Process form for adding or editing publisher data
if (isset($_POST['submitPenerbit'])) {
    if ($id) {
        // Edit data if ID is provided
        editData($_POST, 'penerbit','http://localhost:90/UNIBOOKSTORE/index.php?page=admin&menu=buku');
    } else {
        // Add new data if no ID
        addData($_POST, 'penerbit','http://localhost:90/UNIBOOKSTORE/index.php?page=admin&menu=buku');
    }
}

// Delete request processing
if (isset($_GET['action']) && $_GET['action'] == 'deletePenerbit' && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer for security
    deleteData($id, 'penerbit', 'http://localhost:90/UNIBOOKSTORE/index.php?page=admin&menu=buku'); // Call function to delete data
}

// Fetch all publishers data
$penerbits = show("SELECT * FROM penerbit");
?>

<!-- Form and Table for Managing Publishers -->
<div id="form-penerbit">
    <!-- Form for adding/editing publisher data -->
    <form action="" method="post" class="mb-4" id="formPenerbit">
        <input type="hidden" id="id" name="id" value="">

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukkan Kota" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan Telepon" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="submitPenerbit">Submit</button>
    </form>

    <!-- Publisher Data Table -->
    <h3>Data Penerbit</h3>
    <div class="table-responsive" id="table-penerbit">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penerbits as $key => $penerbit): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= htmlspecialchars($penerbit['nama']) ?></td>
                        <td><?= htmlspecialchars($penerbit['alamat']) ?></td>
                        <td><?= htmlspecialchars($penerbit['kota']) ?></td>
                        <td><?= htmlspecialchars($penerbit['telepon']) ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-warning btn-sm"
                                onclick="editPenerbit(<?= $penerbit['id'] ?>, '<?= htmlspecialchars($penerbit['nama']) ?>', '<?= htmlspecialchars($penerbit['alamat']) ?>', '<?= htmlspecialchars($penerbit['kota']) ?>', '<?= htmlspecialchars($penerbit['telepon']) ?>')">
                                Edit
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteData(<?= $penerbit['id'] ?>)">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Function to populate form for editing
    function editPenerbit(id, nama, alamat, kota, telepon) {
        document.getElementById('id').value = id;
        document.getElementById('nama').value = nama;
        document.getElementById('alamat').value = alamat;
        document.getElementById('kota').value = kota;
        document.getElementById('telepon').value = telepon;
    }

    // Function to confirm and delete data
    function deleteData(id) {
        if (confirm("Apakah Anda yakin ingin menghapus penerbit ini?")) {
            window.location.href = "index.php?page=admin&action=deletePenerbit&id=" + id;
        }
    }
</script>