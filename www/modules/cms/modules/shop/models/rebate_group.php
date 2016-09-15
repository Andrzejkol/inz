<?php
class Rebate_Group_Model extends Model_Core {
    private $_rDb;
    private $_iId;
    private $_sRebateGroupName;
    private $_iRebate;
    private $_eActive;

    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            if( ! empty($id) && $this->Exists($id)->Value === true) {
                $rebateGroup = $this->_rDb->Find($id)->Value[0];
                $this->_iId = $rebateGroup->id_rebate_group;
                $this->_sGroupName = $rebateGroup->group_name;
                $this->_iRebate = $rebateGroup->rebate;
                $this->_eActive = $rebateGroup->active;
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
            if($this->_rDb->getwhere(table::SHOP_REBATES_GROUPS, array('id_rebate_group' => $id))>0) {
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
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->insert(table::SHOP_REBATES_GROUPS, $data), Kohana::lang('rebate_group.insert_rebate_group_success'));
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
            $data['active'] = !empty($data['active']) && $data['active'] == 'on' ? 'Y' : 'N';
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->update(table::SHOP_REBATES_GROUPS, $data, array('id_rebate_group' => $id)), Kohana::lang('rebate_group.update_rebate_group_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->delete(table::SHOP_REBATES_GROUPS, array('id_rebate_group' => $id)), Kohana::lang('rebate_group.delete_rebate_group_success'));
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
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_REBATES_GROUPS, array('id_rebate_group' => $id)), '');
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
				$rebates_groups_orderby = 'id_rebate_group';
				$kind = 'ASC';
				if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==1) {$rebates_groups_orderby = 'id_rebate_group'; $kind = 'ASC';}
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==2) {$rebates_groups_orderby = 'id_rebate_group'; $kind = 'DESC';}
				
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==3) {$rebates_groups_orderby = 'group_name'; $kind = 'ASC';}
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==4) {$rebates_groups_orderby = 'group_name'; $kind = 'DESC';}
				
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==5) {$rebates_groups_orderby = 'rebate'; $kind = 'ASC';}
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==6) {$rebates_groups_orderby = 'rebate'; $kind = 'DESC';}
				
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==7) {$rebates_groups_orderby = 'active'; $kind = 'ASC';}
				else if(!empty($_GET['rebates_groups_orderby']) && $_GET['rebates_groups_orderby']==8) {$rebates_groups_orderby = 'active'; $kind = 'DESC';}
			
			
			
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->orderby($rebates_groups_orderby, $kind)->get(table::SHOP_REBATES_GROUPS), '');
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->get(table::SHOP_REBATES_GROUPS), '');
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

    /**
     *
     * @return ErrorReporting
     */
    public function GetRebateGroups() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_REBATES_GROUPS, array('active' => 'Y')));
        } catch(Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    /**
     * Pobiera grupy rabatowe dla selekta przy edycji produktu
     * @param Bool $bSelect - czy ma byc w selekcie 'wybierz'
     * @return ErrorReporting
     */
    public function GetRebateGroupsAsArray($bSelect = null) {
        try {
            $result = $this->_rDb->from(table::SHOP_REBATES_GROUPS)
                    ->where(array('active' => 'Y'))
                    ->get();

            $aRebates = array();
            if(!empty($bSelect)) {
                $aRebates[0] = Kohana::lang('product.check');
            }
            foreach($result as $r) {
                $aRebates[$r->id_rebate_group] = $r->group_name;
            }

            return new ErrorReporting(ErrorReporting::SUCCESS,$aRebates);
        } catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }
}