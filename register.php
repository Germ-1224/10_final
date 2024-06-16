<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>森上梅友前_二手商店 - 會員註冊</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>森上梅友前_二手商店 - 會員註冊</h1>
        <form method="POST" action="information.php">
            <label for="name">會員名稱:</label>
            <input type="text" name="name" id="name" required>
           
            <label for="email">Email帳號:</label>
            <input type="email" name="email" id="email" required>
           
            <label for="password">密碼:</label>
            <input type="password" name="password" id="password" required>
           
            <label for="address">通訊地址:</label>
            <input type="text" name="address" id="address" required>
           
            <label for="birthday">出生年月日:</label>
            <input type="date" name="birthday" id="birthday" required>
           
            <input type="submit" value="註冊">
        </form>
        <input type="button" value="返回" onclick="window.location.href='index.php';">
    </div>
</body>
</html>
