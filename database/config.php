<?php
abstract class Connexion {
protected $pdo;
function __construct()
{
$this->pdo =new PDO('mysql:host=localhost;dbname=gestion_consultants','root','');
$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
function __destruct()
{
$this->pdo=null;
}
function getPdo(){
    $this->pdo;
}
}
?>