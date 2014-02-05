<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;
use Zend\Db\Sql\Sql;

use Application\Entity\Pogrzeb;

class PogrzebTabela {
      protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * 
     * @return array of \Application\Entity\Pogrzeb;
     * 
     */
    public function getAll(){
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('p'=>'pogrzeb',))
               ->columns(array('grobid'))
               ->join(array('s'=>'sakrament'), 'p.sakramentid = s.id', array('*'), $select::JOIN_LEFT)
               ->join(array('o'=>'osoba'), 's.osobaid = o.id', array('osoba' => 'imie_nazwisko'), $select::JOIN_LEFT)
               ->join(array('k'=>'ksiadz'), 's.ksiadzid = k.id', array('ksiadz' => 'imie_nazwisko'), $select::JOIN_LEFT);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Pogrzeb
     * 
     */
    public function get($id) {
        $id  = (int) $id;
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('p'=>'pogrzeb',))
               ->columns(array('grobid'))
               ->join(array('s'=>'sakrament'), 'p.sakramentid = s.id', array('*'), $select::JOIN_LEFT)
               ->where->equalTo('sakramentid', $id);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet->current();
    }
    
    public function add(Pogrzeb $rekord) {
        $data = $rekord->extract();
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Pogrzeb $rekord) {
        $data = $rekord->extract();
//        var_dump($data);
//        echo $id;
        if($this->tableGateway->update($data, array('sakramentid'=>$id))){
            return $id;
        } else {
            throw new Exception('DB insert project error');
        }
        
    }
    
    public function delete($id) {
        if($this->tableGateway->delete(array('sakramentid' => $id))) {
            return $id;
        } else {
            throw new Exception("DB delete error");
        }
    }
}
