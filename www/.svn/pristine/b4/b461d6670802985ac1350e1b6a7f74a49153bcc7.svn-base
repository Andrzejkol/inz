<?php

class Payment_Type_Model extends Model_Core {

    private $_rDb;
    private $_iIdPaymentType;
    private $_sPaymentName;
    private $_fPaymentCost;
    private $_eActive;
    private $_aLanguage;

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
            if (!empty($id) && $this->Exists($id)->Value === true) {
                $payment = $this->Find($id)->Value[0];
                $this->_iIdPaymentType = $payment->id_payment_type;
                $this->_sPaymentName = $payment->payment_type_name;
                $this->_fPaymentCost = $payment->payment_cost;
                $this->_eActive = $payment->active;
            }
        } catch (Exception $ex) {
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
        switch ($field) {
            case 'ID':
                return $this->_iIdPaymentType;
                break;
            case 'PaymentName':
                return $this->_sPaymentName;
                break;
            case 'PaymentCost':
                return $this->_fPaymentCost;
                break;
            case 'Active':
                return $this->_eActive;
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
        switch ($field) {
            case 'ID':
                return $this->_iIdPaymentType = $value + 0;
                break;
            case 'PaymentName':
                return $this->_sPaymentName = trim($value);
                break;
            case 'PaymentCost':
                return $this->_fPaymentCost = $value;
                break;
            case 'Active':
                return $this->_eActive = in_array($value, array('Y', 'N')) ? $value : 'Y';
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
            if ($this->_rDb->count_records(table::SHOP_PAYMENT_TYPES, array('id_payment_type' => $id)) > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('payment_type.payment_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('payment_type.payment_type_not_exists'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @todo Upload pliku
     * @param array $data
     * @return ErrorReporting
     */
    public function Insert(array $data) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $data_desc['payment_type_name'] = $data['payment_type_name'];            
            if(!empty($data['payment_type_info']))
            {
                $data_desc['payment_type_info'] = $data['payment_type_info'];
            }
            $data_desc['payment_type_language'] = $data['payment_type_language'];
            $data['payment_cost'] = layer::MakeDecimal($data['payment_cost']);
            unset($data['submit'], $data['payment_type_name'], $data['payment_type_info'], $data['payment_type_language']);
            $results = $this->_rDb->insert(table::SHOP_PAYMENT_TYPES, $data);
            $iInsertId = $results->insert_id();
            $data_desc['payment_type_id'] = $iInsertId;
            $this->_rDb->insert(table::SHOP_PAYMENT_TYPES_DESCRIPTION, $data_desc);
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, Kohana::lang('payment_type.insert_payment_type_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @param integer $id
     * @param array $data
     * @return ErrorReporting
     */
    public function Update($id, array $data) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $data_desc['payment_type_name'] = $data['payment_type_name'];            
            if(!empty($data['payment_type_info']))
            {
                $data_desc['payment_type_info'] = $data['payment_type_info'];
            }
            $data_desc['payment_type_language'] = $data['payment_type_language'];
            $data['payment_cost'] = layer::MakeDecimal($data['payment_cost']);
            unset($data['submit'], $data['payment_type_name'], $data['payment_type_info'], $data['payment_type_language']);
            $results = $this->_rDb->update(table::SHOP_PAYMENT_TYPES, $data, array('id_payment_type' => $id));
            $this->_rDb->update(table::SHOP_PAYMENT_TYPES_DESCRIPTION, $data_desc, array('payment_type_id' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, Kohana::lang('payment_type.update_payment_type_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
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
            if (empty($this->_iId)) {
                throw new Exception(Kohana::lang('producer.cant_save_empty_producer'));
            }
            throw new Exception('Brak implementacji');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * Usuwanie typu płatności
     * @param integer $id
     * @return ErrorReporting
     */
    public function DeletePaymentType($id) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $results = $this->_rDb->delete(table::SHOP_PAYMENT_TYPES_DESCRIPTION, array('payment_type_id' => $id));
            $this->_rDb->delete(table::SHOP_PAYMENT_TYPES, array('id_payment_type' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('payment_type.delete_payment_type_success'));
        } catch (Exception $ex) {
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION . ' AS ptd', 'ptd.payment_type_id', 'pt.id_payment_type', 'INNER')->getwhere(table::SHOP_PAYMENT_TYPES . ' AS pt', array('id_payment_type' => $id)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $limit
     * @param integer $offset
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null) {
        try {
            if (!empty($limit) && !empty($offset) && isset($offset)) {
                $this->_rDb->limit($limit, $offset);
            }
            $payment_types_orderby = 'pt.id_payment_type';
            $kind = 'ASC';
            if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 1) {
                $payment_types_orderby = 'pt.id_payment_type';
                $kind = 'ASC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 2) {
                $payment_types_orderby = 'pt.id_payment_type';
                $kind = 'DESC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 3) {
                $payment_types_orderby = 'ptd.payment_type_name';
                $kind = 'ASC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 4) {
                $payment_types_orderby = 'ptd.payment_type_name';
                $kind = 'DESC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 5) {
                $payment_types_orderby = 'pt.payment_cost';
                $kind = 'ASC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 6) {
                $payment_types_orderby = 'pt.payment_cost';
                $kind = 'DESC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 7) {
                $payment_types_orderby = 'pt.active';
                $kind = 'ASC';
            } else if (!empty($_GET['payment_types_orderby']) && $_GET['payment_types_orderby'] == 8) {
                $payment_types_orderby = 'pt.active';
                $kind = 'DESC';
            }



            $result = $this->_rDb->from(table::SHOP_PAYMENT_TYPES . ' AS pt')
                    ->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION . ' AS ptd', 'ptd.payment_type_id', 'pt.id_payment_type', 'INNER')
                    ->orderby($payment_types_orderby, $kind)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_PRODUCERS), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @todo poprawić walidację
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function ValidateInsert(array $data = array(), array $files = array()) {
        try {
            $alert = '';
            if (empty($_POST['payment_type_name'])) {
                $alert .= '<li>' . Kohana::lang('shop_admin.payment_type.error.payment_type_name_empty') . '</li>';
            }
            if (!empty($alert)) {
                $alert = Kohana::lang('shop_admin.following_errors') . ': <ul>' . $alert . '</ul>';
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
     * @todo Dodać poprawną walidację
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function ValidateUpdate(array $data = array(), array $files = array()) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('producer.validate_update_success'));
            $errors = array();
            if (!empty($data) && is_array($data)) {
                
            }
            if (!empty($files) && is_array($files)) {
                
            }
            if (empty($data)) {
                if (empty($this->_sProducerName)) {
                    
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function GetPaymentTypes($sLanguage = 'pl_PL') {
        try {
            $result = $this->_rDb
                    ->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION . ' AS ptd', 'ptd.payment_type_id', 'pt.id_payment_type', 'INNER')
                    ->orderby('ptd.payment_type_name')
                    ->getwhere(table::SHOP_PAYMENT_TYPES . ' AS pt', array('payment_type_language' => $sLanguage, 'active' => 'Y'));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function GetPaymentType($iPaymentTypeId, $sLanguage) {
        try {
            $result = $this->_rDb
                    ->join(table::SHOP_PAYMENT_TYPES_DESCRIPTION . ' AS ptd', 'ptd.payment_type_id', 'pt.id_payment_type', 'INNER')
                    ->orderby('ptd.payment_type_name')
                    ->getwhere(table::SHOP_PAYMENT_TYPES . ' AS pt', array('id_payment_type' => $iPaymentTypeId, 'payment_type_language' => $sLanguage, 'active' => 'Y'));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

}
