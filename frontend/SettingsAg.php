<?php
include_once('../database/config.php');
include_once('../controllers/AgentController.php');

$agentController = new AgentController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ad = $agentController->getAgent($id);

    if ($ad) {
        $firstname = $ad['first_name'];
        $lastname = $ad['last_name'];
        $email = $ad['email'];
        $pass = $ad['pass'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateSett"])) {
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $AgentUp = new Agent($firstname,$lastname, $email, $pass, $id);
            $agentController->updateAgent($AgentUp);

            header("Location: AgentDashboard.php?id=$id");
            exit();
        }
    } else {
        echo "Agent non trouvé.";
        exit();
    }
} else {
    echo "ID agent non spécifié.";
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
        <form action="SettingsAg.php?id=<?= $id; ?>" method="POST" name="F">
            <input type="hidden" name="agent_id" value="<?= $id; ?>">
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" name="first_name" value="<?= $firstname; ?>">

            <label for="lastname">Lastname:</label>
            <input type="text" id="lastname" name="last_name" value="<?= $lastname; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $email; ?>">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= $pass; ?>">

            <input type="submit" value="Save Changes" name="updateSett">
        </form>
    </div>
</body>
</html>
