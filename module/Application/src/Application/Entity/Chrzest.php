<?php

namespace Application\Entity;


    
   
class Chrzest {
       
        public $sakramentid;
	   
	/**
	 * @AttributeType String
	 */
	public $dane_matki;
	/**
	 * @AttributeType String
	 */
	public $dane_ojca;
	/**
	 * @AttributeType String
	 */
	public $dane_crzestnej;
	/**
	 * @AttributeType String
	 */
	public $dane_chrzestnego;
	
	
        public function exchangeArray($data){
            $this->sakramentid = (isset($data['sakramentid'])) ? $data['sakramentid'] : null;
            $this->dane_matki = (isset($data['dane_matki'])) ? $data['dane_matki'] : null;
            $this->dane_ojca = (isset($data['dane_ojca'])) ? $data['dane_ojca'] : null;
            $this->dane_crzestnej = (isset($data['dane_crzestnej'])) ? $data['dane_crzestnej'] : null;
            $this->dane_chrzestnego = (isset($data['dane_chrzestnego'])) ? $data['dane_chrzestnego'] : null;
        
        }
        public function extract() {
            return array(
                'sakramentid' => $this->sakramentid,
                'dane_matki' => $this->dane_matki,
                'dane_ojca' => $this->dane_ojca,
                'dane_crzestnej' => $this->dane_crzestnej,
                'dane_chrzestnego' => $this->dane_chrzestnego,
           );
        }
}
?>
