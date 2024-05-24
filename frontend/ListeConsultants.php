<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');
$consultantController = new ConsultantController();
$consultants = $consultantController->consultantList();

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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultants as $c) : ?>
                <tr>
                    <td><?php echo $c['first_name'] . " " . $c['last_name']; ?></td>
                    <td>
                        <details>
                            <summary>More details</summary>
                            <?php echo "Cin : ".$c['cin']; ?>
                            <?php echo "<br/>E-mail : ".$c['email']; ?>
                            <?php echo "<br/>Date of birth : ".$c['date_of_birth']; ?>
                            <?php echo "<br/>Place of birth : ".$c['place_of_birth']; ?>
                            <?php echo "<br/>Country of residence : ".$c['country_of_residence']; ?>
                        </details>
                    </td>
                    <td>
                        <div class="disp">
                        <!-- for Modify -->
                        <form action="ModifyCons.php" method="post">
                            <input type="hidden" name="consultant_id" value="<?php echo $c['consultant_id']; ?>">
                            <button type="submit" class="btn btn-primary">Modify</button>
                        </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- for Delete -->
                        <form method="post" action="DeleteCons.php">
                            <input type="hidden" name="consultant_id" value="<?php echo $c['consultant_id']; ?>">
                            <button type="submit" class="btn btn-danger" name="del">Delete</button>
                        </form>
                    </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="AdminDashboard.php" class="btn btn-secondary">Back</a>
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
