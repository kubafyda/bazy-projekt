<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;
use Zend\Db\Sql\Sql;

use Application\Entity\Slub;

class SlubTabela {
      protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * 
     * @return array of \Application\Entity\Slub;
     * 
     */
    public function getAll(){
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('p'=>'slub',))
              // ->columns(array('grobid'))
               ->join(array('s'=>'sakrament'), 'p.sakramentid = s.id', array('*'), $select::JOIN_LEFT);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Slub
     * 
     */
    public function get($id) {
        $id  = (int) $id;
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('p'=>'slub',))
               ->join(array('s'=>'sakrament'), 'p.sakramentid = s.id', array('*'), $select::JOIN_LEFT)
               ->where->equalTo('sakramentid', $id);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet->current();
    }
    
    public function add(Slub $rekord) {
        $data = $rekord->extract();
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Slub $rekord) {
        $data = $rekord->extract();
        if($this->tableGateway->update($data, array('id'=>$id))){
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
