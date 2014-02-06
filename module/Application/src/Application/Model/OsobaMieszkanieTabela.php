<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;

use Application\Entity\OsobaMieszkanie;

class OsobaMieszkanieTabela {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function add(OsobaMieszkanie $rekord) {
        $data = $rekord->extractWithId($rekord);
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, OsobaMieszkanie $rekord) {
        $data = $rekord->extract($rekord);
        if($this->tableGateway->update($data, array('osobaid'=>$id))){
            return $id;
        } else {
//            throw new Exception('DB insert project error');
        }
    }
    
    public function delete($id) {
        if($this->tableGateway->delete(array('osobaid' => $id))) {
            return $id;
        } else {
            throw new Exception("DB delete error");
        }
    }
}
