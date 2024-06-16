<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>使用者新增商品</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Soft gray */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* White */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333333; /* Dark gray */
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555555; /* Gray */
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da; /* Light gray */
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff; /* Blue */
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue */
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #6ca6cd; /* Red */
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #437285; /* Darker red */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>新增商品</h1>
        <form method="POST" action="add_manage.php" enctype="multipart/form-data">
            <label for="name">商品名稱:</label>
            <input type="text" name="name" required>
           
            <label for="price">商品價格:</label>
            <input type="number" name="price" required>
           
            <label for="introduction">商品介紹:</label>
            <textarea name="introduction" required></textarea>
           
            <label for="image">圖片:</label>
            <input type="file" name="image">
           
            <input type="submit" value="新增商品">
        </form>
        <button onclick="goToIndex()">離開</button>
    </div>


    <script>
        function goToIndex() {
            window.location.href = 'owner.php';
        }
    </script>
</body>
</html>
