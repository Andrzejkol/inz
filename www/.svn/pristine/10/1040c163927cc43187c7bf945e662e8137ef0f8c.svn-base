<?php defined('SYSPATH') OR die('No direct access allowed.');
class Language_Model extends Model_Core {
    protected $_rDb;
    
 
    public function __construct() {
        parent::__construct();
        $this->_rDb = Database::instance();
        
        //mapowanie nazw tabel dla tłumaczeń
        $this->aTable = array('category' => table::SHOP_CATEGORIES_DESCRIPTION, 
            'product' => table::SHOP_PRODUCTS_DESCRIPTION, 
            'attribute' => table::SHOP_ATTRIBUTES_DESCRIPTION,
            'attribute_value' => table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION
                );
    }


    /*
     * Pobieranie języków.
     * @param $bNoArray
     * @param $bCheck
     * @return ErrorReporting (Array $lang || MySQL Object $langs || Bool false)
     */
    public function GetLanguages($bNoArray = null, $bCheck = null) {
        try {
            $results = $this->_rDb->get(table::LANGUAGES);
            if ($bNoArray === true) {
                $langs = $results;
            }
            else {
                $langs = array();
                if(!empty($bCheck)) {
                    $langs[0] = Kohana::lang('pages.check');
                }
                foreach($results as $result) {
                    $langs[$result->name] = Kohana::lang('language.' . $result->description);
                }
            }
            
            return new ErrorReporting(ErrorReporting::ERROR, $langs, Kohana::lang('language.error_get_languages'));
        } catch(Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('language.error_get_languages'));
        }

    }
    
    public function SetLanguage() {
        try {
            if(!empty($_COOKIE['language'])) {
                $lang_type = $_COOKIE['language'];
                $language = explode('_', $lang_type);
                $lang = $language[0];
            } else {
                $lang_type = 'pl_PL';
                $lang = 'pl';
            }
            return new ErrorReporting(ErrorReporting::ERROR, array($lang_type, $lang), Kohana::lang('language.success_set_languages'));

        } catch(Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('language.error_set_languages'));
        }
    }

    public function GetLanguagesI18n($skip = array()) {
        try {
            if(is_array($skip) && count($skip)) {
                $this->_rDb->notin('name', $skip);
            }
            $results = $this->_rDb->orderby('name')->get(table::LANGUAGES);
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch(Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('language.error_set_languages'));
        }
    }

    /**
     *
     * @param integer $iLanguageId
     * @return ErrorReporting
     */
    static public function GetISOById($iLanguageId) {
        try {
            $db = Database::instance();
            return new ErrorReporting(ErrorReporting::SUCCESS, $db->select('name')->getwhere(table::LANGUAGES, array('id_language' => $iLanguageId)), '');
        } catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('language.error_set_languages'));
        }
    }
    
    /**
     * 
     * @param type $data
     * @return \ErrorReporting
     */
    public function UpdateTranslation($data) {
        try {
            //nazwy pól
            $table_name = $this->aTable[$data['table']];
            $lang_name = $data['table'].'_language';            
            $id_name = $data['table'].'_id';
            
            //przepisanie danych
            $id = $data['id'];
            $lang = $data['lang'];
            
            //unset pod zapytania
            unset($data['id'], $data['lang'], $data['table']);
            
            //sprawdzamy czy wpis istnieje już w bazie
            $status = $this->_rDb->from($table_name)->where(array($lang_name => $lang, $id_name=>$id))->get();
            
            //wpis jest -> update
            if(!empty($status) && $status->count() > 0){
                $result = $this->_rDb->update($table_name, $data, array($id_name => $id, $lang_name => $lang));
            }
            //wpisu nie ma -> insert
            else {
                $data[$lang_name] = $lang;
                $data[$id_name] = $id;
                $result = $this->_rDb->insert($table_name, $data);
            }
            
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch(Exception $ex) {
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('language.error_set_languages'));
        }
    }
    
    /**
     * 
     * @param type $data
     */
    public function GetTranslation($data) {
        $table_name = $this->aTable[$data['table']];
        $lang_name = $data['table'].'_language';            
        $id_name = $data['table'].'_id';
        $input_name = $data['input_name'];
        
        $id = $data['id'];
        $lang = $data['lang'];
        
        $result = '';
        
        $status = $this->_rDb->select($input_name)->from($table_name)->where(array($lang_name => $lang, $id_name=>$id))->get();
        
        if(!empty($status) && $status->count() > 0){
            foreach($status as $tmp) {
                $result = $tmp->$input_name;
            }
        }        
        return $result;
    }
}
?>