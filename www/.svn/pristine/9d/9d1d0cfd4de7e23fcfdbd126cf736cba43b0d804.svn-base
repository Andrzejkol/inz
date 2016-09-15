<?php

class Producer_Model extends Model_Core {

    const PRODUCER_LOGO_PATH = 'files/producers/std/';
    const PRODUCER_LOGO_THUMBSPATH = 'files/producers/thumb/';

    private $_rDb;
    private $_iId;
    private $_sProducerName;
    private $_sProducerLogo;
    private $_eActive;
    private $_iRebate;

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            if (!empty($id) && $this->Exists($id)->Value === true) {
                $producer = $this->_rDb->Find($id)->Value[0];
                $this->_iId = $producer->id_producer;
                $this->_sProducerName = $producer->producer_name;
                $this->_sProducerLogo = $producer->producer_logo;
                $this->_eActive = $producer->active;
                $this->_iRebate = $producer->rebate;
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
                return $this->_iId;
                break;
            case 'ProducerName':
                return $this->_sProducerName;
                break;
            case 'ProducerName':
                return $this->_sProducerName;
                break;
            case 'ProducerLogo':
                return $this->_sProducerLogo;
                break;
            case 'Active':
                return $this->_eActive;
                break;
            case 'Rebate':
                return $this->_iRebate;
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
     * @return ErrorReporting
     */
    public function Exists($id) {
        try {
            if ($this->_rDb->getwhere(table::SHOP_PRODUCERS, array('id_producer' => $id)) > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('producer.producer_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('producer.producer_not_exists'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @todo Upload pliku
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Insert(array $data, array $files = array()) {
        try {
            unset($data['submit']);
            $aUploadedFile = array();
            if (!empty($files) && is_array($files) && !empty($files['producer_logo']['tmp_name'])) {
                $aUploadArgs = array(
                    'path' => self::PRODUCER_LOGO_PATH,
                    'thumbpath' => self::PRODUCER_LOGO_THUMBSPATH,
                    'width' => 240,
                    'height' => 38,
                    'thumbwidth' => 50,
                    'thumbheight' => 50
                );
                $aUploadedFile = file::upload($files['producer_logo'], $aUploadArgs);
                $data['producer_logo'] = $aUploadedFile->Value['filename'];
            }

            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $this->_rDb->insert(table::SHOP_PRODUCERS, $data), Kohana::lang('producer.insert_producer_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @param integer $id
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Update($id, array $data, array $files = array()) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            unset($data['submit']);
            if (!empty($_FILES) && is_array($_FILES) && !empty($_FILES['producer_logo']['tmp_name'])) {
                $oProducerLogo = $this->_rDb->select('producer_logo')->getwhere(table::SHOP_PRODUCERS, array('id_producer' => $id));
                if (!empty($oProducerLogo[0]->producer_logo)) {
                    @unlink(self::PRODUCER_LOGO_THUMBSPATH . $oProducerLogo[0]->producer_logo);
                    @unlink(self::PRODUCER_LOGO_PATH . $oProducerLogo[0]->producer_logo);
                    $this->_rDb->update(table::SHOP_PRODUCERS, array('producer_logo' => ''), array('id_producer' => $id));
                }
                $aUploadArgs = array(
                    'path' => self::PRODUCER_LOGO_PATH,
                    'thumbpath' => self::PRODUCER_LOGO_THUMBSPATH,
                    'width' => 240,
                    'height' => 38,
                    'thumbwidth' => 50,
                    'thumbheight' => 50
                );
                $data['producer_logo'] = file::upload($files['producer_logo'], $aUploadArgs)->Value['filename'];
            }
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $results = $this->_rDb->update(table::SHOP_PRODUCERS, $data, array('id_producer' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, Kohana::lang('producer.update_producer_success'));
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
            $oProducerLogo = $this->_rDb->select('producer_logo')->getwhere(table::SHOP_PRODUCERS, array('id_producer' => $id));
            if (!empty($oProducerLogo[0]->producer_logo)) {
                @unlink(self::PRODUCER_LOGO_PATH . '/' . $oProducerLogo[0]->producer_logo);
            }
            $results = $this->_rDb->delete(table::SHOP_PRODUCERS, array('id_producer' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('producer.delete_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_PRODUCERS, array('id_producer' => $id)), '');
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
    public function FindAll($limit = null, $offset = null, $active = false) {
        try {
            if (!empty($_GET['producers_orderby'])) {

                if ($_GET['producers_orderby'] == 1) {
                    $producers_orderby = 'producer_name';
                    $kind = 'ASC';
                } else if ($_GET['producers_orderby'] == 2) {
                    $producers_orderby = 'producer_name';
                    $kind = 'DESC';
                } else if ($_GET['producers_orderby'] == 3) {
                    $producers_orderby = 'rebate';
                    $kind = 'ASC';
                } else if ($_GET['producers_orderby'] == 4) {
                    $producers_orderby = 'rebate';
                    $kind = 'DESC';
                } else if ($_GET['producers_orderby'] == 5) {
                    $producers_orderby = 'active';
                    $kind = 'ASC';
                } else if ($_GET['producers_orderby'] == 6) {
                    $producers_orderby = 'active';
                    $kind = 'DESC';
                }


                $this->_rDb->from(table::SHOP_PRODUCERS);
                if (!empty($limit) && isset($offset)) {
                    $this->_rDb->limit($limit, $offset);
                }
                if (!empty($active) && $active == true) {
                    $this->_rDb->where(array('active' => 'Y'));
                }
                $this->_rDb->orderby($producers_orderby, $kind);
                $result = $this->_rDb->get();

                return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
            } else {
                $this->_rDb->from(table::SHOP_PRODUCERS);
                if (!empty($limit) && isset($offset)) {
                    $this->_rDb->limit($limit, $offset);
                }
                if (!empty($active) && $active == true) {
                    $this->_rDb->where(array('active' => 'Y'));
                }
                $this->_rDb->orderby(array('position' => 'DESC', 'id_producer' => 'ASC'));
                $result = $this->_rDb->get();

                return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
            }
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
     * @param Bool $bAsArray
     * @return ErrorReporting
     */
    public function GetProducers($bAsArray = null) {
        try {
            $result = $this->_rDb->from(table::SHOP_PRODUCERS)->orderby('producer_name')->get();
            if ($bAsArray === true) {
                $producers = array(0 => Kohana::lang('producer.all_producers'));
                foreach ($result as $r) {
                    $producers[$r->id_producer] = $r->producer_name;
                }
            } else {
                $producers = $result;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $producers, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function updateElementsPositions($aData) {
        try {
            if (!empty($aData['elements']) AND count($aData['elements']) > 0) {
                foreach ($aData['elements'] as $iElementId => $iPosition) {
                    $this->_rDb->update(table::SHOP_PRODUCERS, array('position' => intval($iPosition)), array('id_producer' => intval($iElementId)));
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('producer.success.update_elements_positions'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('producer.error.update_elements_positions'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('producer.error.update_elements_positions'));
        }
    }

}
