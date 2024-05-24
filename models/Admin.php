<?php
require_once '../database/config.php';

class Admin {
    private $username;
    private $email;
    private $password;
    private $id;

    public function __construct($username="", $email="", $password="",$id=null) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->id=$id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function verifyPassword($email, $password) {
        $conn = new PDO('mysql:host=localhost;dbname=gestion_consultants','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt = $conn->prepare('SELECT id, username, email, password FROM admin WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->password = $row['password'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            return false;
        }
    }
}
?>
