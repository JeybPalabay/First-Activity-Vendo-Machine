<?php
session_start();
include 'cart1.php';

if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$shoeCollection = [
    ["id" => 1, "name" => "Air Jordan 1", "price" => 3000, "image" => "img/J1AA.png", "image_hover" => "img/J1BB.png"],
    ["id" => 2, "name" => "Air Jordan 2", "price" => 3200, "image" => "img/J2BB.png", "image_hover" => "img/J2AA.png"],
    ["id" => 3, "name" => "Jordan Havoc", "price" => 2800, "image" => "img/J3AA.png", "image_hover" => "img/J3BB.png"],
    ["id" => 4, "name" => "Nike Flyknit", "price" => 3500, "image" => "img/N1B.png", "image_hover" => "img/N1A.png"],
    ["id" => 5, "name" => "Nike Low-Tops", "price" => 3400, "image" => "img/N5B.png", "image_hover" => "img/N5A.png"],
    ["id" => 6, "name" => "Nike Air Max", "price" => 4000, "image" => "img/N6B.png", "image_hover" => "img/N6A.png"],
    ["id" => 7, "name" => "Nike Blazer", "price" => 2500, "image" => "img/N7B.png", "image_hover" => "img/N7A.png"],
    ["id" => 8, "name" => "World Balance", "price" => 5000, "image" => "img/W8B.png", "image_hover" => "img/W8A.png"]
];

function getTotalItems($cartItems) {
    $totalItems = 0;
    foreach ($cartItems as $product) {
        $totalItems += $product['quantity'];
    }
    return $totalItems;
}

$totalItemsInCart = getTotalItems($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Collection</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/shopping-cart.css" rel="stylesheet">

</head>
<body>
    <header class="py-3 bg-white shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="header-title h3 m-0" style="font-weight: 700; color: #004085;">Shoe Shop</h1>
            <a href="cart.php" class="btn btn-outline-secondary position-relative" style="border-color: #004085; color: #004085; background-color: white; transition: all 0.3s ease;"
                onmouseover="this.style.backgroundColor='#f0f8ff'; this.style.boxShadow='0px 4px 8px rgba(0, 64, 133, 0.2)'; this.style.transform='scale(1.05)';"
                onmouseout="this.style.backgroundColor='white'; this.style.boxShadow='none'; this.style.transform='scale(1)';"><i class="bi bi-cart"></i> Cart<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"style="background-color: #ffc107; color: #333;">
        <?php echo $totalItemsInCart; ?>
    </span>
</a>

        </div>
    </header>

    <main class="container my-4">
        <div class="row gy-4">
            <?php foreach ($shoeCollection as $shoe): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card card-container" onclick="window.location.href='details.php?id=<?php echo $shoe['id']; ?>'">
                        <div class="card-image-wrapper">
                            <img src="<?php echo $shoe['image']; ?>" class="normal" alt="<?php echo htmlspecialchars($shoe['name']); ?>">
                            <img src="<?php echo $shoe['image_hover']; ?>" class="hover" alt="<?php echo htmlspecialchars($shoe['name']); ?>">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($shoe['name']); ?></h5>
                            <p class="card-text">₱<?php echo number_format($shoe['price'], 2); ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <button class="btn btn-outline-primary"><i class="bi bi-cart"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
