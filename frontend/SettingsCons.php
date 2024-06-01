<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');

$ConsController = new ConsultantController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cons = $ConsController->getConsultant($id);

    if ($cons) {
        $first_name = $cons['first_name'];
        $last_name = $cons['last_name'];
        $cin = $cons['cin'];
        $dateBirth = $cons['date_of_birth'];
        $placeBirth = $cons['place_of_birth'];
        $country = $cons['country_of_residence'];
        $email = $cons['email'];
        $pass = $cons['pass'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateSett"])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $cin = $_POST['cin'];
            $email = $_POST['email'];
            $dateBirth = $_POST['date_of_birth'];
            $placeBirth = $_POST['place_of_birth'];
            $country = $_POST['country_of_residence'];
            $pass = $_POST['password'];

            $ConsUp = new Consultant($first_name, $last_name, $cin, $dateBirth, $placeBirth, $country, $email, $pass, $pass, $id);
            $ConsController->updateConsultant($ConsUp);

            header("Location: ConsultantDashboard.php?id=$id");
            exit();
        }
    } else {
        echo "Consultant non trouvé.";
        exit();
    }
} else {
    echo "ID consultant non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <link rel="icon" href="./assets/ConsRo.png"/>
    <link rel="stylesheet" href="css/settings.css">
    <style>
        .settings-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <h1>Settings</h1>
        <form action="SettingsCons.php?id=<?= $id; ?>" method="POST" name="F">
            <input type="hidden" name="cons_id" value="<?= $id; ?>">

            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" id="firstname" name="first_name" value="<?= $first_name; ?>">
            </div>

            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" name="last_name" value="<?= $last_name; ?>">
            </div>

            <div class="form-group">
                <label for="cin">Cin:</label>
                <input type="text" id="cin" name="cin" value="<?= $cin; ?>">
            </div>

            <div class="form-group">
                <label for="dateB">Date of Birth:</label>
                <input type="date" id="dateB" name="date_of_birth" value="<?= $dateBirth; ?>">
            </div>

            <div class="form-group">
                <label for="placeB">Place of Birth:</label>
                <input type="text" id="placeB" name="place_of_birth" value="<?= $placeBirth; ?>">
            </div>

            <div class="form-group">
                <label for="country">Country of Residence:</label>
                <input type="text" id="country" name="country_of_residence" value="<?= $country; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $email; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?= $pass; ?>">
            </div>


            <input type="submit" value="Save Changes" name="updateSett">
        </form>
    </div>
</body>
</html>
