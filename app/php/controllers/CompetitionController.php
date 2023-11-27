<?php

use models\CompetitionPhoto;

require_once 'AppController.php';
require_once __DIR__.'/../models/CompetitionPhoto.php';


class CompetitionController extends AppController{

    private $messages = [];

    const MAX_FILE_SIZE=1024*1024;
    const SUPPORTED_TYPES= [ "image/png" , "image/jpg" ];
    const UPLOAD_DIR = '/../iuploadsTMP/';

    public function addCP(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIR.$_FILES['file']['name']);

            $competitionPhoto = new CompetitionPhoto($_POST['description'], $_FILES['file']['name']);

            return $this->render('acc',["messages" => $this->messages, 'competitionPhoto'=> $competitionPhoto]);
        }

        $this->messages[] = 'No file attached!';
        $this->render("acc",["messages" => $this->messages]);
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
