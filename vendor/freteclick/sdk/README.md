# SDK

SDK para a API da plataforma Frete Click
https://api.freteclick.com.br


# Instalação
<pre>
composer require freteclick/sdk
</pre>

#Uso

<pre>
use SDK\SDK;
use SDK\Models\QuoteRequest;
use SDK\Models\Package;
use SDK\Models\Origin;
use SDK\Models\Destination;
use SDK\Models\Config;


$quote_request = new QuoteRequest();

$config = new Config();
$config->setQuoteType('full');
$config->setOrder('total');
$quote_request->setConfig($config);

$origin = new freteclick\SDK\Models\Origin();  
$origin->setCEP($cep);
$origin->setStreet($street);
$origin->setNumber($number);
$origin->setComplement($complement);
$origin->setDistrict($district);
$origin->setCity($city);
$origin->setState($state);
$origin->setCountry($country); 
$quote_request->setOrigin($origin);



$destination = new freteclick\SDK\Models\Destination(); 
$destination->setCEP($cep);
$destination->setStreet($street);
$destination->setNumber($number);
$destination->setComplement($complement);
$destination->setDistrict($district);
$destination->setCity($city);
$destination->setState($state);
$destination->setCountry($country); 	
$quote_request->setDestination($destination);  


$SDK = new SDK($api_key);
$cotafacil = $SDK->cotaFacilClient();			
$array_resp = $cotafacil::quote($quote_request);	


print_r($array_resp); 
</pre>
