<?php
include_once('../database/config.php');
include_once('../controllers/AgentController.php');

$agentController = new AgentController();
$agents = $agentController->agentListe();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des agents</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("agentTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
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
        .disp {
            display: flex;
        }
    </style>
</head>
<body class="container">
    <input type="text" id="searchInput" onkeyup="filterTable()" class="form-control mt-3" placeholder="Rechercher par nom"/>
    <table id="agentTable" class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>        
            <?php foreach ($agents as $a) :?> 
                <tr>
                    <td><?php echo $a['first_name'] . " " . $a['last_name']; ?></td>
                    <td>
                        <details>
                            <summary>More details</summary>
                            <?php echo "Email: " . $a['email']; ?>
                        </details>
                    </td>
                    <td>
                        <div class="disp">
                            <form action="ModifyAgent.php" method="post">
                                <input type="hidden" name="hr_agent_id" value="<?php echo $a['hr_agent_id']; ?>">
                                <button type="submit" class="btn btn-primary">Modify</button>
                            </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <form method="post" action="DeleteAgent.php">
                                <input type="hidden" name="hr_agent_id" value="<?php echo $a['hr_agent_id']; ?>">
                                <button type="submit" class="btn btn-danger" name="del">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>   
            <?php endforeach ?>
        </tbody>
    </table>  
    <a href="AdminDashboard.php" class="btn btn-secondary">Back</a>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
