<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Msza;

class MszaController extends AbstractRestfulController
{
    private $mszaTabele;
    
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getMszaTabela()->getAll();
        $msze = array();
        foreach ($results as $msza) {
            $msze[] = $msza;
        }
        return new JsonModel(
            array('msze' => $msze)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getMszaTabela()->get($id);
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
        $rekord = new Msza();
        $rekord->exchangeArray($data);
        $this->getMszaTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Msza();
        $rekord->exchangeArray($data);
        $this->getMszaTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getMszaTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\MszaTabela
     */
    public function getMszaTabela(){
        if(!$this->mszaTabele){
            $this->mszaTabele = $this->getServiceLocator()->get('MszaTabela');
        }
        return $this->mszaTabele;
    }
}

