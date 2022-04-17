<?php

namespace App\Models\ConnectionModel;

use Dibi;

class Db
{
    public static function getConnection()
    {
        try {
            $db = new Dibi\Connection([
                'driver'   => 'mysqli',
                'host'     => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'filmsdb',
            ]);
          
        } catch (Dibi\Exception $e) {
            echo get_class($e), ': ', $e->getMessage(), "\n";
        }
        echo "</p>\n";

        return $db;
    }
}
 



