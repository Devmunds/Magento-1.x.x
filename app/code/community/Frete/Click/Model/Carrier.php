<?php
class Frete_Click_Model_Carrier extends Frete_Click_Model_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    protected $_code = 'freteclick';

    protected $_allowedMethods = array();
    
    /**
     * @var Mage_Shipping_Model_Rate_Result
     */
    protected $_result;

    /**
     * @var Mage_Shipping_Model_Rate_Request
     */
    protected $_rawRequest;

    /**
     * (non-PHPdoc)
     * @see Mage_Shipping_Model_Carrier_Interface::getAllowedMethods()
     */
    public function getAllowedMethods()
    {
        return array(
            'freteclick' => $this->getConfigData('name'),
          );;    
    }
    
    /**
     * (non-PHPdoc)
     * @see Mage_Shipping_Model_Carrier_Abstract::proccessAdditionalValidation()
     */
    public function proccessAdditionalValidation(Mage_Shipping_Model_Rate_Request $request)
    {
        Mage::log('Frete_Click_Model_Carrier::proccessAdditionalValidation');
        $requestPostcode = Mage::helper('freteclick')->formatZip($request->getDestPostcode());
        $address = Mage::getModel($this->getConfigData('address_model'))->load($requestPostcode);

        if (!$this->isValid($address)) {
            return false;
        }

        if (!$this->validateAllowedZips($requestPostcode)) {
            return false;
        }

        $this->setDestAddress($address);
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see Mage_Shipping_Model_Carrier_Abstract::collectRates()
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $result = Mage::getModel('shipping/rate_result');

        $array_resp = json_decode($this->_calculate_shipping());

        foreach($array_resp->response->data->order->quotes as $key => $quote){
    
            $quote = ( array ) $quote;

            $rate = Mage::getModel('shipping/rate_result_method');
            
            $rate->setCarrier($this->_code);
            $rate->setCarrierTitle($this->getConfigData('title'));
            $rate->setMethod($quote['carrier']->alias);
            $rate->setMethodTitle($this->getMethodTitle($quote));
            $rate->setPrice($quote['total']);
            $rate->setCost(0);

            $result->append($rate);
        }

        return $result;
    }

    protected function _setFreeMethodRequest($freeMethod)
    {
        $this->_isFreeRequest = true;
    }

    /**
     * (non-PHPdoc)
     * @see Mage_Shipping_Model_Carrier_Abstract::getMethodPrice()
     */
    public function getMethodPrice($cost, $method = '')
    {
        return $this->getConfigFlag('free_shipping_enable')
            && $this->getConfigData('free_shipping_subtotal') <= $this->_rawRequest->getBaseSubtotalInclTax()
            ? '0.00'
            : $this->getFinalPriceWithHandlingFee($cost);
    }

    /**
     * (non-PHPdoc)
     * @see Mage_Shipping_Model_Carrier_Abstract::_updateFreeMethodQuote()
     */
    protected function _updateFreeMethodQuote($request)
    {
        if ($request->getFreeMethodWeight() == $request->getPackageWeight() || !$request->hasFreeMethodWeight()) {
            return;
        }

        if ($request->getFreeMethodWeight() > 0) {
            $this->_setFreeMethodRequest(true);
            $result = $this->_getQuotes();
            $this->_result = $result;
        } else {
            /**
             * if we can apply free shipping for all order we should force price
             * to $0.00 for shipping with out sending second request to carrier
             */
            Mage::log('Save request. Setting zero for all methods.');
            $singleResult = Mage::getModel('shipping/rate_result');
            $rates = $this->_result->getAllRates();

            if ($rate = array_shift($rates)) {
                $rate->setPrice(0);
                $rate->setMethodTitle(__('Free Shipping'));
                $singleResult->append($rate);
            }

            $this->_result = $singleResult;
        }
    }
}
