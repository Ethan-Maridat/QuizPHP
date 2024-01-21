<?php
namespace db\php\DBClasses;

require_once __DIR__ . "/../../../Autoloader.php";
use \Classes\Autoloader;
Autoloader::register();

use mysqli;
use User\User;

class UserDB
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function getUserByPseudo(string $pseudo): ?User
    {
        $query = "SELECT * FROM USER WHERE pseudo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $this->mapToUser($row);
        } else {
            return null;
        }
    }

    public function addUser(User $user): bool
    {
        $query = "INSERT INTO USER (pseudo, mdp) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
    
        $pseudo = $user->getPseudo();
        $mdp = password_hash($user->getMdp(), PASSWORD_DEFAULT);
    
        $stmt->bind_param("ss", $pseudo, $mdp);
        return $stmt->execute();
    }

    public function deleteUser(string $pseudo): bool
    {
        $query = "DELETE FROM USER WHERE pseudo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $pseudo);
        return $stmt->execute();
    }

    public function userExists(string $pseudo): bool
    {
        $query = "SELECT COUNT(*) as count FROM USER WHERE pseudo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }

    private function mapToUser($row): User
    {
        $pseudo = $row['pseudo'];
        $mdp = $row['mdp'];
        return new User($pseudo, $mdp);
    }

    public function checkPassword(string $pseudo, string $password): bool
    {
        $query = "SELECT mdp FROM USER WHERE pseudo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPasswordFromDB = $row['mdp'];
    
            return password_verify($password, $hashedPasswordFromDB);
        } else {
            return false;
        }
    }    

}
?>