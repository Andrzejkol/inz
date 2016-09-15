<?php

defined('SYSPATH') OR die('No direct access allowed.');

class rebate_codes {

    /**
     * Wyświetla formularz kodu rabatowego na koszyku
     * @return type
     */
    public static function RebateCodeForm() {
        if (shop_config::getConfig('rebates_codes')) {
            return View::factory('app/rebate_codes/rebate_code_form');
        }
    }

    public static function BasketRebateInfo() {
        if (shop_config::getConfig('rebates_codes')) {
            return View::factory('app/rebate_codes/rebate_basket_info');
        }
    }
    
    public static function BasketCustomerRebateInfo() {
        if (shop_config::getConfig('rebates_codes')) {
            return View::factory('app/rebate_codes/rebate_customer_basket_info');
        }
    }

    /**
     * Po wysłaniu kodu rabatowego (na koszyku) sprawdza czy jest on poprawny, jeśli tak to zapisuje go do sesji
     */
    function RebateCodePost() {
        $_oRebateCodes = new Rebate_Code_Model();
        // sprawdzamy czy został wysłany kod rabatowy i czy jest on poprawny
        if (!empty($_POST['rebate_code'])) {
            $oRebate = $_oRebateCodes->CheckRebate($_POST['rebate_code']);
            if (!empty($oRebate) && $oRebate->Type == ErrorReporting::SUCCESS) {
                $oRebate = $oRebate->Value;
                $_SESSION['__rebate']['value'] = $oRebate[0]->rebate;
                $_SESSION['__rebate']['id'] = $oRebate[0]->id_rebate_code;
                $_SESSION['__rebate']['name'] = $oRebate[0]->rebate_code;
            } else if (!empty($oRebate) && $oRebate->Type == ErrorReporting::INFO) {
                $_SESSION['msg'] = $oRebate->__toString();
            }
        } else if (!empty($_SESSION['__rebate']) && !empty($_SESSION['__rebate']['name'])) { // reset kodu (jesli user mial go w sesji a w miedzyczasie został wylaczony)
            $oRebate = $_oRebateCodes->CheckRebate($_SESSION['__rebate']['name']);
            if (!empty($oRebate) && $oRebate->Type != ErrorReporting::SUCCESS) { // kod jest juz nie wazny
                if (!empty($oRebate) && $oRebate->Type == ErrorReporting::INFO) {
                    $_SESSION['msg'] = $oRebate->__toString();
                }
                unset($_SESSION['__rebate'], $_SESSION['__rebate_cost_summary'], $_POST['confirm_order']);
            } 
            else { // kod nadal jest wazny, zapisujemy ponownie jego dane - mogły się zmienić
                $oRebate = $oRebate->Value;
                $_SESSION['__rebate']['value'] = $oRebate[0]->rebate;
                $_SESSION['__rebate']['id'] = $oRebate[0]->id_rebate_code;
                $_SESSION['__rebate']['name'] = $oRebate[0]->rebate_code;
            }
        }
        
        if (!shop_config::getConfig('rebates_codes')) { // kody rabatowe są wyłączone więc usuwamy je
            unset($_SESSION['__rebate'], $_SESSION['__rebate_cost_summary']);
        }
        
    }

    public function RebateCostSummary() {


        if (Kohana::lang('order.currency_txt') == 'pln') {
            echo number_format(-$_SESSION['__rebate_cost_summary'], 2, '.', '') . ' ';
            echo Kohana::lang('order.currency');
        } else {
            echo number_format(-$_SESSION['__rebate_cost_summary_eur'], 2, '.', '') . ' ';
            echo Kohana::lang('order.currency');
            echo ' (' . number_format(-$_SESSION['__rebate_cost_summary'], 2, '.', '') . ' zł)';
        }
    }

    public function GetProductRebate($iProductId) {
        // czy to staly klient i ma rabat
        $_oRebateCodes = new Rebate_Code_Model();
        $iRebate = 0;
        if (!empty($_SESSION['_customer']['customer_rebate'])) { //stały klient z kodem rabatowym
            $iRebate = $_SESSION['_customer']['customer_rebate'];
        }

        if (shop_config::getConfig('rebates_codes')) {
            // jesli klient wprowadził kod rabatowy
            if (!empty($_SESSION['__rebate']['value']) && !empty($_SESSION['__rebate']['id'])) {
                $oCheck = $_oRebateCodes->CheckProductRebate($iProductId, $_SESSION['__rebate']['id'])->Value;
                if (!empty($oCheck) && $oCheck === TRUE) { // kod rabatowy działa na ten produkt
                    if ($_SESSION['__rebate']['value'] > $iRebate) { // jesli rabat z kodu jest większy niż rabat stalego klienta (lub jesli klient ma tylko kod rabatowy)
                        $iRebate = $_SESSION['__rebate']['value'];
                    }
                }
            }
        }

        return $iRebate;
    }

}
