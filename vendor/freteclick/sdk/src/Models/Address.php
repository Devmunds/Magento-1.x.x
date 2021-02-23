<?php
namespace SDK\Models;
use SDK\Utils\Valitator;

class Address{

	protected $CEP;
	protected $street;
	protected $number;
	protected $complement;
	protected $district;
	protected $city;
	protected $state;
	protected $country;


	public function getCEP(){
		return $this->CEP;			
	}

	public function getStreet(){
		return $this->street;			
	}

	public function getNumber(){
		return $this->number;			
	}

	public function getComplement(){
		return $this->complement;			
	}

	public function getDistrict(){
		return $this->district;			
	}

	public function getCity(){
		return $this->city;			
	}

	public function getState(){
		return $this->state;			
	}

	public function getCountry(){
		return $this->country;			
	}

	public function setCEP($CEP){
		$this->CEP = $CEP;
		return $this;
	}

	public function setStreet($street){
		$this->street = $street;
		return $this;
	}

	public function setNumber($number){
		$this->number = $number;
		return $this;
	}

	public function setComplement($complement){
		$this->complement = $complement;
		return $this;
	}

	public function setDistrict($district){
		$this->district = $district;
		return $this;
	}

	public function setCity($city){
		$this->city = $city;
		return $this;
	}

	public function setState($state){
		$this->state = $state;
		return $this;
	}
	
	public function setCountry($country){
		$this->country = $country;
		return $this;
	}

}