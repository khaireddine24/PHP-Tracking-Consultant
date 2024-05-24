<?php
include_once('../database/config.php');
include_once('../controllers/AgentController.php');

$agentController = new AgentController();

if (isset($_POST['hr_agent_id'])) {
    $idcons = $_POST['hr_agent_id'];
    $cons = $agentController->getAgent($idcons);

    if ($cons) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["Save"])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $id = $_POST['hr_agent_id'];

            $updateCons = new agent($first_name, $last_name, $email, $password, $id);
            $agentController->updateAgent($updateCons);

            header("Location: AdminDashboard.php");
            exit();
        }
    } else {
        echo "Agent not found.";
        exit();
    }
} else {
    echo "ID agent not defined";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Update Agent</h2>
        <form action="ModifyAgent.php" method="POST">
            <input type="hidden" name="hr_agent_id" value="<?= $cons['hr_agent_id']; ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required value="<?= $cons['first_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required value="<?= $cons['last_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required value="<?= $cons['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required value="<?= $cons['pass']; ?>">
            </div>
            <input type="submit" class="btn btn-primary" name="Save" value="Save">
            <input type="reset" class="btn btn-danger" value="Cancel">
        </form>
    </div>
</body>
</html>
