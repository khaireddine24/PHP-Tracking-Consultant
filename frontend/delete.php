<?php
$con = mysqli_connect("localhost", "root", "", "gestion_consultants");

if (isset($_GET['id'])) {
    $document_id = $_GET['id'];

    // Vérifiez que l'ID est valide et existe dans la base de données
    $sql = "SELECT * FROM `document` WHERE `id` = '$document_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Supprime le document
        $sql_delete = "DELETE FROM `document` WHERE `id` = '$document_id'";
        if (mysqli_query($con, $sql_delete)) {
            // Redirige vers la page upload.php après suppression
            header("Location: upload.php?id=" . $_GET['consultant_id']);
            exit();
        } else {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='text-center'>Error deleting document</h4>
            </div>
            ";
        }
    } else {
        echo "
        <div class='alert alert-danger' role='alert'>
            <h4 class='text-center'>Invalid document ID</h4>
        </div>
        ";
    }
} else {
    echo "
    <div class='alert alert-danger' role='alert'>
        <h4 class='text-center'>Document ID not provided</h4>
    </div>
    ";
}
?>
