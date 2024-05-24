<?php
include_once('../database/config.php');
include_once('../controllers/AdminController.php');
include_once('../controllers/ConsultantController.php');
include_once('../controllers/AgentController.php');

//Admin
$adminController = new AdminController();
$admin = $adminController->AdminList();

//Consultant
$consultantController = new ConsultantController();
$consultants=$consultantController->consultantList();
$rowCountCons = $consultants->rowCount();

//Agent
$agentController = new AgentController();
$agents=$agentController->agentListe();
$rowCountAg = $agents->rowCount();

if ($admin && $admin->rowCount() > 0) {
    $row = $admin->fetch(PDO::FETCH_ASSOC);
	$id = $row['id'];
    $username = $row['username'];
} else {
    echo "error.";
}
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

	<title>AdminDashboard</title>
    <script>
        function filterTable() {
            var input, filter, tables, tr, td, i, j, txtValue, showRow;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            tables = document.querySelectorAll("table");

            tables.forEach(function(table) {
                tr = table.getElementsByTagName("tr");
                for (i = 1; i < tr.length; i++) {
                    showRow = false;
                    td = tr[i].getElementsByTagName("td");
                    for (j = 0; j < td.length; j++) {
                        if (td[j]) {
                            txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                showRow = true;
                                break;
                            }
                        }
                    }
                    if (showRow) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            });
        }
    </script>
</head>
<body>
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminDashboard</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">
                    Dashboard
                </span>
				</a>
			</li>
			<li>
				<a href="ConsultantRegist.php">
                    <i class='bx bxs-group' ></i>
					<span class="text">Add Consultant</span>
				</a>
			</li>
			<li>
				<a href="AgenRegist.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Add AgentHR</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				
				<a href="SettingsAdmin.php?id=<?= $id; ?>">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
					<input type="search" id="searchInput" placeholder="Search..." onkeyup="filterTable()">
					<button type="button" class="search-btn"><i class='bx bx-search' ></i></button>
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
					<h1><?php
                        echo $username;
                    ?></h1>
					<ul class="breadcrumb">
						<li>
							<a href="AdminDashboard.php">Dashboard</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $rowCountAg; ?></h3>
						<p>AgentHR</p>
					</span>
				</li>
				<li class="cons">
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $rowCountCons; ?></h3>
						<p>Consultants</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>AgentHR</h3>
					</div>

					<table id="agentTable">
						<thead>
							<tr>
								<th>User</th>
								<th>Email</th>
								<th>Password</th>
								<th>More details</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
                        <?php
                            foreach ($agents as $ag) : ?>
							<tr>
								<td>
									<img src="assets/userLi.png">
									<p><?php echo $ag['first_name'] .' '.$ag['last_name'] ?></p>
								</td>
								<td><?php echo $ag['email']?></td>
								<td><?php echo $ag['pass']?></td>
								<td>
									<form action="ListeAgents.php" method="get">
                                            <button type="submit" class="btn btn-warning">Details</button>
                                    </form>
								</td>
								<td>

                                <div class="disp">
                                    <!-- for Modify -->
                                        <form action="ModifyAgent.php" method="post">
                                            <input type="hidden" name="hr_agent_id" value="<?php echo $ag['hr_agent_id']; ?>">
                                            <button type="submit" class="btn btn-primary">Modify</button>
                                        </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <!-- for Delete -->
                                    <form method="post" action="DeleteAgent.php">
                                        <input type="hidden" name="hr_agent_id" value="<?php echo $ag['hr_agent_id']; ?>">
                                        <button type="submit" class="btn btn-danger" name="del">Delete</button>
                                    </form>
                                </div>
                                </td>
							</tr>
                            <?php endforeach;?>
						</tbody>
					</table>
				</div>

				<!-- Consultants -->

				<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Consultants</h3>
						
					</div>

					<table id="consultantTable">
						<thead>
							<tr>
								<th>User</th>
								<th>Email</th>
								<th>Password</th>
								<th>More details</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
                        <?php
                            foreach ($consultants as $cons) : ?>
							<tr>
								<td>
									<img src="assets/userLi.png">
									<p><?php echo $cons['first_name'] .' '.$cons['last_name'] ?></p>
								</td>
								<td><?php echo $cons['email']?></td>
								<td><?php echo $cons['pass']?></td>
								<td>
									<form action="ListeConsultants.php" method="get">
                                            <button type="submit" class="btn btn-warning">Details</button>
                                    </form>
								</td>
								<td>

								<div class="disp">
                        		<!-- for Modify -->
                        		<form action="ModifyCons.php" method="post">
                            		<input type="hidden" name="consultant_id" value="<?php echo $cons['consultant_id']; ?>">
                            		<button type="submit" class="btn btn-primary">Modify</button>
                        		</form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        		<!-- for Delete -->
                        		<form method="post" action="DeleteCons.php">
                           		 <input type="hidden" name="consultant_id" value="<?php echo $cons['consultant_id']; ?>">
                            		<button type="submit" class="btn btn-danger" name="del">Delete</button>
                        		</form>
                    		</div>
                                </td>
							</tr>
                            <?php endforeach;?>
						</tbody>
					</table>
				</div>
				
		</main>
        
	</section>
	
	<script src="js/script.js"></script>
</body>
</html>
