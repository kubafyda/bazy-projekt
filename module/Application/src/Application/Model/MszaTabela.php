<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;
use Zend\Db\Sql\Sql;

use Application\Entity\Msza;

class MszaTabela {
      protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * 
     * @return array of \Application\Entity\Msza
     * Join z tabelami 'osoba' i 'ksiadz' dla uzyskania nazwiska osoby i ksiedza nie tylko ID
     */
    public function getAll(){
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from(array('m'=>'msza',))
               ->join(array('o'=>'osoba'), 'm.osobaid = o.id', array('osoba' => 'imie_nazwisko'), $select::JOIN_LEFT)
               ->join(array('k'=>'ksiadz'), 'm.ksiadzid = k.id', array('ksiadz' => 'imie_nazwisko'), $select::JOIN_LEFT);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Msza
     * 
     */
    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id'=>$id));
        return $rowset->current();
    }
    
    public function add(Msza $rekord) {
        $data = array(
            'id' => $rekord->id,
            'osobaid' => $rekord->osobaid,
            'ksiadzid' => $rekord->ksiadzid,
            'intencja' => $rekord->intencja,
            'data_mszy' => $rekord->data_mszy,
            'ofiara' => $rekord->ofiara,
        );
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Msza $rekord) {
        $data = array(
            'ksiadzid' => $rekord->ksiadzid,
            'intencja' => $rekord->intencja,
            'data_mszy' => $rekord->data_mszy,
            'ofiara' => $rekord->ofiara,
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
