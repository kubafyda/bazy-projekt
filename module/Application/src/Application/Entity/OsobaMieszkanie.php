<?php

namespace Application\Entity;

class OsobaMieszkanie {
	public $osobaid;
	public $mieszkanieid;
	
        public function exchangeArray($data){
            $this->osobaid = (isset($data['osobaid'])) ? $data['osobaid'] : null;
            $this->mieszkanieid = (isset($data['mieszkanieid'])) ? $data['mieszkanieid'] : null;
        }
        
        public function extract($object) {
            return array(
                'mieszkanieid' => $object->mieszkanieid,
            );
        }
        
        public function extractWithId($object) {
            return array(
                'osobaid' => $object->osobaid,
                'mieszkanieid' => $object->mieszkanieid,
            );
        }
	
	
}
?>
