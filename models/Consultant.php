<?php

class Consultant
{
    private $idCons;
    private $first_name;
    private $last_name;
    private $cin;
    private $email;
    private $dateBirth;
    private $placeBirth;
    private $countryRes;
    private $password;
    private $confpassword;

    public function __construct($first_name = "", $last_name = "", $cin = "", $dateBirth = "",$placeBirth="",$countryRes="",$email = "",$password="",$confpassword="",$idCons=null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->cin = $cin;
        $this->dateBirth = $dateBirth;
        $this->placeBirth = $placeBirth;
        $this->countryRes = $countryRes;
        $this->email = $email;
        $this->password = $password;
        $this->confpassword = $confpassword;
        $this->idCons=$idCons;
    }

    //getters

    public function getIdCons()
    {
        return $this->idCons;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    public function getPlaceBirth()
    {
        return $this->placeBirth;
    }

    public function getCountryRes()
    {
        return $this->countryRes;
    }

    public function getCin()
    {
        return $this->cin;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getConfPassword()
    {
        return $this->confpassword;
    }

    //Setters

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    public function setCountryRes($c)
    {
        $this->countryRes = $c;
    }

    public function setDateBirth($d)
    {
        $this->dateBirth = $d;
    }

    public function setPlaceBirth($pb)
    {
        $this->placeBirth = $pb;
    }

    public function setPassword($p)
    {
        $this->password = $p;
    }

    public function setConfPassword($cp)
    {
        $this->confpassword = $cp;
    }
}
?>
