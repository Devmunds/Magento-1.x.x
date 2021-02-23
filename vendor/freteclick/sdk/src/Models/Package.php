<?php
namespace SDK\Models;

class Package{

	protected $quantity;
	protected $weight;
	protected $height;
	protected $width;
	protected $depth;
	protected $product_type;
	protected $price;

	public function getQuantity(){		
		return $this->quantity;
	}

	public function getWeight(){		 
		return $this->weight;
	}

	public function getHeight(){		 
		return $this->height;
	}

	public function getWidth(){		 
		return $this->width;
	}

	public function getDepth(){		 
		return $this->depth;
	}

	public function getProductType(){		 
		return $this->product_type;
	}

	public function getProductPrice(){		 
		return $this->price;
	}

	public function setQuantity($quantity){
		$this->quantity = $quantity;
		return $this;
	}

	public function setWeight($weight){
		$this->weight = $weight;
		return $this;
	}

	public function setHeight($height){
		$this->height = $height;
		return $this;
	}

	public function setWidth($width){
		$this->width = $width;
		return $this;
	}

	public function setDepth($depth){
		$this->depth = $depth;
		return $this;
	}

	public function setProductType($product_type){
		$this->product_type = $product_type;
		return $this;
	}

	public function setProductPrice($price){
		$this->price = $price;
		return $this;
	}	
}