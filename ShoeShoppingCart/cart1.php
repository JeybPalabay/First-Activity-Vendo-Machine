<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!function_exists('get_cart_count')) {
    function get_cart_count() {
        // Return 0 if the cart is not set or empty, else calculate the total quantity
        if (empty($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            return 0;
        }

        $cart_count = array_reduce($_SESSION['cart'], function($total, $item) {
            return $total + (isset($item['quantity']) ? $item['quantity'] : 0);
        }, 0);

        return $cart_count;
    }
}
?>
