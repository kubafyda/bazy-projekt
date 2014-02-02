<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Osoba;

class OsobaController extends AbstractRestfulController
{
    private $osobaTabele;
    
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getOsobaTabela()->getAll();
        $osoby = array();
        foreach ($results as $osoba) {
            $osoby[] = $osoba;
        }
        return new JsonModel(
            array('osoby' => $osoby)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getOsobaTabela()->get($id);
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
        $rekord = new Osoba();
        $rekord->exchangeArray($data);
        $this->getOsobaTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Osoba();
        $rekord->exchangeArray($data);
        $this->getOsobaTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getOsobaTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\OsobaTabela
     */
    public function getOsobaTabela(){
        if(!$this->osobaTabele){
            $this->osobaTabele = $this->getServiceLocator()->get('OsobaTabela');
        }
        return $this->osobaTabele;
    }
}

