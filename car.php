<?php
session_start();
ob_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<div style="font-family: Arial, sans-serif; text-align: center; margin-top: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f8f8; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">';
    echo '<h2 style="color: #4CAF50;">購物車是空的</h2>';
    echo '<p style="color: #333;">三秒後將重回購物頁面</p>';
    echo '</div>';
    header("Refresh: 3; URL=member.php");
    ob_end_flush();
    exit();
}


// 增加商品數量
if (isset($_GET['action']) && $_GET['action'] == 'increase' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    }
}

// 減少商品數量
if (isset($_GET['action']) && $_GET['action'] == 'decrease' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity'] > 1) {
        $_SESSION['cart'][$product_id]['quantity']--;
    } else {
        unset($_SESSION['cart'][$product_id]);
    }
}

// 移除商品
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// 清空購物車
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    $_SESSION['cart'] = [];
    header("Refresh:3; URL=member.php");
    echo "購物車已清空，3秒後返回首頁";
    ob_end_flush();
    exit();
}

ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
    <title>購物車</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .action-btn {
            background-color: #f1f1f1;
            color: black;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
        .action-btn:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>購物車</h2>
    <table>
        <thead>
            <tr>
                <th>商品名稱</th>
                <th>價格</th>
                <th>數量</th>
                <th>總計</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $item):
                $total += $item['price'] * $item['quantity'];
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo number_format($item['price'], 2); ?> 元</td>
                <td>
                    <?php echo $item['quantity']; ?>
                    <a href="car.php?action=increase&product_id=<?php echo $product_id; ?>" class="action-btn">+</a>
                    <a href="car.php?action=decrease&product_id=<?php echo $product_id; ?>" class="action-btn">-</a>
                </td>
                <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> 元</td>
                <td>
                    <a href="car.php?action=remove&product_id=<?php echo $product_id; ?>" class="action-btn">移除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>總計: <?php echo number_format($total, 2); ?> 元</h3>
    <form action="checkout.php" method="get">
        <button type="submit">前往結帳</button>
    </form>
    <br>
    <form action="car.php" method="get">
        <button type="submit" name="action" value="clear">清空購物車</button>
    </form>
    <br>
    <form action="member.php" method="get">
        <button type="submit">繼續購物</button>
    </form>
</body>
</html>
