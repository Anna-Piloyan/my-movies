<?php
namespace App\CreatorModule\Model\Creator;

class Creator{
     public $id;
     public $creatorName;
     public $surname;
     public $dateOfBirth;
     public $country;
    public function __construct() {

    }
    public static function createFromInput(array $value): Creator{
         $c = new Creator();
         $c->creatorName = $value['creatorName'];
         $c->surname = $value['surname'];
         $c->dateOfBirth = $value['dateOfBirth'];
         $c->country = $value['country'];
     
         return $c;
    }
    
}