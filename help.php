<?php
$servername = "localhost";
$username = "id22250158_final";
$password = "A11133_nukim";
$dbname = "id22250158_final";

// 創建數據庫連接
$mysqli = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($mysqli->connect_error) {
    die("連接失敗: " . $mysqli->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $message = $mysqli->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    ob_start();
    
    if ($mysqli->query($sql) === TRUE) {
        echo "<p>您的消息已發送。我們會盡快回覆您。</p>";
        echo "<p>三秒後將重回購物頁面。</p>";
        header("Refresh:3;URL=member.php");
    } else {
        echo "<p>發生錯誤: " . $mysqli->error . "</p>";
        header("Refresh:3;URL=member.php");
    }
    
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>客服中心</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 50%;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px #000;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input, textarea, button {
            margin-bottom: 10px;
        }
        input, textarea {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>客服中心</h1>
        <form method="POST" action="help.php">
            <label for="name">姓名:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">電子郵件:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">您的建議:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">發送</button>
            
            <button type="button" class="return-button" onclick="window.location.href='member.php'">返回</button>
        </form>
        

    </div>
</body>
</html>
