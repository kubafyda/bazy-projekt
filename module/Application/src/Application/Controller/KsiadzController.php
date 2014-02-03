<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Ksiadz;

class KsiadzController extends AbstractRestfulController
{
    private $ksiadzTabele;
    
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getKsiadzTabela()->getAll();
        $ksieza = array();
        foreach ($results as $ksiadz) {
            $ksieza[] = $ksiadz;
        }
        return new JsonModel(
            array('ksieza' => $ksieza)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getKsiadzTabela()->get($id);
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
        $rekord = new Ksiadz();
        $rekord->exchangeArray($data);
        $this->getKsiadzTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Ksiadz();
        $rekord->exchangeArray($data);
        $this->getKsiadzTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getKsiadzTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\KsiadzTabela
     */
    public function getKsiadzTabela(){
        if(!$this->ksiadzTabele){
            $this->ksiadzTabele = $this->getServiceLocator()->get('KsiadzTabela');
        }
        return $this->ksiadzTabele;
    }
}

