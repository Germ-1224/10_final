<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start output buffering
    ob_start();

    $mysqli = new mysqli('localhost', 'id22250158_final', 'A11133_nukim', 'id22250158_final');

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $customer_name = $mysqli->real_escape_string($_POST['customer_name']);
    $customer_email = $mysqli->real_escape_string($_POST['customer_email']);
    $customer_address = $mysqli->real_escape_string($_POST['customer_address']);
    $payment_method = $mysqli->real_escape_string($_POST['payment_method']);

    $product_details = json_encode($_SESSION['cart']);
    $total_amount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    $query = "INSERT INTO orders (customer_name, customer_email, customer_address, payment_method, product_details, total_amount)
              VALUES ('$customer_name', '$customer_email', '$customer_address', '$payment_method', '$product_details', '$total_amount')";

    if ($mysqli->query($query) === TRUE) {
        echo '<div style="text-align: center; margin-top: 50px;">';
        echo "訂單已送出，謝謝您的訂購！3秒後將重回購物頁面 •̀ Ω •́ ";
        echo '</div>';
        $_SESSION['cart'] = []; // Clear the shopping cart
        header("Refresh:3;URL=member.php");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }

    $mysqli->close();

    // Send output buffer and end buffering
    ob_end_flush();
} else {
    header('Location: member.php');
    exit();
}
?>
