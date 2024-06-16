<?php
// 資料庫連接設置
$servername = "localhost";  // 伺服器名稱
$username = "id22250158_final";  // 資料庫使用者名稱
$password = "A11133_nukim";  // 資料庫密碼
$dbname = "id22250158_final";  // 資料庫名稱

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 確認 Email 和 Password 是否存在於 POST 資料中
    if (isset($_POST['Email']) && isset($_POST['Password'])) {
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        // 預防 SQL 注入
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // 查詢資料庫
        $sql = "SELECT * FROM owner WHERE Email = '$email' AND Password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 登入成功
            session_start();
            $_SESSION['email'] = $email;
            header("Location: owner.php");
        } else {
            // 登入失敗
            echo '<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入失敗</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .message-container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #ced4da;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            font-size: 1.2em;
            color: #dc3545;
        }
    </style>
    <meta http-equiv="refresh" content="3;url=owner_login.php">
</head>
<body>
    <div class="message-container">
        <div class="message">無效的電子郵件或密碼</div>
        <div>3 秒後將返回管理員登入頁面...</div>
    </div>
</body>
</html>';
        }
    } else {
        echo "請提供電子郵件和密碼";
    }
}

$conn->close();
?>
