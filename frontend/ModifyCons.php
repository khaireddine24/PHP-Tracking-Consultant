<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');

$consultantController = new ConsultantController();

if (isset($_POST['consultant_id'])) {
    $idcons = $_POST['consultant_id'];
    $cons = $consultantController->getConsultant($idcons);

    if ($cons) {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["Save"])) {
                
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $cin = $_POST['cin'];
                $date_of_birth=$_POST['date_of_birth'];
                $place_of_birth=$_POST['place_of_birth'];
                $country_of_residence=$_POST['country_of_residence'];
                $email = $_POST['email'];
                $mdp=$_POST['mdp'];
                $cmdp=$_POST['cmdp'];
                $id=$_POST["consultant_id"];
                $updateCons = new Consultant($first_name, $last_name,$cin,$date_of_birth,$place_of_birth,$country_of_residence,$email,$mdp,$cmdp,$id);
                $consultantController->updateConsultant($updateCons);
               
                header("Location: AdminDashboard.php");
                exit();
    }
    } else {
        echo "Consultant not found.";
        exit();
    }
} else {
    echo "ID Consultant not defined.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultant Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Update Consultant</h2>
        <form action="ModifyCons.php" method="POST">
        <input type="hidden" name="consultant_id" value="<?= $cons['consultant_id']; ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required  value="<?= $cons['first_name']; ?>">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required value="<?= $cons['last_name']; ?>">
            </div>

            <div class="mb-3">
                <label for="cin" class="form-label">Cin:</label>
                <input type="text" id="cin" name="cin" class="form-control" required value="<?= $cons['cin']; ?>">
            </div>
            
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required value="<?= $cons['date_of_birth']; ?>">
            </div>
            
            <div class="mb-3">
                <label for="place_of_birth" class="form-label">Place of Birth:</label>
                <input type="text" id="place_of_birth" name="place_of_birth" class="form-control" required value="<?= $cons['place_of_birth']; ?>">
            </div>
            
            <div class="mb-3">
                <label for="country_of_residence" class="form-label">Country of Residence:</label>
                <input type="text" id="country_of_residence" name="country_of_residence" class="form-control" required value="<?= $cons['country_of_residence']; ?>">
            </div>
            
            
            <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required value="<?= $cons['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Password:</label>
                <input type="text" id="mdp" name="mdp" class="form-control" required value="<?= $cons['pass']; ?>">
            </div>
            
            <div class="mb-3">
                <label for="cmdp" class="form-label">Confirm Password:</label>
                <input type="text" id="cmdp" name="cmdp" class="form-control" required value="<?= $cons['confpassword']; ?>">
            </div>


            <input type="submit" class="btn btn-primary" name="Save" value="Save">
            <input type="reset" class="btn btn-danger" value="cancel"/>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
