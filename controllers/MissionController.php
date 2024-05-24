<?php
include_once('../models/MissionModel.php');
include_once('../database/config.php');

class MissionController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    function insert(Mission $mission)
    {
        $query = "INSERT INTO missions (position, filed_of_activity, client_name, client_representative_position, mission_start_date, mission_end_date, daily_rate, consultant_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);

        $params = array(
            $mission->getPosition(),
            $mission->getActivity(),
            $mission->getClientName(),
            $mission->getClientPosition(),
            $mission->getDateStart(),
            $mission->getDateEnd(),
            $mission->getDailyRate(),
            $mission->getConsultantId()
        );

        return $stmt->execute($params);
    }
    
    function getMission($idM)
    {
        $query = "SELECT * FROM missions WHERE mission_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($idM));
        $mission = $stmt->fetch(PDO::FETCH_ASSOC);
        return $mission;
    }

    function getMissionCon($idC)
    {
        $query = "SELECT * FROM missions WHERE consultant_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($idC));
        return $stmt;
    }

    function delete($mission_id)
    {
        $query = "DELETE FROM missions WHERE mission_id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($mission_id));
    }

    function missionListe()
    {
        $query = "SELECT * FROM missions";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function validateMission($mission_id)
    {
        $query = "DELETE FROM missions WHERE mission_id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($mission_id));
    }

    function updateMission(Mission $mission, $mission_id)
{
    $sql = "UPDATE missions SET position = ?, filed_of_activity = ?, client_name = ?, client_representative_position = ?, mission_start_date = ?, mission_end_date = ?, daily_rate = ? WHERE mission_id = ?";
    $stmt = $this->pdo->prepare($sql);

    $params = array(
        $mission->getPosition(),
        $mission->getActivity(),
        $mission->getClientName(),
        $mission->getClientPosition(),
        $mission->getDateStart(),
        $mission->getDateEnd(),
        $mission->getDailyRate(),
        $mission_id
    );

    return $stmt->execute($params);
}
}
?>
