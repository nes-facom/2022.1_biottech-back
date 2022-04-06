<?php

namespace App\Utility;

class UsersGetRequestBody {

    public $id;
    public $name;
    public $usename;
    public $type;
    
    public function __construct($id, $name, $usename, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->usename = $usename;
        $this->type = $type;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUsename() {
        return $this->usename;
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

    public function setUsename($usename): void {
        $this->usename = $usename;
    }

    public function setType($type): void {
        $this->type = $type;
    }







}
