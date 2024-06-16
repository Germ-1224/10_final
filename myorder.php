<?php
session_start();

if (!isset($_SESSION['customer_email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "id22250158_final";
$password = "A11133_nukim";
$dbname = "id22250158_final";

// 創建數據庫連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 獲取用戶的電子郵件地址
$customer_email = $_SESSION['customer_email'];

// 查詢用戶的訂單
$sql = "SELECT * FROM orders WHERE customer_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_email);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>我的訂單</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .back-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>我的訂單</h1>
    <table>
        <tr>
            <th>訂單編號</th>
            <th>配送地址</th>
            <th>支付方式</th>
            <th>商品數量</th>
            <th>商品名稱</th>
            <th>總金額</th>
            <th>訂單日期</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['customer_address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['payment_method']) . "</td>";
                
                // 解析商品詳情
                $product_details = json_decode($row['product_details'], true);
                $product_names = [];
                $product_quantities = [];
                foreach ($product_details as $product) {
                    $product_names[] = $product['name'];
                    $product_quantities[] = $product['quantity'];
                }
                $product_names_string = implode("<br>", $product_names);
                $product_quantities_string = implode("<br>", $product_quantities);
                
                echo "<td>" . $product_quantities_string . "</td>";
                echo "<td>" . $product_names_string . "</td>";
                
                echo "<td>" . htmlspecialchars($row['total_amount']) . "</td>";
                echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>尚無訂單</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <div class="button-container">
        <a href="member.php" class="back-button">返回購物頁面</a>
    </div>
</body>
</html>
