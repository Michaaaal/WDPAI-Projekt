<?php

use models\CompetitionPhoto;
use repository\CompetitionPhotoRepository;

require_once 'AppController.php';
require_once __DIR__.'/../models/CompetitionPhoto.php';
require_once __DIR__.'/../repository/CompetitionPhotoRepository.php';


class CompetitionController extends AppController{

    private $messages = [];

    const MAX_FILE_SIZE=1024*1024;
    const SUPPORTED_TYPES= [ "image/png" , "image/jpg" ];
    const UPLOAD_DIR = '/../iuploadsTMP/';

    public function addCP(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            $topicId = $_SESSION['topicId'];
            $userId = $_SESSION['userId'];

            if($userId==null || $topicId==null ){
                $this->messages[] = 'Something went wrong!!!!!!';
                $this->render("acc",["messages" => $this->messages]);
            }

            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIR.$_FILES['file']['name']);

            $competitionPhoto = new CompetitionPhoto($topicId, $userId, $_POST['description'], $_FILES['file']['name'],0,0,null);
            $competitionPhotoRepository = new CompetitionPhotoRepository();
            $competitionPhotoRepository->addCP($competitionPhoto);


            return $this->render('acc',["messages" => $this->messages, 'competitionPhoto'=> $competitionPhoto]);
        }

        $this->messages[] = 'No file attached!';
        $this->render("acc",["messages" => $this->messages]);
    }

    function displayCompetitionImage(): void
    {
        $imagePath = "app/iuploadsTMP/";
        $userId = $_SESSION['userId'];

        $competitionPhotoRepository = new CompetitionPhotoRepository();
        $allCPbyUserId = $competitionPhotoRepository->getAllCPbyUserId($userId);

        foreach ($allCPbyUserId as $competitionPhoto){
            if ($competitionPhoto != null) {
                $description = $competitionPhoto->getImage();
                if (!empty($description)) {
                    $imagePath .= $description;
                } else {
                    $imagePath .= 'No-Photo.jpg';
                }
            } else {
                $imagePath .= 'No-Photo.jpg';
        }

        echo '<img class="uploadedIMG" src="' . $imagePath . '" alt="Competition Image">';
        }
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
