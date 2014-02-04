<?php

namespace Application\Entity;

class Pogrzeb {
	public $sakramentid;
	public $grobid;
	
	
        public function exchangeArray($data){
            $this->sakramentid = (isset($data['sakramentid'])) ? $data['sakramentid'] : null;
            $this->grobid = (isset($data['grobid'])) ? $data['grobid'] : null;
        }
        
        public function extract() {
            return array(
                'sakramentid' => $this->sakramentid,
                'grobid' => $this->grobid,
           );
        }
}
?>
