<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');
include_once('../controllers/AgentController.php');
include_once('../controllers/MissionController.php');
include_once('../controllers/TransferController.php');

// Agent
$agentController = new AgentController();
$agents = $agentController->agentListe();
$rowCountAg = $agents->rowCount();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consultantController = new ConsultantController();
    $consultants = $consultantController->getConsultantLogin($id);
    if ($consultants && $consultants->rowCount() > 0) {
        $row = $consultants->fetch(PDO::FETCH_ASSOC);
        $id = $row['consultant_id'];
        $username = $row['first_name'] . ' ' . $row['last_name'];
    } else {
        echo "error.";
    }
} else {
    echo "verifier";
}

// Mission
$missionController = new MissionController();
$missions = $missionController->getMissionCon($id);
$rowCountMi = $missions->rowCount();

// Transfers
$transfController = new TransferController();
$transfers = $transfController->transferListCount();
$rowCountTr = $transfers->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styleDash.css">
    <link rel="icon" href="./assets/ConsRo.png"/>
    <title>ConsultantDashboard</title>
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("agentTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("searchInput").addEventListener("keyup", filterTable);
        });
    </script>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">ConsultantDashboard</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="ListerTransListCons.php">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">transfers</span>
                </a>
            </li>
            <li>
                <a href="upload.php?id=<?= $id; ?>">
                    <i class='bx bxs-file-doc'></i>
                    <span class="text">Add Document</span>
                </a>
            </li>
            <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="MissionVue.php?id=<?= $id; ?>">
                <i class='bx bxs-paper-plane'></i>
                <span class="text">Add Mission</span>
            </a>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="SettingsCons.php?id=<?= $id; ?>">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="logoutCons.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="profile">
                <img src="assets/user.png">
            </a>
        </nav>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1><?php echo $username; ?></h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="ConsultantDashboard">Dashboard</a>
                        </li>
                    </ul>
                </div>
                
            </div>

            <ul class="box-info">
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3><?php echo $rowCountMi; ?></h3>
                        <p>Missions</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3><?php echo $rowCountTr; ?></h3>
                        <p>Transfers</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Mission</h3>
                    </div>

                    <table id="agentTable">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Filed of activity</th>
                                <th>Client Name</th>
                                <th>Client Representative position</th>
                                <th>Mission details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($missions as $m) : ?>
                            <tr>
                                <td>
                                    <img src="assets/userLi.png">
                                    <p><?php echo $m['position']; ?></p>
                                </td>
                                <td><?php echo $m['filed_of_activity']; ?></td>
                                <td><?php echo $m['client_name']; ?></td>
                                <td><?php echo $m['client_representative_position']; ?></td>
                                <td>
                                    <form action="ListerMissionidCons.php" method="get">
                                        <input type="hidden" name="cons" value="<?php echo $m['consultant_id']; ?>"/>
                                        <button type="submit" class="btn btn-warning">Details</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>

    <script src="js/script.js"></script>
</body>
</html>
