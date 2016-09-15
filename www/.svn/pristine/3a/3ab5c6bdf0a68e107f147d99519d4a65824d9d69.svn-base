<?php
class Product_Status_Model extends Model_Core {
    private $_rDb;
    private $_iId;
    private $_sProductStatusName;
    private $_iRebate;
    private $_eActive;
    private $_aLanguage = array();

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
            if( ! empty($id) && $this->Exists($id)->Value === true) {
                $productStatus = $this->_rDb->Find($id)->Value[0];
                $this->_iId = $productStatus->id_rebate_group;
                $this->_sGroupName = $productStatus->group_name;
                $this->_iRebate = $productStatus->rebate;
                $this->_eActive = $productStatus->active;
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
            if($this->_rDb->getwhere(table::SHOP_PRODUCTS_STATUSES, array('id_product_status ' => $id))>0) {
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
            $sStatusName = $data['product_status_name'];
            unset($data['submit'], $data['product_status_name']);
            $data['allow_buy'] = !empty($data['allow_buy']) && $data['allow_buy'] == 'on' ? 'Y' : 'N';
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $results = $this->_rDb->insert(table::SHOP_PRODUCTS_STATUSES, $data);
            $iInsertId = $results->insert_id();
            $this->_rDb->insert(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION, array(
                'product_status_id' => $iInsertId,
                'product_status_name' => $sStatusName,
                'product_status_language' => $this->_aLanguage
            ));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('product_status.insert_product_status_success'));
        } catch(Exception $ex) {
            $this->_rDb->query('ROLLBACK');
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
            $sStatusName = $data['product_status_name'];
            unset($data['submit'], $data['product_status_name']);
            $data['allow_buy'] = !empty($data['allow_buy']) && $data['allow_buy'] == 'on' ? 'Y' : 'N';
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $results = $this->_rDb->update(table::SHOP_PRODUCTS_STATUSES, $data, array('id_product_status' => $id));
            $this->_rDb->update(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION, array('product_status_name' => $sStatusName), array(
                'product_status_id' => $id,
                'product_status_language' => $this->_aLanguage
            ));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('product_status.update_product_status_success'));
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
                throw new Exception(Kohana::lang('product_status.cant_save_empty_producer'));
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
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $this->_rDb->delete(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION, array('product_status_id' => $id));
            $results = $this->_rDb->delete(table::SHOP_PRODUCTS_STATUSES, array('id_product_status' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('product_status.delete_product_status_success'));
        } catch(Exception $ex) {
            $this->_rDb->query('ROLLBACK');
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION . ' AS spsd', 'spsd.product_status_id', 'sps.id_product_status', 'INNER')->getwhere(table::SHOP_PRODUCTS_STATUSES . ' AS sps ', array('id_product_status' => $id)), '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param [integer $limit]
     * @param [integer $offset]
     * @param [string $lang]
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null, $lang = 'pl_PL') {
        try {
            if(!empty($lang)) {
                $this->_rDb->where(array('product_status_language' => $lang));
            }
            if(empty($limit) && empty($offset) && ! isset($offset)) {
			$products_statues_orderby = 'spsd.product_status_id'; $kind = 'ASC';
			if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==1 ) { $products_statues_orderby = 'spsd.product_status_id'; $kind = 'ASC';}
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==2 ) { $products_statues_orderby = 'spsd.product_status_id'; $kind = 'DESC';}
			
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==3 ) { $products_statues_orderby = 'spsd.product_status_name'; $kind = 'ASC';}
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==4 ) { $products_statues_orderby = 'spsd.product_status_name'; $kind = 'DESC';}
			
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==5 ) { $products_statues_orderby = 'sps.active'; $kind = 'ASC';}
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==6 ) { $products_statues_orderby = 'sps.active'; $kind = 'DESC';}
			
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==7 ) { $products_statues_orderby = 'sps.allow_buy'; $kind = 'ASC';}
			else if(!empty($_GET['products_statues_orderby']) && $_GET['products_statues_orderby']==8 ) { $products_statues_orderby = 'sps.allow_buy'; $kind = 'DESC';}
			
			
			
                $result = new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION . ' AS spsd', 'spsd.product_status_id', 'sps.id_product_status', 'INNER')->orderby($products_statues_orderby, $kind)->get(table::SHOP_PRODUCTS_STATUSES . ' AS sps '), '');
                return $result;
            } else {
                $result = new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->join(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION . ' AS spsd', 'spsd.product_status_id', 'sps.id_product_status', 'INNER')->get(table::SHOP_PRODUCTS_STATUSES . ' AS sps '), '');
                return $result;
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_REBATES_GROUPS), '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateInsert(array $data = array(), array $files = array()) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            $errors = array();
            if( ! empty($data) && is_array($data)) {

            }
            if( ! empty($files) && is_array($files)) {

            }
            if(empty($data)) {
                if(empty($this->_sProducerName)) {

                }
            }
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function ValidateUpdate(array $data = array(), array $files = array()) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function GetProductStatuses($sLanguage) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, 
                $this->_rDb->join(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION . ' AS psd', 'psd.product_status_id', 'ps.id_product_status', 'INNER')
                ->getwhere(table::SHOP_PRODUCTS_STATUSES . ' AS ps', array('psd.product_status_language' => $sLanguage)),
                '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }
}