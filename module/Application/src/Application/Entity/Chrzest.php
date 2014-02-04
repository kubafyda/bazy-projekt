<?php

namespace Application\Entity;
   
class Chrzest {
       
        public $sakramentid;
        public $dzieckoid;
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
	public $dane_chrzestnej;
	/**
	 * @AttributeType String
	 */
	public $dane_chrzestnego;
	
	
        public function exchangeArray($data){
            $this->sakramentid = (isset($data['sakramentid'])) ? $data['sakramentid'] : null;
            $this->dzieckoid = (isset($data['dzieckoid'])) ? $data['dzieckoid'] : null;
            $this->dane_matki = (isset($data['dane_matki'])) ? $data['dane_matki'] : null;
            $this->dane_ojca = (isset($data['dane_ojca'])) ? $data['dane_ojca'] : null;
            $this->dane_chrzestnej = (isset($data['dane_chrzestnej'])) ? $data['dane_chrzestnej'] : null;
            $this->dane_chrzestnego = (isset($data['dane_chrzestnego'])) ? $data['dane_chrzestnego'] : null;
        
        }
        public function extract() {
            return array(
                'sakramentid' => $this->sakramentid,
                'dzieckoid' => $this->dzieckoid,
                'dane_matki' => $this->dane_matki,
                'dane_ojca' => $this->dane_ojca,
                'dane_chrzestnej' => $this->dane_chrzestnej,
                'dane_chrzestnego' => $this->dane_chrzestnego,
           );
        }
}
?>
