<?php
include_once('../database/config.php');
include_once('../controllers/MissionController.php');

$missionController = new MissionController();
$idC=$_GET['cons'];

if(isset($_POST['mission_id'])){
    $idM=$_POST['mission_id'];
    $miss= $missionController->getMission($idM);

    if($miss){
        if($_SERVER['REQUEST_METHOD']==='POST' && isset ($_POST["Save"])){
            $position = $_POST['position'];
            $field_of_activity = $_POST['field_of_activity'];
            $client_name = $_POST['client_name'];
            $client_representative = $_POST['client_representative'];
            $mission_start_date = $_POST['mission_start_date'];
            $mission_end_date = $_POST['mission_end_date'];
            $daily_rate = $_POST['daily_rate'];
            $mission_id=$_POST['mission_id'];
            $updateMiss = new Mission($position,$field_of_activity, $client_name,$client_representative,$mission_start_date,$mission_end_date,$daily_rate,8895);
            if ($missionController->updateMission($updateMiss, $mission_id)) {
                header("Location: ListerMissionidCons.php?cons=$idC");
                exit();
            } else {
                echo "Erreur lors de la mise à jour de la mission.";
            }
        }
    }else{
        echo"mission not found.";
        exit();
    }
} else{
    echo "ID Mission not defined";
    exit();
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="./css/styleMission.css">
     <style>
        input[type="submit"]{
            margin-left:60%;
        }
    </style>
 </head>
 <body>
        
    <div class="bl">
        <h1 class="r">Update Mission</h1>
        <form  action="Modifymission.php?cons=<?=$idC?>" method="post" >
            <input type="hidden" name="mission_id" value="<?= $miss['mission_id']; ?>">
            <label for="position" class="zz col-sm-2 col-form-label ">Position :</label>
            <input type="text" id="position" name="position" class="form-control z" value="<?= $miss['position']; ?>"><br><br>
            
            <label for="field_of_activity" class="col-sm-2 col-form-label j">Activity  :</label>
            <input type="text" id="field_of_activity" name="field_of_activity" class="form-control jj" value="<?= $miss['filed_of_activity']; ?>"><br><br>
            
            <label for="client_name" class="col-sm-2 col-form-label h">Client name :</label>
            <input type="text" id="client_name" name="client_name" class="form-control hh" value="<?= $miss['client_name']; ?>"><br><br>

            <label for="client_representative" class="col-sm-2 col-form-label l">Client Position :</label>
            <input type="text" id="client_representative" name="client_representative" class="form-control ll" value="<?= $miss['client_representative_position']; ?>"><br><br>

            <label for="mission_start_date" class="col-sm-2 col-form-label o">Date Start:</label>
        <input type="date" id="mission_start_date" name="mission_start_date" class="form-control oo" value="<?= $miss['mission_start_date']; ?>"><br><br>
        <label for="mission_end_date" class="col-sm-2 col-form-label d">Date end:</label>
        <input type="date" id="" name="mission_end_date" class="form-control dd" value="<?= $miss['mission_end_date']; ?>"><br><br>

        <label for="daily_rate" class="col-sm-2 col-form-label t">Daily rate:</label>
        <input type="number" id="daily_rate" name="daily_rate" class="form-control tt" min="1" max="10" value="<?= $miss['daily_rate']; ?>"><br><br>
        <br/><br/><br/><br/><br/><br/><br/><br/>
        <input type="submit" class="btn btn-primary" name="Save" value="Save">
        <input type="reset" class="btn btn-danger" value="cancel"/>
    </div>
    
 </body>
 </html>