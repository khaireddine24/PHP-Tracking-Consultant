<?php
$con = mysqli_connect("localhost", "root", "", "gestion_consultants");

if (isset($_GET['id'])) {
    $documentId = $_GET['idDoc'];
    $consId = $_GET['id'];
    $sql_fetch = "SELECT * FROM `document` WHERE `id`='$documentId'";
    $result_fetch = mysqli_query($con, $sql_fetch);
    $fetch = mysqli_fetch_assoc($result_fetch);
    $cinCopyCurrent = $fetch['CinCopy'];
    $permisCopyCurrent = $fetch['PermisCopy'];
    $fileSimulationCurrent = $fetch['FileSimulation'];
} else {
    echo "Verifier";
    exit;
}

if (isset($_POST['btn_update'])) {
    $cinCopy = $_FILES["cinCopy"]["name"];
    $permisCopy = $_FILES["permisCopy"]["name"];
    $fileSimulation = $_FILES["fileSimulation"]["name"];

    if ($_FILES["cinCopy"]["error"] == 0 && $_FILES["permisCopy"]["error"] == 0 && $_FILES["fileSimulation"]["error"] == 0) {
        $uploadDir = "uploads/";
        move_uploaded_file($_FILES["cinCopy"]["tmp_name"], $uploadDir . basename($cinCopy));
        move_uploaded_file($_FILES["permisCopy"]["tmp_name"], $uploadDir . basename($permisCopy));
        move_uploaded_file($_FILES["fileSimulation"]["tmp_name"], $uploadDir . basename($fileSimulation));

        $sql_update = "UPDATE `document` SET `CinCopy`='$cinCopy', `PermisCopy`='$permisCopy', `FileSimulation`='$fileSimulation' WHERE `id`='$documentId'";
        $result_update = mysqli_query($con, $sql_update);
        if ($result_update) {
            echo "
            <div class='alert alert-success' role='alert'>
                <h4 class='text-center'>Document updated successfully</h4>
            </div>
            ";
            header("Location: upload.php?idDoc=$documentId&id=$consId");
        } else {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='text-center'>Error updating document</h4>
            </div>
            ";
        }
    } else {
        echo "
        <div class='alert alert-danger' role='alert'>
            <h4 class='text-center'>Error uploading files</h4>
        </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Document</title>
    <link rel="icon" href="./assets/DocumentIcon.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Document</h2>
        <form action="updateDocument.php?idDoc=<?php echo $documentId; ?>&id=<?php echo $consId; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="cinCopy" class="form-label">Cin Copy:</label>
                <input type="file" class="form-control" id="cinCopy" name="cinCopy" accept="image/*">
                <p>Current Cin Copy: <?php echo $cinCopyCurrent; ?></p>
            </div>
            <div class="mb-3">
                <label for="permisCopy" class="form-label">Permis Copy:</label>
                <input type="file" class="form-control" id="permisCopy" name="permisCopy" accept="image/*">
                <p>Current Permis Copy: <?php echo $permisCopyCurrent; ?></p>
            </div>
            <div class="mb-3">
                <label for="fileSimulation" class="form-label">File Simulation:</label>
                <input type="file" class="form-control" id="fileSimulation" name="fileSimulation" accept=".pdf">
                <p>Current File Simulation: <?php echo $fileSimulationCurrent; ?></p>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_update">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
