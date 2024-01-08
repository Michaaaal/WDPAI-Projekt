<?php

use models\CompetitionPhoto;
use repository\CompetitionPhotoRepository;
use repository\TopicRepository;

require_once 'AppController.php';
require_once __DIR__.'/../models/CompetitionPhoto.php';
require_once __DIR__.'/../repository/CompetitionPhotoRepository.php';
require_once __DIR__.'/../repository/TopicRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';


class CompetitionController extends AppController{

    private $messages = [];

    const MAX_FILE_SIZE=1024*1024;
    const SUPPORTED_TYPES= [ "image/png" , "image/jpg" ];
    const UPLOAD_DIR = '/../iuploadsTMP/';

    public function addCP(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
                header('Location: login.php');
                exit;
            }


            $userId = $_SESSION['userId'];
            $userRepository = new UserRepository();
            $user = $userRepository->getUserById($userId);


            $topicRepository= new TopicRepository();
            $topic = $topicRepository->getTopicByActual();
            $topicId = $topic->getId();

            if($userId==null || $topicId==null ){
                $this->messages[] = 'Something went wrong!!!!!!';
                $this->render("acc",["messages" => $this->messages]);
            }

            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIR.$_FILES['file']['name']);

            $description = $user->getName()."   (".$topic->getTopic()."): ". $_POST['description'];

            $competitionPhoto = new CompetitionPhoto(null,$topicId, $userId,$description, $_FILES['file']['name'],0,0,null);
            $competitionPhotoRepository = new CompetitionPhotoRepository();
            $competitionPhotoRepository->addCP($competitionPhoto);


            return $this->render('acc',["messages" => $this->messages, 'competitionPhoto'=> $competitionPhoto]);
        }

        $this->messages[] = 'No file attached!';
        $this->render("acc",["messages" => $this->messages]);
    }


    public function displayCompetitionImagesUploaded()
    {
        $userId = $_SESSION['userId'];
        $topicId = $_SESSION['topicId'];

        $competitionPhotoRepository = new CompetitionPhotoRepository();
        $allCPbyUserId = $competitionPhotoRepository->getAllCPbyUserId($userId);
        if(count($allCPbyUserId)==0){
            return;
        }

        foreach ($allCPbyUserId as $competitionPhoto){
            $imagePath = "app/iuploadsTMP/";
            if ($competitionPhoto != null && $competitionPhoto->getTopicId() == $topicId) {
                $description = $competitionPhoto->getImage();
                if (!empty($description)) {
                    $imagePath .= $description;
                } else {
                    $imagePath .= 'No-Photo.jpg';
                }
            } else {
                continue;
            }

            echo '<img class="uploadedIMG" src="' . $imagePath . '" alt="Competition Image">';
            echo '<p class="uploadedIMG">' . $competitionPhoto->getDescription() . '</p>';
        }
    }

    public function displayCompetitionImagesGallery()
    {
        $userId = $_SESSION['userId'];
        $topicId = $_SESSION['topicId'];

        $competitionPhotoRepository = new CompetitionPhotoRepository();
        $allCPbyUserId = $competitionPhotoRepository->getAllCPbyUserId($userId);
        if(count($allCPbyUserId)==0){
            return;
        }

        foreach ($allCPbyUserId as $competitionPhoto){
            $imagePath = "app/iuploadsTMP/";
            if ($competitionPhoto != null && $competitionPhoto->getTopicId() != $topicId) {
                $description = $competitionPhoto->getImage();
                if (!empty($description)) {
                    $imagePath .= $description;
                } else {
                    $imagePath .= 'No-Photo.jpg';
                }
            } else {
               continue;
            }

            echo '<img class="uploadedIMG" src="' . $imagePath . '" alt="Competition Image">';
            echo '<p class="uploadedIMG">' . $competitionPhoto->getDescription() . '</p>';
        }
    }

    public function evaluateCI() {
        $idCI = intval($_POST['photoId']);
        $ifLike = $_POST['like'] === 'true';

        $userId = $_SESSION["userId"];
        $repo = new CompetitionPhotoRepository();

        $repo->addToEvaluated($userId, $idCI);

        if ($ifLike) {
            $repo->addLike($idCI);
        } else {
            $repo->addDislike($idCI);
        }

        $image = $repo->getCPbyUserNotEvaluatedSingle($userId);
        $this->render('evaluate', ['image' => [$image]]);
    }


    private function validate(array $file):bool {

        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is too large!!!';
            return false;
        }

        if(!isset($file['type'])  && !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'File type is not supported!!!';
            return false;
        }

        return true;
    }
}
