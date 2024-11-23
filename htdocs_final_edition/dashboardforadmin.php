<?php
session_start();
require_once 'config.php';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 查询所有用户
    function getAllUsers($pdo) {
        $stmt = $pdo->query('SELECT * FROM "8500_HKMU_G13"."USERS"');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 查询在职用户
    function getActiveUsers($pdo) {
        $stmt = $pdo->prepare('SELECT * FROM "8500_HKMU_G13"."USERS" WHERE status_inactive = FALSE');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 查询离职用户
    function getInactiveUsers($pdo) {
        $stmt = $pdo->prepare('SELECT * FROM "8500_HKMU_G13"."USERS" WHERE status_inactive = TRUE');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 新增用户
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
        $name = trim($_POST['name']);
        $username = trim($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = $_POST['role'];

        $stmt = $pdo->prepare('INSERT INTO "8500_HKMU_G13"."USERS" (name, username, password, role, status_inactive) VALUES (:name, :username, :password, :role, FALSE)');
        $stmt->execute(['name' => $name, 'username' => $username, 'password' => $password, 'role' => $role]);

        echo "Successfully new staff added！";
    }

    // 标记用户离职
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mark_inactive'])) {
        $userId = $_POST['id'];
        $stmt = $pdo->prepare('UPDATE "8500_HKMU_G13"."USERS" SET status_inactive = TRUE WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        echo "The staff is inactive！";
    }

    // 离职用户回归
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mark_active'])) {
        $userId = $_POST['id'];
        $stmt = $pdo->prepare('UPDATE "8500_HKMU_G13"."USERS" SET status_inactive = FALSE WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        echo "The staff is back！";
    }

    // 更改用户密码
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
        $userId = $_POST['id'];
        $newPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('UPDATE "8500_HKMU_G13"."USERS" SET password = :password WHERE id = :id');
        $stmt->execute(['password' => $newPassword, 'id' => $userId]);
        echo "password is updated！";
    }

    // 查询库存
    function getAllStock($pdo) {
        $stmt = $pdo->query('SELECT 
    item_name, 
    COUNT(item_id) AS total_quantity, 
    SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) AS total_scrapped,
    SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) AS total_sold,
    SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS total_returned,
    COUNT(item_id) - SUM(CASE WHEN status_scrapped = TRUE THEN 1 ELSE 0 END) - 
    SUM(CASE WHEN status_sold = TRUE THEN 1 ELSE 0 END) - 
    SUM(CASE WHEN status_returned = TRUE THEN 1 ELSE 0 END) AS onshelf
FROM 
    "8500_HKMU_G13"."INVENTORY"
GROUP BY 
    item_name');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 新增库存
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_stock'])) {
        $itemName = trim($_POST['item_name']);
        $quantity = intval($_POST['quantity']);

        for ($i = 0; $i < $quantity; $i++) {
            $stmt = $pdo->prepare('INSERT INTO "8500_HKMU_G13"."INVENTORY" (item_name, Status_scrapped, Status_sold, Status_returned) VALUES (:item_name,  FALSE, FALSE, FALSE)');
            $stmt->execute(['item_name' => $itemName]);
        }

        echo "items sucessfully added！";
    }

    //


} catch (PDOException $e) {
    echo "failing to connect：" . htmlspecialchars($e->getMessage());
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
        <h1>User and Inventory Management</h1>
    </header>
    <hr class="border border-danger border-2 opacity-50">

    <nav>
        <div class="form-group">
            <h2>Admin</h2>
            <div>

            </div>
            <ul>
                <li>
                <button class="btn btn-primary">
                    <a href="#add_user" class="no-style ">Add a new staff</a>
                </button>
                </li>
                <li>
                </li>
                <li>
                <button class="btn btn-primary">
                    <a href="#user_list" class="no-style ">Check all staffs list</a>
                </button>
                </li>
                <li>
                </li>
                <li>
                <button class="btn btn-primary">
                    <a href="#active_users" class="no-style ">Check active staffs</a>
                </button>
                </li>
                <li>
                </li>
                <li>
                <button class="btn btn-primary">
                    <a href="#inactive_users" class="no-style ">Check inactive staffs </a>
                </button>
                </li>
                <li>
                </li>
                <li>
                <button class="btn btn-primary">
                    <a href="#stock_list" class="no-style ">Check inventory</a>
                </button>
                </li>
                <li>
                </li>
                <li>
                <button class="btn btn-primary">
                    <a href="#add_stock" class="no-style ">Fix inventory</a>
                </button>
                </li>
                <li>
                </li>
            </ul>
    </nav>

<section id="add_user">

    <div class="card w-50 mb-3">
        <div class="card-body">
            <h5 class="card-title title-ard">Add a new staff</h5>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">First Name:</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">

                        <label for="username">username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">role:</label>
                        <select style="width: 190px" id="role" name="role" class="form-select"
                                aria-label="Default select example"
                                required>
                            <option value="admin">Admin</option>
                            <option value="saler">Saler</option>
                            <option value="keeper">Keeper</option>
                        </select>
                    </div>

                </div>
                <div class="form-group" style="width: 120px;float: left">
                    <input type="submit" class="btn btn-primary" name="add_user" value="Add a staff">
                </div>
            </form>
            <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
        </div>
    </div>

</section>

    <section id="user_list">
        <h2 class="table-title"> Staff List </h2>
        <table class="data-table"> 
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Username</th>
                <th>Status</th>
                <th>Admin</th>
            </tr>
            <?php foreach (getAllUsers($pdo) as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo $user['status_inactive'] ? 'Inactive' : 'Active'; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <input class="form-control make-control"   type="submit" name="mark_inactive" value="Mark as Inactive">
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <input class="form-control make-control"   type="submit" name="mark_active" value="Mark as Active">
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <input type="text" style="color: #fff!important;" class="form-control make-control"   name="new_password" placeholder="New password" required>
                        <input class="form-control make-control"   type="submit" name="change_password" value="Change password">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section id="active_users">
        <h2 class="table-title">Active staffs</h2>
        <table  class="data-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Username</th>
                <th>Status</th>
            </tr>
            <?php foreach (getActiveUsers($pdo) as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td>Active</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section id="inactive_users">
        <h2 class="table-title">inactive staffs</h2>
        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Username</th>
                <th>Status</th>
            </tr>
            <?php foreach (getInactiveUsers($pdo) as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td>Inactive</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section id="stock_list">
        <h2 class="table-title">Inventory</h2>
        <table class="data-table">
            <tr>
                <th>item names</th>
                <th>Quantity</th>
                <th>Scrapped</th>
                <th>Sold</th>
                <th>Returened</th>
                <th>On shelf</th>
            </tr>
            <?php foreach (getAllStock($pdo) as $stock): ?>
            <tr>
                <td><?php echo htmlspecialchars($stock['item_name']); ?></td>
                <td><?php echo htmlspecialchars($stock['total_quantity']); ?></td>
                <td><?php echo htmlspecialchars($stock['total_scrapped']); ?></td>
                <td><?php echo htmlspecialchars($stock['total_sold']); ?></td>
                <td><?php echo htmlspecialchars($stock['total_returned']); ?></td>
                <td><?php echo htmlspecialchars($stock['onshelf']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section id="add_stock">
        <h5 class="card-title title-ard">Add new items</h5>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                    <label for="item_name">Name of the item:</label>
                    <input type="text" id="item_name" name="item_name" required>
                    </div>

                    <div class="form-group">
                    
                    <label for="quantity">quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>
                    </div>

                </div>
                    <div class="form-group" style="width: 140px">            
                    <input type="submit" name="add_stock" value="Add new items">
                    </div>
            </form>
        </div>
    </div>

    </section>

</body>
</html>