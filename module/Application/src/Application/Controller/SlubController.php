<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Slub;
use Application\Entity\Sakrament;

class SlubController extends AbstractRestfulController
{
    private $table;
    private $sakramentTable;
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getSlubTabela()->getAll();
        $list = array();
        foreach ($results as $osoba) {
            $list[] = $osoba;
        }
        return new JsonModel(
            array('sluby' => $list)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getSlubTabela()->get($id);
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
        $rekord = new Slub();
        $sakrament = new Sakrament();
        $sakrament->exchangeArray($data);
        
        $sakramentId = $this->getSakramentTabela()->add($sakrament);
        
        $rekord->sakramentid = $sakramentId;
        $rekord->dane_mlodego = $data['dane_mlodego'];
        $rekord->dane_mlodej = $data['dane_mlodej'];
        $rekord->dane_swiadka = $data['dane_swiadka'];
        $rekord->dane_swiadkowej = $data['dane_swiadkowej'];
        
        $this->getSlubTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Slub();
        $rekord->exchangeArray($data);
        $this->getSlubTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getSlubTabela()->delete($id);
        $this->getSakramentTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * @return \Application\Model\SlubTabela
     */
    public function getSlubTabela(){
        if(!$this->table){
            $this->table = $this->getServiceLocator()->get('SlubTabela');
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

