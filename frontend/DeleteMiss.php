<?php
include_once('../database/config.php');
include_once('../controllers/MissionController.php');
$idC=$_GET['cons'];

$missionController= new MissionController();

if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['del'])){
    if(isset($_POST['mission_id'])){
        $miss_id = $_POST['mission_id'];
        $missionController->delete($miss_id);
    }
}
header("Location: ListerMissionidCons.php?cons=$idC");
exit();
?>