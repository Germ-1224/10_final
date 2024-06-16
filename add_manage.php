<meta charset="utf-8">

<?php
$link = @mysqli_connect(
    'localhost',  //主機名稱
    'id22250158_final',  //使用者名稱
    'A11133_nukim',  //密碼
    'id22250158_final'  //預設使用的資料庫名稱
);

if (!$link) {
    echo "資料庫連接錯誤!<br/>";
    echo "<script>setTimeout(function(){ window.location.href = 'add_product.php'; }, 3000);</script>";
    exit();
}

// Step 2: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $introduction = $_POST["introduction"];

    // Check if an image was uploaded
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES["image"]["name"]);
        $upload_dir = 'uploads/';
        
        // Create the uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $image_path = $upload_dir . $image_name;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($tmp_name, $image_path)) {
            echo "Image uploaded successfully.<br/>";
        } else {
            echo "Failed to upload image.<br/>";
            $image_path = "";  // If upload fails, set image path to an empty string
        }
    } else {
        $image_path = "";  // If no image uploaded, set image path to an empty string
    }

    $sql = "INSERT INTO products (name, price, intro, image) VALUES (?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sdss", $name, $price, $introduction, $image_path);
    
    if ($stmt->execute()) {
        echo "商品新增成功，將在3秒後重回新增頁面 !<br/>";
    } else {
        echo "發生了點錯誤，新增失敗，將在3秒後重回新增頁面" . $link->error . "<br/>";
    }

    $stmt->close();
}

echo "<script>setTimeout(function(){ window.location.href = 'add_product.php'; }, 3000);</script>";

$link->close();
?>
