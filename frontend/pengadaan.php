<?php
include('components/header.php');
include('backend/functions.php');

// Ambil nilai filter jika ada
$stok_min = isset($_POST['stok_min']) ? intval($_POST['stok_min']) : 0; // Stok minimum (default 0)
$stok_max = isset($_POST['stok_max']) ? intval($_POST['stok_max']) : 9999; // Stok maksimum (default 9999)

// Query untuk mengambil data buku dengan filter stok
$query = "SELECT buku.nama_buku, buku.stok, penerbit.nama AS penerbit
          FROM buku
          JOIN penerbit ON buku.penerbit = penerbit.nama
          WHERE buku.stok BETWEEN $stok_min AND $stok_max
          ORDER BY buku.stok";

$query2 = "SELECT buku.nama_buku, buku.stok, penerbit.nama AS penerbit
           FROM buku
           JOIN penerbit ON buku.penerbit = penerbit.nama
           WHERE buku.stok = (SELECT MIN(stok) FROM buku)
           ORDER BY buku.stok";

// Menjalankan query
$buku_kebutuhan = show($query);
$buku_stok_sedikit = show($query2);

?>

<div class="container mt-4">
    <h3>Laporan Kebutuhan Buku</h3>
    <p>Buku dengan stok paling sedikit yang perlu segera dibeli</p>
    <!-- Tabel Buku -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($buku_stok_sedikit): ?>
                    <?php foreach ($buku_stok_sedikit as $key => $buku2): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($buku2['nama_buku']) ?></td>
                            <td><?= htmlspecialchars($buku2['penerbit']) ?></td>
                            <td><?= $buku2['stok'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data buku yang perlu dibeli</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <p>Lihat Stok Buku Yang Lain</p>
    <!-- Form Filter -->
    <form action="" method="POST" class="mb-4">
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="stok_min" class="form-label">Stok Minimum</label>
                <input type="number" class="form-control" id="stok_min" name="stok_min" value="<?= $stok_min ?>" placeholder="Min stok" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="stok_max" class="form-label">Stok Maksimum</label>
                <input type="number" class="form-control" id="stok_max" name="stok_max" value="<?= $stok_max ?>" placeholder="Max stok" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Tabel Buku -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($buku_kebutuhan): ?>
                    <?php foreach ($buku_kebutuhan as $key => $buku): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($buku['nama_buku']) ?></td>
                            <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                            <td><?= $buku['stok'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data buku yang perlu dibeli</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>