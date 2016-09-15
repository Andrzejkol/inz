<?php
class Measurement_Unit_Model extends Model_Core {
    private $_rDb;
    private $_iMeasurementUnit;
    private $_sMeasurementUnit;
    private $_sMeasurementUnitLanguage;
    private $_eActive;
    private $_aLanguage;

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
            if( ! empty($id) && $this->Exists($id)->Value === true) {
//                $deliveryType = $this->_rDb->Find($id)->Value[0];
//                $this->_iId = $producer->id_producer;
//                $this->_sProducerName = $producer->producer_name;
//                $this->_sProducerLogo = $producer->producer_logo;
//                $this->_eActive = $producer->active;
//                $this->_iRebate = $producer->rebate;
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
            case 'DeliveryType':
                return $this->_sDeliveryType;
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
        switch($field) {
            case 'ID':
                return $this->_iId = $value + 0;
                break;
            case 'ProducerName':
                return $this->_sProducerName = trim($value);
                break;
            case 'ProducerLogo':
                return $this->_sProducerLogo = $value;
                break;
            case 'Active':
                return $this->_eActive = in_array($value, array('Y', 'N')) ? $value : 'Y';
                break;
            case 'Rebate':
                return $this->_iRebate = $value + 0;
                break;
            default:
                return null;
        }
    }

    /**
     *
     * @param integer $id
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function Exists($iId, $sLanguage) {
        try {
            if($this->_rDb->getwhere(table::SHOP_MEASUREMENT_UNITS, array('id_measurement_unit' => $id))>0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('measurement_unit.measurement_unit_type_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('delivery_type.delivery_type_not_exists'));
        } catch(Exception $ex) {
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
            $sDeliveryType = $data['delivery_type'];
            unset($data['submit'], $data['delivery_type']);
            $results = $this->_rDb->insert(table::SHOP_DELIVERY_TYPES, $data);
            $iInsertId = $results->insert_id();
            $this->_rDb->insert(table::SHOP_DELIVERY_TYPES_DESCRIPTION, array('delivery_type_id' => $iInsertId, 'delivery_type' => $sDeliveryType, 'delivery_type_language' => $this->_aLanguage));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                ErrorReporting::SUCCESS,
                $results,
                Kohana::lang('delivery_type.insert_delivery_type_success'));
        } catch(Exception $ex) {
            $this->_rDb->query('ROLLBACK');
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
            $sDeliveryType = $data['delivery_type'];
            unset($data['submit'], $data['delivery_type']);
            $results = $this->_rDb->update(table::SHOP_DELIVERY_TYPES, $data, array('id_delivery_type' => $id));
            $this->_rDb->update(table::SHOP_DELIVERY_TYPES_DESCRIPTION, array('delivery_type' => $sDeliveryType), array('delivery_type_id' => $id, 'delivery_type_language' => $this->_aLanguage));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                ErrorReporting::SUCCESS,
                $results,
                Kohana::lang('delivery_type.update_delivery_type_success'));
        } catch(Exception $ex) {
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
            if(empty($this->_iId)) {
                throw new Exception(Kohana::lang('producer.cant_save_empty_producer'));
            }
            throw new Exception('Brak implementacji');
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
            $results = $this->_rDb->delete(table::SHOP_DELIVERY_TYPES_DESCRIPTION, array('delivery_type_id' => $id));
            $this->_rDb->delete(table::SHOP_DELIVERY_TYPES, array('id_delivery_type' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('delivery_type.delete_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')->getwhere(table::SHOP_DELIVERY_TYPES . ' AS dt', array('id_delivery_type' => $id)), '');
        } catch(Exception $ex) {
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
            if(empty($limit) && empty($offset) && ! isset($offset)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')->get(table::SHOP_DELIVERY_TYPES . ' AS dt'), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')->getwhere(table::SHOP_DELIVERY_TYPES . ' AS dt', array('id_delivery_type' => $id)), '');
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_DELIVERY_TYPES), '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @todo poprawić walidację
     * @param array $data
     * @return ErrorReporting
     */
    public function ValidateInsert(array $data = array()) {
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

    /**
     * @todo Dodać poprawną walidację
     * @param array $data
     * @return ErrorReporting
     */
    public function ValidateUpdate(array $data = array()) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('producer.validate_update_success'));
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

    public function GetMeasurementUnits($sLanguage) {
        try {
            return new ErrorReporting(
                ErrorReporting::SUCCESS,
                $this->_rDb
                    ->join(table::SHOP_MEASUREMENT_UNITS_DESCRIPTION . ' AS mud', 'mud.measurement_unit_id', 'mu.id_measurement_unit', 'INNER')
                    ->getwhere(table::SHOP_MEASUREMENT_UNITS . ' AS mu', array('measurement_language' => $sLanguage)),
             '');
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }
}