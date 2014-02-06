<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;
use Zend\Db\Sql\Sql;

use Application\Entity\Osoba;

class OsobaTabela {
      protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * 
     * @return array of \Application\Entity\Osoba
     * 
     */
    public function getAll(){
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('o'=>'osoba'))
               ->join(array('om'=>'osoba_mieszkanie'), 'om.osobaid = o.id', array('mieszkanieid'), $select::JOIN_LEFT)
               ->join(array('m'=>'mieszkanie'), 'om.mieszkanieid = m.id', array('ulica', 'nr_bloku', 'nr_mieszkania'), $select::JOIN_LEFT);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Osoba
     * 
     */
    public function get($id)
    {
        $id  = (int) $id;
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('o'=>'osoba'))
               ->join(array('om'=>'osoba_mieszkanie'), 'om.osobaid = o.id', array('mieszkanieid'), $select::JOIN_LEFT)
               ->join(array('m'=>'mieszkanie'), 'om.mieszkanieid = m.id', array('ulica', 'nr_bloku', 'nr_mieszkania'), $select::JOIN_LEFT)
               ->where->equalTo('o.id', $id);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet->current();
    }
    
    public function add(Osoba $rekord) {
        $data = $rekord->extract($rekord);
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Osoba $rekord) {
        $data = $rekord->extract($rekord);
        if($this->tableGateway->update($data, array('id' => $id))){
            return $id;
        } else {
//            throw new Exception('DB insert project error');
        }
    }
    
    public function delete($id) {
        if($this->tableGateway->delete(array('id' => $id))) {
            return $id;
        } else {
            throw new Exception("DB delete error");
        }
    }
}
