<?php
// Establish MySQL database connection
$mysqli = new mysqli('localhost', 'id22250158_final', 'A11133_nukim', 'id22250158_final');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch data from the messages table
$query = "SELECT * FROM messages";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>顧客意見</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Check if there are any messages
        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<h2>顧客意見</h2>";
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>顧客姓名</th>
                        <th>顧客Email</th>
                        <th>顧客意見</th>
                        <th>頻論時間</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["message"]) . "</td>
                        <td>" . htmlspecialchars($row["created_at"]) . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>尚無顧客意見。</p>";
        }

        // Close database connection
        $mysqli->close();
        ?>
        <div class="btn-container">
            <a href="owner.php" class="btn">返回管理員頁面</a>
        </div>
    </div>
</body>
</html>
