<?php

namespace models;

class Topic
{
    private $id;
    private $topic;
    private $startDate;
    private $endDate;

    private $isActual;

    /**
     * @param $id
     * @param $topic
     * @param $startDate
     * @param $endDate
     * @param $isActual
     */
    public function __construct($id, $topic, $startDate, $endDate, $isActual)
    {
        $this->id = $id;
        $this->topic = $topic;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->isActual = $isActual;
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
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic): void
    {
        $this->topic = $topic;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getIsActual () :bool
    {
        return $this->isActual;
    }

    /**
     * @param mixed $isActual
     */
    public function setIsActual($isActual): void
    {
        $this->isActual = $isActual;
    }


}