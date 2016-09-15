<?php
class Tax_Model extends Model_Core {
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
            unset($data['submit'], $data['tax_id']);
            return new ErrorReporting(ErrorReporting::SUCCESS, $results = $this->_rDb->insert(table::SHOP_TAXES, $data), Kohana::lang('tax.insert_tax_success'));
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
            unset($data['submit'], $data['tax_id']);
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->update(table::SHOP_TAXES, $data, array('id_tax' => $id)), Kohana::lang('tax.update_tax_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->delete(table::SHOP_TAXES, array('id_tax' => $id)), Kohana::lang('tax.delete_tax_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_TAXES, array('id_tax' => $id)), '');
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
			
		$taxes_orderby = 'id_tax';
		$kind = 'ASC';
		if(!empty($_GET['taxes_orderby']) && $_GET['taxes_orderby']==1 ) {$taxes_orderby='id_tax'; $kind='ASC';}
		else if(!empty($_GET['taxes_orderby']) && $_GET['taxes_orderby']==2 ) {$taxes_orderby='id_tax'; $kind='DESC';}
		
		else if(!empty($_GET['taxes_orderby']) && $_GET['taxes_orderby']==3 ) {$taxes_orderby='tax_name'; $kind='ASC';}
		else if(!empty($_GET['taxes_orderby']) && $_GET['taxes_orderby']==4 ) {$taxes_orderby='tax_name'; $kind='DESC';}
		
		else if(!empty($_GET['taxes_orderby']) && $_GET['taxes_orderby']==5 ) {$taxes_orderby='tax_value'; $kind='ASC';}
		else if(!empty($_GET['taxes_orderby']) && $_GET['taxes_orderby']==6 ) {$taxes_orderby='tax_value'; $kind='DESC';}
		
		
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby($taxes_orderby, $kind)->get(table::SHOP_TAXES), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->get(table::SHOP_TAXES), '');
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
}