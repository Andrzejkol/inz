<?php

class Parameter_Model extends Model_Core {

    private $_rDb;
    private $_iId;
    private $_sParameterName = '';
    private $_sParameterLanguage;
    private $_aParameterValues = array();
    private $_aLanguage = array();

    /**
     *
     * @param integer $id
     * @return ErrorReporting
     */
    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
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
            case 'ParameterName':
                return $this->_sParameterName;
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
            case 'AttributeName':
                return $this->_sProducerName = trim($value);
                break;
            default:
                return null;
        }
    }

    /**
     * Metoda określająca, czy istnieje parametr określony całkowitoliczbowym identyfikatorem
     * @param integer $id
     * @return ErrorReporting
     */
    public function Exists($id) {
        try {
            if ($this->_rDb->getwhere(table::SHOP_PARAMETERS, array('id_parameter' => $id)) > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('parameter.parameter_exists'));
            }
            return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('parameter.parameter_not_exists'));
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
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $sParameterName = $data['parameter_name'];
            $aCategories = $data['category'];
            $aValues = explode(',', $data['parameter_values']);
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            unset($data['category'], $data['submit'], $data['parameter_values'], $data['parameter_name']);
            $results = $this->_rDb->insert(table::SHOP_PARAMETERS, $data);
            $iInsertId = $results->insert_id();
            $this->_rDb->insert(table::SHOP_PARAMETERS_DESCRIPTION, array('parameter_id' => $iInsertId, 'parameter_name' => $sParameterName, 'parameter_language' => $this->_aLanguage));
            foreach ($aValues as $v) {
                $v = trim(strval($v));
                $this->_rDb->insert(table::SHOP_PARAMETERS_VALUES, array('parameter_id' => $iInsertId, 'parameter_value' => strval($v)));
            }
            foreach ($aCategories as $cKey => $cValue) {
                $this->_rDb->insert(table::SHOP_PARAMETERS_TO_CATEGORIES, array('parameter_id' => $iInsertId, 'category_id' => ($cKey + 0)));
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('parameter.insert_parameter_success'));
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
            $sParameterName = trim($data['parameter_name']);
            $aCategories = $data['category'];
            $aNewParameterValues = !empty($data['new_parameter_value']) ? $data['new_parameter_value'] : array();
            $aParameterValues = $data['parameter_values'];
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            unset($data['category'], $data['submit'], $data['parameter_values'], $data['parameter_name'], $data['new_parameter_value']);
            $results = $this->_rDb->update(table::SHOP_PARAMETERS, $data, array('id_parameter' => $id));
            $this->_rDb->update(table::SHOP_PARAMETERS_DESCRIPTION, array('parameter_name' => $sParameterName), array('parameter_id' => $id, 'parameter_language' => $this->_aLanguage));
            print_r($this->_rDb->last_query());
            echo '<br />';

            $iParametersCount = 0;
            foreach ($aParameterValues as $pvk => $pwv) {
                $pwv = trim(strval($pwv));
                if (!empty($pwv)) {
                    $this->_rDb->update(table::SHOP_PARAMETERS_VALUES, array('parameter_value' => strval($pwv)), array('id_parameter_value' => $pvk));
                    $iParametersCount++;
                } else {
                    $this->_rDb->delete(table::SHOP_PARAMETERS_VALUES, array('id_parameter_value' => $pvk));
                }
            }
            if (!empty($aNewParameterValues)) {
                foreach ($aNewParameterValues as $v) {
                    $v = trim(strval($v));
                    if (!empty($v)) {
                        $this->_rDb->insert(table::SHOP_PARAMETERS_VALUES, array('parameter_id' => $id, 'parameter_value' => strval($v)));
                        $iParametersCount++;
                    }
                }
            }
            if ($iParametersCount == 0) {
                $this->_rDb->insert(table::SHOP_PARAMETERS_VALUES, array('parameter_id' => $id, 'parameter_value' => ''));
            }


            $this->_rDb->delete(table::SHOP_PARAMETERS_TO_CATEGORIES, array('parameter_id' => $id));
            foreach ($aCategories as $cKey => $cValue) {
                $this->_rDb->insert(table::SHOP_PARAMETERS_TO_CATEGORIES, array('parameter_id' => $id, 'category_id' => ($cKey + 0)));
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('parameter.update_parameter_success'));
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
            $this->_rDb->delete(table::SHOP_PARAMETERS_TO_CATEGORIES, array('parameter_id' => $id));
            $this->_rDb->delete(table::SHOP_PARAMETERS_VALUES, array('parameter_id' => $id));
            $this->_rDb->delete(table::SHOP_PARAMETERS_DESCRIPTION, array('parameter_id' => $id));
            $results = $this->_rDb->delete(table::SHOP_PARAMETERS, array('id_parameter' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('parameter.delete_parameter_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * Pobiera szczegóły parametru określonego całkowitoliczbowym identyfikatorem
     * 
     * @param integer $id
     * @return ErrorReporting
     */
    public function Find($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PARAMETERS_DESCRIPTION . ' AS spd', 'spd.parameter_id', 'sp.id_parameter', 'INNER')->getwhere(table::SHOP_PARAMETERS . ' AS sp', array('id_parameter' => $id)), '');
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
    public function FindValues($id) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PARAMETERS_VALUES . ' AS spv', 'spv.parameter_id', 'sp.id_parameter', 'INNER')->getwhere(table::SHOP_PARAMETERS . ' AS sp', array('id_parameter' => $id)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param Integer $catId
     * @return ErrorReporting
     */
    public function GetParameterCategories($iParameterId, $sLanguage = null) {
        if (!empty($lang)) {
            $categoriesResult = $this->_rDb->orderby(array('category_name' => 'ASC'))->getwhere(table::SHOP_CATEGORIES, array('category_language' => $sLanguage));
        } else {
            $categoriesResult = $this->_rDb->orderby(array('category_name' => 'ASC'))->get(table::PRODUCTS_CATEGORIES);
        }
        $categories = array();
        foreach ($categoriesResult as $category) {
            $categories[] = array(
                'id_product_category' => $category->id_product_category,
                'name' => $category->name,
                'parent_product_category_id' => $category->parent_product_category_id,
                'level' => $category->level
            );
        }
        return $categories;
    }

    /**
     * Pobiera szczegóły parametrów. Opcjonalnie pozwala pobierać tylko określoną ilość elementów poprzez określane limitu i przesunięcia
     *
     * @param integer $limit
     * @param integer $offset
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null) {
        try {
            $parameter_orderby = 'sp.id_parameter';
            $kind = 'ASC';

            if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 1) {
                $parameter_orderby = 'sp.id_parameter';
                $kind = 'ASC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 2) {
                $parameter_orderby = 'sp.id_parameter';
                $kind = 'DESC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 3) {
                $parameter_orderby = 'spd.parameter_name';
                $kind = 'ASC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 4) {
                $parameter_orderby = 'spd.parameter_name';
                $kind = 'DESC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 5) {
                $parameter_orderby = 'sp.type';
                $kind = 'DESC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 6) {
                $parameter_orderby = 'sp.type';
                $kind = 'ASC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 7) {
                $parameter_orderby = 'sp.active';
                $kind = 'ASC';
            } else if (!empty($_GET['parameter_orderby']) && $_GET['parameter_orderby'] == 8) {
                $parameter_orderby = 'sp.active';
                $kind = 'DESC';
            }

            if (empty($limit) && empty($offset) && !isset($offset)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PARAMETERS_DESCRIPTION . ' AS spd', 'spd.parameter_id', 'sp.id_parameter', 'INNER')->orderby($parameter_orderby, $kind)->get(table::SHOP_PARAMETERS . ' AS sp'), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_PARAMETERS_DESCRIPTION . ' AS spd', 'spd.parameter_id', 'sp.id_parameter', 'INNER')->orderby($parameter_orderby, $kind)->limit($limit, $offset)->get(table::SHOP_PARAMETERS . ' AS sp'), '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * Metoda zliczająca rekordy w tabeli parametrów
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_PARAMETERS), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iParameterId
     * @return ErrorReporting
     */
    public function GetCurrentParameterCategoriesAsArray($iParameterId, $language) {
        try {
            $results = $this->_rDb->join(table::SHOP_PARAMETERS_TO_CATEGORIES . ' AS sptc', 'sptc.parameter_id', 'sp.id_parameter', 'INNER')->getwhere(table::SHOP_PARAMETERS . ' AS sp', array('parameter_id' => $iParameterId));
            $aCategories = array();
            foreach ($results as $r) {
                $aCategories[] = $r->category_id;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aCategories, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function ValidateInsert(array $data = array(), array $files = array()) {
        try {
            return new ErrorReporting(ErrorReporting::ERROR, true, '');
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
     * @param array $data
     * @param array $files
     * @return ErrorReporting 
     */
    public function ValidateUpdate(array $data) {
        try {
            return new ErrorReporting(ErrorReporting::ERROR, true, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function GetParameters() {
        try {
            $result = $this->_rDb
                    ->join(table::SHOP_PARAMETERS_DESCRIPTION . ' AS pd', 'pd.parameter_id', 'p.id_parameter', 'INNER')
                    //->join(table::SHOP_PARAMETERS_VALUES . ' AS pv', 'pv.parameter_id', 'p.id_parameter', 'INNER')
                    ->getwhere(table::SHOP_PARAMETERS . ' AS p', array('p.active' => 'Y'));
            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param int $iParameterId
     * @return ErrorReporting 
     */
    public function GetParameterValues($iParameterId = NULL) {
        try {
            $this->_rDb->from(table::SHOP_PARAMETERS)
                    ->join(table::SHOP_PRODUCT_PARAMETERS, table::SHOP_PRODUCT_PARAMETERS . '.parameter_id', table::SHOP_PARAMETERS . '.id_parameter', 'LEFT');

            if (!empty($iParameterId)) {
                $this->_rDb->where(array('id_parameter' => $iParameterId));
            }
            $result = $this->_rDb->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    ///
    public function GetParametersActiveValues() {
        try {
            $result = $this->_rDb
                    ->getwhere(table::SHOP_PARAMETERS_VALUES . ' AS pv', array('pv.active' => 'Y'));

            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

}
