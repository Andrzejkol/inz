<?php defined('SYSPATH') OR die('No direct access allowed.');
class Tag_Model extends Model_Core {
    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->_aLanguage = Kohana::config('locale.language');
    }


    public function AddTags ($tags, $elementId) {
        try {
            $this->db->delete(table::TAGS, array('element_id'=>$elementId));
            $tags = preg_split("/[,;]+/", $tags);
            $tc = count($tags);
            $tags2 = array();
            for($i = 0 ; $i < $tc ; ++$i) {
                if(!in_array($tags[$i], $tags2)) {
                    $word = trim($tags[$i]);
                    if(!empty($word)) {
                        array_push($tags2, $word);
                    }
                }
            }
            $tags = $tags2;
            $tc = count($tags);
            if($tc>0) {
                for($i = 0 ; $i < $tc ; ++$i) {

                    $cnt = $this->db->getwhere(table::TAGS_DICTIONARY, array('word' => $tags[$i]));
                    if($cnt->count()>0) { // istnieje już taki tag
                        $rel = $this->db->count_records(table::TAGS, array('element_id' => $elementId, 'dictionary_tag_id' => $cnt[0]->id_tag_dictionary));
                        if($rel<=0) {
                            $this->db->insert(table::TAGS, array('element_id' => $elementId, 'dictionary_tag_id' => $cnt[0]->id_tag_dictionary));
                        }
                    } else { // nie istnieje, wstaw i pobierz ID
                        $tagResult = $this->db->insert(table::TAGS_DICTIONARY, array('word' => $tags[$i]));
                        $this->db->insert(table::TAGS, array('element_id' => $elementId, 'dictionary_tag_id' => $tagResult->insert_id()));
                    }
                }
            }
            return new ErrorReporting(ErrorReporting::ERROR, true, '');
        }
        catch(Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_insert_page_content'));
        }
    }

    public function GetTags() {

        $result = $this->db->from(table::SHOP_PRODUCTS_TAGS)
                ->join(table::SHOP_PRODUCTS_TAGS_DICT, table::SHOP_PRODUCTS_TAGS_DICT.'.id_tag_dict', table::SHOP_PRODUCTS_TAGS.'.tag_dict_id')
                ->groupby('word')
                ->orderby('word', 'ASC')
                ->select('COUNT(product_id) AS count, word, id_tag_dict')
                ->get();
        if(!empty($result[0]->count)) {
            $tags = array();
            foreach($result as $tag) {
                $tags[] = array(
                        'title' => $tag->word,
                        'link'  => 'produkty_z_tagiem/'.$tag->id_tag_dict,
                        'count' => $tag->count
                );
            }
            $tagCloud = new Tagcloud($tags, 80, 150);
            return $tagCloud;
        }
    }

    public function GetProductsWithTags ($iTagDictionary, $bCount = null) {
        try {
            if(!empty($bCount)) {
                $select = ' COUNT(*) AS count ';
            }
            else {
                $select = ' * ';
            }
            $results = "SELECT ".$select." FROM (".table::SHOP_PRODUCTS." AS `p`)
            LEFT JOIN ( SELECT * FROM ".table::SHOP_PRODUCTS_IMAGES." WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN ".table::SHOP_PRODUCTS_DESCRIPTION." AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            JOIN ".table::SHOP_PRODUCTS_TO_CATEGORIES." AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`)
            JOIN ".table::SHOP_PRODUCTS_TAGS." AS `pt` ON (`pt`.`product_id` = `p`.`id_product`)
            JOIN ".table::SHOP_PRODUCTS_TAGS_DICT." AS `ptd` ON (`ptd`.`id_tag_dict` = `pt`.`tag_dict_id`)
            WHERE p.active = 'Y' AND pd.product_language = '".$this->_aLanguage."' AND ptd.id_tag_dict = '".$iTagDictionary."'  ";


            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        }
        catch(Exception $ex) {
            var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('tag.error_get_products_with_tag'));
        }
    }
    public function GetTagsElements($TagId, $sLang) {
        try {
            $results = $this->db->from(table::TAGS)
                    ->join(table::TAGS_DICTIONARY, table::TAGS_DICTIONARY.'.id_tag_dictionary', table::TAGS.'.dictionary_tag_id')
                    ->join(table::ELEMENTS, table::ELEMENTS.'.id_element', table::TAGS.'.element_id')
                    ->join(table::PAGES_ELEMENTS, table::PAGES_ELEMENTS.'.element_id', table::ELEMENTS.'.id_element')
                    ->join(table::PAGES, table::PAGES.'.id_page', table::PAGES_ELEMENTS.'.page_id')
                    ->where(array('id_tag_dictionary'=>$TagId, 'lang'=>$sLang))
                    ->orderby('name_element')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('page_content.success_insert_page_content'));
        }
        catch(Exception $ex) {
            var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_insert_page_content'));
        }
    }

    public function GetTagsByElementId($element_id) {
        try {
            $results = $this->db->from(table::PAGE_CONTENT)
                    ->join(table::TAGS, table::TAGS.'.element_id', table::PAGE_CONTENT.'.element_id')
                    ->join(table::TAGS_DICTIONARY, table::TAGS_DICTIONARY.'.id_tag_dictionary', table::TAGS.'.dictionary_tag_id')
                    ->where(array(table::TAGS.'.element_id'=>$element_id))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, Kohana::lang('page_content.success_insert_page_content'));
        }
        catch(Exception $ex) {
            var_dump($ex->getMessage());
            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('page_content.error_insert_page_content'));
        }
    }


}
?>