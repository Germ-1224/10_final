<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理商品</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td img {
            max-width: 50px;
            height: auto;
        }
        .btn {
            padding: 10px 20px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-delete:hover {
            background-color: #da190b;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            animation: animatetop 0.4s;
            border-radius: 8px;
        }
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-btn {
            padding: 10px 20px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
        .modal-btn:hover {
            background-color: #45a049;
        }
        .modal-btn.close {
            background-color: #aaa;
        }
        .modal-btn.close:hover {
            background-color: #888;
        }
        .actions {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>管理商品</h1>
    <?php
    $link = new mysqli('localhost', 'id22250158_final', 'A11133_nukim', 'id22250158_final');

    if ($link->connect_error) {
        die("資料庫連接錯誤: " . $link->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['confirmDelete'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "<script>alert('商品已成功刪除。'); window.location.href='admin.php';</script>";
            } else {
                echo "<script>alert('刪除商品時發生錯誤。');</script>";
            }
            $stmt->close();
        }

        if (isset($_POST['confirmEdit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $intro = $_POST['introduction'];
            $image = $_FILES['image'];

            if ($image['error'] == UPLOAD_ERR_OK) {
                $imagePath = 'uploads/' . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $imagePath);

                $sql = "UPDATE products SET name = ?, price = ?, intro = ?, image = ? WHERE id = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("sdsdi", $name, $price, $intro, $imagePath, $id);
            } else {
                $sql = "UPDATE products SET name = ?, price = ?, intro = ? WHERE id = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("sdsi", $name, $price, $intro, $id);
            }

            if ($stmt->execute()) {
                echo "<script>alert('商品已成功修改。'); window.location.href='admin.php';</script>";
            } else {
                echo "<script>alert('修改商品時發生錯誤。');</script>";
            }
            $stmt->close();
        }
    }

    $sql = "SELECT id, name, price, intro, image FROM products";
    $result = $link->query($sql);

    echo "<table>";
    echo "<tr><th>編號</th><th>名稱</th><th>價格</th><th>簡介</th><th>圖片</th><th>操作</th></tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . htmlspecialchars($row["intro"]) . "</td>";
            echo "<td><img src='" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["name"]) . "'></td>";
            echo "<td>
                <button class='btn' onclick='showEditModal(" . $row["id"] . ", \"" . htmlspecialchars($row["name"]) . "\", \"" . $row["price"] . "\", \"" . htmlspecialchars($row["intro"]) . "\", \"" . htmlspecialchars($row["image"]) . "\")'>修改</button>
                <button class='btn btn-delete' onclick='showDeleteModal(" . $row["id"] . ", \"" . htmlspecialchars($row["name"]) . "\", \"" . $row["price"] . "\", \"" . htmlspecialchars($row["intro"]) . "\", \"" . htmlspecialchars($row["image"]) . "\")'>刪除</button>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>沒有任何商品</td></tr>";
    }

    echo "</table>";

    $link->close();
    ?>

    <div class="actions">
        <button class="btn" onclick="window.location.href='add_product.php'">新增商品</button>
        <button class="btn" onclick="window.location.href='owner.php'">離開</button>
    </div>

    <!-- 刪除確認彈出視窗 -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>刪除商品</h2>
            <p>編號: <span id="deleteProductId"></span></p>
            <p>名稱: <span id="deleteProductName"></span></p>
            <p>價格: <span id="deleteProductPrice"></span></p>
            <p>簡介: <span id="deleteProductIntro"></span></p>
            <p>圖片: <img id="deleteProductImage" style="width:50px;height:50px;"></p>
            <form method="post" action="admin.php">
                <input type="hidden" name="id" id="deleteId">
                <input type="submit" name="confirmDelete" value="確認刪除" class="modal-btn">
                <button type="button" class="modal-btn close">取消</button>
            </form>
        </div>
    </div>

    <!-- 修改商品彈出視窗 -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>修改商品</h2>
            <form method="post" action="admin.php" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editId">
                <p>名稱: <input type="text" name="name" id="editName" required></p>
                <p>價格: <input type="number" name="price" id="editPrice" required></p>
                <p>簡介: <textarea name="introduction" id="editIntro" required></textarea></p>
                <p>圖片: <input type="file" name="image" id="editImage"></p>
                <input type="submit" name="confirmEdit" value="確認修改" class="modal-btn">
                <button type="button" class="modal-btn close">取消</button>
            </form>
        </div>
    </div>

    <script>
        function showDeleteModal(id, name, price, intro, image) {
            document.getElementById("deleteProductId").innerText = id;
            document.getElementById("deleteProductName").innerText = name;
            document.getElementById("deleteProductPrice").innerText = price;
            document.getElementById("deleteProductIntro").innerText = intro;
            document.getElementById("deleteProductImage").src = image;
            document.getElementById("deleteId").value = id;
            document.getElementById("deleteModal").style.display = "flex";
        }

        function showEditModal(id, name, price, intro, image) {
            document.getElementById("editId").value = id;
            document.getElementById("editName").value = name;
            document.getElementById("editPrice").value = price;
            document.getElementById("editIntro").value = intro;
            document.getElementById("editModal").style.display = "flex";
        }

        document.querySelectorAll('.close').forEach(function(element) {
            element.onclick = function() {
                document.getElementById("deleteModal").style.display = "none";
                document.getElementById("editModal").style.display = "none";
            };
        });

        window.onclick = function(event) {
            if (event.target == document.getElementById("deleteModal")) {
                document.getElementById("deleteModal").style.display = "none";
            }
            if (event.target == document.getElementById("editModal")) {
                document.getElementById("editModal").style.display = "none";
            }
        }
    </script>
</body>
</html>
