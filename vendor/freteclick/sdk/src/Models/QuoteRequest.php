<?php
namespace SDK\Models;

use SDK\Models\Package;
use SDK\Models\Origin;
use SDK\Models\Destination;
use SDK\Models\Config;

class QuoteRequest{

	protected $origin = [];
	protected $destination = [];
	protected $product_total_price = 0;	
	protected $product_type = "";
	protected $packages = [];
	protected $contact = null;
	protected $config = null;


	public function getPackages(){
		return $this->packages;
	}

	public function addPackage(Package $package){		

		$this->packages[] 			= array(
			'qtd' 		=> (int) $package->getQuantity(),
			'weight' 	=> $package->getWeight(),
			'height' 	=> $package->getHeight(),
			'width' 	=> $package->getWidth(),
			'depth' 	=> $package->getDepth()
		);
		$this->product_total_price 	    += $package->getProductPrice();
		$this->product_type 			.= $package->getProductType().',';
		return $this;
	}	

	public function getProductTotalPrice(){
		return $this->product_total_price;
	}

	public function getProductType(){
		return $this->product_type;
	}

	public function getContact(){
		return $this->contact;
	}

	public function getConfig(){
		if (!$this->config){
			$this->config = new Config();
		}
		return $this->config;
	}

	public function setConfig(Config $config){
		$this->config = $config;
		return $this;
	}

	public function getOrigin(){
		return $this->origin;
	}

	public function setOrigin(Origin $origin){
		$this->origin = [
			//'cep' 			=> (int) $origin->getCEP(),
			//'street' 		=> $origin->getStreet(),
			//'number' 		=> (int) $origin->getNumber(),
			//'complement' 	=> $origin->getComplement(),
			//'district' 		=> $origin->getDistrict(),
			'city' 			=> $origin->getCity(),
			'state' 		=> $origin->getState(),
			'country' 		=> $origin->getCountry()
		];		
		return $this;
	}

	public function getDestination(){
		return $this->destination;
	}

	public function setDestination(Destination $destination){
		$this->destination = [
			//'cep' 			=> (int) $destination->getCEP(),
			//'street'		=> $destination->getStreet(),
			//'number' 		=> (int) $destination->getNumber(),
			//'complement' 	=> $destination->getComplement(),
			//'district' 		=> $destination->getDistrict(),
			'city' 			=> $destination->getCity(),
			'state' 		=> $destination->getState(),
			'country' 		=> $destination->getCountry()
		];	
		return $this;
	}	

	
}