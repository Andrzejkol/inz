<?php

class Rebate_Code_Model extends Model_Core {

    private $_rDb;

    public function __construct() {
        $this->_rDb = Database::instance();
    }

    public function Find($id) {
        try {
            $result = $this->_rDb->from(table::SHOP_REBATES_CODES)
                    ->where(array('id_rebate_code' => $id))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function CheckRebate($sCode) {
        try {
//            $result = $this->_rDb->from(table::SHOP_REBATES_CODES)
//                    ->where(array('rebate_code' => $sCode, 'active' => 1))
//                    ->get();

            
            $query = "SELECT * FROM ".table::SHOP_REBATES_CODES."  
                WHERE rebate_code = '$sCode' AND active = 1 AND
                ((rebate_start IS NOT NULL AND rebate_start < '".date('Y-m-d H:i:s', time())."') OR rebate_start IS NULL) 
                AND 
                ((rebate_end IS NOT NULL AND rebate_end > '".date('Y-m-d H:i:s', time())."') OR rebate_end IS NULL)"
                    . "";

            $result = $this->_rDb->query($query);

            if (!empty($result) && $result->count() > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
            }
            return new ErrorReporting(ErrorReporting::INFO, 0, 'Podany kod jest nieprawidłowy.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function CheckProductRebate($iProductId, $iRebateId) {
        try {
            $result = $this->_rDb->from(table::SHOP_REBATES_CODES_TO_PRODUCTS)
                    ->where(array('product_id' => $iProductId, 'rebate_code_id' => $iRebateId))
                    ->get();
            if (!empty($result) && $result->count() > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            }
            return new ErrorReporting(ErrorReporting::INFO, FALSE);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param [integer $limit]
     * @param [integer $offset]
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null) {
			try {
            if (empty($limit) && empty($offset) && !isset($offset)) {
			//Sortowanie po ID
			if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==1){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby('id_rebate_code','ASC')->get(table::SHOP_REBATES_CODES), '');
			}
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==2){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby('id_rebate_code','DESC')->get(table::SHOP_REBATES_CODES), '');
			}
			//Sortowanie po kodzie rabatowym
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==3){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby(array('rebate_code'=>'ASC','id_rebate_code'=>'ASC' ))->get(table::SHOP_REBATES_CODES), '');
			}
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==4){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby(array('rebate_code'=>'DESC', 'id_rebate_code'=>'ASC'))->get(table::SHOP_REBATES_CODES), '');
			}
			//Sortowanie po wysokości rabatu
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==5){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby(array('rebate'=>'ASC', 'id_rebate_code'=>'ASC'))->get(table::SHOP_REBATES_CODES), '');
			}
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==6){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby(array('rebate'=>'DESC', 'id_rebate_code'=>'ASC'))->get(table::SHOP_REBATES_CODES), '');
			}
			//Sortowanie po aktywnosci
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==7){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby(array('active'=>'ASC', 'id_rebate_code'=>'ASC'))->get(table::SHOP_REBATES_CODES), '');
			}
			else if(!empty($_GET['codes_orderby']) && $_GET['codes_orderby']==8){
			return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby(array('active'=>'DESC', 'id_rebate_code'=>'ASC'))->get(table::SHOP_REBATES_CODES), '');
			}
			//Domyślne - po ID malejąco
			else
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby('id_rebate_code','DESC')->get(table::SHOP_REBATES_CODES), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->get(table::SHOP_REBATES_CODES), '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateInsert(array $aPost = array(), array $files = array()) {
        try {
            $alert = '';
             if (empty($aPost['rebate_code']) && !isset($aPost['automatically_generate'])) {
                $alert .= '<li>Musisz podać nazwę kodu rabatowego lub zaznaczyć automatyczną generację.</li>';
            }
            if (empty($aPost['rebate'])) {
                $alert .= '<li>Musisz podać wartość rabatu.</li>';
            }
            if (!empty($aPost['rebate_start']) && !empty($aPost['rebate_end'])) {
                $iStart = strtotime($aPost['rebate_start']);
                $iEnd = strtotime($aPost['rebate_end']);
                if ($iEnd <= $iStart) {
                    $alert .= '<li>Musisz data wyłączenia rabatu musi być większa niż data rozpoczęcia rabatu.</li>';
                }
            }
            if (!empty($alert)) {
                $alert = '<strong>' . Kohana::lang('poll.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateUpdate(array $aPost = array(), array $files = array()) {
        try {
            $alert = '';
            if (empty($aPost['rebate_code'])) {
                $alert .= '<li>Musisz podać nazwę kodu rabatowego.</li>';
            }
            if (empty($aPost['rebate'])) {
                $alert .= '<li>Musisz podać wartość rabatu.</li>';
            }
            if (!empty($aPost['rebate_start']) && !empty($aPost['rebate_end'])) {
                $iStart = strtotime($aPost['rebate_start']);
                $iEnd = strtotime($aPost['rebate_end']);
                if ($iEnd <= $iStart) {
                    $alert .= '<li>Musisz data wyłączenia rabatu musi być większa niż data rozpoczęcia rabatu.</li>';
                }
            }
            if (!empty($alert)) {
                $alert = '<strong>' . Kohana::lang('poll.following_errors') . '</strong>: <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alert);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param array $data
     * @return ErrorReporting
     */
     public function Insert(array $data) {
        try {
			if(isset($data['automatically_generate'])){$automatic = "on"; unset($data['automatically_generate']);}
			if(isset($data['quantity_codes'])){$number_of_codes = $data['quantity_codes']; unset($data['quantity_codes']);}
			
			if(!empty($automatic) && $automatic=="on" && $number_of_codes>0){
			
			for($i=0; $i<$number_of_codes; $i++)
			{
			$Adata['rebate_code']='';
			$tablica_znakow='1234567890ABCDEFGHIJKLMNOPQRSTUWXZ';
			$liczba_blokow=4;
			$dlugosc_bloku=4;
			for($j=0; $j<$liczba_blokow*$dlugosc_bloku;$j++)
			{
			$Adata['rebate_code'] .= $tablica_znakow[rand()%(strlen($tablica_znakow))];
			if(($j+1)%$dlugosc_bloku==0 && $j<($liczba_blokow*$dlugosc_bloku-1))
			{$Adata['rebate_code'] .='-';}
			}
			$aProducts = (!empty($data['products']) ? $data['products'] : array());
            $Adata['active'] = !empty($data['active']) ? 1 : 0;
            $Adata['rebate_add'] = date('Y-m-d H:i:s', time());
            if (!empty($data['rebate_start'])) {
                $Adata['rebate_start'] = date('Y-m-d H:i:s', strtotime($data['rebate_start']));
            }
            if (!empty($data['rebate_end'])) {
                $Adata['rebate_end'] = date('Y-m-d H:i:s', strtotime($data['rebate_end']));
            }
			$Adata['rebate']=$data['rebate'];
			
            $oInsert = $this->_rDb->insert(table::SHOP_REBATES_CODES, $Adata);
			
            if (!empty($aProducts)) {
                foreach ($aProducts as $iProductId) {
                    $this->_rDb->insert(table::SHOP_REBATES_CODES_TO_PRODUCTS, array('product_id' => $iProductId, 'rebate_code_id' => $oInsert->insert_id()));
                }
            }
			}
			return new ErrorReporting(ErrorReporting::SUCCESS, $oInsert, 'Kody rabatowe zostały dodane.');
			}
			
			else {
            $aProducts = (!empty($data['products']) ? $data['products'] : array());
            unset($data['submit'], $data['products']);
            $data['active'] = !empty($data['active']) ? 1 : 0;
            $data['rebate_add'] = date('Y-m-d H:i:s', time());
            if (!empty($data['rebate_start'])) {
                $data['rebate_start'] = date('Y-m-d H:i:s', strtotime($data['rebate_start']));
            }
            if (!empty($data['rebate_end'])) {
                $data['rebate_end'] = date('Y-m-d H:i:s', strtotime($data['rebate_end']));
            }
            $oInsert = $this->_rDb->insert(table::SHOP_REBATES_CODES, $data);

            if (!empty($aProducts)) {
                foreach ($aProducts as $iProductId) {
                    $this->_rDb->insert(table::SHOP_REBATES_CODES_TO_PRODUCTS, array('product_id' => $iProductId, 'rebate_code_id' => $oInsert->insert_id()));
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $oInsert, 'Kod rabatowy został dodany.');
        }} catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Update($id, array $data) {
        try {
            $aProducts = (!empty($data['products']) ? $data['products'] : array());
            unset($data['submit'], $data['products']);
            $data['active'] = !empty($data['active']) ? 1 : 0;
            $data['rebate_modify'] = date('Y-m-d H:i:s', time());
            if (isset($data['rebate_start'])) {
                if (!empty($data['rebate_start'])) {
                    $data['rebate_start'] = date('Y-m-d H:i:s', strtotime($data['rebate_start']));
                } else {
                    $data['rebate_start'] = null;
                }
            }
            if (isset($data['rebate_end'])) {
                if (!empty($data['rebate_end'])) {
                    $data['rebate_end'] = date('Y-m-d H:i:s', strtotime($data['rebate_end']));
                } else {
                    $data['rebate_end'] = null;
                }
            }
            $oUpdate = $this->_rDb->update(table::SHOP_REBATES_CODES, $data, array('id_rebate_code' => $id));

            $this->_rDb->delete(table::SHOP_REBATES_CODES_TO_PRODUCTS, array('rebate_code_id' => $id));
            if (!empty($aProducts)) {
                foreach ($aProducts as $iProductId) {
                    $this->_rDb->insert(table::SHOP_REBATES_CODES_TO_PRODUCTS, array('product_id' => $iProductId, 'rebate_code_id' => $id));
                }
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $oUpdate, 'Kod rabatowy został zaktualizowany.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function Delete($id) {
        try {
            $this->_rDb->delete(table::SHOP_REBATES_CODES_TO_PRODUCTS, array('rebate_code_id' => $id));
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->delete(table::SHOP_REBATES_CODES, array('id_rebate_code' => $id)), 'Usunięto kod rabatowy.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function GetProductForRebate($iRebateId, $bAsArray = NULL) {
        try {
            $oProducts = $this->_rDb->from(table::SHOP_REBATES_CODES_TO_PRODUCTS)
                            ->where(array('rebate_code_id' => $iRebateId))->get();

            if (!empty($bAsArray)) {
                $aArr = array();
                if (!empty($oProducts) && $oProducts->count() > 0) {
                    foreach ($oProducts as $oP) {
                        $aArr[] = $oP->product_id;
                    }
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, $aArr);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $oProducts);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * Obliczanie wartości produktów w koszyku (dla headera)
     * @param array $aCart
     * @return ErrorReporting
     */
    public function CountCartRebate($aCart, $currency = 'pln') {
        try {
            $sum = 0.0;
            if (count($aCart)) {
                foreach ($aCart as $product) {
                    // rabat
                    if (!empty($product['rebate'])) {
                        if ($currency == 'eur') {
                            $sum += (($product['price_eur'] * ($product['rebate'] / 100)) * $product['count']);
                        } else {
                            $sum += (($product['price'] * ($product['rebate'] / 100)) * $product['count']);
                        }
                    }
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $sum);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas obliczania wartości produktów w koszyku.');
        }
    }

}
