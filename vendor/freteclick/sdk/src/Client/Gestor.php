<?php

namespace SDK\Client;
use SDK\Service\FreteClick;

class Gestor{
	private function __construct(){

	}

	protected function getInstance($api_key){
		$this->api_key = $api_key;
		return $this;
	}	

}