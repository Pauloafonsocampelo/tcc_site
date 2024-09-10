<?php class Database
{
    private $host = 'localhost';
    private $db_name = 'TCC';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function getConnection()
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
        return $this->pdo;
    }
    
}
?>