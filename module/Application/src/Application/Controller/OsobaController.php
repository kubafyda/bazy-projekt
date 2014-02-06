<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Application\Entity\Osoba;
use Application\Entity\OsobaMieszkanie;

class OsobaController extends AbstractRestfulController
{
    private $table;
    private $osobaMieszkanieTable;
    
 
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
        $osobaMieszkanie = new OsobaMieszkanie();
        $rekord->exchangeArray($data);
        $osobaId = $this->getOsobaTabela()->add($rekord);
        
        $osobaMieszkanie->exchangeArray($data);
        $osobaMieszkanie->osobaid = $osobaId;
        $this->getOsobaMieszkanieTabela()->add($osobaMieszkanie);
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {   // Action used for PUT requests
        $rekord = new Osoba();
        $osobaMieszkanie = new OsobaMieszkanie();
        $rekord->exchangeArray($data);
        $this->getOsobaTabela()->update($id, $rekord);
        
        $osobaMieszkanie->exchangeArray($data);
        $osobaMieszkanie->osobaid = $rekord->id;
        $this->getOsobaMieszkanieTabela()->update($id, $osobaMieszkanie);

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
        if(!$this->table){
            $this->table = $this->getServiceLocator()->get('OsobaTabela');
        }
        return $this->table;
    }
    /**
     * 
     * @return \Application\Model\OsobaMieszkanieTabela
     */
    public function getOsobaMieszkanieTabela() {
        if(!$this->osobaMieszkanieTable){
            $this->osobaMieszkanieTable = $this->getServiceLocator()->get('OsobaMieszkanieTabela');
        }
        return $this->osobaMieszkanieTable;
    }
}

