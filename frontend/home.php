<?php
include('components/header.php');
include('backend/functions.php');

// Get the search query from URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Create SQL query based on the search input
if ($searchQuery) {
    $books = show("SELECT * FROM buku WHERE 
        nama_buku LIKE '%$searchQuery%' OR 
        kategori LIKE '%$searchQuery%' OR 
        harga LIKE '%$searchQuery%' OR 
        stok LIKE '%$searchQuery%' OR 
        penerbit LIKE '%$searchQuery%'");
} else {
    // If no search query, show all books
    $books = show("SELECT * FROM buku");
}
?>

<main>
    <!-- Search Section -->
    <section class="search-section text-center py-5 bg-lightblue text-dark">
        <div class="container">
            <h1 class="display-4">Welcome to UNIBOOKSTORE</h1>
            <p class="lead">Find your favorite books with ease!</p>
            <form class="search-form mx-auto" action="" method="get">
                <div class="input-group w-75 mx-auto">
                    <input
                        type="text"
                        name="search"
                        class="form-control form-control-lg"
                        value="<?= htmlspecialchars($searchQuery) ?>"
                        placeholder="Search for books..."
                        aria-label="Search">
                    <button type="submit" class="btn btn-primary btn-lg">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Book Cards Section -->
    <section class="books-section py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php if (count($books) > 0): ?>
                    <?php foreach ($books as $book): ?>
                        <div class="col mb-4">
                            <div class="card border-0 shadow-lg rounded-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?= strtoupper(htmlspecialchars($book['nama_buku'])) ?></h5>
                                    <p class="text-muted"><strong>Kategori:</strong> <?= ucfirst(htmlspecialchars($book['kategori'])) ?></p>
                                    <p class="text-muted"><strong>Harga:</strong> Rp. <?= number_format($book['harga'], 0, ',', '.') ?></p>
                                    <p class="text-muted"><strong>Stok:</strong> <?= htmlspecialchars($book['stok']) ?> items</p>
                                    <p class="text-muted"><strong>Penerbit:</strong> <?= htmlspecialchars($book['penerbit']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- No Results Card -->
                    <div class="col-12 d-flex justify-content-center">
                        <div class="card border-0 shadow-lg rounded-3">
                            <div class="card-body text-center">
                                <h5 class="card-title">No books found matching your search criteria.</h5>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>