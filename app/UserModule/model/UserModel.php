<?php

namespace App\UserModule\Model;

use App\Models\ConnectionModel\Db;
use App\UserModule\Model\User\User;
use Dibi;
use Nette\Application\UI\Form;


class UserModel
{
    public function register(array $user)
    {
        $db = Db::getConnection();
        echo "connection";
        $db->query('INSERT INTO users', $user);
    }
    public function createOutput(Dibi\Row $row)
    { 
        $dao = new User();
        $dao->id = $row['id'];
        $dao->name = $row['name'];
        $dao->email = $row['email'];
        $dao->password = $row['password'];
        return $dao;
    }

    public function getUsers(): array
    {   
        $ret = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM users");
        if ($result->getRowCount() === 0) {
            return $ret;
        }
        $data = $result->fetchAll();        
        foreach ($data as $row) {
            $ret[] = $this->createOutput($row);
        }
        return $ret;
    }
}
