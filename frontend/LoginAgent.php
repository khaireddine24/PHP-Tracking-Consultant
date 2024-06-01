<?php
include_once('../database/config.php');
include_once('../controllers/AgentController.php');

$agentController = new AgentController();
$row = $agentController->agentListe();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["connect"])) {
    $em = $_POST['email'];
    $pass = $_POST['password'];
    
    foreach ($row as $ad) {
        if ($ad['email'] === $em && $ad['pass'] === $pass) {
            $id = $ad['hr_agent_id'];
            header("Location: AgentDashboard.php?id=$id");
            exit();
        }
    }
    $url = 'LoginAgent.php?showAlert=true';
    header('Location: ' . $url);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LoginAgent Form</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/login.css"/>
<link rel="icon" href="./assets/AgentRo.png"/>
</head>
<body>
<div class="container login-container">
    <form action="LoginAgent.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id ?>">
        <h2 class="text-center mb-4">Login Agent</h2>
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
