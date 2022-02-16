<?php

namespace models;

use core\Model;
use helpers\Helper;

class AuthModel extends Model{
    public string $username = '';
    public string $password = '';

    public function rules(): array{
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED], 
        ];
    }

    public function login(){
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $user_data = $stmt->fetch();
        
        if (!$user_data || !\password_verify($this->password, $user_data['password']))
            return false;

        $_SESSION['user_info'] = [
            'logged' => True,
            'username' => $this->username
        ];
        return True;
    }
}