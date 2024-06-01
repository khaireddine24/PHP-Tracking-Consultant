<?php
include_once('../database/config.php');
include_once('../controllers/MissionController.php');

$missionController = new MissionController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["AddM"])) {
        $position = $_POST['position'];
        $field_of_activity = $_POST['field_of_activity'];
        $client_name = $_POST['client_name'];
        $client_representative = $_POST['client_representative'];
        $mission_start_date = $_POST['mission_start_date'];
        $mission_end_date = $_POST['mission_end_date'];
        $daily_rate = $_POST['daily_rate'];
        $consultant_id = $_POST['cons_id'];

        if (strtotime($mission_start_date) > strtotime($mission_end_date)) {
            die("Erreur : La date de début ne peut pas être superieure à la date de fin.");
        }

        $mission = new Mission($position, $field_of_activity, $client_name, $client_representative, $mission_start_date, $mission_end_date, $daily_rate, $consultant_id);

        try {
            if ($missionController->insert($mission)) {
                header("Location: ConsultantDashboard.php?id=$id");
                exit();
            } else {
                echo "Erreur lors de l'ajout de la mission.";
            }
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
        }
    }
} else {
    echo "Veuillez vérifier votre ID.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mission</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styleMission.css">
    <link rel="icon" href="./assets/MissionIcon.png"/>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Formulaire de mission</h1>
        
        <form action="MissionVue.php?id=<?= htmlspecialchars($id); ?>" method="post">
            <input type="hidden" name="cons_id" value="<?= htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="position">Position :</label>
                <input type="text" id="position" name="position" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="field_of_activity">Activity :</label>
                <input type="text" id="field_of_activity" name="field_of_activity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="client_name">Client Name :</label>
                <input type="text" id="client_name" name="client_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="client_representative">Client Position :</label>
                <input type="text" id="client_representative" name="client_representative" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mission_start_date">Date Start :</label>
                <input type="date" id="mission_start_date" name="mission_start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mission_end_date">Date End :</label>
                <input type="date" id="mission_end_date" name="mission_end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="daily_rate">Daily Rate :</label>
                <input type="number" id="daily_rate" name="daily_rate" class="form-control" min="1" required>
            </div>
            <input type="submit" class="btn btn-primary" name="AddM" value="envoyer">
        </form>
    </div>
</body>
</html>
