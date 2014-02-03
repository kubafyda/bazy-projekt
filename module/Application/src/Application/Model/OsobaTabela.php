<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;

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
     */
    public function getAll(){
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Osoba
     */
    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id'=>$id));
        return $rowset->current();
    }
    
    public function add(Osoba $rekord) {
        $data = array(
            'id' => $rekord->id,
            'imie_nazwisko' => $rekord->imie_nazwisko,
            'data_urodzenia' => $rekord->data_urodzenia,
            'zawod' => $rekord->zawod,
            'parafianin' => $rekord->parafianin,
            'zywa' => $rekord->zywa,
            
           );
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Osoba $rekord) {
        $data = array(
            'imie_nazwisko' => $rekord->imie_nazwisko,
            'data_urodzenia' => $rekord->data_urodzenia,
            'zawod' => $rekord->zawod,
            'parafianin' => $rekord->parafianin,
            'zywa' => $rekord->zywa,
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
