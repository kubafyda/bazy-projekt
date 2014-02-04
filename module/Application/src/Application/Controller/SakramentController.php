<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Sakrament;

class SakramentController extends AbstractRestfulController
{
    private $osobaTabele;
    
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getSakramentTabela()->getAll();
        $list = array();
        foreach ($results as $osoba) {
            $list[] = $osoba;
        }
        return new JsonModel(
            array('sakramenty' => $list)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getSakramentTabela()->get($id);
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
        $rekord = new Sakrament();
        $rekord->exchangeArray($data);
        $this->getSakramentTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Sakrament();
        $rekord->exchangeArray($data);
        $this->getSakramentTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getSakramentTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\SakramentTabela
     */
    public function getSakramentTabela(){
        if(!$this->osobaTabele){
            $this->osobaTabele = $this->getServiceLocator()->get('SakramentTabela');
        }
        return $this->osobaTabele;
    }
}

