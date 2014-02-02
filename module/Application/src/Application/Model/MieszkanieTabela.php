<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;

use Application\Entity\Mieszkanie;

class MieszkanieTabela {
      protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * 
     * @return array of \Project\Entity\Project
     */
    public function getAll(){
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * 
     * @return \Project\Entity\Project
     */
    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id'=>$id));
        return $rowset->current();
    }
    
    public function add(Mieszkanie $rekord) {
        $data = array(
            'id' => $rekord->id,
            'ulica' => $rekord->ulica,
            'nr_bloku' => $rekord->nr_bloku,
            'nr_mieszkania' => $rekord->nr_mieszkania,
        );
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Mieszkanie $rekord) {
        $data = array(
            'ulica' => $rekord->ulica,
            'nr_bloku' => $rekord->nr_bloku,
            'nr_mieszkania' => $rekord->nr_mieszkania,
        );
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
