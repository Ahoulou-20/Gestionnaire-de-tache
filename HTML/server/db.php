<?php
class Database
{
    private $host = DB_HOST;
    private $db = DB_NAME;
    private $user = USER_NAME;
    private $pwd = USER_PWD;

    public $connexion;

    public function get_connexion()
    {
        $this->connexion = null;
        try {
            $this->connexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db,
                $this->user,
                $this->pwd
            );
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion " . $e->getMessage();
        }
        return $this->connexion;
    }
}