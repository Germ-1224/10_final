<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>森上梅友前_二手商店 - 管理員登入</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-container input[type="submit"],
        .login-container input[type="button"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .login-container input[type="submit"]:hover,
        .login-container input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>森上梅友前_二手商店 - 管理員登入</h2>
        <form action="owner_login_process.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required><br><br>
            <label for="password">密碼:</label>
            <input type="password" id="password" name="Password" required><br><br>
            <input type="submit" value="登入">
        </form>
        <input type="button" value="返回" onclick="window.location.href='index.php';">
    </div>
</body>
</html>
