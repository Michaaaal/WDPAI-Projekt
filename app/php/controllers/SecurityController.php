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
            return $this->render("login");
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
        if(!password_verify($password, $user->getPassword())){
            return $this->render("login", ['messeges' => ["Wrong password!"]]);
        }

        $topicRepository = new TopicRepository();
        $actualTopic = $topicRepository->getTopicByActual();

        $_SESSION['userId'] = $user->getId();
        if($actualTopic!=null){
            $_SESSION['topicId'] = $actualTopic->getId();
            $_SESSION['topicName'] = $actualTopic->getTopic();
            $_SESSION['topicEndDate'] = $actualTopic->getEndDate();
        }
        $_SESSION["isLoggedIn"] = true;
        return $this->render("acc");
    }

    public function logout(){
        $_SESSION["isLoggedIn"] = false;
        session_destroy();
        return $this->render("login");
    }

    public function registerUser(){
        if(!$this->isPost()){
            return $this->render("register");
        }

        $email= $_POST["e-mail"];
        $password = $_POST["firstPassword"];
        $secondPassword = $_POST["secondPassword"];
        $nickname = $_POST["nickname"];
        $phoneNumber = $_POST["phone-number"];

        if($email == null || $password == null || $secondPassword == null || $nickname == null || $phoneNumber == null){
            return $this->render("register", ['messeges' => ["Wrong data couldnt register!!!"]]);
        }
        $userRepository = new UserRepository();
        if($userRepository->getUser($email)){
            return $this->render("register", ['messeges' => ["This e-mail is allready used!!!"]]);
        }


        if($password == $secondPassword){
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $user = new User($email, $hashedPassword, $nickname, $phoneNumber,null);
            $userRepository->addUser($user);
            return $this->render("login", ['messeges' => ["You have registered"]]);
        }

        return $this->render("register", ['messeges' => ["Wrong data couldnt register!!!"]]);
    }



    public function changeAcc(){
        $userRepository = new UserRepository();
        $user = $userRepository->getUserById($_SESSION['userId']);

        $newNickname = $_POST['changeNickname'];
        $newPassword = $_POST['changePassword'];
        $newRepeatPassword = $_POST['repeatPassword'];
        $newPhoneNumber = $_POST['phoneNumber'];

        if($newNickname=="" && $newPassword=="" && $newPhoneNumber==""){
            return $this->render("acc", ['messeges' => ["Can't change data, no data to change!"]]);
        }
        if($newPhoneNumber!="" && strlen($newPhoneNumber)!=9){
            return $this->render("acc", ['messeges' => ["Can't change data, wrong phone number!"]]);
        }
        if($newPassword != "" && $newPassword != $newRepeatPassword){
            return $this->render("acc", ['messeges' => ["Can't change data, different passwords!"]]);
        }


        if($newNickname != "" ){
            $user->setName($newNickname);
        }
        if($newPhoneNumber != ""){
            $user->setPhoneNumber($newPhoneNumber);
        }
        if($newPassword != ""){
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $user->setPassword($hashedPassword);
        }

        $userRepository->changeUser($user);
        return $this->render("acc", ['messeges' => ["User data changed!"]]);
    }
}