<?php
include_once('../database/config.php');
include_once('../controllers/TransferController.php');

$transferController = new TransferController();
$transfers = $transferController->transferList();
$consultants = $transferController->fetchConsultantIDs();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Please verify your ID";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transfer'])) {
    $consultant_id = $_POST['consultant_id'];
    $transfer_type = $_POST['transfer_type'];
    $beneficiary = $_POST['beneficiary'];
    $amount = $_POST['amount'];

    $newTransfer = new TransferModel();
    $newTransfer->setConsultantId($consultant_id);
    $newTransfer->setTransferType($transfer_type);
    $newTransfer->setBeneficiary($beneficiary);
    $newTransfer->setAmount($amount);
    $newTransfer->setAgentId($id);

    $transferController->insert($newTransfer);

    header("Location: AgentDashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h2>Transfer</h2>
        <form action="Transfer.php?id=<?= $id ?>" method="POST">

            <div class="mb-3">
                <label for="consultant_id" class="form-label">Consultant:</label>
                <select class="form-select" id="consultant_id" name="consultant_id" required>
                    <option selected disabled>Choose Consultant</option>
                    <?php foreach ($consultants as $consultant) : ?>
                        <option value="<?php echo $consultant['consultant_id']; ?>">
                            <?php echo $consultant['first_name'] . ' ' . $consultant['last_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="transfer_type" class="form-label">Transfer Type</label>
                <select class="form-select" id="transfer_type" name="transfer_type" required>
                    <option selected disabled>Choose a transfer type</option>
                    <option value="participation">Participation</option>
                    <option value="referral">Referral</option>
                    <option value="remuneration">Remuneration</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="beneficiary" class="form-label">Beneficiary:</label>
                <input type="text" id="beneficiary" name="beneficiary" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Amount:</label>
                <input type="number" id="amount" name="amount" step=".01" min="0" class="form-control" required>
            </div>

            <button type="submit" name="transfer" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
