<?php

class Attribute_Model extends Model_Core {

    private $_rDb;
    private $_iId;
    private $_sAttributeName = '';
    private $_iPosition = '';
    private $_eActive = '';
    private $_aAttributeValues = array();
    private $_aLanguage = array();

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
            if (!empty($id) && $this->Exists($id)->Value === true) {
                $attribute = $this->Find($id)->Value[0];
                $this->_iId = $attribute->id_attribute;
                $this->_sAttributeName = $attribute->attributes_name;
                $this->_iPosition = $attribute->position + 0;
                $this->_eActive = in_array($attribute->active, array('Y', 'N')) ? $attribute->active : 'Y';
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
            case 'AttributeName':
                return $this->_sAttributeName;
                break;
            case 'Position':
                return $this->_iPosition;
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
                return $this->_iId = $value + 0;
                break;
            case 'AttributeName':
                return $this->_sAttributeName = trim($value);
                break;
            case 'Position':
                return $this->_iPosition = in_array($value, array('Y', 'N')) ? $value : 'Y';
                ;
                break;
            case 'AttributeName':
                return $this->_eActive = $value;
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
            if ($this->_rDb->count_records(table::SHOP_ATTRIBUTES, array('id_attribute' => $id)) > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
            return new ErrorReporting(ErrorReporting::INFO, false, '');
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
            if (!empty($data['options'])) {
                $aOptions = explode(',', $data['options']);
            }
            $sAttributeName = $data['attribute_name'];
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            unset($data['submit'], $data['options'], $data['attribute_name']);

            $results = $this->_rDb->insert(table::SHOP_ATTRIBUTES, $data);
            $iInsertId = $results->insert_id();
            $this->_rDb->insert(
                    table::SHOP_ATTRIBUTES_DESCRIPTION, array(
                'attribute_id' => $iInsertId,
                'attribute_name' => $sAttributeName,
                'attribute_language' => $this->_aLanguage
                    )
            );
            if (!empty($aOptions) && count($aOptions) > 0) {
                foreach ($aOptions as $o) {
                    $o = trim($o);
                    $attributeValuesResult = $this->_rDb->insert(table::SHOP_ATTRIBUTES_VALUES, array('attribute_id' => $iInsertId, 'default' => 'N', 'active' => 'Y'));
                    $this->_rDb->insert(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value_id' => $attributeValuesResult->insert_id(), 'attribute_value' => $o, 'attribute_value_language' => $this->_aLanguage));
                    //echo Kohana::debug($this->_aLanguage);exit();
                }
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('attribute.insert_attribute_success'));
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
            $sAttributeName = $data['attribute_name'];
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            unset($data['submit'], $data['attribute_name']);
            $results = $this->_rDb->update(table::SHOP_ATTRIBUTES, $data, array('id_attribute' => $id));
            $this->_rDb->update(
                    table::SHOP_ATTRIBUTES_DESCRIPTION, array('attribute_name' => $sAttributeName), array(
                'attribute_id' => $id,
                'attribute_language' => $this->_aLanguage
                    )
            );
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('attribute.update_attribute_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * @param array $data
     * @return ErrorReporting
     */
    public function InsertAttributeValue(array $data, array $files) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $sAttributeValue = $data['attribute_value'];
            if (isset($data['attribute_color'])) {
                $attr_additional['attribute_color'] = $data['attribute_color'];
            }
            $ifPattern = !empty($data['attribute_if_pattern']) ? $data['attribute_if_pattern'] : 'N';

            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            $data['default'] = !empty($data['default']) && $data['default'] == 'on' ? 'Y' : 'N';
            // jesli ten jest ustawiony na domyślny to resetujemy domyślne dla warosci tego atrybutu
            if ($data['default'] == 'Y') {
                $this->_rDb->update(table::SHOP_ATTRIBUTES_VALUES, array('default' => 'N'), array('attribute_id' => $data['attribute_id']));
            }
            unset($data['submit'], $data['attribute_value'], $data['attribute_if_pattern'], $data['attribute_color'], $data['attribute_pattern']);
            $results = $this->_rDb->insert(table::SHOP_ATTRIBUTES_VALUES, $data);

            //opis atrybutów
            $result = $this->_rDb->insert(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array(
                'attribute_value_id' => $results->insert_id(),
                'attribute_value' => $sAttributeValue,
                'attribute_value_language' => $this->_aLanguage)
            );

            if (!empty($files['attribute_pattern']) && $ifPattern == 'Y') {
                if (isset($files['attribute_pattern']['error']) && $files['attribute_pattern']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles = file::upload(
                                    $files['attribute_pattern'], array(
                                'unique' => true,
                                'width' => shop::ATTR_BIG_WIDTH,
                                'height' => shop::ATTR_BIG_HEIGHT,
                                'mediumwidth' => shop::ATTR_MEDIUM_WIDTH,
                                'mediumheight' => shop::ATTR_MEDIUM_HEIGHT,
                                'thumbwidth' => shop::ATTR_SMALL_WIDTH,
                                'thumbheight' => shop::ATTR_SMALL_HEIGHT,
                                'path' => shop::ATTR_BIG_PATH,
                                'mediumpath' => shop::ATTR_MEDIUM_PATH,
                                'thumbpath' => shop::ATTR_SMALL_PATH,
                                    )
                    );
                }

                $attr_additional['attribute_pattern'] = $uploadedFiles->Value['filename'];
            }

            if (!empty($attr_additional) && count($attr_additional) > 0) {
                $attr_additional['attribute_value_id'] = $results->insert_id();
                $result_additional = $this->_rDb->insert(table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL, $attr_additional);
            }

            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('attribute.insert_attribute_value_success'));
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
    public function UpdateAttributeValue($id, array $data, array $files) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $sAttributeValue = $data['attribute_value'];
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';

            if (isset($data['attribute_color'])) {
                $attr_additional['attribute_color'] = $data['attribute_color'];
            }

            $ifPattern = !empty($data['attribute_if_pattern']) ? $data['attribute_if_pattern'] : 'N';

            $data['default'] = !empty($data['default']) && $data['default'] == 'on' ? 'Y' : 'N';
            // jesli ten jest ustawiony na domyślny to resetujemy domyślne dla warosci tego atrybutu
            if ($data['default'] == 'Y') {
                $result = $this->FindAttributeValue($id, $this->_aLanguage)->Value[0];
                $this->_rDb->update(table::SHOP_ATTRIBUTES_VALUES, array('default' => 'N'), array('attribute_id' => $result->attribute_id));
            }

            unset($data['submit'], $data['attribute_value'], $data['attribute_if_pattern'], $data['attribute_color'], $data['attribute_pattern']);
            $results = $this->_rDb->update(table::SHOP_ATTRIBUTES_VALUES, $data, array('id_attribute_value' => $id));

            $this->_rDb->update(
                    table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value' => $sAttributeValue), array(
                'attribute_value_id' => $id,
                'attribute_value_language' => $this->_aLanguage,
                    )
            );

            if (!empty($files['attribute_pattern']) && $ifPattern == 'Y') {
                if (isset($files['attribute_pattern']['error']) && $files['attribute_pattern']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles = file::upload(
                                    $files['attribute_pattern'], array(
                                'unique' => true,
                                'width' => shop::ATTR_BIG_WIDTH,
                                'height' => shop::ATTR_BIG_HEIGHT,
                                'mediumwidth' => shop::ATTR_MEDIUM_WIDTH,
                                'mediumheight' => shop::ATTR_MEDIUM_HEIGHT,
                                'thumbwidth' => shop::ATTR_SMALL_WIDTH,
                                'thumbheight' => shop::ATTR_SMALL_HEIGHT,
                                'path' => shop::ATTR_BIG_PATH,
                                'mediumpath' => shop::ATTR_MEDIUM_PATH,
                                'thumbpath' => shop::ATTR_SMALL_PATH,
                                    )
                    );
                }
                $attr_additional['attribute_pattern'] = $uploadedFiles->Value['filename'];
            }

            if (!empty($attr_additional) && count($attr_additional) > 0) {
                $attr_additional['attribute_value_id'] = $id;

                $pattern = $this->_rDb->select('attribute_pattern')->from(table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL)->where(array('attribute_value_id' => $id))->get();

                if (!empty($pattern[0]->attribute_pattern) && $pattern[0]->attribute_pattern != '') {
                    if (file_exists(shop::ATTR_BIG_PATH . $pattern[0]->attribute_pattern)) { //duże foto
                        unlink(shop::ATTR_BIG_PATH . $pattern[0]->attribute_pattern);
                    }
                    if (file_exists(shop::ATTR_MEDIUM_PATH . $pattern[0]->attribute_pattern)) { //medium foto
                        unlink(shop::ATTR_MEDIUM_PATH . $pattern[0]->attribute_pattern);
                    }
                    if (file_exists(shop::ATTR_SMALL_PATH . $pattern[0]->attribute_pattern)) { //small foto
                        unlink(shop::ATTR_SMALL_PATH . $pattern[0]->attribute_pattern);
                    }
                }
                $this->_rDb->delete(table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL, array('attribute_value_id' => $id));

                $result_additional = $this->_rDb->insert(table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL, $attr_additional);
            }



            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('attribute.update_attribute_value_success'));
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
            $results = $this->_rDb->delete(table::SHOP_ATTRIBUTES, array('id_attribute' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, 'Atrybut został usunięty.');
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
    public function DeleteValue($id) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $this->_rDb->delete(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value_id' => $id));
            $pattern = $this->_rDb->select('attribute_pattern')->from(table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL)->where(array('attribute_value_id' => $id))->get();

            if (!empty($pattern[0]->attribute_pattern) && $pattern[0]->attribute_pattern != '') {
                if (file_exists(shop::ATTR_BIG_PATH . $pattern[0]->attribute_pattern)) { //duże foto
                    unlink(shop::ATTR_BIG_PATH . $pattern[0]->attribute_pattern);
                }
                if (file_exists(shop::ATTR_MEDIUM_PATH . $pattern[0]->attribute_pattern)) { //medium foto
                    unlink(shop::ATTR_MEDIUM_PATH . $pattern[0]->attribute_pattern);
                }
                if (file_exists(shop::ATTR_SMALL_PATH . $pattern[0]->attribute_pattern)) { //small foto
                    unlink(shop::ATTR_SMALL_PATH . $pattern[0]->attribute_pattern);
                }
            }

            $this->_rDb->delete(table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL, array('attribute_value_id' => $id));
            $results = $this->_rDb->delete(table::SHOP_ATTRIBUTES_VALUES, array('id_attribute_value' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('attribute.delete_attribute_value_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_ATTRIBUTES_DESCRIPTION . ' AS sad', 'sa.id_attribute', 'sad.attribute_id', 'INNER')->getwhere(table::SHOP_ATTRIBUTES . ' AS sa', array('sa.id_attribute' => $id, 'sad.attribute_language' => $this->_aLanguage)), '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iId
     * @param string $sLanguage
     * @return ErrorReporting 
     */
    public function FindAttributeValue($iId, $sLanguage) {
        try {
            $results = $this->_rDb->join(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION . ' AS savd', 'sav.id_attribute_value', 'savd.attribute_value_id', 'INNER')->getwhere(table::SHOP_ATTRIBUTES_VALUES . ' AS sav', array('id_attribute_value' => $iId, 'attribute_value_language' => $sLanguage));
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
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
    public function FindAttributeValues($id) {
        try {
            $results = $this->_rDb->join(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION . ' AS savd', 'sav.id_attribute_value', 'savd.attribute_value_id', 'INNER')->getwhere(table::SHOP_ATTRIBUTES_VALUES . ' AS sav', array('attribute_id' => $id, 'attribute_value_language' => $this->_aLanguage));
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
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
		$attributes_orderby = 'sa.id_attribute';
		$kind = 'ASC';
		if(!empty($_GET['attributes_orderby']) && $_GET['attributes_orderby']==1 ) {$attributes_orderby='sa.id_attribute'; $kind='ASC';}
		else if(!empty($_GET['attributes_orderby']) && $_GET['attributes_orderby']==2 ) {$attributes_orderby='sa.id_attribute'; $kind='DESC';}
		
		else if(!empty($_GET['attributes_orderby']) && $_GET['attributes_orderby']==3 ) {$attributes_orderby='sad.attribute_name'; $kind='ASC';}
		else if(!empty($_GET['attributes_orderby']) && $_GET['attributes_orderby']==4 ) {$attributes_orderby='sad.attribute_name'; $kind='DESC';}
		
		else if(!empty($_GET['attributes_orderby']) && $_GET['attributes_orderby']==5 ) {$attributes_orderby='sa.active'; $kind='ASC';}
		else if(!empty($_GET['attributes_orderby']) && $_GET['attributes_orderby']==6 ) {$attributes_orderby='sa.active'; $kind='DESC';}
			
		
            if (empty($limit) && empty($offset) && !isset($offset)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby($attributes_orderby, $kind)->join(table::SHOP_ATTRIBUTES_DESCRIPTION . ' AS sad', 'sad.attribute_id', 'sa.id_attribute', 'INNER')->get(table::SHOP_ATTRIBUTES . ' AS sa'), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->join(table::SHOP_ATTRIBUTES_DESCRIPTION . ' AS sad', 'sad.attribute_id', 'sa.id_attribute', 'INNER')->orderby($attributes_orderby, $kind)->get(table::SHOP_ATTRIBUTES . ' AS sa'), '');
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_ATTRIBUTES), '');
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
    public function ValidateUpdate(array $data = array(), array $files = array()) {
        try {
            
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iAttributeId
     * @param string $sLanguage
     * @param string $sValue
     * @return ErrorReporting
     */
    public function ChangeAttributeTranslation($iAttributeId, $sLanguage, $sValue) {
        try {
            
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iAttributeValueId
     * @param string $sLanguage
     * @param string $sValue
     * @return ErrorReporting
     */
    public function ChangeAttributeValueTranslation($iAttributeValueId, $sLanguage, $sValue) {
        try {
            if ($sValue == '') {
                if ($this->_rDb->count_records(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value_id' => $iAttributeValueId, 'attribute_value_language' => $sLanguage))) {
                    
                } else {
                    
                }
                //$this->_rDb->insert
            } else {
                
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param array $post
     * @return ErrorReporting
     */
    public function ValidateAttributeAdd(array $post) {
        try {
            return true;
            if ($sValue == '') {
                if ($this->_rDb->count_records(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value_id' => $iAttributeValueId, 'attribute_value_language' => $sLanguage))) {
                    
                } else {
                    
                }
                //$this->_rDb->insert
            } else {
                
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param array $post
     * @return ErrorReporting
     */
    public function ValidateAttributeEdit(array $post) {
        try {
            return true;
            if ($sValue == '') {
                if ($this->_rDb->count_records(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value_id' => $iAttributeValueId, 'attribute_value_language' => $sLanguage))) {
                    
                } else {
                    
                }
                //$this->_rDb->insert
            } else {
                
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     *
     * @param array $post
     * @return ErrorReporting
     */
    public function ValidateAttributeValueEdit(array $post) {
        try {
            return true;
            if ($sValue == '') {
                if ($this->_rDb->count_records(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_value_id' => $iAttributeValueId, 'attribute_value_language' => $sLanguage))) {
                    
                } else {
                    
                }
                //$this->_rDb->insert
            } else {
                
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * SELECT a.id_attribute, ad.attribute_name, avd.attribute_value
     * FROM `shop_attributes` AS `a`
     * INNER JOIN `shop_attributes_description` AS `ad` ON (ad.attribute_id = a.id_attribute)
     * INNER JOIN `shop_attributes_values` AS `av` ON (av.attribute_id = a.id_attribute) 
     * INNER JOIN `shop_attributes_values_description` AS `avd` ON (avd.attribute_value_id = av.id_attribute_value) 
     * WHERE a.active = 'Y' AND av.active = 'Y' AND ad.attribute_language = 'pl_PL' AND avd.attribute_value_language = 'pl_PL'
     * ORDER BY `ad`.`attribute_name` ASC
     *
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function GetAttributes($sLanguage, $bActive = NULL) {
        try {

            //->select('id_attribute, attribute_name, attribute_value, attribute_price')
            $this->_rDb->from(table::SHOP_ATTRIBUTES . ' AS a')
                    ->join(table::SHOP_ATTRIBUTES_DESCRIPTION . ' AS ad', 'a.id_attribute', 'ad.attribute_id', 'INNER')
                    ->join(table::SHOP_ATTRIBUTES_VALUES . ' AS av', 'av.attribute_id', 'a.id_attribute', 'INNER')
                    ->join(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION . ' AS avd', 'avd.attribute_value_id', 'av.id_attribute_value', 'INNER')
                    ->orderby(array('attribute_name' => 'ASC'))
                    ->where(array('attribute_language' => $sLanguage));

            if(!empty($bActive) && $bActive===TRUE) {
                $this->_rDb->where(array('a.active'=>'Y'));
            }
            $results = $this->_rDb->get();
            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    public function GetAttributesAsArray() {
        try {
            $results = $this->_rDb
                    ->from(table::SHOP_ATTRIBUTES . ' AS a')
                    ->join(table::SHOP_ATTRIBUTES_DESCRIPTION . ' AS ad', 'a.id_attribute', 'ad.attribute_id', 'INNER')
                    ->where(array('a.active'=>'Y'))
                    ->get();

            if (!empty($results) && $results->count() > 0) {
                $aAttrs = array();
                foreach ($results as $r) {
                    $aAttrs[$r->attribute_id] = $r->attribute_name;
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, $aAttrs);
            }
            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, array());
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     * 
     */
    public function GetAttributeValues($iAttributeId) {
        try {
            $result = $this->_rDb->getwhere(table::SHOP_PARAMETERS_VALUES, array('attribute_id' => $iAttributeId, 'active' => 'Y'));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function AjaxDeleteImages($data) {
        try {
            $data = explode('_', $data['id']);
            // pobieramy id obrazka
            $id_attr_images = end($data);

            // pobieramy nazwe pliku
            $result = $this->_rDb->from(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION)->where(array('attribute_value_id' => $id_attr_images))->get();
            //usuwamy z dysku

            if (file_exists(shop::ATTR_BIG_PATH . $result[0]->attribute_pattern)) { // duże foto
                unlink(shop::ATTR_BIG_PATH . $result[0]->attribute_pattern);
            }
            if (file_exists(shop::ATTR_MEDIUM_PATH . $result[0]->attribute_pattern)) { // duże foto
                unlink(shop::ATTR_MEDIUM_PATH . $result[0]->attribute_pattern);
            }
            if (file_exists(shop::ATTR_SMALL_PATH . $result[0]->attribute_pattern)) { // male foto
                unlink(shop::ATTR_SMALL_PATH . $result[0]->attribute_pattern);
            }

            // usuwamy z bazy obrazkow
            $this->_rDb->update(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, array('attribute_pattern' => NULL), array('attribute_value_id' => $id_attr_images));



            return $id_attr_images;
        } catch (Exception $ex) {
            return 'false';
        }
    }

}
