<?php

namespace App\MovieModule\Model;

use App\Models\ConnectionModel\Db;
use App\MovieModule\Model\Movie\Movie;
use Dibi;
use Tracy\OutputDebugger;


class MovieModel
{
    public function insert(array $movie)
    {
        $db = Db::getConnection();
        $db->query('INSERT INTO films', $movie);
    }
    public function delete($id)
    {
        $db = Db::getConnection();
        $db->query('DELETE FROM films WHERE id = ?', $id);
        $affectedRows = $db->getAffectedRows();
    }
    public function update($id, array $movie)
    {
        $db = Db::getConnection();
        $db->query('UPDATE films SET', [
            'name' => $movie['name'],
            'image' => $movie['image'],
            'year' => $movie['year'],
            'length' => $movie['length'],
            'genre' => $movie['genre']
        ], 'WHERE id = ?', $id);

        $affectedRows = $db->getAffectedRows();
    }
    public function createOutput(Dibi\Row $row)
    {
        $dao = new Movie();
        $dao->id = $row['id'];
        $dao->name = $row['name'];
        $dao->image = $row['image'];
        $dao->year = $row['year'];
        $dao->length = $row['length'];
        $dao->genre = $row['genre'];
        return $dao;
    }

    public function getMovies(): array
    {
        $ret = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM films");
        if ($result->getRowCount() === 0) {
            return $ret;
        }
        $data = $result->fetchAll();
        foreach ($data as $row) {
            $ret[] = $this->createOutput($row);
        }
        return $ret;
    }

    public function getMovie($id)
    {
        $ret = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM films WHERE id = ?', $id");
        if ($result->getRowCount() === 0) {
            return $ret;
        }
        $row = $result->fetch();
      
        $ret[] = $this->createOutput($row);
       
        return $ret;
    }
}
