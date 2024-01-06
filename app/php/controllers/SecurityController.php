<?php
use models\User;
use repository\TopicRepository;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/TopicRepository.php';


class SecurityController extends AppController
{
    public function login(){
        $userRepository = new UserRepository();

        if(!$this->isPost()){
            return $this->login();
        }

        $email= $_POST["email"];
        $password = $_POST["password"];

        $user =  $userRepository->getUser($email);

        if(!$user){
            return $this->render("login", ['messeges' => ["User with this e-mail does not exist"]]);
        }
        if($user->getEmail()!== $email){
            return $this->render("login", ['messeges' => ["User with this e-mail does not exist"]]);
        }
        if($user->getPassword() !== $password){
            return $this->render("login", ['messeges' => ["Wrong password!"]]);
        }

        $topicRepository = new TopicRepository();
        $actualTopic = $topicRepository->getTopicByActual();

        $_SESSION['userId'] = $user->getId();
        if($actualTopic!=null){
            $_SESSION['topicId'] = $actualTopic->getId();
        }
        return $this->render("topic");
    }
}