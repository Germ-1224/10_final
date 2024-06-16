<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

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

// 獲取特色商品
$featured_result = $mysqli->query("SELECT * FROM products LIMIT 4");

// 檢查查詢是否成功
if (!$featured_result) {
    die("查詢失敗: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>森上梅友前_二手商店</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #4CAF50;
            padding: 10px 20px;
            color: white;
        }
        #logo {
            font-size: 24px;
            font-weight: bold;
        }
        #menu {
            display: flex;
            align-items: center;
        }
        #menu button {
            margin-left: 10px;
            padding: 5px 10px;
            font-size: 16px;
            background-color: white;
            color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #menu button:hover {
            background-color: #45a049;
            color: white;
        }
        #banner {
            text-align: center;
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        #banner p {
            text-align: left;
            line-height: 1.6;
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }
        #featured {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .product {
            background-color: white;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 220px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            text-align: center;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .product h3 {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .product p {
            margin-top: 5px;
            font-size: 16px;
            color: #808080;
        }
        .product .intro {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        .product button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .product button:hover {
            background-color: #45a049;
        }
        .section-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <header>
        <div id="logo">森上梅友前_二手商店</div>
        <div id="menu">
            <a href="index.php"><button>回首頁</button></a>
            <a href="admin.php"><button>商品管理</button></a>
            <a href="order_manage.php"><button>訂單管理</button></a>
            <a href="opinion.php"><button>顧客意見</button></a>
            <a href="sales.php"><button>商品銷售狀況</button></a>
        </div>
    </header>
    <div id="banner">
        <p>歡迎光臨我們的二手商店！這裡是尋找珍寶與回憶的最佳去處(⁎⁍̴̛ᴗ⁍̴̛́⁎)。我們致力於為顧客提供高品質、經濟實惠的二手商品，從日常用品到服飾、書籍，應有盡有。</p>
        <p>在我們的二手商店，每一件商品都有它自己的故事和歷史。✧٩(•́⌄•́๑)و 我們精心挑選並檢查每一件商品，確保它們的質量和功能性，讓您買得放心，用得舒心。無論您是在尋找實用的家居用品，還是希望找到一件獨特的裝飾品，我們的店內都能滿足您的需求。</p>
        <p>我們深信可持續生活的重要性，購買二手商品不僅能節省資源，還能減少浪費，對環境更加友好。加入我們，一起支持環保，實現可持續生活的理念( •̀ Ω •́ )✧。</p>
        <p>還等什麼，趕快來吧！(๑>◡<๑) 走進我們的二手商店，探索屬於您的那一份驚喜與感動！我們的友善工作人員隨時準備為您提供幫助，讓您的購物體驗愉快而難忘。期待您的光臨與支持！ヽ(＾Д＾)ﾉ</p>
    </div>
    <div class="section-title">特色商品</div>
    <div id="featured">
        <?php
        while ($row = $featured_result->fetch_assoc()):
        ?>
        <div class="product">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>價格: <?php echo number_format($row['price'], 2); ?> 元</p>
            <p class="intro"><?php echo htmlspecialchars($row['intro']); ?></p>
        </div>
        <?php
        endwhile;
        ?>
    </div>
</body>
</html>
