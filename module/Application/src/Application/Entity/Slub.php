<?php

namespace Application\Entity;

class Slub {
    
        public $sakramentid;
        
	/**
	 * @AttributeType String
	 */
	public $dane_mlodego;
	/**
	 * @AttributeType String
	 */
	public $dane_mlodej;
	/**
	 * @AttributeType String
	 */
	public $dane_swiadka;
	/**
	 * @AttributeType String
	 */
	public $dane_swiadkowej;
	
	
        public function exchangeArray($data){
            $this->sakramentid = (isset($data['sakramentid'])) ? $data['sakramentid'] : null;
            $this->dane_mlodego = (isset($data['dane_mlodego'])) ? $data['dane_mlodego'] : null;
            $this->dane_mlodej = (isset($data['dane_mlodej'])) ? $data['dane_mlodej'] : null;
            $this->dane_swiadka = (isset($data['dane_swiadka'])) ? $data['dane_swiadka'] : null;
            $this->dane_swiadkowej = (isset($data['dane_swiadkowej'])) ? $data['dane_swiadkowej'] : null;
        
        }
        public function extract() {
            return array(
                'sakramentid' => $this->sakramentid,
                'dane_mlodego' => $this->dane_mlodego,
                'dane_mlodej' => $this->dane_mlodej,
                'dane_swiadka' => $this->dane_swiadka,
                'dane_swiadkowej' => $this->dane_swiadkowej,
           );
        }
}
?>
