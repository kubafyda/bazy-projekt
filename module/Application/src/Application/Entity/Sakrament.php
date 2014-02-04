<?php

namespace Application\Entity;

class Sakrament {
	public $id;
	public $osobaid;
        public $ksiadzid;
        public $miejsce_sakramentu;
        public $data;
        public $ofiara;
	
	
        public function exchangeArray($data){
            $this->id = (isset($data['id'])) ? $data['id'] : null;
            $this->osobaid = (isset($data['osobaid'])) ? $data['osobaid'] : null;
            $this->ksiadzid = (isset($data['ksiadzid'])) ? $data['ksiadzid'] : null;
            $this->miejsce_sakramentu = (isset($data['miejsce_sakramentu'])) ? $data['miejsce_sakramentu'] : null;
            $this->data = (isset($data['data'])) ? $data['data'] : null;
            $this->ofiara = (isset($data['ofiara'])) ? $data['ofiara'] : null;
        }
        
        public function extract() {
            return array(
                'id' => $this->id,
                'osobaid' => $this->osobaid,
                'ksiadzid' => $this->ksiadzid,
                'miejsce_sakramentu' => $this->miejsce_sakramentu,
                'data' => $this->data,
                'ofiara' => $this->ofiara,
           );
        }
}
?>
