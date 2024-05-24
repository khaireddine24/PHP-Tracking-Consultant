<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');
$consultantController = new ConsultantController();
$consultants = $consultantController->getMissionsWithConsultants();
if ($consultants && $consultants->rowCount() > 0) {
    $row = $consultants->fetch(PDO::FETCH_ASSOC);
	$id = $row['consultant_id'];
} else {
    echo "error.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultants</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        input[type="button"], input[type="submit"] {
            margin-top: 10px;
        }
        .disp{
            display:flex;
        }
    </style>
</head>
<body class="container">
    <input type="text" id="searchInput" onkeyup="filterTable()" class="form-control mt-3" placeholder="Rechercher par nom">
    <table id="consultantTable" class="table mt-3">
        <thead>
            <tr>
                <th>UserName</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                    <td>
                        <details>
                            <summary>More details</summary>
                            <?php echo "Cin : ".$row['cin']; ?>
                            <?php echo "<br/>E-mail : ".$row['email']; ?>
                            <?php echo "<br/>Date of birth : ".$row['date_of_birth']; ?>
                            <?php echo "<br/>Place of birth : ".$row['place_of_birth']; ?>
                            <?php echo "<br/>Country of residence : ".$row['country_of_residence']; ?>
                        </details>
                    </td>
                </tr>
        </tbody>
    </table>
    <a href="AgentDashboard.php" class="btn btn-secondary">Back</a>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("consultantTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
