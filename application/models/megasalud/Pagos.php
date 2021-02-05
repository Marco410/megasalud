<?php

/**
 * 
 */
class Pagos extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    
   function getIDMerch(){
        $this->db->where('id', 4);
		return $this->db->get('config_site');
    }
    
    function getKey(){
        $this->db->where('id', 5);
		return $this->db->get('config_site');
    }
    

	public function pagoTarjeta($chargeData) {
		 include_once APPPATH.'libraries/openpay-php-master/Openpay.php';
        
        $id = $this->getIDMerch()->row();
        $key = $this->getKey()->row();
        
        try {
            $openpay = Openpay::getInstance($id->option_value, $key->option_value);
            Openpay::setProductionMode(true);
            $charge = $openpay->charges->create($chargeData);
            
               echo json_encode(array('error' => false, 'cargo' => $charge));
        
         } catch (OpenpayApiTransactionError $e) {
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                  ' [error code: ' . $e->getErrorCode() . 
                  ', error category: ' . $e->getCategory() . 
                  ', HTTP code: '. $e->getHttpCode() . 
                  ', request ID: ' . $e->getRequestId() . ']', 0);
            echo json_encode(array('error' => true, 'msg' => $e->getMessage(). 'Http'.$e->getHttpCode(), 'code' => $e->getErrorCode()));

        } catch (OpenpayApiRequestError $e) {
            error_log('ERROR on the request: ' . $e->getMessage(), 0);
              echo json_encode(array('error' => true, 'msg' => $e->getMessage()));
        } catch (OpenpayApiConnectionError $e) {
            error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
              echo json_encode(array('error' => true, 'msg' => 'ERROR while connecting to the API: ' . $e->getMessage()));
        } catch (OpenpayApiAuthError $e) {
            error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
              echo json_encode(array('error' => true, 'msg' => 'ERROR on the authentication: ' . $e->getMessage()));
        } catch (OpenpayApiError $e) {
            error_log('ERROR on the API: ' . $e->getMessage(), 0);
              echo json_encode(array('error' => true, 'msg' => 'ERROR on the API: ' . $e->getMessage()));
        } catch (Exception $e) {
            error_log('Error on the script: ' . $e->getMessage(), 0);
              echo json_encode(array('error' => true, 'msg' => 'Error on the script: ' . $e->getMessage()));
        }
		
	}

	

}