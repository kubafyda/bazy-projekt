<?php

namespace Application\Entity;


class Msza {
	/**
	 * @AttributeType int
	 */
	public $id;
        public $osobaid;
        public $ksiadzid;
	/**
	 * @AttributeType String
	 */
	public $intencja;
	/**
	 * @AttributeType Timestamp
	 */
	public $data_mszy;
	/**
	 * @AttributeType Float
	 */
	public $ofiara;
	
        public function exchangeArray($data){
            
            $this->id = (isset($data['id'])) ? $data['id'] : null;
            $this->osobaid = (isset($data['osobaid'])) ? $data['osobaid'] : null;
            $this->ksiadzid = (isset($data['ksiadzid'])) ? $data['ksiadzid'] : null;
            $this->intencja = (isset($data['intencja'])) ? $data['intencja'] : null;
            $this->data_mszy = (isset($data['data_mszy'])) ? $data['data_mszy'] : null;
            $this->ofiara = (isset($data['ofiara'])) ? $data['ofiara'] : null;
         
        }
        
        
	
	
}
?>
