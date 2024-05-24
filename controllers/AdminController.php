
<?php
include_once('../models/Admin.php');
include_once('../database/config.php');

class AdminController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

function AdminList()
    {
        $query = "SELECT * FROM admin";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getAdmin($idA)
    {
        $query="SELECT * FROM admin WHERE id=?";
        $stmt=$this->pdo->prepare($query);
        $stmt->execute(array($idA));
        $array=$stmt->fetch();
        return $array;
    }

    function updateAdmin(Admin $ad)
{
    $sql = "UPDATE admin
        SET username=?, email=?, password=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $ad->getUsername(),
            $ad->getEmail(),
            $ad->getPassword(),
            $ad->getId()
));
}

}

?>