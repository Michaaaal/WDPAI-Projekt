<?php
use models\User;
require_once __DIR__.'/../models/User.php';
require_once 'Repository.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ? User
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM users WHERE email= :email");
        $stmt->bindParam(':email',$email , PDO::PARAM_STR);
        $stmt->execute();

        $user= $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }

        return new User(
            $user['id_user'],
            $user['email'],
            $user['password_hash'],
            $user['nickname']
        );
    }

    public function addUser(string $email, string $password, string $repeatedPassword){

    }
}