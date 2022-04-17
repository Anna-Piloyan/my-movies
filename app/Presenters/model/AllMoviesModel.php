<?php

namespace App\Presenters\Model;

use App\Models\ConnectionModel\Db;
use App\Presenters\Model\AllMovies\AllMovies;
use Dibi;

class AllMoviesModel
{
    public function createOutput(Dibi\Row $row)
    {
        $dao = new AllMovies();
        $dao->id = $row['id'];
        $dao->name = $row['name'];
        $dao->image = $row['image'];
        $dao->year = $row['year'];
        $dao->length = $row['length'];
        $dao->genre = $row['genre'];
        $dao->creatorName = $row['creatorName'];
        $dao->surname = $row['surname'];
        $dao->dateOfBirth = $row['dateOfBirth'];
        $dao->country = $row['country'];

        return $dao;
    }

    public function getAllMovies(): array
    {
        $ret = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM creators
        INNER JOIN films ON films.creators_id = creators.id");
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
