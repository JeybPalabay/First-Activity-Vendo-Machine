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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                $cart_item['quantity'] = min(max(1, (int)$quantity), 99);
            }
        }
    }
    header("Location: cart.php");
    exit;
}

$total_price = 0;
$total_quantity = 0;

foreach ($_SESSION['cart'] as $cart_item) {
    foreach ($shoeCollection as $item) {
        if ($item['id'] === $cart_item['id']) {
            $total_price += $cart_item['quantity'] * $item['price'];
            break;
        }
    }
    $total_quantity += $cart_item['quantity'];
}

$cart_count = $total_quantity; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Shoe Shop</title>
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

    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-secondary text-center" role="alert">
                Your cart is currently empty.
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Continue Shopping</a>
            </div>
        <?php else: ?>
            <form action="cart.php" method="POST">
                <table class="table table-striped table-bordered table-blue">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                            <?php
                                $item_details = null;
                                foreach ($shoeCollection as $item) {
                                    if ($item['id'] === $cart_item['id']) {
                                        $item_details = $item;
                                        break;
                                    }
                                }
                                if ($item_details):
                                    $item_total = $item_details['price'] * $cart_item['quantity'];
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $item_details['image']; ?>" alt="<?php echo htmlspecialchars($item_details['name']); ?>" class="me-3" style="width: 60px;">
                                        <span><?php echo htmlspecialchars($item_details['name']); ?></span>
                                    </div>
                                </td>
                                <td class="text-center"><?php echo isset($cart_item['size']) ? htmlspecialchars($cart_item['size']) : 'N/A'; ?></td>
                                <td class="text-center">
                                    <input type="number" name="quantity[<?php echo $cart_item['id']; ?>]" value="<?php echo $cart_item['quantity']; ?>" min="1" max="99" class="form-control" style="width: 70px;">
                                </td>
                                <td>₱<?php echo number_format($item_details['price'], 2); ?></td>
                                <td>₱<?php echo number_format($item_total, 2); ?></td>
                                <td class="text-center">
                                    <a href="remove.php?product_id=<?php echo $cart_item['id']; ?>" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total</td>
                            <td colspan="2" class="fw-bold">₱<?php echo number_format($total_price, 2); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="index.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left-circle"></i> Continue Shopping</a>
                        <button type="submit" class="btn btn-outline-success"><i class="bi bi-save2"></i> Update Cart</button>
                        <a href="checkout.php" class="btn btn-primary"><i class="bi bi-credit-card-2-front"></i> Checkout</a>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
