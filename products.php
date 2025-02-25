<?php
include 'db.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM products WHERE 1";

// Apply category filter
if ($category) {
    $sql .= " AND category = '$category'";
}

// Apply search filter
if ($search) {
    $sql .= " AND name LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Coffee & Tea</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Shop Our Coffee & Tea Collection</h1>
    <form method="GET">
        <input type="text" name="search" placeholder="Search Products..." value="<?= $search ?>">
        <select name="category">
            <option value="">All Categories</option>
            <option value="Coffee" <?= $category == 'Coffee' ? 'selected' : '' ?>>Coffee</option>
            <option value="Tea" <?= $category == 'Tea' ? 'selected' : '' ?>>Tea</option>
        </select>
        <button type="submit">Filter</button>
        <button onclick="addToWishlist(<?= $row['id']; ?>)">❤️ Add to Wishlist</button>

    </form>
</header>

<section>
    <div class="product-list">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <img src='images/" . $row['image_url'] . "' alt='" . $row['name'] . "'>
                    <h3>" . $row['name'] . "</h3>
                    <p>" . $row['description'] . "</p>
                    <p>₹" . $row['price'] . "</p>
                    <p>⭐ " . $row['rating'] . "/5</p>
                    <button>Add to Cart</button>
                  </div>";
        }
        ?>
    </div>
</section>

</body>
</html>
