<?php

class Delivery_Type_Model extends Model_Core {

    private $_rDb;
    private $_iIdDeliveryType;
    private $_sDeliveryType;
    private $_fDeliveryCost;
    private $_eActive;
    private $_sLanguage;
    private $_aLanguage;

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
            if (!empty($id) && $this->Exists($id)->Value === true) {
                $deliveryType = $this->Find($id)->Value[0];
                $this->_iIdDeliveryType = $deliveryType->id_delivery_type;
                $this->_sDeliveryType = $deliveryType->delivery_type;
//                /$this->_fDeliveryCost = $deliveryType->delivery_cost;
                $this->_eActive = $deliveryType->active;
                $this->_sLanguage = $this->_aLanguage;
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
                return $this->_iIdDeliveryType;
                break;
            case 'DeliveryType':
                return $this->_sDeliveryType;
                break;
            case 'DeliveryCost':
                return $this->_fDeliveryCost;
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
                return $this->_iIdDeliveryType = $value + 0;
                break;
            case 'DeliveryType':
                return $this->_sDeliveryType = trim($value);
                break;
            case 'DeliveryCost':
                return $this->_fDeliveryCost = number_format($value, 2, '.', '');
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
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function Exists($iId, $sLanguage = 'pl_PL') {
        try {
            if ($this->_rDb->count_records(table::SHOP_DELIVERY_TYPES, array('id_delivery_type' => $iId)) > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('delivery_type.delivery_type_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('delivery_type.delivery_type_not_exists'));
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
			//var_dump($data);
			//exit;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
			$data['cash_on_delivery'] = !empty($data['cash_on_delivery']) && $data['cash_on_delivery'] == 'on' ? '1' : '0';
            $sDeliveryType = $data['delivery_type'];
            $langs = $data['lang'];
            unset($data['submit'], $data['delivery_type'], $data['lang']);
            $results = $this->_rDb->insert(table::SHOP_DELIVERY_TYPES, $data);
            $iInsertId = $results->insert_id();
            $this->_rDb->insert(table::SHOP_DELIVERY_TYPES_DESCRIPTION, array('delivery_type_id' => $iInsertId, 'delivery_type' => $sDeliveryType, 'delivery_type_language' => $langs));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, Kohana::lang('delivery_type.insert_delivery_type_success'));
        } catch (Exception $ex) {
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
			$data['cash_on_delivery'] = !empty($data['cash_on_delivery']) && $data['cash_on_delivery'] == 'on' ? '1' : '0';
            $sDeliveryType = $data['delivery_type'];
            $langs = $data['lang'];
            unset($data['submit'], $data['delivery_type'], $data['lang']);
            $results = $this->_rDb->update(table::SHOP_DELIVERY_TYPES, $data, array('id_delivery_type' => $id));
            $this->_rDb->update(table::SHOP_DELIVERY_TYPES_DESCRIPTION, array('delivery_type' => $sDeliveryType, 'delivery_type_language' => $langs), array('delivery_type_id' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, Kohana::lang('delivery_type.update_delivery_type_success'));
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
            $this->_rDb->delete(table::SHOP_DELIVERY_RANGES, array('delivery_type_id' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('delivery_type.delete_delivery_type_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')->getwhere(table::SHOP_DELIVERY_TYPES . ' AS dt', array('id_delivery_type' => $id)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * Pobiera listę typów dostaw
     * @param integer $limit
     * @param integer $offset
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null) {
        try {
            if (!empty($limit) && !empty($offset) && isset($offset)) {
                $this->_rDb->limit($limit, $offset);
            }
		$delivery_types_orderby = 'dt.id_delivery_type';
		$kind = 'ASC';
		if(!empty($_GET['delivery_types_orderby']) && $_GET['delivery_types_orderby']==1 ) {$delivery_types_orderby = 'dt.id_delivery_type'; $kind='ASC';}
		else if(!empty($_GET['delivery_types_orderby']) && $_GET['delivery_types_orderby']==2 ) {$delivery_types_orderby = 'dt.id_delivery_type'; $kind='DESC';}
		
		else if(!empty($_GET['delivery_types_orderby']) && $_GET['delivery_types_orderby']==3 ) {$delivery_types_orderby = 'dtd.delivery_type'; $kind='ASC';}
		else if(!empty($_GET['delivery_types_orderby']) && $_GET['delivery_types_orderby']==4 ) {$delivery_types_orderby = 'dtd.delivery_type'; $kind='DESC';}
		
		else if(!empty($_GET['delivery_types_orderby']) && $_GET['delivery_types_orderby']==5 ) {$delivery_types_orderby = 'dt.active'; $kind='ASC';}
		else if(!empty($_GET['delivery_types_orderby']) && $_GET['delivery_types_orderby']==6 ) {$delivery_types_orderby = 'dt.active'; $kind='DESC';}

			
            $result = $this->_rDb->from(table::SHOP_DELIVERY_TYPES . ' AS dt')
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')
                    ->orderby($delivery_types_orderby, $kind)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_DELIVERY_TYPES), '');
        } catch (Exception $ex) {
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
     * @todo Dodać poprawną walidację
     * @param array $data
     * @return ErrorReporting
     */
    public function ValidateUpdate(array $data = array()) {
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

    public function GetDeliveryTypes($sLanguage = 'pl_PL') {
        try {
            $result = $this->_rDb
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')
                    ->orderby('dtd.delivery_type')
                    ->getwhere(table::SHOP_DELIVERY_TYPES . ' AS dt', array('delivery_type_language' => $sLanguage, 'active' => 'Y'));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }
    
    /**
     * Ta funkcja uwzględnia przedziały, nie zmieniałem tej wyżej bo może być używana w innych miejsach w ktorych przedzialy sa nieistotne (np. admin)
     * @param type $sLanguage
     * @return \ErrorReporting
     */
    public function GetDeliveryTypes2($sLanguage = 'pl_PL', $dPrice = NULL, $iDeliveryId = NULL) {
        try {
            $this->_rDb->from(table::SHOP_DELIVERY_TYPES . ' AS dt')
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')
                    ->orderby('dtd.delivery_type')
                    ->where(array('delivery_type_language' => $sLanguage, 'active' => 'Y'));
            
            if(!empty($dPrice)) {
                $this->_rDb->join(table::SHOP_DELIVERY_RANGES, table::SHOP_DELIVERY_RANGES.'.delivery_type_id', 'dt.id_delivery_type', 'INNER')
                    ->where(array('range_from<='=>$dPrice, 'range_to>'=>$dPrice));
            }
            
            if(!empty($iDeliveryId)) {
                $this->_rDb->where(array('dt.id_delivery_type'=>$iDeliveryId));
            }
            
            $result = $this->_rDb->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iDeliveryId
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function GetDeliveryType($iDeliveryId, $sLanguage) {
        try {
            $result = $this->_rDb
                    ->join(table::SHOP_DELIVERY_TYPES_DESCRIPTION . ' AS dtd', 'dtd.delivery_type_id', 'dt.id_delivery_type', 'INNER')
                    ->orderby('dtd.delivery_type')
                    ->getwhere(table::SHOP_DELIVERY_TYPES . ' AS dt', array('id_delivery_type' => $iDeliveryId, 'delivery_type_language' => $sLanguage, 'active' => 'Y'));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function DeliveryRangeAdd($iDeliveryId, array $post) {
        try {
            $result = null;
            $iDeliveryId += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            if (!empty($post['delivery_price'])) {
                foreach ($post['delivery_price'] as $iKey => $value) {
                    $aAdd = array(
                        'delivery_price' => $value,
                        'range_from' => $post['range_from'][$iKey],
                        'range_to' => $post['range_to'][$iKey],
                        'delivery_type_id' => $iDeliveryId
                    );
                    $result = $this->_rDb->insert(table::SHOP_DELIVERY_RANGES, $aAdd);
                }
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, 'Przedziały zostały dodane.');
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function DeliveryRangeAddValidate($iDeliveryId, $post) {
        try {
            $alert = '';
            if (!empty($post['delivery_price'])) {
                foreach ($post['delivery_price'] as $iKey => $value) {
                    // sprawdzamy czy wartości są ceną
                    if (!valid::numeric($post['range_from'][$iKey]) || !valid::numeric($post['range_to'][$iKey])) {
                        $alert['integer'] = 'Nieprawidłowa wartość kosztów przedziału.';
                    } else if (!valid::numeric($value)) {
                        $alert['numeric'] = 'Nieprawidłowa wartość kosztów przesyłki.';
                    } else {
                        // sprawdzamy czy przedział już istnieje
                        $query = "SELECT * FROM " . table::SHOP_DELIVERY_RANGES . ' 
                            WHERE delivery_type_id=' . $iDeliveryId . ' AND ((
                                range_from<=' . $post['range_from'][$iKey] . ' 
                                    AND range_to>' . $post['range_to'][$iKey] . ') OR (
                                range_from=' . $post['range_from'][$iKey] . ' 
                                    AND range_to=' . $post['range_to'][$iKey] . ') OR 
                                        (range_from<' . $post['range_from'][$iKey] . ' 
                                            AND range_to>=' . $post['range_to'][$iKey] . '))';

                        $result = $this->_rDb->query($query);

                        if (!empty($result) && $result->count() > 0) {
                            $alert['exist'] = 'Już istnieje przedział dla podanych kosztów.';
                        }
                    }
                }
            }
//            var_dump($alert);exit;
            if (!empty($alert) && count($alert)) {
                $tmp = Kohana::lang('product.errors_occured') . "<ul>\n";
                foreach ($alert as $e) {
                    $tmp .= '<li>' . $e . "</li>\n";
                }
                $tmp .= "</ul>\n";
                return new ErrorReporting(ErrorReporting::ERROR, false, $tmp);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function DeliveryRangeGet($iDeliveryId) {
        try {
            $result = $this->_rDb->from(table::SHOP_DELIVERY_RANGES)
                    ->where(array('delivery_type_id' => $iDeliveryId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function DeleteRange($iRangeId) {
        try {
            $results = $this->_rDb->delete(table::SHOP_DELIVERY_RANGES, array('id_shop_delivery_ranges' => $iRangeId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, 'Przedział został usunięty.');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

}
