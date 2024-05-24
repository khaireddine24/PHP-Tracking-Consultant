<?php
include_once('../database/config.php');
include_once('../controllers/ConsultantController.php');

$consultantController = new ConsultantController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
    if (isset($_POST['consultant_id'])) {
        $consultant_id = $_POST['consultant_id'];
        $consultantController->delete($consultant_id);
    }
    
}
header("Location: ListeConsultants.php");
exit();
?>
