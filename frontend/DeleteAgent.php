<?php
include_once('../database/config.php');
include_once('../controllers/AgentController.php');

$agentController= new AgentController();

if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['del'])){
    if(isset($_POST['hr_agent_id'])){
        $agent_id = $_POST['hr_agent_id'];
        $agentController->delete($agent_id);
    }
}
header("Location: AdminDashboard.php");
exit();
?>