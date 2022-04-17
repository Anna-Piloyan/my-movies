<?php
namespace App\UserModule\Model\User;

class User{
    public $id;
    public $name;
    public $email;
    public $password;
    public function __construct() {

    }
    public static function createFromInput(array $value): User{
      
        $u = new User();
        $u->name = $value['name'];
        $u->email = $value['email'];
        $u->password = $value['password'];

        return $u;
    }
}