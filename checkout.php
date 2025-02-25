<?php
session_start();
include 'db.php';

if (empty($_SESSION['cart'])) {
    echo "Your cart is empty!";
    exit;
}

// Process payment and create order
// (This is a placeholder; you'll need to integrate a payment gateway like Stripe or PayPal)
echo "Checkout successful!";
?>