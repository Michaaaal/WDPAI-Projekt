<?php

namespace models;

class CompetitionPhoto
{
    private $id;

    private $topic_id;
    private $user_id;
    private $description;
    private $image;

    private $likes;
    private $unlikes;
    private $place;

    /**
     * @param $id
     * @param $topic_id
     * @param $user_id
     * @param $description
     * @param $image
     * @param $likes
     * @param $unlikes
     * @param $place
     */
    public function __construct($id, $topic_id, $user_id, $description, $image, $likes, $unlikes, $place)
    {
        $this->id = $id;
        $this->topic_id = $topic_id;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->image = $image;
        $this->likes = $likes;
        $this->unlikes = $unlikes;
        $this->place = $place;
    }

    /**
     * @param $topic_id
     * @param $user_id
     * @param $description
     * @param $image
     * @param $likes
     * @param $unlikes
     * @param $place
     */



    public function getDescription() : string
    {
        return $this->description;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param mixed $topic_id
     */
    public function setTopicId($topic_id): void
    {
        $this->topic_id = $topic_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getUnlikes()
    {
        return $this->unlikes;
    }

    /**
     * @param mixed $unlikes
     */
    public function setUnlikes($unlikes): void
    {
        $this->unlikes = $unlikes;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place): void
    {
        $this->place = $place;
    }




}