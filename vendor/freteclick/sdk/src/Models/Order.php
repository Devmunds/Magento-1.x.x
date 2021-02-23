<?php
namespace SDK\Models;

use SDK\Utils\Valitator;
use SDK\Models\Quote;

class Order{

	protected $id;
	protected $quotes = [];

	public function setId($id){
		$this->id = $id;
		return $this;
	}

	public function getId(){
		return $this->id;
	}

	public function getQuotes(){
		return $this->quotes;
	}

	public function addQuote(Quote $quote){
		$this->quotes[] = $quote;
		return $this;
	}
	
}