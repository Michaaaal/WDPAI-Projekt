<?php

namespace repository;

use models\CompetitionPhoto;
use models\User;
use PDO;
use Repository;

require_once __DIR__.'/../models/User.php';
require_once 'Repository.php';

class CompetitionPhotoRepository extends \Repository
{
    public function getCPbyUserId(int $id): ? CompetitionPhoto
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM competition_images ci WHERE ci.user_id = :id ORDER BY ci.likes ASC LIMIT 1");
        $stmt->bindParam(':id',$id , PDO::PARAM_STR);
        $stmt->execute();

        $competitionPhoto= $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$competitionPhoto){
            return null;
        }

        return new CompetitionPhoto(
            $competitionPhoto['topic_id'],
            $competitionPhoto['user_id'],
            $competitionPhoto['description'],
            $competitionPhoto['img'],
            $competitionPhoto['likes'],
            $competitionPhoto['unlikes'],
            $competitionPhoto['place']
        );
    }

    public function getAllCPbyUserId(int $id): array
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM competition_images ci WHERE ci.user_id = :id ORDER BY ci.likes ASC");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $competitionPhotos = [];

        while ($competitionPhoto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $competitionPhotos[] = new CompetitionPhoto(
                $competitionPhoto['topic_id'],
                $competitionPhoto['user_id'],
                $competitionPhoto['description'],
                $competitionPhoto['img'],
                $competitionPhoto['likes'],
                $competitionPhoto['unlikes'],
                $competitionPhoto['place']
            );
        }

        return $competitionPhotos;
    }

    public function addCP(CompetitionPhoto $competitionPhoto):void{

        $query = "INSERT INTO competition_images (topic_id, user_id, img, likes, unlikes, description, place) 
                  VALUES (:topic_id, :user_id, :image, :likes, :unlikes,:description, :place)";

        $stmt = $this->database->connect()->prepare($query);

        $topicId = $competitionPhoto->getTopicId();
        $stmt->bindParam(':topic_id', $topicId);
        $description = $competitionPhoto->getDescription();
        $stmt->bindParam(':description', $description);
        $image = $competitionPhoto->getImage();
        $stmt->bindParam(':image', $image);
        $likes = $competitionPhoto->getLikes();
        $stmt->bindParam(':likes', $likes);
        $unlikes = $competitionPhoto->getUnlikes();
        $stmt->bindParam(':unlikes', $unlikes);
        $place = $competitionPhoto->getPlace();
        $stmt->bindParam(':place', $place);
        $userId = $competitionPhoto->getUserId();
        $stmt->bindParam('user_id', $userId);

        $stmt->execute();
    }
}