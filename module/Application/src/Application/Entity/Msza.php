<?php

namespace Application\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @access public
 * @author Kuba
 */
class Msza {
	/**
	 * @AttributeType int
	 */
	public $id;
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
            $this->intencja = (isset($data['intencja'])) ? $data['intencja'] : null;
            $this->data_mszy = (isset($data['data_mszy'])) ? $data['data_mszy'] : null;
            $this->ofiara = (isset($data['ofiara'])) ? $data['ofiara'] : null;
         
        }
        
        
	
	
}
?>
