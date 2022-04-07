<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Utility;

/**
 * Description of UserNewPasswordRequestBody
 *
 * @author Leonardo
 */
class UserNewPasswordRequestBody {
  
    public $newPassword;
    
    public function __construct($newPassword) {
        $this->newPassword = $newPassword;
    }
    
    public function getNewPassword() {
        return $this->newPassword;
    }

    public function setNewPassword($newPassword): void {
        $this->newPassword = $newPassword;
    }



}
