<?php
session_start();
require_once 'config.php';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function getCurrentStock($pdo) {
        $stmt = $pdo->query('SELECT 
        item_name, 
        COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END)  AS total_quantity, 
        SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) AS total_scrapped,
        SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) AS total_sold,
        SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS total_returned,
        COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) - 
        SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) - 
        SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS onshelf
    FROM 
        "8500_HKMU_G13"."INVENTORY"
    GROUP BY 
        item_name
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSoldRecords($pdo) {
        $stmt = $pdo->query('SELECT 
        item_name, 
        COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END)  AS total_quantity, 
        SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) AS total_scrapped,
        SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) AS total_sold,
        SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS total_returned,
        COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) - 
        SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) - 
        SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS onshelf
    FROM 
        "8500_HKMU_G13"."INVENTORY"
    GROUP BY 
        item_name
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getReturnedRecords($pdo) {
        $stmt = $pdo->query('SELECT 
        item_name, 
        COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END)  AS total_quantity, 
        SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) AS total_scrapped,
        SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) AS total_sold,
        SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS total_returned,
        COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) - 
        SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) - 
        SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS onshelf
    FROM 
        "8500_HKMU_G13"."INVENTORY"
    GROUP BY 
        item_name
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sold_quantity'])) {
        $solditemName = trim($_POST['sold_item_name']);
        $itemquantity = trim($_POST['sold_quantity']);

        for ($i = 0; $i < $itemquantity; $i++) {
        $stmt = $pdo->prepare('
            UPDATE "8500_HKMU_G13"."INVENTORY"
            SET status_sold = TRUE
            
            WHERE item_id = (
                SELECT item_id
                FROM "8500_HKMU_G13"."INVENTORY" 
                WHERE item_name = :item_name AND status_sold = FALSE
                ORDER BY item_id ASC
                LIMIT 1
                FOR UPDATE SKIP LOCKED
            )
                         
        ');
        $stmt->execute(['item_name' => $solditemName]);
        $updatedItem = $stmt->fetch(PDO::FETCH_ASSOC);

        }
        
        echo "Sold！";
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['returned_quantity'])) {
        $returneditemName = trim($_POST['returned_item_name']);
        $itemquantity = trim($_POST['returned_quantity']);

        for ($i = 0; $i < $itemquantity; $i++) {
        $stmt = $pdo->prepare('
            UPDATE "8500_HKMU_G13"."INVENTORY"
            SET status_returned = TRUE
            
            WHERE item_id = (
                SELECT item_id
                FROM "8500_HKMU_G13"."INVENTORY" 
                WHERE item_name = :item_name AND status_returned = FALSE
                ORDER BY item_id ASC
                LIMIT 1
                FOR UPDATE SKIP LOCKED
            )
                         
        ');
        $stmt->execute(['item_name' => $returneditemName]);
        $updatedItem = $stmt->fetch(PDO::FETCH_ASSOC);

        }
        
        echo "Returned！";
    }
    

} catch (PDOException $e) {
    echo "connection failed" . htmlspecialchars($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Inventory Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;

            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            /*border: 1px solid black;*/
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        nav {
            margin-bottom: 20px;
        }

        section {
            margin-bottom: 40px;
        }

        .no-style {
            text-decoration: none;
            color: inherit;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 40px;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: #2d3748;
            font-size: 32px;
            margin-bottom: 12px;
        }

        .form-header p {
            color: #718096;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #4a5568;
            font-size: 15px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            height: 47px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-group textarea {
            height: 120px;
            resize: vertical;
        }


        .title-ard {
            height: 50px;
            line-height: 50px;
            background: #3182ce;
            text-align: center;
            color: #fff;
        }


        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            font-size: 15px;
        }

        .data-table th,
        .data-table td {
            padding: 16px 24px;
            text-align: left;
            border-bottom: 1px solid #edf2f7;
        }

        .data-table th {
            background-color: #f8fafc;
            color: #4a5568;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .data-table tbody tr {
            transition: all 0.2s ease;
        }

        .data-table tbody tr:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
        }

        .data-table td {
            color: #2d3748;
        }

        .stock-card {
            width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 3rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dashboard-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
        .table-title {
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-title::after {
            content: '';
            flex-grow: 1;
            height: 2px;
            background: linear-gradient(to right, #e0c3fc, #8ec5fc);
            margin-left: 20px;
            border-radius: 2px;
        }


        .make-control {
            width: 180px!important;
            margin: 5px;
            background: #3182ce!important;
            color: #fff!important;
        }

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <header class="dashboard-header">
    <h1>Selling Management</h1>
    </header>
    <hr class="border border-danger border-2 opacity-50">

    <nav>
    <div class="form-group">


        <h2>Menu</h2>
            <div>

            </div>
                <ul>
                    <li>
                    <button class="btn btn-primary"><a href="#current_stock" class="no-style ">Inventory</a>
                    </button>
                    </li>
                    <li>
                    </li>
                    <li>
                    <button class="btn btn-primary"><a href="#sold_records"class="no-style ">Selling Records</a>
                    </button>
                    </li>
                    <li>
                    </li>
                    <li>
                    <button class="btn btn-primary"><a href="#returned_records"class="no-style ">Returning Records</a>
                    </button>
                    </li>
                    <li>
                    </li>
                    <li>
                    <button class="btn btn-primary"><a href="#add_sold"class="no-style ">To Sell</a>
                    </button>
                    </li>
                    <li>
                    </li>
                    <li>
                    <button class="btn btn-primary"><a href="#add_returned"class="no-style ">To Return</a>
                    </button>
                    </li>
                    <li>
                    </li>
                </ul>
            </nav>

            <section id="current_stock">
                <h2 class="table-title">Inventory</h2>
                <table class="data-table">
                    <tr>
                        <th>Items</th>
                        <th>On shelf</th>
                        <th>Sold</th>
                        <th>Returned</th>
                    </tr>
                    <?php foreach (getCurrentStock($pdo) as $stock): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($stock['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($stock['onshelf']); ?></td>
                        <td><?php echo htmlspecialchars($stock['total_sold']); ?></td>
                        <td><?php echo htmlspecialchars($stock['total_returned']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <section id="sold_records">
                <h2 class="table-title" >Selling Records</h2>
                <table class="data-table">
                    <tr>
                        <th>Items</th>
                        <th>Sold</th>
                        <th>On shelf</th>
                        <th>Sold pecentage (%)</th>
                    </tr>
                    <?php foreach (getSoldRecords($pdo) as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($record['total_sold']); ?></td>
                        <td><?php echo htmlspecialchars($record['onshelf']); ?></td>
                        <td><?php echo ($record['total_quantity'] > 0) ? round(($record['total_sold'] / $record['total_quantity']) * 100, 2) : 0; ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <section id="returned_records">
                <h2 class="table-title">Returning Records</h2>
                <table class="data-table">
                    <tr>
                        <th>Items</th>
                        <th>Returned</th>
                        <th>On shelf</th>
                        <th>Returned pecentage (%)</th>
                    </tr>
                    <?php foreach (getReturnedRecords($pdo) as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($record['total_returned']); ?></td>
                        <td><?php echo htmlspecialchars($record['onshelf']); ?></td>
                        <td><?php echo ($record['total_quantity'] > 0) ? round(($record['total_returned'] / $record['total_quantity']) * 100, 2) : 0; ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <section id="add_sold">
                <h5  class="card-title title-ard">To sell</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group">

                            <label for="sold_item_name">items:</label>
                            <input type="text" id="sold_item_name" name="sold_item_name" required>
                        </div>  
                        <div class="form-group">      
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="sold_quantity" required min="1">
                        </div>
                        
                            <div class="form-group" style="width: 140px">  

                                <input type="submit" name="mark_sold" value="Sell">
                            </div>     
                </form>
            </section>

            <section id="add_returned">
                <h5 class="card-title title-ard">To return</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group">

                            <label for="returned_item_name">items:</label>
                            <input type="text" id="return_item_name" name="returned_item_name" required>
                        </div>  
                        <div class="form-group">      
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="returned_quantity" required min="1">
                        </div>
                        
                            <div class="form-group" style="width: 140px">  

                                <input type="submit" name="mark_returned" value="Return">
                            </div>     
                </form>
            </section>

</body>
</html>