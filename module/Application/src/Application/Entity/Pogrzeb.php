<?php

namespace Application\Entity;

class Pogrzeb {
	public $sakramentid;
	public $grobid;
	
	
        public function exchangeArray($data){
            $this->sakramentid = (isset($data['sakramentid'])) ? $data['sakramentid'] : null;
            $this->grobid = (isset($data['grobid'])) ? $data['grobid'] : null;
        }
        
        public function extract($object) {
            return array(
                'grobid' => $object->grobid,
           );
        }
        
         public function extractWithId($object) {
            return array(
                'sakramentid' => $object->sakramentid,
                'grobid' => $object->grobid,
           );
        }
}
?>
