<?php
// Establish MySQL database connection
$mysqli = new mysqli('localhost', 'id22250158_final', 'A11133_nukim', 'id22250158_final');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch total earnings from the database
$query = "SELECT SUM(total_amount) AS total_earnings FROM orders";
$result = $mysqli->query($query);
$totalEarningsRow = $result->fetch_assoc();
$totalEarnings = $totalEarningsRow['total_earnings'];

// Fetch data from the database
$query = "SELECT product_details FROM orders";
$result = $mysqli->query($query);

// Process data to aggregate product quantities
$productQuantities = [];
while ($row = $result->fetch_assoc()) {
    $orderDetails = json_decode($row['product_details'], true);
    foreach ($orderDetails as $item) {
        $productName = $item['name'];
        $quantity = $item['quantity'];
        if (!isset($productQuantities[$productName])) {
            $productQuantities[$productName] = $quantity;
        } else {
            $productQuantities[$productName] += $quantity;
        }
    }
}

// Close database connection
$mysqli->close();

// Sort products by name
ksort($productQuantities);

// Prepare data for the pie chart
$productNames = array_keys($productQuantities);
$productQuantitiesArray = array_values($productQuantities);

// Convert the data to JSON format for JavaScript
$productNamesJSON = json_encode($productNames);
$productQuantitiesJSON = json_encode($productQuantitiesArray);
?>

<!DOCTYPE html>
<html>
<head>
    <title>商品銷售狀況</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Display the table of product sales -->
    <h2 style="text-align: center;">商品銷售狀況</h2>
    <div style="width: 50%; margin: auto;">
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center; border-collapse: collapse;">
            <tr>
                <th style="padding: 10px;">商品名稱</th>
                <th style="padding: 10px;">商品總銷售數量</th>
            </tr>
            <?php foreach ($productQuantities as $productName => $quantity): ?>
            <tr>
                <td style="padding: 10px;"><?php echo $productName; ?></td>
                <td style="padding: 10px;"><?php echo $quantity; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Display total earnings and congratulatory message -->
    <div style="text-align: center; margin-top: 20px;">
        <p style="font-weight: bold;">總收入: $<?php echo number_format($totalEarnings, 2); ?></p>
        <?php if ($totalEarnings > 0): ?>
        <p style="color: black; font-weight: bold;">恭喜！這個月有賺錢喔！🎉</p>
        <?php endif; ?>
    </div>

    <!-- Display the pie chart -->
    <h2 style="text-align: center;">圓餅圖</h2>
    <div style="width: 50%; margin: auto;">
        <canvas id="pieChart"></canvas>
    </div>

    <script>
        // Prepare data for the pie chart
        var productNames = <?php echo $productNamesJSON; ?>;
        var productQuantities = <?php echo $productQuantitiesJSON; ?>;

        // Create the pie chart
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: productNames,
                datasets: [{
                    label: '商品銷售數量',
                    data: productQuantities,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    
    <!-- Button to navigate to owner.php -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="owner.php">
            <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">離開</button>
        </a>
    </div>
</body>
</html>
