<?php

namespace Application\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Osoba
 *
 * @author Kuba
 */
class Osoba {
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
	public $data_urodzenia;
	/**
	 * @AttributeType String
	 */
	public $zawod;
	/**
	 * @AttributeType boolean
	 */
	public $parafianin;
	/**
	 * @AttributeType boolean
	 */
	public $zywa;
	
	
        public function exchangeArray($data){
            $this->id = (isset($data['id'])) ? $data['id'] : null;
            $this->imie_nazwisko = (isset($data['imie_nazwisko'])) ? $data['imie_nazwisko'] : null;
            $this->data_urodzenia = (isset($data['data_urodzenia'])) ? $data['data_urodzenia'] : null;
            $this->zawod = (isset($data['zawod'])) ? $data['zawod'] : null;
            $this->parafianin = (isset($data['parafianin'])) ? $data['parafianin'] : null;
            $this->zywa = (isset($data['zywa'])) ? $data['zywa'] : null;
        }
        
        
	public function extract($object) {
            return array(
                'imie_nazwisko' => $object->imie_nazwisko,
                'data_urodzenia' => $object->data_urodzenia,
                'zawod' => $object->zawod,
                'parafianin' => $object->parafianin,
                'zywa' => $object->zywa,
            );
        }
	
}
?>
