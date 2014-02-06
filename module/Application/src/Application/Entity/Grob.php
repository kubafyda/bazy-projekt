<?php

namespace Application\Entity;

class Grob {
	public $id;
	public $osobaid;
	public $blok;
	public $sektor;
	public $numer;
	public $data_zgonu;
	
	
        public function exchangeArray($data){
            $this->id = (isset($data['id'])) ? $data['id'] : null;
            $this->osobaid = (isset($data['osobaid'])) ? $data['osobaid'] : null;
            $this->blok = (isset($data['blok'])) ? $data['blok'] : null;
            $this->sektor = (isset($data['sektor'])) ? $data['sektor'] : null;
            $this->numer = (isset($data['numer'])) ? $data['numer'] : null;
            $this->data_zgonu = (isset($data['data_zgonu'])) ? $data['data_zgonu'] : null;
        }
        
        public function extract($object) {
            return array(
                'osobaid' => $object->osobaid,
                'blok' => $object->blok,
                'sektor' => $object->sektor,
                'numer' => $object->numer,
                'data_zgonu' => $object->data_zgonu,
           );
        }
        
        public function extractWithId($object) {
            return array(
                'id' => $object->id,
                'osobaid' => $object->osobaid,
                'blok' => $object->blok,
                'sektor' => $object->sektor,
                'numer' => $object->numer,
                'data_zgonu' => $object->data_zgonu,
           );
        }
}
?>
