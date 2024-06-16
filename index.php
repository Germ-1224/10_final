<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>森上梅友前_二手商店</title>
  <style>
    body {
      background-color: #f7f7f7;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: #333;
      text-align: center;
    }
    h1 {
      font-family: "fantasy";
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      color: #444;
    }
    h3 {
      font-size: 18px;
      line-height: 1.5;
      margin-bottom: 30px;
      color: #666;
    }
    .button-container {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    button {
      background-color: #6ca6cd;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
    }
    button:hover {
      background-color: #437285;
      transform: scale(1.05);
    }
  </style>
</head>
<body>
  <h1>歡迎光臨 森上梅友前</h1>
  <h3>
    這是一個二手買賣平台!<br/>
    我們提供各種類型的商品。<br/>
    請隨時瀏覽我們的產品頁面並選擇您喜歡的商品。
  </h3>
  <div class="button-container">
    <button onclick="window.location.href='login.php'">會員</button>
    <button onclick="window.location.href='normal.php'">一般使用者</button>
    <button onclick="window.location.href='owner_login.php'">管理員</button>
  </div>
  <div class="button-container">
    <button onclick="window.location.href='register.php'">會員註冊</button>
  </div>
</body>
</html>


