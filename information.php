<?php
    // 連接資料庫
    $link = @mysqli_connect(
        'localhost',  // 主機名稱
        'id22250158_final',  // 使用者名稱
        'A11133_nukim',  // 密碼
        'id22250158_final'  // 預設使用的資料庫名稱
    );

    if(!$link){
        echo "資料庫連接錯誤!<br/>";
        exit();
    }

    // 獲取表單資料
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];

    // 插入資料到資料庫
    $sql = "INSERT INTO customer (name, email, password, address, birthday) VALUES ('$name', '$email', '$password', '$address', '$birthday')";
    if ($link->query($sql) === TRUE) {
        // 註冊成功訊息並跳轉
        echo '<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊成功</title>
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
            color: #28a745;
        }
    </style>
    <meta http-equiv="refresh" content="3;url=index.php">
</head>
<body>
    <div class="message-container">
        <div class="message">註冊成功</div>
        <div>3 秒後將返回首頁...</div>
    </div>
</body>
</html>';
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    $link->close();
?>
