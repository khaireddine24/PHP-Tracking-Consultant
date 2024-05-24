<?php
include_once('../models/agent.php');
include_once('../database/config.php');

class AgentController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    function insert(agent $cons)
    {
        $query = "INSERT INTO hr_agents(first_name, last_name, email, pass) VALUES(?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $params = array(
            $cons->getFirstName(),
            $cons->getLastName(),
            $cons->getEmail(),
            $cons->getPassword()
        );
        return $stmt->execute($params);
    }

    function getAgent($id)
    {
        $query = "SELECT * FROM hr_agents WHERE hr_agent_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getAgentLogin($id)
    {
        $query = "SELECT * FROM hr_agents WHERE hr_agent_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        return $stmt;
    }

    function delete($agent_id)
    {
        $query = "DELETE FROM hr_agents WHERE hr_agent_id=?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($agent_id));
    }

    function agentListe()
    {
        $query = "SELECT * FROM hr_agents";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function updateAgent(agent $cons)
    {
        $sql = "UPDATE hr_agents SET first_name=?, last_name=?, email=?, pass=? WHERE hr_agent_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $cons->getFirstName(),
            $cons->getLastName(),
            $cons->getEmail(),
            $cons->getPassword(),
            $cons->getIdAge()
        ));
    }
}
?>
