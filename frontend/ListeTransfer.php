<?php
include_once('../database/config.php');
include_once('../controllers/TransferController.php');
include_once('../controllers/ConsultantController.php');
$transferController = new TransferController();
$transfers = $transferController->transferList();
foreach ($transfers as $transfer) :
    $id=$transfer['hr_agent_id'];
endforeach;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Transferts</title>
    <link rel="icon" href="./assets/TransfersIcon.png"/>
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
        .disp {
            display: flex;
        }
    </style>
</head>
<body class="container">
    <input type="text" id="searchInput" onkeyup="filterTable()" class="form-control mt-3" placeholder="Rechercher par bénéficiaire">
    <input type="date" id="dateInput" onchange="filterTable()" class="form-control mt-3" placeholder="Rechercher par date de transfert">
    <input type="text" id="typeInput" onkeyup="filterTable()" class="form-control mt-3" placeholder="Rechercher par type de transfert">
    <!-- <a href="ExpTransfers.php" target="_blank" class="btn btn-primary mt-3">Télécharger la liste des transferts en PDF</a> -->
    <table id="transferTable" class="table mt-3">
        <thead>
            <tr>
                <th>Consultant</th>
                <th>Transfer Type</th>
                <th>Beneficiary</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transfers as $transfer) : ?>
                <tr>
                    <td><?php echo $transfer['first_name'].' '.$transfer['last_name']; ?></td>
                    <td><?php echo $transfer['transfer_type']; ?></td>
                    <td><?php echo $transfer['beneficiary']; ?></td>
                    <td><?php echo $transfer['amount']; ?></td>
                    <td><?php echo $transfer['transfer_date']; ?></td>
                    <td>
                        <div class="disp">
                            <form action="deleteTransfer.php" method="POST">
                                <input type="hidden" name="transfer_id" value="<?php echo $transfer['transfer_id']; ?>">
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                            </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <form action="modifyTransfer.php" method="POST">
                                <input type="hidden" name="transfer_id" value="<?php echo $transfer['transfer_id']; ?>">
                                <input type="submit" name="modify" value="Modify" class="btn btn-warning">
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="AgentDashboard.php?id=<?=$id;?>" class="btn btn-secondary">Back</a>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function filterTable() {
            let nameInput = document.getElementById('searchInput').value.toLowerCase();
            let dateInput = document.getElementById('dateInput').value;
            let typeInput = document.getElementById('typeInput').value.toLowerCase();
            
            let table = document.getElementById('transferTable');
            let trs = table.getElementsByTagName('tr');

            for (let i = 1; i < trs.length; i++) {
                let tds = trs[i].getElementsByTagName('td');
                let show = false;

                let nameMatch = !nameInput || tds[2].innerHTML.toLowerCase().indexOf(nameInput) > -1;
                let typeMatch = !typeInput || tds[1].innerHTML.toLowerCase().indexOf(typeInput) > -1;
                
                let dateMatch = true;
                if (dateInput) {
                    let transferDate = new Date(tds[4].innerHTML);
                    let inputDate = new Date(dateInput);
                    dateMatch = transferDate.toDateString() === inputDate.toDateString();
                }

                if (nameMatch && dateMatch && typeMatch) {
                    show = true;
                }

                trs[i].style.display = show ? '' : 'none';
            }
        }
    </script>
</body>
</html>
