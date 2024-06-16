<!DOCTYPE html>
<html>
<head>
    <title>結帳</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
        }
        form {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 48%;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-button {
            background-color: #f44336;
        }
        .back-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <form method="post" action="process_checkout.php">
        <h2>結帳</h2>
        <label for="name">姓名</label>
        <input type="text" id="name" name="customer_name" required>

        <label for="email">電子郵件</label>
        <input type="email" id="email" name="customer_email" required>

        <label for="address">地址</label>
        <input type="text" id="address" name="customer_address" required>

        <label for="payment">付款方式</label>
        <select id="payment" name="payment_method" required>
            <option value="Credit Card">信用卡</option>
            <option value="PayPal">PayPal</option>
            <option value="Bank Transfer">銀行轉帳</option>
        </select>

        <div class="button-container">
            <button type="submit">提交訂單</button>
            <button type="button" class="back-button" onclick="window.location.href='member.php'">返回購物頁面</button>
        </div>
    </form>
</body>
</html>
