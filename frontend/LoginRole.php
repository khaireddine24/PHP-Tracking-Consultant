<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginRole</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .link-card {
            transition: transform 0.2s;
        }
        .link-card:hover {
            transform: scale(1.05);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        #R {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container mt-5" id="R">
    <div class="row">
        <!-- Lien Admin -->
        <div class="col-md-4">
            <div class="card link-card">
                <a href="Login.php">
                    <img src="./assets/AdminRo.png" class="card-img-top" alt="Admin">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Admin</h5>
                </div>
            </div>
        </div>
        <!-- Lien AgentHR -->
        <div class="col-md-4">
            <div class="card link-card">
                <a href="LoginAgent.php">
                    <img src="./assets/AgentRo.png" class="card-img-top" alt="AgentHR">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">AgentHR</h5>
                </div>
            </div>
        </div>
        <!-- Lien Consultants -->
        <div class="col-md-4">
            <div class="card link-card">
                <a href="LoginCons.php">
                    <img src="./assets/ConsRo.png" class="card-img-top" alt="Consultants">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Consultants</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
