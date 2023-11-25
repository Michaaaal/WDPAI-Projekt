<?php

namespace models;

class CompetitionPhoto
{
    private $description;
    private $image;

    public function __construct($description, $image)
    {
        $this->description = $description;
        $this->image = $image;
    }


    public function getDescription() : string
    {
        return $this->description !== null ? $this->description : 'AAA';
    }

    public function getImage() : string
    {
        return $this->image;
    }


}