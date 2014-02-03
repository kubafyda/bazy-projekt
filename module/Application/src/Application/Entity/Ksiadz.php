<?php

namespace Application\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ksiadz
 *
 * @author Kuba
 */
class Ksiadz {
	/**
	 * @AttributeType int
	 */
	public $id;
	/**
	 * @AttributeType String
	 */
	public $imie_nazwisko;
	/**
	 * @AttributeType Date
	 */
	public $data_swiecen;
	/**
	 * @AttributeType String
	 */
	public $tytul;
	/**
	 * @AttributeType String
	 */
	public $funkcja_w_parafii;
	
	
        public function exchangeArray($data){
            $this->id = (isset($data['id'])) ? $data['id'] : null;
            $this->imie_nazwisko = (isset($data['imie_nazwisko'])) ? $data['imie_nazwisko'] : null;
            $this->data_swiecen = (isset($data['data_swiecen'])) ? $data['data_swiecen'] : null;
            $this->tytul = (isset($data['tytul'])) ? $data['tytul'] : null;
            $this->funkcja_w_parafii = (isset($data['funkcja_w_parafii'])) ? $data['funkcja_w_parafii'] : null;
           
        }
        
        
	
	
}
?>
