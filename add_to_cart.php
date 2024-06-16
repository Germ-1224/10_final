<?php
session_start();
$mysqli = new mysqli('localhost', 'id22250158_final', 'A11133_nukim', 'id22250158_final');


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if (isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $result = $mysqli->query("SELECT * FROM products WHERE id = $product_id");


    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $product_name = $product['name'];
        $product_price = $product['price'];


        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product_name,
                'price' => $product_price,
                'quantity' => $quantity
            ];
        }
    }
}


header('Location: car.php');
exit;
?>


