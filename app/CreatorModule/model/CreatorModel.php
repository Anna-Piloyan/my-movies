<?php

namespace App\CreatorModule\Model;

use App\Models\ConnectionModel\Db;
use App\CreatorModule\Model\Creator\Creator;
use Dibi;
use Tracy\OutputDebugger;


class CreatorModel
{
    public function insert(array $creator)
    {
        $db = Db::getConnection();
        $db->query('INSERT INTO creators', $creator);
    }
    public function delete($id)
    {
        $db = Db::getConnection();
        $db->query('DELETE FROM creators WHERE id = ?', $id);
        $affectedRows = $db->getAffectedRows();
    }
    public function update($id, array $creator)
    {
        $db = Db::getConnection();
        $db->query('UPDATE users SET', [
            'creatorName' => $creator['creatorName'],
            'surname' => $creator['surname'],
            'dateOfBirth' => $creator['dateOfBirth'],
            'country' => $creator['country'],
        ], 'WHERE id = ?', $id);

        $affectedRows = $db->getAffectedRows();
    }
    public function createOutput(Dibi\Row $row)
    {
        $dao = new Creator();
        $dao->id = $row['id'];
        $dao->creatorName = $row['creatorName'];
        $dao->surname = $row['surname'];
        $dao->dateOfBirth = $row['dateOfBirth'];
        $dao->country = $row['country'];
        return $dao;
    }

    public function getCreators(): array
    {
        $ret = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM creators");
        if ($result->getRowCount() === 0) {

            return $ret;
        }
        $data = $result->fetchAll();
        foreach ($data as $row) {
            $ret[] = $this->createOutput($row);
        }
        return $ret;
    }
    public function getCreator($id): array
    {
        $ret = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM creators WHERE id = ?', $id");
        if ($result->getRowCount() === 0) {
            return $ret;
        }
        $row = $result->fetch();
      
        $ret[] = $this->createOutput($row);
        return $ret;
    }
}
