<?php
session_start();
include 'cart1.php'; 
$cart_count = get_cart_count();

$item_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null;
$item = null;

if ($item_id && isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $item_id) {
            $item = $cart_item;
            break;
        }
    }
}

if (!$item) {
    header("Location: cart.php");
    exit;
}

function getItemDetails($id) {
    $products = [
        ["id" => 1, "name" => "Air Jordan 1", "price" => 3000, "image" => "img/J1AA.png", "image_hover" => "img/J1BB.png", "description" => "Classic Air Jordan 1 sneakers, perfect for basketball and street style."],
        ["id" => 2, "name" => "Air Jordan 2", "price" => 3200, "image" => "img/J2BB.png", "image_hover" => "img/J2AA.png", "description" => "Bold and unique, Air Jordan 2 brings style to the court and beyond."],
        ["id" => 3, "name" => "Jordan Havoc", "price" => 2800, "image" => "img/J3AA.png", "image_hover" => "img/J3BB.png", "description" => "Stylish and comfortable, Jordan Havoc is ideal for everyday wear."],
        ["id" => 4, "name" => "Nike Flyknit", "price" => 3500, "image" => "img/N1B.png", "image_hover" => "img/N1A.png", "description" => "Lightweight and flexible, Nike Flyknit offers a snug fit for runners."],
        ["id" => 5, "name" => "Nike Low-Tops", "price" => 3400, "image" => "img/N5B.png", "image_hover" => "img/N5A.png", "description" => "Trendy Nike low-top sneakers for a sleek and casual look."],
        ["id" => 6, "name" => "Nike Air Max", "price" => 4000, "image" => "img/N6B.png", "image_hover" => "img/N6A.png", "description" => "Experience comfort and style with Nike Air Max’s iconic Air cushioning."],
        ["id" => 7, "name" => "Nike Blazer", "price" => 2500, "image" => "img/N7B.png", "image_hover" => "img/N7A.png", "description" => "Retro-inspired Nike Blazer, great for casual and streetwear."],
        ["id" => 8, "name" => "World Balance", "price" => 5000, "image" => "img/W8B.png", "image_hover" => "img/W8A.png", "description" => "Stylish World Balance sneakers, a must-have for fashion enthusiasts."]
    ];

    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}

$product_details = getItemDetails($item_id);


if (!$product_details) {
    echo "<div class='alert alert-danger'>Product details not found. Please go back and try again.</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $item_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); 
            break;
        }
    }
    header("Location: cart.php?message=Item successfully removed.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Confirmation - Shoe Shop</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/shopping-cart.css" rel="stylesheet">
</head>
<body>
    <header class="py-3 bg-white shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">Shoe Shop</h1>
            <a href="cart.php" class="btn btn-outline-secondary position-relative">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($product_details['image']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?>" class="img-fluid normal-image">
                            <img src="<?php echo htmlspecialchars($product_details['image_hover']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?> (hover)" class="img-fluid hover-image position-absolute top-0 start-0">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3><?php echo htmlspecialchars($product_details['name']); ?> <span class="badge bg-warning">₱<?php echo number_format($product_details['price'], 2); ?></span></h3>
                        <p class="mt-3"><?php echo htmlspecialchars($product_details['description']); ?></p>
                        <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size']); ?></p>
                        <p><strong>Quantity:</strong> <?php echo (int)$item['quantity']; ?></p>
                        <div class="mt-4">
                            <form method="POST">
                                <button type="submit" class="btn btn-dark me-2">
                                    <i class="bi bi-trash"></i> Confirm Product Removal
                                </button><br><br>
                            </form>
                            <a href="cart.php" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Cancel/Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>

    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
