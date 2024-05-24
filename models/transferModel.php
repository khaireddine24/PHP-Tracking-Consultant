<?php
class TransferModel {
    private $consultant_id;
    private $transfer_type;
    private $beneficiary;
    private $amount;
    private $transfer_id;
    private $hr_agent_id;


    public function setTransferId($transfer_id) {
        $this->transfer_id = $transfer_id;
    }

    public function getTransferId() {
        return $this->transfer_id;
    }

    public function setConsultantId($consultant_id) {
        $this->consultant_id = $consultant_id;
    }

    public function getConsultantId() {
        return $this->consultant_id;
    }

    public function setAgentId($agent_id) {
        $this->hr_agent_id = $agent_id;
    }

    public function getAgentId() {
        return $this->hr_agent_id;
    }

    public function setTransferType($transfer_type) {
        $this->transfer_type = $transfer_type;
    }

    public function getTransferType() {
        return $this->transfer_type;
    }

    public function setBeneficiary($beneficiary) {
        $this->beneficiary = $beneficiary;
    }

    public function getBeneficiary() {
        return $this->beneficiary;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }
}
?>
