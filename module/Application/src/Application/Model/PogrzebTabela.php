<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;

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
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Pogrzeb
     * 
     */
    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id'=>$id));
        return $rowset->current();
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
        if($this->tableGateway->update($data, array('id'=>$id))){
            return $id;
        } else {
            throw new Exception('DB insert project error');
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
