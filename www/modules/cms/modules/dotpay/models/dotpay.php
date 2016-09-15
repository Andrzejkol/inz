<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Dotpay_Model extends Model_Core {

    public function __construct($iOrderId = null) {
        parent::__construct();
        $this->_rDb = Database::instance();
        $this->_oOrder = new Order_Model();
    }
    
    public function GetForm($iPaymentTypeId, $iOrderId, $sControl, $Price, $currency) {
        $oForm = new View('dotpay_form');
        $oForm->sGet = '?id='.$iOrderId.'&confirm_string='.$sControl;
        $oForm->sControl = $sControl;
        $oForm->Price = $Price;
        $oForm->Currency = $currency;  
        $rez = $this->_rDb->limit(1)
                   ->getwhere(table::SHOP_PAYMENT_TYPES, array('id_payment_type' => $iPaymentTypeId));
        
        $oForm->iPaymentTypeLogin = $rez[0]->auth_login;    
        $oForm->iPaymentTypeUrl = $rez[0]->auth_url;   
        return $oForm->render();
    }

    public function CheckPayment() {
        try {
			$iIp = self::get_ip();
            if(!in_array($iIp, array('217.17.41.5', '195.150.9.37'))) {
                return null;
            }
		
//        [id] => 68655
//        [t_id] => 68655-TST4
//        [control] => ec4bf09d3dbe0cb71e6abc3ea44a7273
//        [amount] => 1.00
//        [email] => hubert@olicom.pl
//        [description] => test
//        [t_status] => 2
//        [code] => A1234BCD
//        [service] => 68655
//        [md5] => ea2513cc9d0824284f477ebe584ef083

//            $_POST['t_status'] = 2;
//            $_POST['control'] = '308f882e16b4b1b5c5c818a20f801dbe';
//            $_POST['t_id'] = '100-P12';

            if (!empty($_POST)) {
                if (isset($_POST['status']) && $_POST['status'] == 'FAIL') {
                    Kohana::log('error', 'Nie odnotowano wpłaty');
                    return new ErrorReporting(ErrorReporting::ERROR, false);
                }

                if (!empty($_POST['t_status'])) {
                    if ($_POST['t_status'] == 2) {
                        // TODO: sprawdzenie czy kwota sie zgadza
                        $oIdOrder = $this->_rDb->from(table::SHOP_ORDERS)->where(array('confirm_string' => $_POST['control']))->get();
                        if (!empty($oIdOrder) && $oIdOrder->count() > 0 && !empty($oIdOrder[0]->id_order)) {
                            if ($oIdOrder[0]->paid != 'Y') {
                                $oUpdate = $this->_rDb->update(table::SHOP_ORDERS, array('paid' => 'Y'), array('confirm_string' => $_POST['control']));
                                //var_dump($oIdOrder);
                            }

                            $this->_oOrder->ChangeStatus(2, $oIdOrder[0]->id_order);
                            dotpay::log(array('log_desc' => serialize($_POST), 'log_time' => date('Y-m-d H:i:s'), 't_id' => $_POST['t_id']));
                            return new ErrorReporting(ErrorReporting::SUCCESS, 'OK');
                        } else {
                            dotpay::log(array('log_desc' => serialize($_POST), 'log_time' => date('Y-m-d H:i:s'), 't_id' => $_POST['t_id'], 'info'=>'error - nie ma takiego zamowienia'));
                            Kohana::log('error', 'Brak takiego zamówienia ' . print_r($_POST));
                            return new ErrorReporting(ErrorReporting::SUCCESS, 'ERROR');
                        }
                    }
                    if ($_POST['t_status'] == 3 || $_POST['t_status'] == 4 || $_POST['t_status'] == 5) {
                        $this->_rDb->update(table::SHOP_ORDERS, array('paid' => 'N'), array('confirm_string' => $_POST['control']));
                        dotpay::log(array('log_desc' => serialize($_POST), 'log_time' => date('Y-m-d H:i:s'), 't_id' => $_POST['t_id']));
                        return new ErrorReporting(ErrorReporting::SUCCESS, 'OK');
                    }
                }
            }
            return new ErrorReporting(ErrorReporting::ERROR, 'ERROR');
        } catch (Exception $e) {
            Kohana::log('error', $e->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 'ERROR', $e->getMessage());
        }
    }
	
	public static function get_ip($ip2long = FALSE) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if ($ip2long) {
            $ip = ip2long($ip);
        }

        return $ip;
    }

}

?>
