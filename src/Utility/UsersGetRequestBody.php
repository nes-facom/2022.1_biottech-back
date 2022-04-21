<?php

namespace App\Utility;

class UsersGetRequestBody {

    public $id;
    public $name;
    public $username;
    public $type;
    
    public function __construct($id, $name, $username, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->type = $type;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getType() {
        return $this->type;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setType($type): void {
        $this->type = $type;
    }


}
