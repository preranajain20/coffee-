<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please login to add items to wishlist.";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
$conn->query($sql);
echo "Added to wishlist!";
?>
