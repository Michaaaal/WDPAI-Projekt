<?php

use models\User;


require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';


class SecurityController extends AppController
{
    public function login(){
        $userRepository = new UserRepository();

        if(!$this->isPost()){
            return $this->login();
        }

        $email= $_POST["email"];
        $password = $_POST["password"];

        $user =  $userRepository->getUser($email);    //new User("pudzian@KOX.com", "passyKOXA", "Mariusz", "Pudzianowski");

        if(!$user){
            return $this->render("login", ['messeges' => ["User with this e-mail does not exist"]]);
        }

        if($user->getEmail()!== $email){
            return $this->render("login", ['messeges' => ["User with this e-mail does not exist"]]);
        }
        if($user->getPassword() !== $password){
            return $this->render("login", ['messeges' => ["Wrong password!"]]);
        }

        return $this->render("topic");
    }


}