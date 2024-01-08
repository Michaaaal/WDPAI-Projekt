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
            $user['email'],
            $user['password_hash'],
            $user['nickname'],
            $user['phone_number'],
            $user['id_user']
        );
    }

    public function getUserById(string $id): ? User
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM users u WHERE u.id_user= :id");
        $stmt->bindParam(':id',$id , PDO::PARAM_STR);
        $stmt->execute();

        $user= $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }

        return new User(
            $user['email'],
            $user['password_hash'],
            $user['nickname'],
            $user['phone_number'],
            $user['id_user']
        );
    }

    public function addUser(User $user){

        $query = "INSERT INTO users (gallery_images_id ,user_type_id ,email, password_hash, phone_number, nickname, country_id) 
                  VALUES (null ,1 ,:email, :password, :phone_number, :nickname, 171)";

        $stmt = $this->database->connect()->prepare($query);


        $email = $user->getEmail();
        $stmt->bindParam(':email', $email);
        $password = $user->getPassword();
        $stmt->bindParam(':password', $password);
        $phoneNumber = $user->getPhoneNumber();
        $stmt->bindParam(':phone_number', $phoneNumber);
        $name = $user->getName();
        $stmt->bindParam(':nickname', $name);

        $stmt->execute();
    }

    public function changeUser(User $user){
        $query = "UPDATE users SET password_hash = :password, phone_number = :phone_number, nickname = :nickname WHERE id_user = :id";

        $stmt = $this->database->connect()->prepare($query);

        $password = $user->getPassword();
        $phoneNumber = $user->getPhoneNumber();
        $name = $user->getName();
        $id = $user->getId();

        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone_number', $phoneNumber);
        $stmt->bindParam(':nickname', $name);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }

}