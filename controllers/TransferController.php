<?php
include_once('../models/transferModel.php');
include_once('../database/config.php');


class TransferController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    function insert(transferModel $cons)
    {
        $query="INSERT INTO transfers (consultant_id, transfer_type, beneficiary, amount,hr_agent_id) VALUES (?,?,?,?,?)";
        $stmt=$this->pdo->prepare($query);

        $params=array(
            $cons->getConsultantId(),
            $cons->getTransferType(),
            $cons->getBeneficiary(),
            $cons->getAmount(),
            $cons->getAgentId(),
            
        );
        return $stmt->execute($params);
    }

    function getTransferId($transfer_id){
        $query="SELECT * FROM transfers WHERE transfer_id=?";
        $stmt=$this->pdo->prepare($query);
        $stmt->execute([$transfer_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    function transferList() {
        $query = "
            SELECT transfers.*, consultants.*
            FROM transfers
            JOIN consultants ON transfers.consultant_id = consultants.consultant_id
            JOIN hr_agents ON transfers.hr_agent_id = hr_agents.hr_agent_id
        ";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function transferListCount() {
        $query = "
            SELECT transfers.*, consultants.*
            FROM transfers
            JOIN consultants ON transfers.consultant_id = consultants.consultant_id
        ";
        $stmt = $this->pdo->query($query);
        return $stmt;
    }
    
    public function fetchConsultantIDs() {
        $query = "SELECT consultant_id, first_name, last_name FROM consultants";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    function searchIndex($transfer_type){
        $index=array_search($transfer_type, ['transfer_type' ,'participation', 'referal','remun']);
    if($index!==false){
        $transfer_type_value=$index;
    }else{
        $transfer_type_value=null;
    }
    return $transfer_type_value;
     }

     function delete($transfer_id){
        $query="DELETE FROM transfers WHERE transfer_id=?";
        $stmt=$this->pdo->prepare($query);
        return $stmt->execute([$transfer_id]);
     }

     function update(TransferModel $transfer)
     {
        $query="UPDATE transfers SET consultant_id=?, transfer_type=?, beneficiary=?, amount=? WHERE transfer_id=?";
        $stmt=$this->pdo->prepare($query);

        $params=array(
            $transfer->getConsultantId(),
            $transfer->getTransferType(),
            $transfer->getBeneficiary(),
            $transfer->getAmount(),
            $transfer->getTransferId(),

        );
        return $stmt->execute($params);
     }
     public function getTransferById($transfer_id) {
        $query = "SELECT * FROM transfers WHERE transfer_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$transfer_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    }

?>