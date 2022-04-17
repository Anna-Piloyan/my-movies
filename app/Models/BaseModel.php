<?php
namespace App\Models;
use Dibi;

class BaseModel{

    public static function getConnection()
    {
        try {
            $db = dibi::connect([
                'driver' => 'pdo',
                'host' => 'localhost',
                'username' => 'root',
               'password' => 'xxx',
                'database' => 'filmsdb'
        
            ]);
            echo 'OK';
        } catch (Dibi\Exception $e) {
            echo get_class($e), ': ', $e->getMessage(), "\n";
        }
        echo "</p>\n";
        
        return $db;
    }
}