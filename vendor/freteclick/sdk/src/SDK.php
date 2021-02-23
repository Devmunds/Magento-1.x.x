<?php
namespace SDK;
use SDK\Client\CotaFacil;
use SDK\Client\Gestor;

class SDK{

	private $api_key = NULL;	

	public function __construct($api_key){
		$this->api_key = $api_key;
		return $this;
	}

	public function cotaFacilClient(){
		return CotaFacil::getInstance($this->api_key);
	}

	public function gestorClient(){
		return Gestor::getInstance($this->api_key);
	}


	
}