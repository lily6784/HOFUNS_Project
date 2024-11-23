<?php
// login.php
session_start();
require_once 'config.php';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM "8500_HKMU_G13"."USERS" WHERE "username" = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && crypt($password, $user['password']) === $user['password'])  {
            if ($user['Status_inactive']) {
                echo "The user does not work at here any more.";
            } 
            else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];


                 // 根据用户类型进行重定向
                 switch ($user['role']) {
                    case 'admin':
                        header("Location: dashboardforadmin.php");
                        break;
                    case 'saler':
                        header("Location: dashboardforsaler.php");
                        break;
                    case 'keeper':
                        header("Location: dashboardforkeeper.php");
                        break;
                    default:
                        echo "ineffective role！";
                }
                 exit();  // 确保脚本停止执行
            }
         } else {
            echo "Wrong username or password, please try again！";
        }
    }
} catch (PDOException $e) {
    echo "fail to connect：" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HoManTin Furniture Nexus System</title>
  <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1890ff 0%, #722ed1 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

.login-container {
    background: rgba(255, 255, 255, 0.98);
    padding: 45px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    width: 420px;
    transition: transform 0.3s ease;
}

.login-container:hover {
    transform: translateY(-5px);
}

.login-header {
    text-align: center;
    margin-bottom: 35px;
}

.login-header h1 {
    color: #2d3748;
    font-size: 32px;
    margin-bottom: 12px;
    font-weight: 600;
}

.login-header p {
    color: #718096;
    font-size: 16px;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    color: #4a5568;
    font-size: 15px;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 14px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.login-btn {
    width: 100%;
    padding: 14px;
    background: #667eea;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.login-btn:hover {
    background: #5a67d8;
    transform: translateY(-1px);
}

.login-footer {
    text-align: center;
    margin-top: 25px;
}

.login-footer a {
    color: #667eea;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.3s ease;
}

.login-footer a:hover {
    color: #5a67d8;
    text-decoration: underline;
}
</style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
        <h1>HoManTin Furniture Nexus System</h1>
    <div>

<form id="loginForm" method="POST">
    <div class="form-group">
        <label for="username">Username</label>        
        <input type="text" name="username" placeholder="Enter your username" required>
        </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        </div>
    <button type="submit" class="login-btn">Sign In</button>
    </form>
    </div>
</body>
</html>