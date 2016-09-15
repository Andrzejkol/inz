<?php
class Currencies_Model extends Model_Core {
    private $_rDb;
    private $_iId;
    private $_sTaxName = '';
    private $_iTaxValue = 0;

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            if( ! empty($id) && $this->Exists($id)->Value === true) {
                $tax = $this->_rDb->Find($id)->Value[0];
                $this->_iId = $tax->id_tax;
                $this->_sTaxName = $tax->tax_name;
                $this->_iTaxValue = $tax->tax_value + 0;
            }
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param string $field
     * @return mixed
     */
    public function __get($field) {
        switch($field) {
            case 'ID':
                return $this->_iId;
                break;
            case 'TaxName':
                return $this->_sTaxName;
                break;
            case 'TaxValue':
                return $this->_iTaxValue;
                break;
            default:
                return null;
        }
    }

    /**
     *
     * @param string $field
     * @param mixed $value
     * @return mixed
     */
    public function __set($field, $value) {
        switch($field) {
            case 'ID':
                return $this->_iId = $value + 0;
                break;
            case 'TaxName':
                return $this->_sTaxName = trim($value);
                break;
            case 'TaxValue':
                return $this->_iTaxValue = $value + 0;
                break;
            default:
                return null;
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function Exists($id) {
        try {
            if($this->_rDb->getwhere(table::SHOP_TAXES, array('id_tax' => $id))>0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
            return new ErrorReporting(ErrorReporting::INFO, false, '');
        } catch(Exception $ex) {
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
            unset($data['submit']);
            
            $data['currency_factor'] = str_replace(',','.',$data['currency_factor']);
            $data['currency_active'] = (!empty($data['currency_active'])) ? $data['currency_active'] : 'N';
            
            $results = $this->_rDb->insert(table::SHOP_CURRENCIES, $data);
            
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('shop_admin.currencies.insert_currency_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function Update($id, array $data) {
        try {
            unset($data['submit']);
            $data['currency_factor'] = str_replace(',','.',$data['currency_factor']);
            $data['currency_active'] = (!empty($data['currency_active'])) ? $data['currency_active'] : 'N';
            
            $result = $this->_rDb->update(table::SHOP_CURRENCIES, $data, array('id_currency' => $id));
            
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('shop_admin.currencies.update_currency_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Save() {
        try {
            if( empty($this->_iId)) {
                throw new Exception(Kohana::lang('producer.cant_save_empty_producer'));
            }
            throw new Exception('Brak implementacji metody Save()');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function Delete($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->delete(table::SHOP_CURRENCIES, array('id_currency' => $id)), Kohana::lang('shop_admin.currencies.delete_currency_success'));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function Find($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_CURRENCIES, array('id_currency' => $id)), '');
        } catch(Exception $ex) {
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
            if(empty($limit) && empty($offset) && ! isset($offset)) {
			
		$currencies_orderby = 'id_currency';
		$kind = 'ASC';
		if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==1 ) {$currencies_orderby='id_currency'; $kind='ASC';}
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==2 ) {$currencies_orderby='id_currency'; $kind='DESC';}
		
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==3 ) {$currencies_orderby='currency_name'; $kind='ASC';}
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==4 ) {$currencies_orderby='currency_name'; $kind='DESC';}
		
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==5 ) {$currencies_orderby='currency_code'; $kind='ASC';}
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==6 ) {$currencies_orderby='currency_code'; $kind='DESC';}
		
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==7 ) {$currencies_orderby='currency_factor'; $kind='ASC';}
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==8 ) {$currencies_orderby='currency_factor'; $kind='DESC';}
		
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==9 ) {$currencies_orderby='currency_active'; $kind='ASC';}
		else if(!empty($_GET['currencies_orderby']) && $_GET['currencies_orderby']==10 ) {$currencies_orderby='currency_active'; $kind='DESC';}
			
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->from(table::SHOP_CURRENCIES)->orderby($currencies_orderby, $kind)->get(), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->from(table::SHOP_CURRENCIES)->orderby(array('id_currency' => 'ASC'))->get(), '');
            }
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_TAXES), '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateInsert($aPost) {
        try {                         
            $alert = '';            
            if (empty($aPost['currency_name'])) {
                $alert .= '<li>' . Kohana::lang('shop_admin.currencies.validation.error_currency_name_empty') . '</li>';
            }
            if (empty($aPost['currency_code'])) {
                $alert .= '<li>' . Kohana::lang('shop_admin.currencies.validation.error_currency_code_empty') . '</li>';
            }
//            if (empty($aPost['currency_unit'])) {
//                $alert .= '<li>' . Kohana::lang('shop_admin.currencies.validation.error_currency_unit_empty') . '</li>';
//            }            
            if (empty($aPost['currency_factor'])) {
                $alert .= '<li>' . Kohana::lang('shop_admin.currencies.validation.error_currency_factor_empty') . '</li>';
            }
            elseif(valid::numeric($aPost['currency_factor']) != true){
                $alert .= '<li>' . Kohana::lang('shop_admin.currencies.validation.error_currency_factor_not_decimal_empty') . '</li>';
            }
            
            if (!empty($alert)) {
                $alerts = Kohana::lang('shop_admin.currencies.validation.following_errors') . ': <ul>' . $alert . '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, false, $alerts);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }    
}