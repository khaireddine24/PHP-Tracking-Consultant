<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');

$consController = new ConsultantController();
$row = $consController->consultantList();
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["connect"])) {
    $em = $_POST['email'];
    $pass = $_POST['password'];
    
    foreach ($row as $ad) {
        if ($ad['email'] === $em && $ad['pass'] === $pass) {
            $id = $ad['consultant_id'];
            header("Location: ConsultantDashboard.php?id=$id");
            exit();
        }
    }
    $url = 'LoginCons.php?showAlert=true';
    header('Location: ' . $url);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LoginConsultant Form</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<div class="container login-container">
    <!-- Ajoutez un champ input hidden pour l'identifiant -->
    <form action="LoginCons.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <h2 class="text-center mb-4">Login Consultant</h2>
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
