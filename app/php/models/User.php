<?php

namespace models;

class User
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $phoneNumber;

    /**
     * @param $id
     * @param $email
     * @param $password
     * @param $name
     * @param $phoneNumber
     */
    public function __construct($email, $password, $name, $phoneNumber,$id)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->id = $id;
    }

    /**
     * @param $id
     * @param $email
     * @param $password
     * @param $name
     * @param $phoneNumber
     */


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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }





}