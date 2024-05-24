<?php
class Mission {
    private $idM;
    private $position;
    private $activity;
    private $client_name;
    private $client_position;
    private $date_start;
    private $date_end;
    private $daily_rate;
    private $consultant_id;

    public function __construct($position="", $activity="", $client_name="", $client_position="", $date_start="", $date_end="", $daily_rate=0, $consultant_id=null,$id=null) {
        $this->position = $position;
        $this->activity = $activity;
        $this->client_name = $client_name;
        $this->client_position = $client_position;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->daily_rate = $daily_rate;
        $this->consultant_id = $consultant_id;
        $this->idM=$id;
    }

    public function getPosition() {
        return $this->position;
    }


    public function getActivity() {
        return $this->activity;
    }

    public function getClientName() {
        return $this->client_name;
    }

    public function getClientPosition() {
        return $this->client_position;
    }

    public function getDateStart() {
        return $this->date_start;
    }

    public function getDateEnd() {
        return $this->date_end;
    }

    public function getDailyRate() {
        return $this->daily_rate;
    }

    public function getConsultantId() {
        return $this->consultant_id;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function setActivity($activity) {
        $this->activity = $activity;
    }

    public function setClientName($client_name) {
        $this->client_name = $client_name;
    }

    public function setClientPosition($client_position) {
        $this->client_position = $client_position;
    }

    public function setDateStart($date_start) {
        $this->date_start = $date_start;
    }

    public function setDateEnd($date_end) {
        $this->date_end = $date_end;
    }

    public function setDailyRate($daily_rate) {
        $this->daily_rate = $daily_rate;
    }

    public function setConsultantId($consultant_id) {
        $this->consultant_id = $consultant_id;
    }
}
?>
