<?php
namespace SDK\Service;

use SDK\Models\QuoteRequest;
use SDK\Models\Order;
use SDK\Models\Config;
use SDK\Models\Quote;
use SDK\Models\Error;

class FreteClick{

	private static $url = 'https://api.freteclick.com.br/';
	private static $api_key = null;	
	private static $api = null;	
	private static $config = null;
	private static $response = null;	
	
	private function __construct(){}

	public static function getInstance($api_key){
		self::$api_key = $api_key;		
		self::$api = new \GuzzleHttp\Client(
			[			
				'verify' => false,	
				'headers' => [ 
					'Accept' => 'application/json',
            		'content-type' => 'application/ld+json',
					'api-token' => self::$api_key
				]
			]);	
	    return __CLASS__;	
	}

	public static function quote(QuoteRequest $quote_request){
		self::$config = $quote_request->getConfig();		

		$response = self::$api->request('POST', self::$url.'quotes', [
		    'json'   => array(
				'origin' => $quote_request->getOrigin(),
				'destination' => $quote_request->getDestination(),
				'productTotalPrice' => $quote_request->getProductTotalPrice(),
				'productType' => $quote_request->getProductType(),				
				'packages' => $quote_request->getPackages(),
				'contact' => $quote_request->getContact(),
				'order' => $quote_request->getConfig()->getOrder(),
				'quote_type' => $quote_request->getConfig()->getQuoteType()
		    )
		]);		
		
		return $response->getBody()->getContents();
	}	

	public static function getResponse(){
		return self::$response;
	}

	protected static function addError($error){
		Error::addError($error);
		return $this;
	}

	public static function getErrors(){
		return Error::getErrors();
	}

}