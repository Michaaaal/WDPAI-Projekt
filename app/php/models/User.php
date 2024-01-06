<?php

namespace models;

class User
{
    private $id;
    private $email;
    private $password;
    private $name;


    public function __construct(int $id ,string $email, string $password, string $name)
    {
        $this->id=$id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }


}