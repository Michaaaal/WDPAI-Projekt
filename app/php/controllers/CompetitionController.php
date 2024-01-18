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
        $this->checkIfLoggedIn();
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {

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

    public function evaluateCI() {
        $this->checkIfLoggedIn();

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

    public function displayCompetitionImagesForTopic()
    {
        $topicId = $_SESSION['topicId'];

        $competitionPhotoRepository = new CompetitionPhotoRepository();
        $allCPbyUserId = $competitionPhotoRepository->getCPByTopicIdObjects($topicId);
        if(count($allCPbyUserId)==0){
            return;
        }

        foreach ($allCPbyUserId as $competitionPhoto){
            $imagePath = "app/iuploadsTMP/";
            if ($competitionPhoto != null ) {
                $description = $competitionPhoto->getImage();
                if (!empty($description)) {
                    $imagePath .= $description;
                } else {
                    $imagePath .= 'No-Photo.jpg';
                }
            } else {
                continue;
            }

            echo '<div class="imgPlusDesc"><img class="uploadedIMG" src="' . $imagePath . '" alt="Competition Image">';
            echo '<p class="uploadedIMG">' . $competitionPhoto->getDescription() . '</p></div>';
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

    public function search(){
        $this->checkIfLoggedIn();

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $topicRepository = new TopicRepository();

            // Pobieranie tematów
            $topics = $topicRepository->getTopicNameLike($decoded['search']);

            // Zapisywanie nazw tematów do pliku
            $this->saveTopicNamesToFile($topics);

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($topics);
        }
    }

    public function competitionImages() {
        $this->checkIfLoggedIn();

        $topicId = $_GET['topicId'] ?? null;
        if ($topicId) {
            $repoCI = new CompetitionPhotoRepository();
            $cis = $repoCI->getCPByTopicId($topicId);
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($cis);
        }
    }
    private function saveTopicNamesToFile($topics) {
        $fileName = 'topics.txt'; // Nazwa pliku do zapisu
        $file = fopen($fileName, 'a'); // Otwarcie pliku w trybie dopisywania

        foreach ($topics as $topic) {
            fwrite($file, $topic['topic'] . PHP_EOL); // Zapis nazwy tematu do pliku
        }

        fclose($file); // Zamknięcie pliku
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
