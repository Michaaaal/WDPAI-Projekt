<?php
namespace repository;
require_once 'Repository.php';
require_once __DIR__.'/../models/Topic.php';
use models\Topic;
use PDO;

class TopicRepository extends \Repository
{
    public function getTopicByActual(){
        $stmt = $this->database->connect()->prepare("SELECT * FROM topics WHERE actual=true LIMIT 1");
        $stmt->execute();

        $topic = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($topic == false){
            return null;
        }

        return new Topic(
            $topic["id_topic"],
            $topic["topic"],
            $topic["start_date"],
            $topic["end_date"],
            $topic["actual"]
        );

    }

    public function getTopicById(int $id): ?Topic
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM topics WHERE id_topic=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $topic = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($topic == false){
            return null;
        }

        return new Topic(
            $topic["id_topic"],
            $topic["topic"],
            $topic["start_date"],
            $topic["end_date"],
            $topic["actual"]
        );

    }

    public function getTopicNameLike(string $topicName): array
    {
        $topicName = '%'.strtolower($topicName).'%';

        $stmt = $this->database->connect()->prepare("SELECT * FROM topics WHERE LOWER(topic) LIKE :topicName");
        $stmt->bindParam(':topicName', $topicName);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}