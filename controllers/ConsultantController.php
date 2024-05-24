<?php
include_once('../models/Consultant.php');
include_once('../database/config.php');

class ConsultantController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    function insert(Consultant $cons)
{
    $query = "INSERT INTO consultants(first_name,last_name,cin,date_of_birth,place_of_birth,country_of_residence,email,pass,confpassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($query);

    $params = array(
        $cons->getFirstName(),
        $cons->getLastName(),
        $cons->getCin(),
        $cons->getDateBirth(),
        $cons->getPlaceBirth(),
        $cons->getCountryRes(),
        $cons->getEmail(),
        $cons->getPassword(),
        $cons->getConfPassword()
    );

    return $stmt->execute($params);
}

    function getConsultant($id)
    {
        $query = "SELECT * FROM consultants WHERE  consultant_id= ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $array = $stmt->fetch();
        return $array;
    }

    function getConsultantLogin($id)
{
    $query = "SELECT * FROM consultants WHERE consultant_id = ?";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(array($id));
    return $stmt;
}

    function delete($consultant_id)
    {
        $query = "DELETE FROM consultants WHERE consultant_id=?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($consultant_id));
    }

    function consultantList()
    {
        $query = "SELECT * FROM consultants";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getMissionsWithConsultants()
    {
        $query = "SELECT *
                  FROM missions m,consultants c
                  WHERE m.consultant_id = c.consultant_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    function updateConsultant(Consultant $cons)
    {
        $sql = "UPDATE consultants 
                SET first_name=?,last_name=?,cin=?,date_of_birth=?,place_of_birth=?,country_of_residence=?,email=?,pass=?,confpassword=? 
                WHERE consultant_id=?";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $cons->getFirstName(),
            $cons->getLastName(),
            $cons->getCin(),
            $cons->getDateBirth(),
            $cons->getPlaceBirth(),
            $cons->getCountryRes(),
            $cons->getEmail(),
            $cons->getPassword(),
            $cons->getConfPassword(),
            $cons->getIdCons()
        ));
    }
}
?>
