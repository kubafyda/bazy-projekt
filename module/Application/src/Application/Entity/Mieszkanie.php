<?php

namespace Application\Entity;

/**
 * Description of Mieszkanie
 *
 * @author Kuba
 */
class Mieszkanie {
	/**
	 * @AttributeType int
	 */
	public $id;
	/**
	 * @AttributeType String
	 */
	public $ulica;
	/**
	 * @AttributeType String
	 */
	public $nr_bloku;
	/**
	 * @AttributeType String
	 */
	public $nr_mieszkania;
	
        public function exchangeArray($data){
            $this->id = (isset($data['id'])) ? $data['id'] : null;
            $this->ulica = (isset($data['ulica'])) ? $data['ulica'] : null;
            $this->nr_bloku = (isset($data['nr_bloku'])) ? $data['nr_bloku'] : null;
            $this->nr_mieszkania = (isset($data['nr_mieszkania'])) ? $data['nr_mieszkania'] : null;
        }
        
        
	
	
}
?>
