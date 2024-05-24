<?php
$con = mysqli_connect("localhost", "root", "", "gestion_consultants");

if (isset($_GET['id'])) {
    $consultant_id = $_GET['id'];
} else {
    echo "Verifier";
    exit;
}

$uploadDir = 'uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_POST['btn_img'])) {
    $cinCopy = $_FILES["cinCopy"]["name"];
    $permisCopy = $_FILES["permisCopy"]["name"];
    $fileSimulation = $_FILES["fileSimulation"]["name"];

    if ($fileSimulation == "") {
        echo "
        <div class='alert alert-danger' role='alert'>
            <h4 class='text-center'>Blank not Allowed</h4>
        </div>
        ";
    } else {
        // Déplacer les fichiers uploadés vers un répertoire spécifique
        $uploadDir = "uploads/";
        move_uploaded_file($_FILES["cinCopy"]["tmp_name"], $uploadDir . basename($cinCopy));
        move_uploaded_file($_FILES["permisCopy"]["tmp_name"], $uploadDir . basename($permisCopy));
        move_uploaded_file($_FILES["fileSimulation"]["tmp_name"], $uploadDir . basename($fileSimulation));

        $sql = "INSERT INTO `document`(`consultant_id`, `CinCopy`, `PermisCopy`, `FileSimulation`) VALUES ('$consultant_id', '$cinCopy', '$permisCopy', '$fileSimulation')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "
            <div class='alert alert-success' role='alert'>
                <h4 class='text-center'>Files uploaded successfully</h4>
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='text-center'>Error uploading files</h4>
            </div>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Upload Documents</title>
    <style>
        a {
            margin-left: 40%;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="alert alert-secondary" role="alert">
        <h4 class="text-center">Upload Documents</h4>
    </div>
    <div class="container col-12 m-5">
        <div class="col-6 m-auto">
            <form action="upload.php?id=<?php echo $consultant_id; ?>" method="post" class="form-control" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="cinCopy" class="form-label">Cin Copy</label>
                    <input type="file" class="form-control" name="cinCopy" id="cinCopy" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="permisCopy" class="form-label">Permis Copy</label>
                    <input type="file" class="form-control" name="permisCopy" id="permisCopy" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="fileSimulation" class="form-label">File Simulation</label>
                    <input type="file" class="form-control" name="fileSimulation" id="fileSimulation" accept=".pdf">
                </div>
                <div class="col-4 m-auto">
                    <button type="submit" name="btn_img" class="btn btn-outline-success m-4">Submit</button>
                </div>
            </form>
            <table class="table text-center">
                <tr>
                    <th>Cin Copy</th>
                    <th>Permis Copy</th>
                    <th style="width:25%">File Simulation</th>
                    <th>Action to Delete</th>
                    <th>Action to Update</th>
                </tr>
                <?php
                $sql2 = "SELECT * FROM `document` WHERE `consultant_id` = '$consultant_id'";
                $result2 = mysqli_query($con, $sql2);
                while ($fetch = mysqli_fetch_assoc($result2)) {
                    ?>
                    <tr>
                        <td><?php echo !empty($fetch['CinCopy']) ? $fetch['CinCopy'] : "No File Here"; ?></td>
                        <td><?php echo !empty($fetch['PermisCopy']) ? $fetch['PermisCopy'] : "No File Here"; ?></td>
                        <td style="width:20%"><?php echo !empty($fetch['FileSimulation']) ? $fetch['FileSimulation'] : "No File Here"; ?></td>
                        <td>
                            <?php    
                               
                            if (!empty($fetch['CinCopy']) || !empty($fetch['PermisCopy']) || !empty($fetch['FileSimulation'])) {
                                echo '<a href="delete.php?id=' . $fetch['id'] . '&consultant_id=' . $consultant_id . '" class="btn btn-outline-danger">Delete</a>';
                            } else {
                                echo 'No File Here';
                            }
                            ?>
                        </td>
                        <td>
                        <?php       
                            if (!empty($fetch['CinCopy']) || !empty($fetch['PermisCopy']) || !empty($fetch['FileSimulation'])) {
                                echo '<a href="updateDocument.php?idDoc=' . $fetch['id'] .'&id=' . $consultant_id . '" class="btn btn-outline-primary">Update</a>';
                            } else {
                                echo 'No File Here';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                } 
                ?>
            </table>
        </div>
    </div>
    <a href="ConsultantDashboard.php?id=<?php echo $consultant_id; ?>" class="btn btn-secondary" id="back">Back</a>
</body>
</html>
