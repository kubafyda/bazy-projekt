<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Chrzest;
use Application\Entity\Sakrament;

class ChrzestController extends AbstractRestfulController
{
    private $table;
    private $sakramentTable;
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getChrzestTabela()->getAll();
        $list = array();
        foreach ($results as $osoba) {
            $list[] = $osoba;
        }
        return new JsonModel(
            array('chrzty' => $list)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getChrzestTabela()->get($id);
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
        $rekord = new Chrzest();
        $sakrament = new Sakrament();
        $sakrament->exchangeArray($data);
        
        $sakramentId = $this->getSakramentTabela()->add($sakrament);
        $rekord->sakramentid = $sakramentId;
        //$rekord->dzieckoid = $data['dzieckoid'];
        
        $rekord->dane_matki = $data['dane_matki'];
        $rekord->dane_ojca = $data['dane_ojca'];
        $rekord->dane_chrzestnej = $data['dane_chrzestnej'];
        $rekord->dane_chrzestnego = $data['dane_chrzestnego'];
       
        $this->getChrzestTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Chrzest();
        $rekord->exchangeArray($data);
        $this->getChrzestTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getChrzestTabela()->delete($id);
        $this->getSakramentTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * @return \Application\Model\ChrzestTabela
     */
    public function getChrzestTabela(){
        if(!$this->table){
            $this->table = $this->getServiceLocator()->get('ChrzestTabela');
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

