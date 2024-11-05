<?php
session_start();
include 'cart1.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$item_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$size = isset($_POST['size']) ? $_POST['size'] : null;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if ($quantity > 99) {
    $quantity = 99;
}

if ($item_id && $size) {
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] === $item_id && $cart_item['size'] === $size) {
            $cart_item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = ["id" => $item_id, "size" => $size, "quantity" => $quantity];
    }
}

$cart_count = get_cart_count();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase - Shoe Shop</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/shopping-cart.css" rel="stylesheet">
</head>
<body>
    <header class="py-3 bg-white shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="header-title h3 m-0" style="font-weight: 700; color: #004085;">Shoe Shop</h1>
            <a href="cart.php" class="btn btn-outline-secondary position-relative" style="border-color: #004085; color: #004085;">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #ffc107; color: #333;">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row card-shadow rounded p-5 bg-white">
            <div class="col-12 text-center">
                <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 3rem;"></i>
                <h2 class="fw-bold">Success!</h2>
                <p class="lead mt-3">Your product has been successfully added to the cart.</p>
                <div class="mt-4">
                    <a href="index.php" class="btn btn-outline-primary btn-lg me-2"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
                    <a href="cart.php" class="btn btn-success btn-lg"><i class="bi bi-cart-check-fill"></i> View Cart</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
