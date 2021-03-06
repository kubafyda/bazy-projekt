<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Mieszkanie;

class MieszkanieController extends AbstractRestfulController
{
    private $mieszkanieTabele;
    
 
    public function getList() {     // Action used for GET requests without resource Id
        $results = $this->getMieszkanieTabela()->getAll();
        $mieszkania = array();
        foreach ($results as $mieszkanie) {
            $mieszkania[] = $mieszkanie;
        }
        return new JsonModel(
            array('mieszkania' => $mieszkania)
        );
    }

    public function get($id) {   // Action used for GET requests with resource Id
        $result = $this->getMieszkanieTabela()->get($id);
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
        $rekord = new Mieszkanie();
        $rekord->exchangeArray($data);
        $this->getMieszkanieTabela()->add($rekord);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Mieszkanie();
        $rekord->exchangeArray($data);
        $this->getMieszkanieTabela()->update($id, $rekord);

        return new JsonModel(array('id' => $id, 'data' => $data));
    }

    public function delete($id) {   // Action used for DELETE requests
        $this->getMieszkanieTabela()->delete($id);
        return new JsonModel(array('id' => $id));
    }
    
    /**
     * 
     * @return \Application\Model\MieszkanieTabela
     */
    public function getMieszkanieTabela(){
        if(!$this->mieszkanieTabele){
            $this->mieszkanieTabele = $this->getServiceLocator()->get('MieszkanieTabela');
        }
        return $this->mieszkanieTabele;
    }
}

