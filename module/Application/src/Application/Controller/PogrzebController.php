<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Pogrzeb;

class PogrzebController extends AbstractRestfulController
{
    private $osobaTabele;
    
 
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
        $rekord->exchangeArray($data);
        $this->getPogrzebTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Pogrzeb();
        $rekord->exchangeArray($data);
        $this->getPogrzebTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getPogrzebTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\PogrzebTabela
     */
    public function getPogrzebTabela(){
        if(!$this->osobaTabele){
            $this->osobaTabele = $this->getServiceLocator()->get('PogrzebTabela');
        }
        return $this->osobaTabele;
    }
}

