<?php
$link = @mysqli_connect(
    'localhost',  // 主機名稱
    'id22250158_final',  // 使用者名稱
    'A11133_nukim',  // 密碼
    'id22250158_final');  // 預設使用的資料庫名稱

if(!$link){
    echo "資料庫連接錯誤!<br/>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm'])) {
        $No = $_POST['id'];
        $Name = $_POST['name'];
        $Price = $_POST['price'];
        $Introduction = $_POST['introduction'];

        $sql = "UPDATE product SET Name = ?, Price = ?, Introduction = ? WHERE No = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sdsi", $Name, $Price, $Introduction, $No);
        if ($stmt->execute()) {
            echo "<script>alert('商品已成功修改。'); window.location.href='admin.php';</script>";
        } else {
            echo "<script>alert('修改商品時發生錯誤。');</script>";
        }
        $stmt->close();
        $link->close();
        exit();
    }
}
?>
