<?php
include_once ('../database/config.php');
include_once('../controllers/AgentController.php');

$agentController=new AgentController();

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST["AddA"])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  

    $newCons=new agent($first_name, $last_name,$email,$password);
    $agentController->insert($newCons);

    header("Location: AdminDashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR agent Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./assets/AgentRo.png"/>
</head>
<body>
    <div class="container">
        <h2>HR Agent Registration</h2>
        <form action="AgenRegist.php" method="POST">
        
          <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control">
          </div>

          <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password: </label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          

          <button type="submit" name="AddA" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Reset</button> 


          </div> 
          
               
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>