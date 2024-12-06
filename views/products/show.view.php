<?php require 'views/partials/header.php'; ?>
<main class="container mt-4">
    <h1>products</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $product['price']; ?></h6>
                        <p class="card-text"><?php echo $product['description'] ?></p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require 'views/partials/footer.php'; ?>