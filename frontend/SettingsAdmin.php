<?php
include_once('../database/config.php');
include_once('../controllers/AdminController.php');

$adminController = new AdminController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ad = $adminController->getAdmin($id);

    if ($ad) {
        $username = $ad['username'];
        $email = $ad['email'];
        $pass = $ad['password'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateSett"])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $AdminUp = new Admin($username, $email, $pass, $id);
            $adminController->updateAdmin($AdminUp);

            header("Location: AdminDashboard.php");
            exit();
        }
    } else {
        echo "Admin non trouvé.";
        exit();
    }
} else {
    echo "ID admin non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>
    <div class="settings-container">
        <h1>Settings</h1>
        <form action="SettingsAdmin.php?id=<?= $id; ?>" method="POST" name="F">
            <input type="hidden" name="admin_id" value="<?= $id; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= $username; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $email; ?>">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= $pass; ?>">

            <input type="submit" value="Save Changes" name="updateSett">
        </form>
    </div>
</body>
</html>
