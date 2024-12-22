<?php
// Handle form submission for adding/editing books
if (isset($_POST['submitBuku'])) {
    $id = !empty($_POST['id']) ? intval($_POST['id']) : null;
    $nama_buku = htmlspecialchars($_POST['nama_buku']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = floatval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $penerbit = htmlspecialchars($_POST['penerbit']);

    if ($id) {
        // Update book data if ID is provided
        editData($_POST, 'buku');
    } else {
        // Add new book if no ID is provided
        addData($_POST, 'buku');
    }
}

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] == 'deleteBuku' && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer for security
    deleteData($id, 'buku'); // Call function to delete data
}

// Fetch book and publisher data
$bukus = show("SELECT * FROM buku");
$penerbits = show("SELECT * FROM penerbit");
?>

<!-- Form to Add/Edit Books -->
<form action="" method="post" class="mb-4" id="form-buku">
    <input type="hidden" id="id" name="id" value="">

    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="nama_buku" class="form-label">Nama Buku</label>
            <input type="text" class="form-control" id="nama_buku" name="nama_buku" placeholder="Masukkan Nama Buku" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Kategori" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok" required>
        </div>

        <!-- Publisher Dropdown -->
        <div class="col-12 col-md-6 mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <select class="form-control" id="penerbit" name="penerbit" required>
                <option value="">Pilih Penerbit</option>
                <?php foreach ($penerbits as $penerbit): ?>
                    <option value="<?= htmlspecialchars($penerbit['nama']) ?>">
                        <?= htmlspecialchars($penerbit['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" name="submitBuku">Submit</button>
</form>

<!-- Table to Display Books -->
<h3>Data Buku</h3>
<div class="table-responsive" id="table-buku">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penerbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bukus as $key => $buku): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= htmlspecialchars($buku['nama_buku']) ?></td>
                    <td><?= htmlspecialchars($buku['kategori']) ?></td>
                    <td>Rp <?= number_format($buku['harga'], 0, ',', '.') ?></td>
                    <td><?= $buku['stok'] ?></td>
                    <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning btn-sm" onclick="editBuku(<?= $buku['id'] ?>, '<?= htmlspecialchars($buku['nama_buku']) ?>', '<?= htmlspecialchars($buku['kategori']) ?>', <?= $buku['harga'] ?>, '<?= htmlspecialchars($buku['penerbit']) ?>', <?= $buku['stok'] ?>)">
                            Edit
                        </button>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(<?= $buku['id'] ?>)">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    // Function to populate form with book data for editing
    function editBuku(id, nama_buku, kategori, harga, penerbit, stok) {
        document.getElementById('id').value = id;
        document.getElementById('nama_buku').value = nama_buku;
        document.getElementById('kategori').value = kategori;
        document.getElementById('harga').value = harga;
        document.getElementById('stok').value = stok;

        // Set selected publisher in dropdown
        document.getElementById('penerbit').value = penerbit;
    }

    // Function to confirm and delete book data
    function deleteData(id) {
        if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
            window.location.href = "index.php?page=admin&menu=buku&action=deleteBuku&id=" + id;
        }
    }
</script>