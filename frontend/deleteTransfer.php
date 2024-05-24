 <?php

include_once('../database/config.php');
include_once('../controllers/TransferController.php');

$transferController = new TransferController();

if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['delete'])){
    if(isset($_POST['transfer_id'])){
        $transfer_id = $_POST['transfer_id'];
        $transferController->delete($transfer_id);
    }
}
header("Location: ListeTransfer.php");
exit();

?>