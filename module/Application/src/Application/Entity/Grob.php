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
        
        public function extract() {
            return array(
                'id' => $this->id,
                'osobaid' => $this->osobaid,
                'blok' => $this->blok,
                'sektor' => $this->sektor,
                'numer' => $this->numer,
                'data_zgonu' => $this->data_zgonu,
           );
        }
}
?>
