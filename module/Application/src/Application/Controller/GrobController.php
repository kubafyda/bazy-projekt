<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Grob;

class GrobController extends AbstractRestfulController
{
    private $osobaTabele;
    
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getGrobTabela()->getAll();
        $list = array();
        foreach ($results as $osoba) {
            $list[] = $osoba;
        }
        return new JsonModel(
            array('groby' => $list)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getGrobTabela()->get($id);
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
        $rekord = new Grob();
        $rekord->exchangeArray($data);
        $this->getGrobTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Grob();
        $rekord->exchangeArray($data);
        $this->getGrobTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getGrobTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\GrobTabela
     */
    public function getGrobTabela(){
        if(!$this->osobaTabele){
            $this->osobaTabele = $this->getServiceLocator()->get('GrobTabela');
        }
        return $this->osobaTabele;
    }
}

