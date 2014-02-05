<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Pogrzeb;
use Application\Entity\Sakrament;

class PogrzebController extends AbstractRestfulController
{
    private $table;
    private $sakramentTable;
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getPogrzebTabela()->getAll();
        $list = array();
        foreach ($results as $osoba) {
            $list[] = $osoba;
        }
        return new JsonModel(
            array('pogrzeby' => $list)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getPogrzebTabela()->get($id);
        $rekord = array();
        if($result) {
            $rekord = $result;
        } else {
            $rekord = array(
                'status' => 'error',
                'message' => 'Not found'
            );
        }
        return new JsonModel(array('rekord' => $rekord));
    }

    public function create($data) {   // Action used for POST requests
        $rekord = new Pogrzeb();
        $sakrament = new Sakrament();
        $sakrament->exchangeArray($data);
        
        $sakramentId = $this->getSakramentTabela()->add($sakrament);
        $rekord->exchangeArray($data);
        $rekord->sakramentid = $sakramentId;
        
        $this->getPogrzebTabela()->add($rekord);
        
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Pogrzeb();
        $sakrament = new Sakrament();
        $rekord->exchangeArray($data);
        $rekord->sakramentid = $id;
        $this->getPogrzebTabela()->update($id, $rekord);
        
        $sakrament->exchangeArray($data);
        $sakrament->id = $id;
        $this->getSakramentTabela()->update($id, $sakrament);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getPogrzebTabela()->delete($id);
        $this->getSakramentTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * @return \Application\Model\PogrzebTabela
     */
    public function getPogrzebTabela(){
        if(!$this->table){
            $this->table = $this->getServiceLocator()->get('PogrzebTabela');
        }
        return $this->table;
    }
    /**
     * @return \Application\Model\SakramentTabela
     */
    public function getSakramentTabela(){
        if(!$this->sakramentTable){
            $this->sakramentTable = $this->getServiceLocator()->get('SakramentTabela');
        }
        return $this->sakramentTable;
    }
}

