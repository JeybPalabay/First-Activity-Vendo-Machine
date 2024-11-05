<?php
session_start();
include 'cart1.php';

$items = [
    ["id" => 1, "name" => "Air Jordan 1", "price" => 3000, "image" => "img/J1AA.png", "image_hover" => "img/J1BB.png", "description" => "Classic Air Jordan 1 sneakers, perfect for basketball and street style."],
    ["id" => 2, "name" => "Air Jordan 2", "price" => 3200, "image" => "img/J2BB.png", "image_hover" => "img/J2AA.png", "description" => "Bold and unique, Air Jordan 2 brings style to the court and beyond."],
    ["id" => 3, "name" => "Jordan Havoc", "price" => 2800, "image" => "img/J3AA.png", "image_hover" => "img/J3BB.png", "description" => "Stylish and comfortable, Jordan Havoc is ideal for everyday wear."],
    ["id" => 4, "name" => "Nike Flyknit", "price" => 3500, "image" => "img/N1B.png", "image_hover" => "img/N1A.png", "description" => "Lightweight and flexible, Nike Flyknit offers a snug fit for runners."],
    ["id" => 5, "name" => "Nike Low-Tops", "price" => 3400, "image" => "img/N5B.png", "image_hover" => "img/N5A.png", "description" => "Trendy Nike low-top sneakers for a sleek and casual look."],
    ["id" => 6, "name" => "Nike Air Max", "price" => 4000, "image" => "img/N6B.png", "image_hover" => "img/N6A.png", "description" => "Experience comfort and style with Nike Air Max’s iconic Air cushioning."],
    ["id" => 7, "name" => "Nike Blazer", "price" => 2500, "image" => "img/N7B.png", "image_hover" => "img/N7A.png", "description" => "Retro-inspired Nike Blazer, great for casual and streetwear."],
    ["id" => 8, "name" => "World Balance", "price" => 5000, "image" => "img/W8B.png", "image_hover" => "img/W8A.png", "description" => "Stylish World Balance sneakers, a must-have for fashion enthusiasts."]
];



$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = null;

foreach ($items as $product) {
    if ($product['id'] === $item_id) {
        $item = $product;
        break;
    }
}

if (!$item) {
    header("Location: index.php");
    exit;
}

$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $cart_count += $cart_item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['name']; ?> - Shoe Shop</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/shopping-cart.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
       
    </style>
</head>
<body>
<header class="py-3 bg-white shadow-sm mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="header-title h3 m-0">Shoe Shop</h1>
        <a href="cart.php" class="btn btn-outline-secondary position-relative">
            <i class="bi bi-cart"></i> Cart
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-custom">
                <?php echo $cart_count; ?>
            </span>
        </a>
    </div>
</header>

<div class="container">
    <div class="row card-shadow rounded p-4">
        <div class="col-md-5">
            <div class="product-image mb-4">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="normal">
                <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="hover">
            </div>
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold"><?php echo $item['name']; ?> <span class="badge badge-custom">₱<?php echo number_format($item['price'], 2); ?></span></h2>
            <p class="mt-3"><?php echo $item['description']; ?></p>

            <form action="confirm.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                
                <h5 class="mt-4">Select Size:</h5>
                <div class="mb-3">
                    <label class="form-check-label me-2"><input type="radio" name="size" value="40" checked> 40</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="41"> 41</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="42"> 42</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="43"> 43</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="44"> 44</label>
                    <label class="form-check-label me-2"><input type="radio" name="size" value="45"> 45</label>
                </div>

                <h5>Enter Quantity:</h5>
                <input type="number" class="form-control w-50 mb-3" name="quantity" value="0" min="1" max="100">


                <button type="submit" class="btn btn-custom"><i class="bi bi-check-circle"></i> Confirm Product Purchase</button>
                <a href="index.php" class="btn btn-outline-secondary ms-2"><i class="bi bi-arrow-left"></i> Cancel/Go Back</a>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
