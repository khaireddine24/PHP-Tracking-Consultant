<?php
include_once('../database/config.php');
include_once('../controllers/AdminController.php');

$adminController = new AdminController();
$row = $adminController->adminList();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["connect"])) {
    $em = $_POST['email'];
    $pass = $_POST['password'];
    
    foreach ($row as $ad) {
        if ($ad['email'] === $em && $ad['password'] === $pass) {
            header("Location: AdminDashboard.php");
            exit();
        }
    }
    $url = 'Admin/login.php?showAlert=true';
    header('Location: ' . $url);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="./assets/AdminRo.png"/>
<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<div class="container login-container">
    <form action="login.php" method="POST">
        <h2 class="text-center mb-4">Login</h2>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="connect">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const showAlert = urlParams.get('showAlert');
            if (showAlert === 'true') {
                alert("Incorrect username or password");
            }
        });
    </script>

</html>
