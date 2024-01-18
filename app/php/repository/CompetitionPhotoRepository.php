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
            $competitionPhoto['id_competition_image'],
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
                $competitionPhoto['id_competition_image'],
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

    public function getCPbyUserNotEvaluated(int $id): array
    {
        $topicId = $_SESSION['topicId'];

        $stmt = $this->database->connect()->prepare("SELECT * FROM competition_images 
                                                            WHERE id_competition_image NOT IN (
                                                                SELECT id_competition_image 
                                                                FROM evaluated
                                                                WHERE id_user = :id
                                                            )
                                                            AND user_id != :id
                                                            AND topic_id = :topicId
                                                            LIMIT 10");

        $stmt->bindParam(':id',$id , PDO::PARAM_STR);
        $stmt->bindParam(':topicId',$topicId , PDO::PARAM_STR);
        $stmt->execute();

        $competitionPhotos = [];

        while ($competitionPhoto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $competitionPhotos[] = new CompetitionPhoto(
                $competitionPhoto['id_competition_image'],
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

    public function getCPbyUserNotEvaluatedSingle(int $id): ?CompetitionPhoto
    {
        $topicId = $_SESSION['topicId'];

        $stmt = $this->database->connect()->prepare("SELECT * FROM competition_images 
                                                            WHERE id_competition_image NOT IN (
                                                                SELECT id_competition_image 
                                                                FROM evaluated
                                                                WHERE id_user = :id
                                                            )
                                                            AND user_id != :id
                                                            AND topic_id = :topicId
                                                            LIMIT 1");

        $stmt->bindParam(':id',$id , PDO::PARAM_STR);
        $stmt->bindParam(':topicId',$topicId , PDO::PARAM_STR);
        $stmt->execute();

        $competitionPhoto= $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$competitionPhoto){
            return null;
        }

        return new CompetitionPhoto(
            $competitionPhoto['id_competition_image'],
            $competitionPhoto['topic_id'],
            $competitionPhoto['user_id'],
            $competitionPhoto['description'],
            $competitionPhoto['img'],
            $competitionPhoto['likes'],
            $competitionPhoto['unlikes'],
            $competitionPhoto['place']
        );
    }

    public function getCPByTopicId(int $topicId){
        $stmt = $this->database->connect()->prepare("SELECT * FROM competition_images WHERE topic_id = :topicId ORDER BY likes desc");
        $stmt->bindParam(':topicId', $topicId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCPByTopicIdObjects(int $topicId){
        $stmt = $this->database->connect()->prepare("SELECT * FROM competition_images WHERE topic_id = :topicId ORDER BY likes desc");
        $stmt->bindParam(':topicId', $topicId);
        $stmt->execute();

        $competitionPhotos = [];

        while ($competitionPhoto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $competitionPhotos[] = new CompetitionPhoto(
                $competitionPhoto['id_competition_image'],
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

    public function addLike(int $idCI){
        $query = "UPDATE competition_images SET likes = likes + 1 WHERE id_competition_image = :id";

        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':id', $idCI);

        $stmt->execute();
    }

    public function addDislike(int $idCI){
        $query = "UPDATE competition_images SET unlikes = unlikes + 1 WHERE id_competition_image = :id";

        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':id', $idCI);

        $stmt->execute();
    }

    public function addToEvaluated(int $userId, int $competitionImageId){
        $query = "INSERT INTO evaluated (id_user, id_competition_image) 
                  VALUES (:idUser, :idCI)";

        $stmt = $this->database->connect()->prepare($query);

        $stmt->bindParam(':idUser', $userId);
        $stmt->bindParam(':idCI', $competitionImageId);

        $stmt->execute();
    }
}