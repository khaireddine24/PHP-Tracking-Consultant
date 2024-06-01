<?php
include_once('../database/config.php');
include_once('../controllers/TransferController.php');

$transferController = new TransferController();
$consultantIDs = $transferController->fetchConsultantIDs();

$transfer = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modify'])) {
    $transfer_id = $_POST['transfer_id'];
    $transfer = $transferController->getTransferById($transfer_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $transfer_id = $_POST['transfer_id'];
    $consultant_id = $_POST['consultant_id'];
    $transfer_type = $_POST['transfer_type'];
    $beneficiary = $_POST['beneficiary'];
    $amount = $_POST['amount'];

    $updatedTransfer = new TransferModel();
    $updatedTransfer->setTransferId($transfer_id);
    $updatedTransfer->setConsultantId($consultant_id);
    $updatedTransfer->setTransferType($transfer_type);
    $updatedTransfer->setBeneficiary($beneficiary);
    $updatedTransfer->setAmount($amount);

    $transferController->update($updatedTransfer);

    header("Location: ListeTransfer.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Transfer</title>
    <link rel="icon" href="./assets/TransfersIcon.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Modify Transfer</h2>
        <form action="ModifyTransfer.php" method="POST">
            <input type="hidden" name="transfer_id" value="<?php echo isset($transfer['transfer_id']) ? $transfer['transfer_id'] : ''; ?>">

            <div class="mb-3">
                <label for="consultant_id" class="form-label">Consultant Name:</label>
                <select id="consultant_id" name="consultant_id" class="form-select" required>
                    <?php foreach ($consultantIDs as $consultant) : ?>
                        <option value="<?php echo $consultant['consultant_id']; ?>" 
                            <?php echo (isset($transfer['consultant_id']) && $consultant['consultant_id'] == $transfer['consultant_id']) ? 'selected' : ''; ?>>
                            <?php echo $consultant['first_name'] . ' ' . $consultant['last_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="transfer_type" class="form-label">Transfer Type</label>
                <select class="form-select" aria-label="Default select example" id="transfer_type" name="transfer_type" required>
                    <option value="participation" <?php echo (isset($transfer['transfer_type']) && $transfer['transfer_type'] == 'participation') ? 'selected' : ''; ?>>Participation</option>
                    <option value="referral" <?php echo (isset($transfer['transfer_type']) && $transfer['transfer_type'] == 'referral') ? 'selected' : ''; ?>>Referral</option>
                    <option value="remuneration" <?php echo (isset($transfer['transfer_type']) && $transfer['transfer_type'] == 'remuneration') ? 'selected' : ''; ?>>Remuneration</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="beneficiary" class="form-label">Beneficiary:</label>
                <input type="text" id="beneficiary" name="beneficiary" class="form-control" value="<?php echo isset($transfer['beneficiary']) ? $transfer['beneficiary'] : ''; ?>">
            </div>

            <div class="mb-3">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" step=".01" min="0" class="form-control" value="<?php echo isset($transfer['amount']) ? $transfer['amount'] : 0; ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>