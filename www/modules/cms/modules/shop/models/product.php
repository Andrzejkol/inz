<?php

ini_set('memory_limit', '128M');
ini_set('max_execution_time', '60');

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 * @author Filip Górczyński <filip.gorczynski@gmail.com>
 *
 */
class Product_Model extends Model_Core {

    const PRODUCT_IMG_BIG = 'files/products/big/';
    const PRODUCT_IMG_MEDIUM = 'files/products/medium/';
    const PRODUCT_IMG_XMEDIUM = 'files/products/xmedium/';
    const PRODUCT_IMG_XXMEDIUM = 'files/products/xxmedium/';
    const PRODUCT_IMG_SMALL = 'files/products/small/';
    const PRODUCT_IMG_XSMALL = 'files/products/xsmall/';
    const PRODUCT_MOST_BUY = 4;
    const PRODUCTS_LIMIT = 12;

    private $_rDb;
    private $_iId;
    private $_fPrice;
    private $_fNetPrice;
    private $_iTaxId;
    private $_fPromotionPrice;
    private $_iTimesViewed;
    private $_sCode;
    private $_eActive;
    private $_eRecommend;
    private $_iQuantity;
    private $_sDateAdded;
    private $_sDateModified;
    private $_sDateExpire;
    private $_sEan;
    private $_eHidePrice;
    private $_iMeasureUnit;
    private $_iRebate;
    private $_sProductLanguage;
    private $_sProductName;
    private $_sProductShortDescription;
    private $_sProductDescription;
    private $_sProductGuarantee;
    private $_aProductAttributes;
    private $_aLanguage;
    private $_aProductImages;

    /**
     * Konstruktor obiektu klasy User_Model
     */
    public function __construct($id = null) {
        try {
            $this->_rDb = Database::instance();
            $this->_aLanguage = Kohana::config('locale.language');
            $this->_oSession = Session::instance();
            if (!empty($id) && $this->Exists($id)->Value === true) {
                $product = $this->Find($id)->Value[0];
                $this->_iId = $product->id_product;
                $this->_fPrice = $product->price;
                $this->_fNetPrice;
                $this->_iTaxId;
                $this->_fPromotionPrice;
                $this->_iTimesViewed;
                $this->_sCode = $product->code;
                $this->_eActive = $product->active;
                $this->_eRecommend;
                $this->_iQuantity = $product->quantity;
                $this->_sDateAdded;
                $this->_sDateModified;
                $this->_sDateExpire;
                $this->_sEan;
                $this->_eHidePrice;
                $this->_iMeasureUnit;
                $this->_iRebate;
                $this->_sProductLanguage = $product->product_language;
                $this->_sProductName = $product->product_name;
                $this->_sProductShortDescription = $product->product_short_description;
                $this->_sProductDescription = $product->product_description;
                $this->_sProductGuarantee;
                $this->_aProductAttributes;
                $this->_aProductImages = $this->GetProductImagesAsArray($id);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, null, $ex->getMessage());
        }
    }

    public function __clone() {
        
    }

    public function Exists($id) {
        $id+=0;
        if (!empty($id) && $this->_rDb->count_records(table::SHOP_PRODUCTS, array('id_product' => $id) > 0)) {
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        }
        return new ErrorReporting(ErrorReporting::WARNING, false);
    }

    public function GetProductImagesAsArray($iProductId) {
        $iProductId += 0;
        $result = $this->GetProductImages($iProductId)->Value;
        $aImages = array();
        foreach ($result as $i) {
            $aImages[] = $i->filename;
        }
        if (count($aImages) > 0) {
            return new ErrorReporting(ErrorReporting::SUCCESS, $aImages);
        }
        return new ErrorReporting(ErrorReporting::WARNING, array());
    }

    /**
     *
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Insert(array $data, array $files) {
        try {
            $sProductName = $data['product_name'];
            $sShortDescription = $data['short_description'];
            $sDescription = $data['description'];
            $aCategories = $data['category_id'];
            $sMedia = (!empty($data['product_media']) ? $data['product_media'] : '');

            $name_en = ((!empty($data['product_name_en'])) ? $data['product_name_en'] : null);
            $short_desc_en = ((!empty($data['short_description_en'])) ? $data['short_description_en'] : '');
            $desc_en = ((!empty($data['description_en'])) ? $data['description_en'] : '');

            $aFiles2 = array();
            $iImgCount = !empty($files['images']['name']) ? count($files['images']['name']) : 0;
            for ($i = 0; $i < $iImgCount; $i++) {
                foreach ($files['images'] as $f => $v) {
                    $aFiles2[$i][$f] = $v[$i];
                }
            }
            $files['images'] = $aFiles2;
            $insertId = -1;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
//            array_unshift($data['category_id'], 0);
//            $isEmptyCategory = $this->_rDb->in('id_category', $data['category_id'])->count_records(table::SHOP_CATEGORIES);
//            if($isEmptyCategory > 0 ) {
//                $this->_rDb->query('ROLLBACK');
//                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('product.cant_add_in_nonempty_category'));
//            }
            $data['active'] = ((!empty($data['active']) && $data['active'] == 'Y') ? 'Y' : 'N');
            $data['new'] = !empty($data['set_as_new']) && $data['set_as_new'] == 'on' ? 'Y' : 'N';
            $data['product_allow_rabate'] = !empty($data['product_allow_rabate']) && $data['product_allow_rabate'] == 1 ? 1 : 0;
            $data['quantity_tracking'] = !empty($data['quantity_tracking']) && $data['quantity_tracking'] == 'on' ? 'Y' : 'N';
            $data['ask_for_price'] = !empty($data['ask_for_price']) && $data['ask_for_price'] == 'on' ? 'Y' : 'N';
            $data['net_price'] = $data['net_price']; //number_format($data['price'] * $data['price'] / 100.00, 2);
            $data['hide_price'] = !empty($data['hide_price']) && $data['hide_price'] == 'on' ? 'Y' : 'N';
            $data['date_added'] = TIME;
            $data['description'] = preg_replace('/color: ?[^;]+;/', '', $data['description']);
            $data['short_description'] = preg_replace('/color: ?[^;]+;/', '', $data['short_description']);
            unset($data['submit'], $data['cancel'], $data['description'], $data['description_en'], $data['short_description'], $data['short_description_en'], $data['product_name'], $data['product_name_en'], $data['category_id'], $data['product_media']);
            $result = $this->_rDb->insert(table::SHOP_PRODUCTS, $data);
            Kohana::log('alert', 'Product INSERT: ' . $this->_rDb->last_query());
            $insertId = $result->insert_id();
            $this->_rDb->insert(table::SHOP_PRODUCTS_DESCRIPTION, array(
                'product_id' => $insertId,
                'product_language' => $this->_aLanguage,
                'product_name' => $sProductName,
                'product_description' => $sDescription,
                'product_short_description' => $sShortDescription,
                'product_guarantee' => '',
                'product_media' => $sMedia
            ));

            Kohana::log('alert', 'Product description INSERT: ' . $this->_rDb->last_query());




//wersja angielska
//            $this->_rDb->insert(table::SHOP_PRODUCTS_DESCRIPTION, array(
//                'product_id' => $insertId,
//                'product_language' => 'en_US',
//                'product_name' => $name_en,
//                'product_description' => $desc_en,
//                'product_short_description' => $short_desc_en,
//                'product_guarantee' => '',
//                'product_media' => $sMedia
//            ));



            foreach ($aCategories as $iCatId) {
                $this->_rDb->insert(table::SHOP_PRODUCTS_TO_CATEGORIES, array('product_id' => $insertId, 'category_id' => $iCatId));
                Kohana::log('alert', 'Product category INSERT: ' . $this->_rDb->last_query());
            }
            if (!empty($files['images'])) {
                foreach ($files['images'] as $sFKey) {
                    if (isset($sFKey['error']) && $sFKey['error'] != UPLOAD_ERR_NO_FILE) {
                        $uploadedFiles = file::upload(
                                        $sFKey, array(
                                    'unique' => true,
                                    'width' => shop::BIG_WIDTH,
                                    'height' => shop::BIG_HEIGHT,
                                    'mediumwidth' => shop::MEDIUM_WIDTH,
                                    'mediumheight' => shop::MEDIUM_HEIGHT,
                                    'xmediumwidth' => shop::XMEDIUM_WIDTH,
                                    'xmediumheight' => shop::XMEDIUM_HEIGHT,
                                    'xxmediumwidth' => shop::XXMEDIUM_WIDTH,
                                    'xxmediumheight' => shop::XXMEDIUM_HEIGHT,
                                    'thumbwidth' => shop::SMALL_WIDTH,
                                    'thumbheight' => shop::SMALL_HEIGHT,
                                    'xthumbwidth' => shop::XSMALL_WIDTH,
                                    'xthumbheight' => shop::XSMALL_HEIGHT,
                                    'path' => shop::BIG_PATH,
                                    'mediumpath' => shop::MEDIUM_PATH,
                                    'xmediumpath' => shop::XMEDIUM_PATH,
                                    'xxmediumpath' => shop::XXMEDIUM_PATH,
                                    'thumbpath' => shop::SMALL_PATH,
                                    'xthumbpath' => shop::XSMALL_PATH,
                                    'xcrop' => true,
                                    'xmediumcrop' => true,
                                        )
                        );
                        $this->_rDb->insert(
                                table::SHOP_PRODUCTS_IMAGES, array(
                            'product_id' => $insertId,
                            'mainimage' => 'N',
                            'filename' => $uploadedFiles->Value['filename'],
                            'realfilename' => $uploadedFiles->Value['realfilename']
                                )
                        );
                        Kohana::log('alert', 'Product image INSERT: ' . $this->_rDb->last_query());
                    }
                }
                $oMinProductImageId = $this->_rDb->select('MIN(id_image) AS minimum')->limit(1)->getwhere(table::SHOP_PRODUCTS_IMAGES, array('product_id' => $insertId));
                $this->_rDb->update(table::SHOP_PRODUCTS_IMAGES, array('mainimage' => 'Y'), array('id_image' => $oMinProductImageId[0]->minimum));
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.add_product_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @todo Sprawdzić wartość mainimage gdy zostaną usunięte wszystkie obrazki
     * @param Integer $id
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Update($id, array $data, array $files = array()) {
        try {
            $submittedTab = $data['submit_tab'];
            unset($data['submit'], $data['submit_tab']);
            $this->_rDb->update(table::SHOP_PRODUCTS, array('date_modified' => TIME), array('id_product' => $id));
            switch ($submittedTab) {
                case 'submit_tab_1':
                    return $this->_UpdateProductDetails($id, $this->_aLanguage, $data);
                    break;
                case 'submit_tab_2':
                    return $this->_UpdateProductDescriptions($id, $this->_aLanguage, $data, $files);
                    break;
                case 'submit_tab_3':
                    return $this->_UpdateProductImages($id, $this->_aLanguage, $data, $files);
                    break;
                case 'submit_tab_4':
                    return $this->_UpdateProductAttributes($id, $this->_aLanguage, $data);
                    break;
                case 'submit_tab_5':
                    //Komentarze - zarzadzanie indywidualne
                    break;
                case 'submit_tab_6':
                    return $this->_UpdateProductFiles($id, $this->_aLanguage, $data, $files);
                    break;
                case 'submit_tab_7':
                    return $this->_UpdateProductSEO($id, $this->_aLanguage, $data);
                    break;
                case 'submit_tab_8':
                    return $this->_UpdateProductSettings($id, $data);
                    break;
                case 'submit_tab_9': // produkty powiązane
                    return $this->_UpdateProductVariant($id, $data);
                    break;
                case 'submit_tab_10':
                    //return $this->_UpdateProductMarks($id, $this->_aLanguage, $data);
                    return $this->_UpdateProductVariants2($id, $this->_aLanguage, $data, $files);
                    break;
            }
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.update_product_error', array($ex->getMessage())));
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param string $sLanguage
     * @param array $post
     * @return ErrorReporting
     */
    private function _UpdateProductDetails($iProductId, $sLanguage, $post) {
        try {
            $iProductId += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $this->_rDb->update(table::SHOP_PRODUCTS, array(
                'price' => !empty($post['price']) ? $post['price'] : '0.00',
                'tax_id' => $post['tax_id'],
                'code' => !empty($post['code']) ? $post['code'] : '',
                'product_stock' => !empty($post['product_stock']) ? $post['product_stock'] : 0,
                'ean' => !empty($post['ean']) ? $post['ean'] : '',
                'date_expire' => !empty($post['date_expire']) ? strtotime($post['date_expire']) : '',
                'producer_id' => !empty($post['producer_id']) ? $post['producer_id'] : 0,
                'ask_for_price' => !empty($post['ask_for_price']) && $post['ask_for_price'] == 'on' ? 'Y' : 'N',
                'hide_price' => !empty($post['hide_price']) && $post['hide_price'] == 'on' ? 'Y' : 'N',
                'active' => $post['active'],
                'product_status_id' => !empty($post['product_status_id']) ? $post['product_status_id'] : '',
                'quantity_tracking' => !empty($post['quantity_tracking']) && $post['quantity_tracking'] == 'on' ? 'Y' : 'N',
                'quantity' => !empty($post['quantity']) ? $post['quantity'] : '',
                'product_position' => !empty($post['product_position']) ? $post['product_position'] : '',
                    )
                    , array('id_product' => $iProductId));
            $this->_rDb->delete(table::SHOP_PRODUCTS_TO_CATEGORIES, array('product_id' => $iProductId));
            foreach ($post['category_id'] as $iCatId) {
                $this->_rDb->insert(table::SHOP_PRODUCTS_TO_CATEGORIES, array('category_id' => $iCatId, 'product_id' => $iProductId));
            }

            $result = $this->_rDb->update(table::SHOP_PRODUCTS_DESCRIPTION, array('product_name' => $post['product_name']), array('product_id' => $iProductId, 'product_language' => $sLanguage));

            //wersja angielska
//            if (empty($post['product_name_en']) || $post['product_name_en'] == '' || $post['product_name_en'] == null) {
//                $post['product_name_en'] = NULL;
//            }
//            $result = $this->_rDb->update(table::SHOP_PRODUCTS_DESCRIPTION, array('product_name' => $post['product_name_en']), array('product_id' => $iProductId, 'product_language' => 'en_US'));

            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.product_description_updated_successfully'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param string $sLanguage
     * @param array $post
     * @return ErrorReporting
     */
    private function _UpdateProductDescriptions($iProductId, $sLanguage, $post, $files = array()) {
        try {
            $iProductId += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            // parametry produktu
            if (!empty($post['parameter_value'])) {
                $aParameterValues = $post['parameter_value'];
                foreach ($aParameterValues as $iKey => $iValue) {
                    $this->_rDb->delete(table::SHOP_PRODUCT_PARAMETERS, array('product_id' => $iProductId, 'parameter_id' => $iKey));
                    if (!empty($iValue)) {
                        $this->_rDb->insert(table::SHOP_PRODUCT_PARAMETERS, array('product_id' => $iProductId, 'parameter_id' => $iKey, 'value' => $iValue));
                    }
                }
            }
            $tags = !empty($post['tags']) ? $post['tags'] : array();
            $currentTags = $this->_rDb->join(table::SHOP_PRODUCTS_TAGS . ' AS t', 't.tag_dict_id', 'td.id_tag_dict', 'INNER')->getwhere(table::SHOP_PRODUCTS_TAGS_DICT . ' AS td', array('product_id' => $iProductId));
            $currentTags2 = array();
            foreach ($currentTags as $tag) {
                array_push($currentTags2, $tag->word);
            }
            $currentTags = $currentTags2;
            if ($tags) {
                $tags = preg_split("/[,;]+/", $tags);
                $tags = array_map('trim', $tags);
                $tags = array_map('mb_strtolower', $tags);
                $tc = count($tags);
                $tags2 = array();
                for ($i = 0; $i < $tc; ++$i) {
                    if (!in_array($tags[$i], $tags2)) {
                        array_push($tags2, $tags[$i]);
                    }
                }
                $tags = $tags2;
            }
            $tc = count($tags);
            for ($i = 0; $i < count($currentTags); ++$i) {
                if (!in_array($currentTags[$i], $tags)) {
                    $tagId = $this->_rDb->join(table::SHOP_PRODUCTS_TAGS . ' AS t', 't.tag_dict_id', 'td.id_tag_dict', 'INNER')->getwhere(table::SHOP_PRODUCTS_TAGS_DICT . ' AS td', array('word' => $currentTags[$i]));
                    $this->_rDb->delete(table::SHOP_PRODUCTS_TAGS, array('product_id' => $iProductId, 'tag_dict_id' => $tagId[0]->id_tag_dict));
                }
            }
            if ($tc > 0) {
                for ($i = 0; $i < $tc; ++$i) {
                    $cnt = $this->_rDb->getwhere(table::SHOP_PRODUCTS_TAGS_DICT, array('word' => $tags[$i]));
                    if ($cnt->count() > 0) { // istnieje już taki tag
                        $res = $this->_rDb->join(table::SHOP_PRODUCTS_TAGS . ' AS t', 't.tag_dict_id', 'td.id_tag_dict', 'INNER')->getwhere(table::SHOP_PRODUCTS_TAGS_DICT . ' AS td', array('product_id' => $iProductId, 'word' => $tags[$i]));
                        $rel = $this->_rDb->count_records(table::SHOP_PRODUCTS_TAGS, array('product_id' => $iProductId, 'tag_dict_id' => $cnt[0]->id_tag_dict));
                        if ($rel <= 0) {
                            $this->_rDb->insert(table::SHOP_PRODUCTS_TAGS, array('product_id' => $iProductId, 'tag_dict_id' => $cnt[0]->id_tag_dict));
                        }
                    } else { // nie istnieje, wstaw i pobierz ID
                        $tagResult = $this->_rDb->insert(table::SHOP_PRODUCTS_TAGS_DICT, array('word' => $tags[$i]));
                        $this->_rDb->insert(table::SHOP_PRODUCTS_TAGS, array('product_id' => $iProductId, 'tag_dict_id' => $tagResult->insert_id()));
                    }
                }
            }
            $result = $this->_rDb->update(table::SHOP_PRODUCTS_DESCRIPTION, array('product_short_description' => $post['product_short_description'], 'product_description' => $post['product_description'], 'product_guarantee' => (!empty($post['guarantee']) ? $post['guarantee'] : ''), 'product_media' => (!empty($post['product_media']) ? $post['product_media'] : '')), array('product_id' => $iProductId, 'product_language' => $sLanguage));

            //wersja en
//            $short_desc_en = ((!empty($post['short_description_en'])) ? $post['short_description_en'] : '');
//            $desc_en = ((!empty($post['description_en'])) ? $post['description_en'] : '');
//
//            $result = $this->_rDb->update(table::SHOP_PRODUCTS_DESCRIPTION, array('product_short_description' => $short_desc_en, 'product_description' => $desc_en, 'product_guarantee' => (!empty($post['guarantee']) ? $post['guarantee'] : ''), 'product_media' => $post['product_media']), array('product_id' => $iProductId, 'product_language' => 'en_US'));



            if (!empty($post['parameter_value'])) {
                $this->_rDb->delete(table::SHOP_PRODUCT_PARAMETERS, array('product_id' => $iProductId));

                foreach ($post['parameter_value'] as $pvKey => $pvValue) {
                    if (!empty($pvValue)) {
                        $this->_rDb->insert(table::SHOP_PRODUCT_PARAMETERS, array('product_id' => $iProductId, 'parameter_id' => $pvKey, 'value' => $pvValue));
                    }
                }
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.product_description_updated_successfully'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param string $sLanguage
     * @param array $post
     * @param array $files
     * @return ErrorReporting
     */
    private function _UpdateProductImages($iProductId, $sLanguage, $post, $files) {
        try {
            $aFiles2 = array();
            $iImgCount = !empty($files['images']['name']) ? count($files['images']['name']) : 0;
            for ($i = 0; $i < $iImgCount; $i++) {
                foreach ($files['images'] as $f => $v) {
                    $aFiles2[$i][$f] = $v[$i];
                }
            }
            $files['images'] = $aFiles2;
            $iProductId += 0;
            $result = null;
            $mainimage = !empty($post['mainimage']) ? $post['mainimage'] : 0;
            $delImages = !empty($post['delImage']) ? $post['delImage'] : array();
            unset($post);
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            if (!empty($files['images'])) {
                foreach ($files['images'] as $sFKey) {
                    if (isset($sFKey['error']) && $sFKey['error'] != UPLOAD_ERR_NO_FILE) {
                        $uploadedFiles = file::upload(
                                        $sFKey, array(
                                    'unique' => true,
                                    'width' => shop::BIG_WIDTH,
                                    'height' => shop::BIG_HEIGHT,
                                    'mediumwidth' => shop::MEDIUM_WIDTH,
                                    'mediumheight' => shop::MEDIUM_HEIGHT,
                                    'xmediumwidth' => shop::XMEDIUM_WIDTH,
                                    'xmediumheight' => shop::XMEDIUM_HEIGHT,
                                    'xxmediumwidth' => shop::XXMEDIUM_WIDTH,
                                    'xxmediumheight' => shop::XXMEDIUM_HEIGHT,
                                    'thumbwidth' => shop::SMALL_WIDTH,
                                    'thumbheight' => shop::SMALL_HEIGHT,
                                    'xthumbwidth' => shop::XSMALL_WIDTH,
                                    'xthumbheight' => shop::XSMALL_HEIGHT,
                                    'path' => shop::BIG_PATH,
                                    'mediumpath' => shop::MEDIUM_PATH,
                                    'xmediumpath' => shop::XMEDIUM_PATH,
                                    'xxmediumpath' => shop::XXMEDIUM_PATH,
                                    'thumbpath' => shop::SMALL_PATH,
                                    'xthumbpath' => shop::XSMALL_PATH,
                                    'xcrop' => true,
                                    'xmediumcrop' => true,
                                        )
                        );
                        $this->_rDb->insert(
                                table::SHOP_PRODUCTS_IMAGES, array(
                            'product_id' => $iProductId,
                            'filename' => $uploadedFiles->Value['filename'],
                            'realfilename' => $uploadedFiles->Value['realfilename']
                                )
                        );
                    }
                }
            }
            if (!empty($delImages)) {
                foreach ($delImages as $imgName => $delete) {
                    $filePath = shop::MEDIUM_PATH . $imgName;
                    if (file_exists($filePath) && is_file($filePath)) {
                        if (@unlink($filePath)) {
                            //echo Kohana::lang('product.file_has_been_deleted', array($imgName));
                        } else {
                            //echo Kohana::lang('product.file_cant_be_deleted', array($imgName));
                        }
                    }
                    $fileBigPath = shop::BIG_PATH . $imgName;
                    if (file_exists($filePath) && is_file($filePath)) {
                        if (@unlink($filePath)) {
                            //echo Kohana::lang('product.file_has_been_deleted', array($imgName));
                        } else {
                            //echo Kohana::lang('product.file_cant_be_deleted', array($imgName));
                        }
                    }
                    $fileThumbPath = shop::MEDIUM_PATH . $imgName;
                    if (file_exists($fileThumbPath) && is_file($fileThumbPath)) {
                        if (@unlink($fileThumbPath)) {
                            //echo Kohana::lang('product.file_has_been_deleted', array($imgName));
                        } else {
                            //echo Kohana::lang('product.file_cant_be_deleted', array($imgName));
                        }
                    }
                    $this->_rDb->delete(table::SHOP_PRODUCTS_IMAGES, array('filename' => $imgName, 'product_id' => $iProductId));
                }
            }
            $this->_rDb->update(table::SHOP_PRODUCTS_IMAGES, array('mainimage' => 'N'), array('product_id' => $iProductId));
            if ($this->_rDb->count_records(table::SHOP_PRODUCTS_IMAGES, array('id_image' => $mainimage)) == 0) {
                $oMinProductImageId = $this->_rDb->select('MIN(id_image) AS minimum')->limit(1)->getwhere(table::SHOP_PRODUCTS_IMAGES, array('product_id' => $iProductId));
                if ($oMinProductImageId->count() > 0) {
                    $this->_rDb->update(table::SHOP_PRODUCTS_IMAGES, array('mainimage' => 'Y'), array('id_image' => $oMinProductImageId[0]->minimum));
                }
            } else {
                $this->_rDb->update(table::SHOP_PRODUCTS_IMAGES, array('mainimage' => 'Y'), array('id_image' => $mainimage));
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.update_images_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function _UpdateProductAttributes($iProductId, $sLanguage, array $post) {
        try {
            $result = null;
            $iProductId += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $aAttributes = !empty($post['attribute_value']) ? $post['attribute_value'] : array();
            // usunięcie wszystkich wartości atrybutów
            $this->_rDb->delete(table::SHOP_PRODUCTS_ATTRIBUTES, array('product_id' => $iProductId));
            foreach ($aAttributes as $iKey => $iValue) {
                foreach (array_keys($iValue) as $attributeValueId) {
                    $result = $this->_rDb->insert(table::SHOP_PRODUCTS_ATTRIBUTES, array('product_id' => $iProductId, 'attribute_id' => $iKey, 'attribute_value_id' => $attributeValueId));
                }
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.update_attributes_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    private function _UpdateProductVariants2($iProductId, $sLanguage, $post, $files) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            //var_dump($post);
            //przygtowujemy tablice atrybut=>wartość
            $attr = array();
            foreach ($post as $name => $val) {
                if (strstr($name, 'attr') != false && $val != 'wybierz') { //TODO: wersje językowe
                    $tmp = explode("_", $name);
                    $attr[$tmp[1]] = $val;
                }
            }
            //sprawdzamy czy dany wariant już istnieje
            $ex_var = $this->_rDb->from(table::SHOP_PRODUCT_TO_VARIANT)->where(array('product_id' => $iProductId))->get();

            if (!empty($ex_var) && $ex_var->count() > 0) {
                foreach ($ex_var as $ex) {
                    if (unserialize($ex->variant_values) == $attr) {
                        //id obecnego wariantu
                        $ex_id = $ex->variant_id;
                        //pobieramy obecne obrazki dla wariantu
                        $oProductsImages = $this->_rDb->getwhere(table::SHOP_PRODUCTS_IMAGES, array('variant_id' => $ex->variant_id));

                        //usuwamy obecne obrazku wariantu
                        foreach ($oProductsImages as $pi) {
                            if (file_exists(shop::MEDIUM_PATH . $pi->filename)) {
                                if (unlink(shop::MEDIUM_PATH . $pi->filename) !== true) {
                                    Kohana::log('error', Kohana::lang('product.cant_delete_medium_image_file'));
                                }
                            }
                            if (file_exists(shop::XMEDIUM_PATH . $pi->filename)) {
                                if (unlink(shop::XMEDIUM_PATH . $pi->filename) !== true) {
                                    Kohana::log('error', Kohana::lang('product.cant_delete_medium_image_file'));
                                }
                            }
                            if (file_exists(shop::SMALL_PATH . $pi->filename)) {
                                if (unlink(shop::SMALL_PATH . $pi->filename) !== true) {
                                    Kohana::log('error', Kohana::lang('product.cant_delete_small_image_file'));
                                }
                            }
                            if (file_exists(shop::XSMALL_PATH . $pi->filename)) {
                                if (unlink(shop::XSMALL_PATH . $pi->filename) !== true) {
                                    Kohana::log('error', Kohana::lang('product.cant_delete_small_image_file'));
                                }
                            }
                            if (file_exists(shop::BIG_PATH . $pi->filename)) {
                                if (unlink(shop::BIG_PATH . $pi->filename) !== true) {
                                    Kohana::log('error', Kohana::lang('product.cant_delete_big_image_file'));
                                }
                            }
                            $this->_rDb->delete(table::SHOP_PRODUCTS_IMAGES, array('id_image' => $pi->id_image));
                        }
                        $attrserd = serialize($attr);
                        $this->_rDb->update(table::SHOP_PRODUCT_TO_VARIANT, array('quantity' => $post['quantity']), array('variant_values' => $attrserd, 'product_id' => $iProductId));
                    } //jeżeli nie ma wariantu dodajemy go do bazy - FIX: czy to się w ogóle wydarzy? 
                    else {
                        $attrserd = serialize($attr);
                        $aAdd = array(
                            'product_id' => $iProductId,
                            'variant_values' => $attrserd,
                            'quantity' => $post['quantity']
                        );
                        $var_ins = $this->_rDb->insert(table::SHOP_PRODUCT_TO_VARIANT, $aAdd);
                        $variant_id = $var_ins->insert_id();
                    }
                }
            } else { //jeżeli nie ma wariantu dodajemy go do bazy
                $attrserd = serialize($attr);
                $aAdd = array(
                    'product_id' => $iProductId,
                    'variant_values' => $attrserd,
                    'quantity' => $post['quantity']
                );
                $var_ins = $this->_rDb->insert(table::SHOP_PRODUCT_TO_VARIANT, $aAdd);
                $variant_id = $var_ins->insert_id();


                //w każdym wypadku wstawiamy nowe zdjęcie
                $aFiles2 = array();
                $iImgCount = !empty($files['images']['name']) ? count($files['images']['name']) : 0;
                for ($i = 0; $i < $iImgCount; $i++) {
                    foreach ($files['images'] as $f => $v) {
                        $aFiles2[$i][$f] = $v[$i];
                    }
                }
                $files['images'] = $aFiles2;
                $iProductId += 0;
                $result = null;
                $mainimage = !empty($post['mainimage']) ? $post['mainimage'] : 0;
                $delImages = !empty($post['delImage']) ? $post['delImage'] : array();
                unset($post);
                if (!empty($files['images'])) {
                    foreach ($files['images'] as $sFKey) {
                        if (isset($sFKey['error']) && $sFKey['error'] != UPLOAD_ERR_NO_FILE) {
                            $uploadedFiles = file::upload(
                                            $sFKey, array(
                                        'unique' => true,
                                        'width' => shop::BIG_WIDTH,
                                        'height' => shop::BIG_HEIGHT,
                                        'mediumwidth' => shop::MEDIUM_WIDTH,
                                        'mediumheight' => shop::MEDIUM_HEIGHT,
                                        'xmediumwidth' => shop::XMEDIUM_WIDTH,
                                        'xmediumheight' => shop::XMEDIUM_HEIGHT,
                                        'xxmediumwidth' => shop::XXMEDIUM_WIDTH,
                                        'xxmediumheight' => shop::XXMEDIUM_HEIGHT,
                                        'thumbwidth' => shop::SMALL_WIDTH,
                                        'thumbheight' => shop::SMALL_HEIGHT,
                                        'xthumbwidth' => shop::XSMALL_WIDTH,
                                        'xthumbheight' => shop::XSMALL_HEIGHT,
                                        'path' => shop::BIG_PATH,
                                        'mediumpath' => shop::MEDIUM_PATH,
                                        'xmediumpath' => shop::XMEDIUM_PATH,
                                        'xxmediumpath' => shop::XXMEDIUM_PATH,
                                        'thumbpath' => shop::SMALL_PATH,
                                        'xthumbpath' => shop::XSMALL_PATH,
                                        'xcrop' => true,
                                        'xmediumcrop' => true,
                                            )
                            );
                            $this->_rDb->insert(
                                    table::SHOP_PRODUCTS_IMAGES, array(
                                'product_id' => $iProductId,
                                'variant_id' => (!empty($variant_id) ? $variant_id : (!empty($ex_id) ? $ex_id : '')),
                                'filename' => $uploadedFiles->Value['filename'],
                                'realfilename' => $uploadedFiles->Value['realfilename'],
                                'mainimage' => 'N'
                                    )
                            );
                        }
                    }
                }
            }

            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('product.update_images_success'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function _UpdateProductFiles($iProductId, $sLanguage, array $post, array $files) {
        try {
            $result = null;
            $iProductId += 0;
            if (!file_exists('files/product_files/' . $iProductId)) {
                mkdir('files/product_files/' . (string) $iProductId, 0777);
            }
            if (!empty($post['delFilesDescription'])) {
                foreach (array_keys($post['delFilesDescription']) as $del) {
                    $result = $this->_rDb->getwhere(table::SHOP_PRODUCTS_FILES, array('id_product_file' => $del));
                    if ($result->count()) {
                        if (file_exists('files/product_files/' . $iProductId . '/' . $result[0]->real_file_name)) {
                            @unlink('files/product_files/' . $iProductId . '/' . $result[0]->real_file_name);
                        }
                    }
                    $this->_rDb->delete(table::SHOP_PRODUCTS_FILES, array('id_product_file' => $del));
                }
            }
//            if (!empty($post['removeFiles'])) {
//                foreach ($post['removeFiles'] as $rem) {
//                    if (file_exists(url::base() . 'files/product_files/' . $iProductId . '/' . $rem) && is_file(url::base() . 'files/product_files/' . $iProductId . '/' . $rem)) {
//                        @unlink(url::base() . 'files/product_files/' . $iProductId . '/' . $rem);
//                        $result = $this->_rDb->delete(table::SHOP_PRODUCTS_FILES, array('id_product_file' => $rem->id_product_file));
//                    }
//                }
//            }
            if (!empty($post['filesDescription'])) {
                foreach ($post['filesDescription'] as $descKey => $descValue) {
                    $result = $this->_rDb->update(table::SHOP_PRODUCTS_FILES, array('description' => $descValue), array('id_product_file' => $descKey));
                }
            }
            $aFiles2 = array();
            $iImgCount = !empty($files['file']['name']) ? count($files['file']['name']) : 0;
            for ($i = 0; $i < $iImgCount; $i++) {
                foreach ($files['file'] as $f => $v) {
                    $aFiles2[$i][$f] = $v[$i];
                }
                $aFiles2[$i]['description'] = $post['new_description'][$i];
            }
            $files['file'] = $aFiles2;
            // TODO: brak zabezpieczenia przed nadpisaniem już istniejącego pliku o identycznej nazwie, jest póki co pomijany (jeśli istnieje w bazie)
            foreach ($files['file'] as $f) {
                if (!empty($f['name']) && 4 != $f['error'] && $f['size']) {
                    if ($this->_rDb->count_records(table::SHOP_PRODUCTS_FILES, array('real_file_name' => $f['name'], 'product_id' => $iProductId)) == 0) {
                        if (is_uploaded_file($f['tmp_name']) && move_uploaded_file($f['tmp_name'], 'files/product_files/' . $iProductId . '/' . $f['name'])) {
                            $result = $this->_rDb->insert(table::SHOP_PRODUCTS_FILES, array('product_id' => $iProductId, 'real_file_name' => $f['name'], 'created_at' => TIME, 'is_active' => 1, 'description' => $f['description']));
                        }
                    }
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.product_files_updated_successfully'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param string $sLanguage
     * @param array $post
     * @return ErrorReporting
     */
    private function _UpdateProductSEO($iProductId, $sLanguage, $post) {
        try {
            $iProductId += 0;
            $result = $this->_rDb->update(table::SHOP_PRODUCTS_DESCRIPTION, array('meta_title' => $post['meta_title'], 'meta_description' => $post['meta_description'], 'meta_keywords' => $post['meta_keywords']), array('product_id' => $iProductId, 'product_language' => $sLanguage));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.product_seo_updated_successfully'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param array $post
     * @return ErrorReporting
     */
    private function _UpdateProductSettings($iProductId, $post) {
        try {
            $iProductId += 0;
            $bAllowVoting = !empty($post['allow_voting']) && $post['allow_voting'] == 'on' ? 'Y' : 'N';
            $bAllowComments = !empty($post['allow_comments']) && $post['allow_comments'] == 'on' ? 'Y' : 'N';
            $bFreeDelivery = !empty($post['free_delivery']) && $post['free_delivery'] == 'on' ? 'Y' : 'N';
            $fAdditionalDeliveryCost = !empty($post['additional_delivery_cost']) ? $post['additional_delivery_cost'] : 0;
            $bRecommend = !empty($post['recommend']) && $post['recommend'] == 'on' ? 'Y' : 'N';
            $bBestseller = !empty($post['bestseller']) && $post['bestseller'] == 'on' ? 'Y' : 'N';
            $bVoucher = !empty($post['voucher']) && $post['voucher'] == '1' ? '1' : '0';
            $bNew = !empty($post['new']) && $post['new'] == 'on' ? 'Y' : 'N';
            $sOldPrice = !empty($post['old_price']) ? $post['old_price'] : NULL;
            $product_allow_rabate = (!empty($post['product_allow_rabate']) && $post['product_allow_rabate'] == 1 ? 1 : 0);
            $result = $this->_rDb->update(table::SHOP_PRODUCTS, array(
                'product_allow_rabate' => $product_allow_rabate,
                'new' => $bNew,
                'recommend' => $bRecommend,
                'bestseller' => $bBestseller,
                'old_price' => $sOldPrice,
                'allow_voting' => $bAllowVoting,
                'allow_comments' => $bAllowComments,
                'free_delivery' => $bFreeDelivery,
                'voucher' => $bVoucher,
                'additional_delivery_cost' => $fAdditionalDeliveryCost
                    ), array('id_product' => $iProductId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.product_settings_updated_successfully'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @param Integer $id
     * @return ErrorReporting
     */
    public function Delete($id) {
        try {
            $id += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $oProductsImages = $this->_rDb->getwhere(table::SHOP_PRODUCTS_IMAGES, array('product_id' => $id));
            foreach ($oProductsImages as $pi) {
                if (file_exists(shop::MEDIUM_PATH . $pi->filename)) {
                    if (unlink(shop::MEDIUM_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_medium_image_file'));
                    }
                }
                if (file_exists(shop::XMEDIUM_PATH . $pi->filename)) {
                    if (unlink(shop::XMEDIUM_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_medium_image_file'));
                    }
                }
                if (file_exists(shop::SMALL_PATH . $pi->filename)) {
                    if (unlink(shop::SMALL_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_small_image_file'));
                    }
                }
                if (file_exists(shop::XSMALL_PATH . $pi->filename)) {
                    if (unlink(shop::XSMALL_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_small_image_file'));
                    }
                }
                if (file_exists(shop::BIG_PATH . $pi->filename)) {
                    if (unlink(shop::BIG_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_big_image_file'));
                    }
                }
                $this->_rDb->delete(table::SHOP_PRODUCTS_IMAGES, array('id_image' => $pi->id_image));
            }
            $this->_rDb->delete(table::SHOP_PRODUCTS_TO_CATEGORIES, array('product_id' => $id));
            $this->_rDb->delete(table::SHOP_PRODUCTS_TAGS, array('product_id' => $id));
            $this->_rDb->delete(table::SHOP_PRODUCTS_PARAMETERS, array('product_id' => $id));
            $this->_rDb->delete(table::SHOP_PRODUCTS_DESCRIPTION, array('product_id' => $id));
            $this->_rDb->delete(table::SHOP_PRODUCTS_ATTRIBUTES, array('product_id' => $id));
            $this->_rDb->delete(table::SHOP_PRODUCTS_COMMENTS, array('product_id' => $id));
            $result = $this->_rDb->delete(table::SHOP_PRODUCTS, array('id_product' => $id));
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.product_deleted_successfully'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @param Integer $id
     * @return ErrorReporting
     */
    public function Find($id) {
        try {
            $id += 0;
            $oResult = $this->_rDb->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS spd', 'spd.product_id', 'sp.id_product', 'INNER')
                    ->getwhere(table::SHOP_PRODUCTS . ' AS sp', array('id_product' => $id));
            return new ErrorReporting(ErrorReporting::SUCCESS, $oResult);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $limit
     * @param Integer $offset
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null, $args = null, $bCount = NULL) {
        try {
            //$this->_oLanguage = Kohana::config('locale.language');
            $where = ' AND 1 = 1 ';
            $whereCat = ' 1 = 1 ';
            if (!empty($args) && is_array($args) && count($args)) {
                foreach ($args as $key => $value) {
                    switch ($key) {
                        case 'query':
                            $where .= " AND (product_name LIKE '%$value%' OR product_description LIKE '%$value%') ";
                            //$this->_rDb->like(array('product_name' => $value, 'product_description' => $value, 'product_short_description' => $value));
                            break;
                        case 'available':
                            $where .= " AND (active = '$value') ";
                            //$this->_rDb->where(array('active' => $value));
                            break;
                        case 'product_status';
                            $where .= " AND (product_status_id = '$value') ";
                            //$this->_rDb->where(array('product_status_id' => $value));
                            break;
                        case 'product_code':
                            $where .= " AND (code = '$value') ";
                            //$this->_rDb->where(array('code' => $value));
                            break;
                        case 'quantity_min':
                            $where .= " AND (quantity >= $value) ";
                            //$this->_rDb->where(array('quantity >=' => $value));
                            break;
                        case 'quantity_max':
                            $where .= " AND (quantity <= $value) ";
                            //$this->_rDb->where(array('quantity <=' => $value));
                            break;
                        case 'price_min':
                            $where .= " AND (price >= $value) ";
                            //$this->_rDb->where(array('price >=' => $value));
                            break;
                        case 'price_max':
                            $where .= " AND (price <= $value) ";
                            //$this->_rDb->where(array('price <=' => $value));
                            break;
                        case 'product_category':
                            $where .= " AND (ptc.category_id = $value) ";
                            $where .= " AND (category_id IN ($value)) ";
                            $whereCat .= " AND (category_id IN ($value)) ";
                            break;
                        case 'product_producers':
                            $where .= " AND (producer_id = $value) ";
                            //$this->_rDb->where(array('producer_id' => $value));
                            break;
                    }
                }
            }
            $sLimit = '';
            if (!empty($limit) && isset($offset)) {
                $sLimit = "LIMIT $offset, $limit ";
            }

            $products_orderby = 'pd.product_name ASC'; // Domyślna wartość bez sortowania
            if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 1)
                $products_orderby = ' p.id_product ASC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 2)
                $products_orderby = ' p.id_product DESC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 3)
                $products_orderby = ' pd.product_name ASC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 4)
                $products_orderby = ' pd.product_name DESC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 5)
                $products_orderby = ' p.price ASC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 6)
                $products_orderby = ' p.price DESC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 7)
                $products_orderby = ' p.active ASC ';
            else if (!empty($_GET['products_orderby']) && $_GET['products_orderby'] == 8)
                $products_orderby = ' p.active DESC ';

            $results = $this->_rDb->query(
                    " SELECT p.id_product, pd.product_name, pi.filename, p.price, p.quantity, p.active, p.recommend, p.promotion_price
              FROM
                " . table::SHOP_PRODUCTS . " AS p
                LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage = 'Y') AS pi ON pi.product_id = p.id_product
                INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS pd ON pd.product_id = p.id_product 
                LEFT JOIN " . table::SHOP_TAXES . " AS `st` ON (`st`.`id_tax` = `p`.`tax_id`)
                LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_TO_CATEGORIES . " GROUP BY product_id) AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`)
                WHERE pd.product_language = '" . $this->_aLanguage . "' {$where}
               
				GROUP BY p.id_product
				ORDER BY " . $products_orderby . "
                $sLimit
           ");
            if (!empty($bCount) && $bCount === TRUE) {
                $results = $results->count();
            }

//            Kohana::log('alert', 'Find All Products: ' . $this->_rDb->last_query());
//            $results =
//                $this->_rDb
//                ->select(
//                        array(
//                            'p.id_product',
//                            'pd.product_name',
//                            'pi.filename',
//                            'p.price',
//                            'p.quantity',
//                            'p.active',
//                            'p.recommend',
//                            'p.promotion_price'
//                        )
//                )
//                ->orderby('pd.product_name')
//                ->limit($limit, $offset)
//                ->groupby('p.id_product')
//                ->join(table::SHOP_PRODUCTS_IMAGES . ' AS pi', 'pi.product_id', 'p.id_product', 'LEFT')
//                ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS pd', 'pd.product_id', 'p.id_product', 'INNER')
//                ->getwhere(table::SHOP_PRODUCTS . ' AS p', array('pd.product_language' => $this->_aLanguage));
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function GetCategoryProducts($id) {
        $id += 0;
        try {
            $result = $this->_rDb->getwhere(table::SHOP_PRODUCTS_TO_CATEGORIES, array('category_id' => $id));
            //var_dump($result);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.get_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.get_category_products_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::SHOP_PRODUCTS), Kohana::lang('product.count_users_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.count_products_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @todo Dodać walidację w PHP
     * @param array $post
     */
    public function ValidateProductAdd(array $post) {
        $errors = array();
        $clean = array();
        $clean['product_name'] = strip_tags($post['product_name']);
//        $clean['product_name_en'] = strip_tags($post['product_name_en']);
        $clean['price'] = $post['price'];
//        $clean['code'] = $post['code'];
//        $clean['ean'] = $post['ean'];
//        $clean['short_description'] = strip_tags($post['short_description']);
//        $clean['short_description'] = trim($clean['short_description']);
        $clean['description'] = strip_tags($post['description']);
        $clean['description'] = trim($clean['description']);
        $clean['category_id'] = !empty($post['category_id']) ? $post['category_id'] : null;
        $clean['date_expire'] = !empty($post['date_expire']) ? $post['date_expire'] : null;
        if (empty($clean['product_name'])) {
            $errors['product_name'] = Kohana::lang('product.product_name_can_not_be_empty');
        }
//        if (empty($clean['product_name_en'])) {
//            $errors['product_name_en'] = Kohana::lang('product.product_name_en_can_not_be_empty');
//        }
        if (empty($post['price'])) {
            $errors['price'] = Kohana::lang('product.price_can_not_be_empty');
        } else {
            if (!empty($errors['price']) && !is_numeric($errors['price'])) {
                $errors['price'] = Kohana::lang('product.price_is_not_numeric');
            }
        }
//        if(empty($clean['code'])) {
//            $errors['code'] = Kohana::lang('product.code_can_not_be_empty');
//        }
//        if(empty($clean['ean'])) {
//            $errors['ean'] = Kohana::lang('product.ean_can_not_be_empty');
//        }
//        if (empty($clean['short_description'])) {
//            $errors['short_description'] = Kohana::lang('product.short_description_can_not_be_empty');
//        }
        if (empty($clean['description'])) {
            $errors['description'] = Kohana::lang('product.description_can_not_be_empty');
        }
        if (empty($clean['category_id'])) {
            $errors['category_id'] = Kohana::lang('product.category_can_not_be_empty');
        }
        if (count($errors)) {
            $tmp = Kohana::lang('product.errors_occured') . "<ul>\n";
            foreach ($errors as $e) {
                $tmp .= '<li>' . $e . "</li>\n";
            }
            $tmp .= "</ul>\n";
            return new ErrorReporting(ErrorReporting::ERROR, false, $tmp);
        }
        return new ErrorReporting(ErrorReporting::SUCCESS, true);
    }

    /**
     *
     * @todo Dodać walidację w PHP
     * @param array $post
     */
    public function ValidateProductEdit(array $post, array $files = array()) {
        $errors = array();
        $clean = array();
        switch ($post['submit_tab']) {
            case 'submit_tab_1':
                $clean['product_name'] = strip_tags($post['product_name']);
//                $clean['product_name_en'] = strip_tags($post['product_name_en']);
                $clean['price'] = $post['price'];
//                $clean['code'] = $post['code'];
//                $clean['ean'] = $post['ean'];
                $clean['category_id'] = !empty($post['category_id']) ? $post['category_id'] : null;
                $clean['date_expire'] = !empty($post['date_expire']) ? $post['date_expire'] : null;
                if (empty($clean['product_name'])) {
                    $errors['product_name'] = Kohana::lang('product.product_name_can_not_be_empty');
                }
//                if (empty($clean['product_name_en'])) {
//                    $errors['product_name_en'] = Kohana::lang('product.product_name_en_can_not_be_empty');
//                }
                if (empty($post['price'])) {
                    $errors['price'] = Kohana::lang('product.price_can_not_be_empty');
                } else {
                    if (!empty($errors['price']) && !is_numeric($errors['price'])) {
                        $errors['price'] = Kohana::lang('product.price_is_not_numeric');
                    }
                }
//                if(empty($clean['code'])) {
//                    $errors['code'] = Kohana::lang('product.code_can_not_be_empty');
//                }
//                if(empty($clean['ean'])) {
//                    $errors['ean'] = Kohana::lang('product.ean_can_not_be_empty');
//                }
                if (empty($clean['category_id'])) {
                    $errors['category_id'] = Kohana::lang('product.category_can_not_be_empty');
                }
                if (count($errors)) {
                    $tmp = Kohana::lang('product.errors_occured') . "<ul>\n";
                    foreach ($errors as $e) {
                        $tmp .= '<li>' . $e . "</li>\n";
                    }
                    $tmp .= "</ul>\n";
                    return new ErrorReporting(ErrorReporting::ERROR, false, $tmp);
                }
                break;
            case 'submit_tab_2':
                //$clean['short_description'] = empty($post['short_description']) ? '' : strip_tags($post['short_description']);
                //$clean['short_description'] = trim($clean['short_description']);
                $clean['product_description'] = empty($post['product_description']) ? '' : strip_tags($post['product_description']);
                $clean['product_description'] = trim($clean['product_description']);
//                if (empty($clean['short_description'])) {
//                    $errors['short_description'] = Kohana::lang('product.short_description_can_not_be_empty');
//                }
                if (empty($clean['product_description'])) {
                    $errors['product_description'] = Kohana::lang('product.description_can_not_be_empty');
                }
                if (count($errors)) {
                    $tmp = Kohana::lang('product.errors_occured') . "<ul>\n";
                    foreach ($errors as $e) {
                        $tmp .= '<li>' . $e . "</li>\n";
                    }
                    $tmp .= "</ul>\n";
                    return new ErrorReporting(ErrorReporting::ERROR, false, $tmp);
                }
                break;
            case 'submit_tab_3':
                // pliki
                break;
            case 'submit_tab_4':

                break;
            case 'submit_tab_5':

                break;
            case 'submit_tab_6':

                break;
            case 'submit_tab_7':
                break;
            case 'submit_tab_8':

                break;
        }
        return new ErrorReporting(ErrorReporting::SUCCESS, true);
    }

    public function SearchCount(array $args = array()) {
        try {
            $rules = '';
            $searchResult = null;
            $value = strip_tags($query);
            // dzielimy wyszukiwany łańcuch znaków na pojedyncze tokeny
            $queryElements = preg_split('/\s+/', $value);
            $tmp = array();
            //                foreach($queryElements as $str) {
            //                    $tmp[] = addslashes(strip_tags($str));
            //                }
            //                $tmp[] = implode('', $tmp);
            $queryElements = $tmp;

            // =========================
            // PRODUCTS
            // =========================
            //sprawdzanie wystąpienia całej frazy
            $sql = " (pd.`product_name` LIKE '%{$value}%' OR pd.`product_description` LIKE '%{$value}%' ";
            // sprawdzanie wystapienia każdej z fraz indywidualnie (dla count() == 1, tak jak powyższe
            if (count($queryElements) > 1) {
                $sql .= 'OR (';
                $tmpSql = '';
                for ($i = 0; $i < count($queryElements); ++$i) {
                    $tmpSql .= empty($tmpSql) ? " p.`product_name` LIKE '%{$queryElements[$i]}%' " : " AND p.`product_name` LIKE '%{$queryElements[$i]}%' ";
                }
                $sql .= $tmpSql;
                $sql .= ') ';
            }
            if (count($queryElements) > 1) {
                $sql .= 'OR (';
                $tmpSql = '';
                for ($i = 0; $i < count($queryElements); ++$i) {
                    $tmpSql .= empty($tmpSql) ? " p.`product_description` LIKE '%{$queryElements[$i]}%' " : " AND p.`product_description` LIKE '%{$queryElements[$i]}%' ";
                }
                $sql .= $tmpSql;
                $sql .= ') ';
            }
//                if (count($queryElements) > 1) {
//                    $sql .= 'OR (';
//                    $tmpSql = '';
//                    for ($i = 0; $i < count($queryElements); ++$i) {
//                        $tmpSql .= empty($tmpSql) ? " p.`product_short_description` LIKE '%{$queryElements[$i]}%' " : " AND p.`product_short_description` LIKE '%{$queryElements[$i]}%' ";
//                    }
//                    $sql .= $tmpSql;
//                    $sql .= ') ';
//                }
            if (!empty($bCount)) {
                $sql2 = " SELECT COUNT(*) AS count ";
            } else {
                $sql2 = "SELECT p.id_product AS product_id, pd.product_name AS product_name, pd.`product_description`, pd.`product_short_description`, i.filename, i.realfilename ";
                $sql2 = "SELECT * ";
            }
            $sql2 .= " FROM " . (table::SHOP_PRODUCTS) . " p" .
                    " INNER JOIN " . (table::SHOP_PRODUCTS_DESCRIPTION) . " pd ON pd.product_id = p.id_product " .
                    " INNER JOIN " . (table::SHOP_PRODUCTS_TO_CATEGORIES) . " c ON c.product_id = p.id_product " .
                    " LEFT JOIN " . (table::SHOP_PRODUCTS_IMAGES) . " i ON i.product_id = p.id_product " .
                    " WHERE (p.active = 1 AND pd.product_language = '" . $lang . "') " .
                    (!empty($sql) ? ' AND (' . $sql . ') ' : '') .
                    " GROUP BY pd.product_id" .
                    " ORDER BY pd.product_name";
            if (!empty($limit) && isset($offset)) {
                $sql2 .= " LIMIT {$limit} OFFSET {$offset}";
            }
            $searchResultProducts = $this->_rDb->query($sql2);
            return new ErrorReporting(ErrorReporting::SUCCESS, $searchResultProducts);
        } catch (Exception $e) {
            
        }
    }

    /**
     *
     * @param array $args
     * @return array
     */
    public function SetSearchCriteria(array $args) {
        return $_SESSION['q'] = serialize($args);
    }

    /**
     *
     * @return array
     */
    public function GetSearchCriteria() {
        if (!empty($_SESSION['q'])) {
            return unserialize($_SESSION['q']);
        }
        return null;
    }

    public function GetSearchedPorductDetails(array $products, $iLimit, $iOffset, $aOrderby = null) {
        try {
            //$aOrderby = array('price' => 'ASC');
            $select = '*';
            $query = "SELECT " . $select . " FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            JOIN " . table::SHOP_PRODUCTS_TO_CATEGORIES . " AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS . " AS `pt` ON (`pt`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS_DICT . " AS `ptd` ON (`ptd`.`id_tag_dict` = `pt`.`tag_dict_id`)
            WHERE p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "' ";
            $query .= " AND id_product IN (" . implode(',', array_filter($products)) . ")
            GROUP BY id_product ";
            if (!empty($aOrderby)) {
                $query .= " ORDER BY ";
                foreach ($aOrderby as $key => $order) {
                    $query .= " " . $key . " " . $order . " ";
                }
            } else {
                $query .= " ORDER BY `pd`.`product_name` ASC";
            }
            if (!empty($iLimit) && isset($iOffset)) {
                $query.=" LIMIT " . $iOffset . " ," . $iLimit . " ";
            }
            $result = $this->_rDb->query($query);
            var_dump($result);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('app.search_results_success'));
        } catch (Exception $ex) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.search_results_error', $ex->getMessage()));
        }
    }

    public function SearchByName($name) {
        return $this->_rDb->query("SELECT product_id, product_name FROM " . table::SHOP_PRODUCTS_DESCRIPTION . " WHERE product_name LIKE '%{$name}%' AND product_language = 'pl_PL'");
    }

    /**
     * Funkcja do produktów powiązanych - mimo że z nazwy to nie wynika :)
     * @param int $iProductId
     * @param type $post
     * @return \ErrorReporting
     */
    public function _UpdateProductVariant($iProductId, $post) {
        try {
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');
            $iProductId += 0;
//            $post['recommend'] = !empty($post['recommend']) && $post['recommend'] == 'on' ? 'Y' : 'N' ;
//            $post['bestseller'] = !empty($post['bestseller']) && $post['bestseller'] == 'on' ? 'Y' : 'N' ;
//            $post['new'] = !empty($post['new']) && $post['new'] == 'on' ? 'Y' : 'N' ;
            $relatedProducts = !empty($post['related_products']) ? $post['related_products'] : array();
            unset($post['related_products'], $post['related_product_suggest']);
//            $result = $this->_rDb->update(table::SHOP_PRODUCTS,
//                array(
//                    'recommend' => $post['recommend'],
//                    'bestseller' => $post['bestseller'],
//                    'new' => $post['new'],
//                    'old_price' => !empty($post['old_price']) && $post['old_price']+0>0?str_replace(',', '.', $post['old_price']):null,
//                    'constant_discount' => !empty($post['constant_discount'])?$post['constant_discount']:'',
//                    'rebate_group_id' => !empty($post['rebate_group_id'])?$post['rebate_group_id']:'',
//                    'max_rebate' => !empty($post['max_rebate'])?$post['max_rebate']:'',
//                    'loyality_points' => !empty($post['loyality_points'])?$post['loyality_points']:'',
//                    'product_of_the_day_date' => !empty($post['product_of_the_day_date'])?strtotime($post['product_of_the_day_date']):'',
//                    'promotion_price' => !empty($post['promotion_price'])?str_replace(',', '.', $post['promotion_price']):'',
//                    'promotion_date_start' => !empty($post['promotion_date_start'])?strtotime($post['promotion_date_start']):'',
//                    'promotion_date_end' => !empty($post['promotion_date_end'])?strtotime($post['promotion_date_end']):'',
//                    'sale' => !empty($post['sale'])?$post['sale']:'',
//                    'sale_date_start' => !empty($post['sale_date_start'])?strtotime($post['sale_date_start']):'',
//                    'sale_date_end' => !empty($post['sale_date_end'])?strtotime($post['sale_date_end']):''
//                    ), array('id_product' => $iProductId)
//            );
            $this->_rDb->delete(table::SHOP_RELATED_PRODUCTS, array('product_id' => $iProductId));
            $cleanDuplicates = array();
            foreach ($relatedProducts as $rp) {
                if (!in_array($rp, $cleanDuplicates)) {
                    $cleanDuplicates[] = $rp;
                }
            }
            $relatedProducts = $cleanDuplicates;
            foreach ($relatedProducts as $rp) {
                $this->_rDb->insert(table::SHOP_RELATED_PRODUCTS, array('product_id' => $iProductId, 'related_product_id' => $rp));
            }
            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, false, Kohana::lang('product.product_variant_updated_successfully'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function Search(array $args = array()) {
        $query = !empty($args['searchbox']) ? $args['searchbox'] : '';

        $rules = '';
        $searchResult = null;
        $value = strip_tags($query);
        // dzielimy wyszukiwany łańcuch znaków na pojedyncze tokeny
        $queryElements = preg_split('/\s+/', $value);
        $tmp = array();

        $queryElements = $tmp;

        // =========================
        // PRODUCTS
        // =========================
        // 
        //sprawdzanie wystąpienia całej frazy
        $sql = " (pd.`product_name` LIKE '%{$value}%' OR pd.`product_description` LIKE '%{$value}%' ";
        // sprawdzanie wystapienia każdej z fraz indywidualnie (dla count() == 1, tak jak powyższe
        if (count($queryElements) > 1) {
            $sql .= 'OR (';
            $tmpSql = '';
            for ($i = 0; $i < count($queryElements); ++$i) {
                $tmpSql .= empty($tmpSql) ? " p.`product_name` LIKE '%{$queryElements[$i]}%' " : " AND p.`product_name` LIKE '%{$queryElements[$i]}%' ";
            }
            $sql .= $tmpSql;
            $sql .= ') ';
        }
        if (count($queryElements) > 1) {
            $sql .= 'OR (';
            $tmpSql = '';
            for ($i = 0; $i < count($queryElements); ++$i) {
                $tmpSql .= empty($tmpSql) ? " p.`product_description` LIKE '%{$queryElements[$i]}%' " : " AND p.`product_description` LIKE '%{$queryElements[$i]}%' ";
            }
            $sql .= $tmpSql;
            $sql .= ') ';
        }

        $sql .= ') ';

        //
        $sql3 = ' ';
        if (!empty($args['price_from'])) {
            $sql3 .= ' AND price >= ' . intval($args['price_from']);
        }
        if (!empty($args['price_to'])) {
            $sql3 .= ' AND price <= ' . intval($args['price_to']);
        }

        if (!empty($args['wheel_size'])) {
            $sql3 .= ' AND pp1.value = "' . addslashes($args['wheel_size']) . '"';
        }
        if (!empty($args['gear'])) {
            $sql3 .= ' AND pp2.value = "' . addslashes($args['gear']) . '"';
        }
        if (!empty($args['producer'])) {
            $sql3 .= ' AND p.producer_id = "' . addslashes($args['producer']) . '"';
        }
        //



        if (!empty($bCount)) {
            $sql2 = " SELECT COUNT(*) AS count ";
        } else {
            $sql2 = "SELECT p.id_product AS product_id, pd.product_name AS product_name, pd.`product_description`, pd.`product_short_description`, i.filename, i.realfilename ";
            $sql2 = "SELECT * ";
        }
        $sql2 .= " FROM " . (table::SHOP_PRODUCTS) . " p" .
                " INNER JOIN " . (table::SHOP_PRODUCTS_DESCRIPTION) . " pd ON pd.product_id = p.id_product " .
                " INNER JOIN " . (table::SHOP_PRODUCTS_TO_CATEGORIES) . " c ON c.product_id = p.id_product " .
                " LEFT JOIN " . table::SHOP_TAXES . " AS `st` ON (`st`.`id_tax` = `p`.`tax_id`) " .
                " LEFT JOIN (SELECT * FROM " . (table::SHOP_PRODUCTS_IMAGES) . " WHERE mainimage = 'Y') AS i ON i.product_id = p.id_product " .
                " LEFT JOIN (SELECT * FROM " . (table::SHOP_PRODUCT_PARAMETERS) . " WHERE parameter_id = 3) AS pp1 ON pp1.product_id = p.id_product " .
                " LEFT JOIN (SELECT * FROM " . (table::SHOP_PRODUCT_PARAMETERS) . " WHERE parameter_id = 18) AS pp2 ON pp2.product_id = p.id_product " .
                " WHERE (p.active = 1) " .
                (!empty($sql) ? ' AND (' . $sql . ') ' : '') .
                ' ' . $sql3 . ' ' .
                " GROUP BY pd.product_id" .
                " ORDER BY pd.product_name";
        if (!empty($limit) && isset($offset)) {
            $sql2 .= " LIMIT {$limit} OFFSET {$offset}";
        }



        $searchResultProducts = $this->_rDb->query($sql2);
        return new ErrorReporting(ErrorReporting::SUCCESS, $searchResultProducts, '');
    }

    /**
     * SELECT p.`id_product`, p.`name` AS `product_name`, p.`lang`, pc.`name` AS `category_name`, p.`available`, p.`recommend`, p.`promotion`
     * FROM `products` p
     * INNER JOIN `products_categories` pc ON p.`product_category_id` = pc.`id_product_category`
     * WHERE
     *     p.`name` LIKE '%a%'
     *     OR p.`description` LIKE '%a%'
     * 	OR p.`short_description` LIKE '%a%'
     * 	OR p.`product_brief` LIKE '%a%'
     * ORDER BY p.`name` ASC
     *
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @param string $query
     * @return ErrorReporting
     */
    public function SearchProducts($query) {
        try {
            $result = $this->_rDb
                    ->select(
                            array(
                                'p.id_product',
                                'p.name',
                                'p.lang',
                                'pc.name AS category_name',
                                'p.available',
                                'p.recommend',
                                'p.promotion'
                            )
                    )
                    ->orderby(array('p.name' => 'ASC'))
                    ->join(table::SHOP_PRODUCTS_CATEGORIES . ' AS pc', 'p.product_category_id', 'pc.id_product_category', 'INNER')
                    ->like('p.name', "{$query}%", false)
//                ->orlike('p.description', "$query%", false)
//                ->orlike('p.short_description', "$query%", false)
//                ->orlike('p.product_brief', "$query%", false)
                    ->get(table::SHOP_PRODUCTS . ' AS p');
            //Kohana::log('error', $this->_rDb->last_query());
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $result, Kohana::lang('product_category.search_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, Kohana::lang('product_category.get_category_id_error'));
        }
    }

    /**
     *
     * @param string $query
     * @return ErrorReporting
     */
    public function SearchResults($lang, $query = '', $bCount = null, $limit = null, $offset = 0) {
//        try {
        if ($query !== '' && mb_strlen($query) < 3) {
            return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('product.search_query_too_short'));
        } else {
            $aIds = array();
            // jesli sa parametry to sprawdzamy jakie product_id maja wybrane parametry
            if (!empty($_GET['pp'])) {
                $sSql = "SELECT product_id FROM (`shop_product_parameters`) WHERE ";
                $iValIter = 0;
                foreach ($_GET['pp'] as $iParId => $aParValue) {
                    foreach ($aParValue as $aVal) {
                        if ($iValIter > 0) {
                            $sSql .= " OR ";
                        }
                        $sSql .= " (`value` = '" . $aVal . "' AND `parameter_id` = " . $iParId . ") ";
                        $iValIter++;
                    }
                }
                $oIds = $this->_rDb->query($sSql);
                if (!empty($oIds) && $oIds->count() > 0) {
                    foreach ($oIds as $oId) {
                        $aIds[] = $oId->product_id;
                    }
                }
            }

            $rules = '';
            $searchResult = null;
            $value = strip_tags($query);
            // dzielimy wyszukiwany łańcuch znaków na pojedyncze tokeny
            $queryElements = preg_split('/\s+/', $value);
            $tmp = array();
            foreach ($queryElements as $str) {
                $tmp[] = addslashes(strip_tags($str));
            }
            $tmp[] = implode('', $tmp);
            $queryElements = $tmp;


            // =========================
            // PRODUCTS
            // =========================
            //sprawdzanie wystąpienia całej frazy
            $sql = " (pd.`product_name` LIKE '%{$value}%' OR pd.`product_description` LIKE '%{$value}%' OR pav.`attribute_value` LIKE '%{$value}%' ) ";
            // sprawdzanie wystapienia każdej z fraz indywidualnie (dla count() == 1, tak jak powyższe
            if (count($queryElements) > 1) {
                $sql .= 'OR (';
                $tmpSql = '';
                for ($i = 0; $i < count($queryElements); ++$i) {
                    $tmpSql .= empty($tmpSql) ? " pd.`product_name` LIKE '%{$queryElements[$i]}%' " : " OR pd.`product_name` LIKE '%{$queryElements[$i]}%' ";
                }
                $sql .= $tmpSql;
                $sql .= ') ';
            }
            if (count($queryElements) > 1) {
                $sql .= 'OR (';
                $tmpSql = '';
                for ($i = 0; $i < count($queryElements); ++$i) {
                    $tmpSql .= empty($tmpSql) ? " pd.`product_description` LIKE '%{$queryElements[$i]}%' " : " OR pd.`product_description` LIKE '%{$queryElements[$i]}%' ";
                }
                $sql .= $tmpSql;
                $sql .= ') ';
            }
            if (count($queryElements) > 1) {
                $sql .= 'OR (';
                $tmpSql = '';
                for ($i = 0; $i < count($queryElements); ++$i) {
                    $tmpSql .= empty($tmpSql) ? " pav.`attribute_value` LIKE '%{$queryElements[$i]}%' " : " OR pav.`attribute_value` LIKE '%{$queryElements[$i]}%' ";
                }
                $sql .= $tmpSql;
                $sql .= ') ';
            }
            if (!empty($bCount)) {
                $sql2 = " SELECT COUNT(*) AS count ";
            } else {
                $sql2 = "SELECT p.id_product AS product_id, pd.product_name AS product_name, pd.`product_description`, pd.`product_short_description`, i.filename, i.realfilename ";
                $sql2 = "SELECT p.*, pd.*, c.*, i.*, pav.*, pa.attribute_id, pa.attribute_value_id, pa.default_value, pa.quantity ";
            }
            $sql2 .= " FROM " . (table::SHOP_PRODUCTS) . " p" .
                    " INNER JOIN " . (table::SHOP_PRODUCTS_DESCRIPTION) . " pd ON pd.product_id = p.id_product " .
                    " INNER JOIN " . (table::SHOP_PRODUCTS_TO_CATEGORIES) . " c ON c.product_id = p.id_product " .
                    " LEFT JOIN " . (table::SHOP_PRODUCTS_IMAGES) . " i ON i.product_id = p.id_product " .
                    " LEFT JOIN " . table::SHOP_TAXES . " AS `st` ON (`st`.`id_tax` = `p`.`tax_id`) " .
                    " LEFT JOIN " . (table::SHOP_PRODUCTS_ATTRIBUTES) . " pa ON pa.product_id = p.id_product " .
                    " LEFT JOIN " . (table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION) . " pav ON pav.attribute_value_id = pa.attribute_value_id " .
                    " WHERE (p.active = 1 AND pd.product_language = '" . $lang . "') " .
                    (!empty($sql) ? ' AND (' . $sql . ') ' : '');

            // wyszukiwanie po cenach
            if (!empty($_GET['price_from']) || !empty($_GET['price_to'])) {
                if (!empty($_GET['price_from'])) {
                    $sql2 .= " AND p.price >= " . $_GET['price_from'] . " ";
                }
                if (!empty($_GET['price_to'])) {
                    $sql2 .= " AND p.price <=" . $_GET['price_to'] . " ";
                }
            }


            if (!empty($aIds)) {
                $sql2 .= " AND id_product IN (" . implode($aIds, ',') . ") ";
            }
            if (!empty($bCount)) {
                $sql2 .= ' GROUP BY p.id_product ';
            } else {
                $sql2 .= " GROUP BY pd.product_id" .
                        " ORDER BY pd.product_name";
            }

            if (!empty($limit) && isset($offset)) {
                $sql2 .= " LIMIT $offset, $limit ";
            }
//            var_dump($offset);var_dump($limit);
            $searchResultProducts = $this->_rDb->query($sql2);
//            var_dump($searchResultProducts);
            if (!empty($bCount)) {
                if (!empty($searchResultProducts) && $searchResultProducts->count() > 0) {
                    return new ErrorReporting(ErrorReporting::SUCCESS, $searchResultProducts->count(), '');
                } else {
                    return new ErrorReporting(ErrorReporting::SUCCESS, 0, '');
                }
            }
//            var_dump($searchResultProducts);
            return new ErrorReporting(ErrorReporting::SUCCESS, $searchResultProducts, '');
        }
//        } catch(Exception $ex) {
//            Kohana::log('error', $ex->getMessage());
//            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('app.search_results_error', array($ex->getMessage())));
//        }
    }

    /**
     * Pobiera najczesciej kupowane produkty z podanym
     * @param Integer $iProductId
     * @return ErrorReporting (MySQL Result $oProducts || Bool false)
     */
    public function GetMostBuyWithProduct($iProductId) {
        try {
            $query = "SELECT product_id, COUNT(*) AS count FROM " . table::SHOP_ORDERS_PRODUCTS . " WHERE order_id IN
(SELECT order_id FROM " . table::SHOP_ORDERS_PRODUCTS . " WHERE product_id = '" . $iProductId . "' GROUP BY order_id)
AND product_id != '" . $iProductId . "' GROUP BY product_id ORDER BY count LIMIT " . self::PRODUCT_MOST_BUY . " ";
            $result = $this->_rDb->query($query);

            $aProductIds = array();
            foreach ($result as $r) {
                $aProductIds[] = $r->product_id;
            }
            if (!empty($aProductIds) && count($aProductIds) > 0) {
                $oProducts = $this->GetProductListing(array(), $this->_aLanguage, array('id_product' => $aProductIds))->Value;
            } else {
                $oProducts = false;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $oProducts, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetNewestProducts($iLimit = null, $bSetAsNew = TRUE) {
        try {
            $this->_rDb->from(table::SHOP_PRODUCTS . ' AS p')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS pd', 'pd.product_id', 'p.id_product', 'INNER')
                    ->join(table::SHOP_PRODUCTS_IMAGES, 'p.id_product', table::SHOP_PRODUCTS_IMAGES . '.product_id', 'LEFT')

                    //->orderby('p.id_product', 'DESC')
                    ->orderby('p.date_added', 'DESC')
                    ->groupby('p.id_product');

            if (!empty($bSetAsNew) && $bSetAsNew === TRUE) {
                $this->_rDb->where(array('new' => 'Y'));
            }

            if (!empty($iLimit)) {
                $this->_rDb->limit($iLimit);
            } else {
                $this->_rDb->limit(5);
            }
            $results = $this->_rDb->get();
//            var_dump($results);
//            exit();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * 
     * @param type $iLimit
     * @return \ErrorReporting
     */
    public function GetTopSellProducts($iCatId = null, $date = '-3 month', $iLimit = null) {
        try {

            if (!empty($iCatId)) {
                $quer = "select shop_orders_products.`product_id`, `category_id`, count(*) as NumSales from shop_orders_products "
                        . "join shop_orders on  id_order =  order_id  "
                        . "join shop_products_to_categories on  shop_products_to_categories.product_id =  shop_orders_products.product_id "
                        . "where  order_date > " . strtotime($date) . " AND category_id = " . $iCatId;
            } else {
                $quer = "select shop_orders_products.`product_id`, count(*) as NumSales from shop_orders_products 
                    join shop_orders on  id_order =  order_id where  order_date > " . strtotime($date);
            }
            $quer .= " group by `product_id` ORDER BY NumSales DESC";
            if (!empty($iLimit)) {
                $quer .= " LIMIT 0, " . $iLimit;
            }
            $tmp_res = $this->_rDb->query($quer);


            if (!empty($tmp_res) && $tmp_res) {
                $id_arr = array();
                foreach ($tmp_res as $tmp) {
                    $id_arr[] = $tmp->product_id;
                }
                $results = self::GetProductListing(null, null, array('id_product' => $id_arr))->Value;
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Pobiera produkty do listy po stronie aplikacji
     * @param Array $aWhere
     * @param string $sLanguage
     * @param Array $aIn
     * @return ErrorReporting
     */
    public function GetProductListing($aWhere, $sLanguage = null, $aIn = array(), $iLimit = null, $iOffset = 0, $aOrderby = null, $bCount = null) {
        try {
            if (!empty($bCount)) {
                $select = ' COUNT(*) AS count ';
            } else {
                $select = ' * ';
            }
            $query = "SELECT " . $select . " FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y' GROUP BY product_id) AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_TO_CATEGORIES . " GROUP BY product_id) AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS . " AS `pt` ON (`pt`.`product_id` = `p`.`id_product`)
                LEFT JOIN " . table::SHOP_TAXES . " AS `st` ON (`st`.`id_tax` = `p`.`tax_id`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS_DICT . " AS `ptd` ON (`ptd`.`id_tag_dict` = `pt`.`tag_dict_id`)
            WHERE p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "' AND pd.product_name IS NOT NULL ";
            if (!empty($aWhere) && count($aWhere) > 0) {
                foreach ($aWhere as $key => $val) {
                    $query .= " AND " . $key . "=" . $val . " ";
                }
            }
            if (!empty($aIn) && count($aIn) > 0) {
                foreach ($aIn as $key => $val) {
                    if (!empty($val) && count($val) > 0) {
                        $in = implode(',', $val);
                        $query .= " AND " . $key . " IN (" . $in . ")";
                    }
                }
            }

            if (empty($bCount)) {
                $query .= " GROUP BY `p`.`id_product` ";
            }
            if (!empty($aOrderby)) {
                $query .= " ORDER BY ";
                foreach ($aOrderby as $key => $order) {
                    $query .= " " . $key . " " . $order . " ";
                }
            } else {
                $query .= " ORDER BY `p`.`product_position` DESC, `pd`.`product_name` ASC";
            }
            if (!empty($iLimit) && isset($iOffset)) {
                $query .= " LIMIT " . $iOffset . " ," . $iLimit . " ";
            }
//            var_dump($query);
            $results = $this->_rDb->query($query);
            //Kohana::log('alert', 'Get All Products: ' . $this->_rDb->last_query());
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetAllProductListing($active = null, $sLanguage = 'pl_PL', $bCount = null, $aOrderby = null) {
        try {
            if (!empty($bCount)) {
                $select = ' COUNT(*) AS count ';
            } else {
                $select = ' * ';
            }
            $query = "SELECT " . $select . " FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y' GROUP BY product_id) AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_TO_CATEGORIES . " GROUP BY product_id) AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS . " AS `pt` ON (`pt`.`product_id` = `p`.`id_product`)
            LEFT JOIN " . table::SHOP_TAXES . " AS `st` ON (`st`.`id_tax` = `p`.`tax_id`)
            LEFT JOIN " . table::SHOP_PRODUCTS_TAGS_DICT . " AS `ptd` ON (`ptd`.`id_tag_dict` = `pt`.`tag_dict_id`)";
            if (!empty($active)) {
                $query .= " WHERE p.active = '" . $active . "'";
            }
            $query .= " AND pd.product_language = '" . $sLanguage . "' ";

            if (empty($bCount)) {
                $query .= " GROUP BY `pi`.`product_id` ";
            }
            if (!empty($aOrderby)) {
                $query .= " ORDER BY ";
                foreach ($aOrderby as $key => $order) {
                    $query .= " " . $key . " " . $order . " ";
                }
            } else {
                $query .= " ORDER BY `pd`.`product_name` ASC";
            }
//            if (!empty($iLimit) && isset($iOffset)) {
//                $query .= " LIMIT " . $iOffset . " ," . $iLimit . " ";
//            }
            //var_dump($query);
            $results = $this->_rDb->query($query);
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Do pobierania szczegołów produktu dla aplikacji (podglad produktu)
     * @param integer $iCategoryId
     * @param string $sLanguage
     * @return ErrorReporting
     */
    public function GetProductDetails($iProductId, $sLanguage = NULL) {
        try {
            if (!isset($sLanguage)) {
                $sLanguage = $this->_aLanguage;
            }
            $this->_rDb
                    ->select('p.*,st.*, p.active AS product_active, pd.*, ptc.*, prod.*, psd.*, sps.*')
                    ->from(table::SHOP_PRODUCTS . ' AS p')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS pd', 'pd.product_id', 'p.id_product')
                    ->join(table::SHOP_TAXES . ' AS st', 'st.id_tax', 'p.tax_id')
                    ->join(table::SHOP_PRODUCTS_TO_CATEGORIES . ' AS ptc', 'ptc.product_id', 'p.id_product')
                    ->join(table::SHOP_PRODUCERS . ' AS prod', 'prod.id_producer', 'p.producer_id', 'LEFT')
                    ->join(table::SHOP_PRODUCTS_STATUSES_DESCRIPTION . ' AS psd', 'psd.product_status_id', 'p.product_status_id', 'LEFT')
                    ->join(table::SHOP_PRODUCTS_STATUSES . ' AS sps', 'sps.id_product_status', 'p.product_status_id', 'LEFT')
                    ->where(array('id_product' => $iProductId));
            if (!empty($sLanguage)) {
                $this->_rDb->where(array('product_language' => $sLanguage));
            }
            //->limit(1)
            $this->_rDb->orderby('product_language', 'DESC')->limit(1);
            $results = $this->_rDb->get();

            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetProductMainImage($iProductId) {
        try {
            $results = $this->_rDb->from(table::SHOP_PRODUCTS_IMAGES)
                    ->where(array('product_id' => $iProductId, 'mainimage' => 'Y'))
                    ->get();
            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductComments($iProductId) {
        try {
            $results = $this->_rDb->orderby(array('id_product_comment' => 'DESC'))->getwhere(table::SHOP_PRODUCTS_COMMENTS, array('product_id' => $iProductId));
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductCategory($iProductId) {
        try {
            $iProductId+=0;
            $results = $this->_rDb
                    ->limit(1)
                    ->join(table::SHOP_PRODUCTS_TO_CATEGORIES . ' AS ptc', 'c.id_category', 'ptc.category_id', 'INNER')
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER')
                    ->getwhere(table::SHOP_CATEGORIES . ' AS c', array('product_id' => $iProductId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     * Pobieranie kategorii dla breadcrumba
     * @author Hubert Kulczak
     * @param Integer $iProductId
     * @return
     */
    public function GetProductCategories($iProductId) {
        try {
            $iProductId+=0;
            $categories = $this->_rDb->from(table::SHOP_CATEGORIES)->get();
            $cats = $this->GetProductCategory($iProductId)->Value;
            $aCats = array($cats[0]->category_id);
            $this->_GetCategoriesTreeAsArray($cats[0]->parent_category_id, $categories, $aCats);

            $result = $this->_rDb->from(table::SHOP_CATEGORIES)
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION, 'category_id', 'id_category')
                    ->in('category_id', $aCats)
                    ->where(array('category_language' => $this->_aLanguage))
                    ->orderby('level', 'ASC')
                    ->get();
            //var_dump($aCats);
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Tworzy array kategorii
     * @param Integer $iCategoryId
     * @param Array $categories
     * @param Array $aCats - Tablica z pasujacymi kategoriami
     */
    private function _GetCategoriesTreeAsArray($iCategoryId, &$categories, &$aCats) {
        try {

            $tmpCat = array();
            foreach ($categories as $cat) {
                if ($cat->id_category == $iCategoryId) {
                    $aCats[] = $cat->id_category;
                    $this->_GetCategoriesTreeAsArray($cat->parent_category_id, $categories, $aCats);
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     */
    public function GetProductDiscount($iProductId) {
        
    }

    /**
     * Pobieranie zdjec dla produktu
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductImages($iProductId, $product_only = false) {
        try {
            $this->_rDb->from(table::SHOP_PRODUCTS_IMAGES)
                    ->orderby(array('mainimage' => 'ASC'))
                    ->where(array('product_id' => $iProductId));
            if ($product_only == true) {
                $this->_rDb->where(array('variant_id' => null));
            }
            $results = $this->_rDb->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductAttachments($iProductId) {
        try {
            $results = $this->_rDb->orderby(array('id_product_image' => 'DESC'))->getwhere(table::SHOP_PRODUCTS_IMAGES, array('product_id' => $iProductId));
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductAttributes($iProductId) {
        try {
            //$results = $this->_rDb->orderby(array('attribute_id' => 'ASC'))->getwhere(table::SHOP_PRODUCTS_ATTRIBUTES, array('product_id' => $iProductId));
            $results = $this->_rDb
                    ->orderby(array(table::SHOP_PRODUCTS_ATTRIBUTES . '.attribute_id' => 'ASC'))
                    ->getwhere(table::SHOP_PRODUCTS_ATTRIBUTES, array('product_id' => $iProductId));
            //echo $this->_rDb->last_query();
//            var_dump($results);exit;
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetAttributesForProduct($iProductId, $bAll = null) {
        try {
            //$results = $this->_rDb->orderby(array('attribute_id' => 'ASC'))->getwhere(table::SHOP_PRODUCTS_ATTRIBUTES, array('product_id' => $iProductId));
            // pobieramy jakie atrybuty ma ten produkt (ogolnie zeby miec nazwy)
            $results = $this->_rDb->from(table::SHOP_PRODUCTS_ATTRIBUTES)
                    ->select('*, ' . table::SHOP_PRODUCTS_ATTRIBUTES . '.attribute_id AS attr_id')
                    ->orderby(array(table::SHOP_ATTRIBUTES . '.position' => 'DESC'))
                    ->groupby(table::SHOP_PRODUCTS_ATTRIBUTES . '.attribute_id')
                    ->join(table::SHOP_ATTRIBUTES_DESCRIPTION, table::SHOP_ATTRIBUTES_DESCRIPTION . '.attribute_id', table::SHOP_PRODUCTS_ATTRIBUTES . '.attribute_id', 'LEFT')
                    ->join(table::SHOP_ATTRIBUTES, table::SHOP_ATTRIBUTES . '.id_attribute', table::SHOP_PRODUCTS_ATTRIBUTES . '.attribute_id', 'LEFT')
                    ->where(array('product_id' => $iProductId))
                    ->get();
            //echo $this->_rDb->last_query();
            if (!empty($bAll)) {
                $aAttrs = array();
                foreach ($results as $r) {
                    $aAttrs[$r->attribute_id] = $this->GetProductAttributeValues2($r->attribute_id, $iProductId)->Value;
                }
                //var_dump($aAttrs);exit;
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, $aAttrs, '');
            }
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
//                echo '<pre>';
//                var_dump($aAttrs);
//                echo '</pre>';
//            var_dump($results);exit;
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductsParameters($args = null) {
        try {
            $results = $this->_rDb->from(table::SHOP_PRODUCTS)->get();
            $aProducts = array();
            foreach ($results as $result) :
                $aProducts[$result->id_product] = $this->GetProductParameters($result->id_product, $args)->Value;
            endforeach;
            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, $aProducts);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductParameters($iProductId, $args = null) {
        try {
            $this->_rDb->from(table::SHOP_PRODUCT_PARAMETERS . ' AS pp ')
                    ->join(table::SHOP_PARAMETERS_DESCRIPTION, table::SHOP_PARAMETERS_DESCRIPTION . '.parameter_id', 'pp.parameter_id')
                    ->orderby(array('product_id' => 'DESC'))
                    ->where(array('product_id' => $iProductId));
            if (!empty($args)) {
                $this->_rDb->in('pp.parameter_id', $args);
            }
            $results = $this->_rDb->get();
            //print_r($this->_rDb->last_query());
            return new ErrorReporting(ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     * @author Hubert Kulczak
     * Pobiera produkt polecany
     * @param Integer $iCategoryId
     * @return ErrorReporting
     */
    public function GetRecommendedProduct($iCategoryId = null, $limit = null) {
        try {
            $iCategoryId+=0;
            $query = "SELECT COUNT(id_product) AS count FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`) ";

            if (!empty($iCategoryId)) {
                $query .= " JOIN " . table::SHOP_PRODUCTS_TO_CATEGORIES . " AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`) ";
            }
            $query .= " WHERE recommend = 'Y' AND p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "'  ";
            if (!empty($iCategoryId)) {
                $query .= " AND ptc.category_id = '" . $iCategoryId . "' ";
            }
            $count = $this->_rDb->query($query);

            $query = "SELECT * FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`) ";

            if (!empty($iCategoryId)) {
                $query .= " JOIN " . table::SHOP_PRODUCTS_TO_CATEGORIES . " AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`) ";
            }
            $query .= " WHERE recommend = 'Y' AND p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "'  ";
            if (!empty($iCategoryId)) {
                $query .= " AND ptc.category_id = '" . $iCategoryId . "' ";
            }
            if (!empty($limit)) {
                $query .= " LIMIT 0, " . $limit;
            }
            $query .= " ORDER BY `product_position` DESC";

            $results = $this->_rDb->query($query);


            if (!empty($count[0]->count)) {
                $iKey = mt_rand(0, $count[0]->count - 1);
                $result = $results[$iKey];
            } else {
                $result = false;
            }


            return new ErrorReporting(ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetProductsInPromotion() {
        try {
            $result = $this->_rDb->from(table::SHOP_PRODUCTS)->where(array('old_price >' => 0))->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetPromotedProduct($iCategoryId = null) {
        try {
            $iCategoryId+=0;
            $query = "SELECT COUNT(id_product) AS count FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`) ";

            if (!empty($iCategoryId)) {
                $query .= " JOIN " . table::SHOP_PRODUCTS_TO_CATEGORIES . " AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`) ";
            }
            $query .= " WHERE (promotion_price IS NOT NULL AND promotion_price > 0.00) AND p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "'  ";
            if (!empty($iCategoryId)) {
                $query .= " AND ptc.category_id = '" . $iCategoryId . "' ";
            }
            $count = $this->_rDb->query($query);

            $query = "SELECT * FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`) ";

            if (!empty($iCategoryId)) {
                $query .= " JOIN " . table::SHOP_PRODUCTS_TO_CATEGORIES . " AS `ptc` ON (`ptc`.`product_id` = `p`.`id_product`) ";
            }
            $query .= " WHERE (promotion_price IS NOT NULL AND promotion_price > 0.00) AND p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "'  ";
            if (!empty($iCategoryId)) {
                $query .= " AND ptc.category_id = '" . $iCategoryId . "' ";
            }

            $results = $this->_rDb->query($query);
            //var_dump($results);
            if (!empty($count[0]->count)) {
                $iKey = mt_rand(0, $count[0]->count - 1);
                $result = $results[$iKey];
            } else {
                $result = false;
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetRelatedProducts($iProductId, $limit = null) {
        if (!empty($limit)) {

            $result = $this->_rDb->query("SELECT spd.product_id, product_name, related_product_id FROM " . table::SHOP_PRODUCTS_DESCRIPTION . " spd INNER JOIN " . table::SHOP_RELATED_PRODUCTS . " srp ON srp.related_product_id = spd.product_id AND srp.product_id = {$iProductId} AND spd.product_language = 'pl_PL' LIMIT {$limit}");
        } else {
            $result = $this->_rDb->query("SELECT spd.product_id, product_name, related_product_id FROM " . table::SHOP_PRODUCTS_DESCRIPTION . " spd INNER JOIN " . table::SHOP_RELATED_PRODUCTS . " srp ON srp.related_product_id = spd.product_id AND srp.product_id = {$iProductId} AND spd.product_language = 'pl_PL'");
        }
        return new ErrorReporting(ErrorReporting::SUCCESS, $result);
    }

    /**
     * @param Integer $iCategoryId
     * @return String
     */
    public function GetAlsoLiked($iCategoryId, $iProductId = NULL) {
        try {
            $aIn['category_id'] = $this->GetProductsForCategory($iCategoryId)->Value;
            $oProducts = $this->GetProductListing(array('id_product!' => $iProductId), $this->_aLanguage, $aIn, 5)->Value;
            return new ErrorReporting(ErrorReporting::SUCCESS, $oProducts);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Do pobierania produktów z kategorii i wszystkich jej podleglych
     * 
     * @param Integer $iCategoryId
     * @return String
     */
    public function GetProductsForCategory($iCategoryId) {
        try {
            $aCats = array($iCategoryId);
            $result = $this->_rDb->from(table::SHOP_CATEGORIES)->get();
            foreach ($result as $val) {
                $tmp[] = $val;
            }
            $this->GetSubcategoriesForCategory($iCategoryId, $result, $aCats);
            return new ErrorReporting(ErrorReporting::SUCCESS, $aCats);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param Integer $catId
     * @param Reference to String $html
     * @param Reference to Array $categories
     */
    public function GetSubcategoriesForCategory($catId, &$categories, &$aCats) {
        try {
            $tmpCat = array();
            foreach ($categories as $cat) {
                if ($cat->parent_category_id == $catId) {
                    $tmpCat[] = $cat;
                }
            }
            foreach ($tmpCat as $cat) {
                if ($cat->parent_category_id >= 0) {
                    $aCats[] = $cat->id_category;
                    $this->GetSubcategoriesForCategory($cat->id_category, $categories, $aCats);
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Pobiera produkty dla widoku kategorii
     * @param Integer $iCategoryId
     * @param String $sFilter (jako IdProducenta:SortujPo:IlWynikow)
     * @return ErrorReporting
     */
    public function GetProductsForCategories($iCategoryId, $iPage, $sFilter = null, $bCount = null) {
        try {
            $iCategoryId+=0;
            // pobieramy kategorie dla produktow (wybrana i wszystkie ponizej)
            $aIn['category_id'] = $this->GetProductsForCategory($iCategoryId)->Value;
            $aData = array();
            $aOrderby = array();
            $iLimit = self::PRODUCTS_LIMIT;

            if (!empty($sFilter)) {
                if (!empty($sFilter['filter_producers'])) {
                    $aData['producer_id'] = $sFilter['filter_producers'];
                }
                if (!empty($sFilter['filter_prices'])) {
                    switch ($sFilter['filter_prices']) {
                        case 'cd':
                            $aOrderby = array('price' => 'DESC');
                            break;
                        case 'ca':
                            $aOrderby = array('price' => 'ASC');
                            break;
                    }
                }

                if (!empty($sFilter['filter_name'])) {
                    switch ($sFilter['filter_name']) {
                        case 'cd':
                            $aOrderby = array('product_name' => 'DESC');
                            break;
                        case 'ca':
                            $aOrderby = array('product_name' => 'ASC');
                            break;
                    }
                }

                if (!empty($sFilter['filter_results'])) {
                    $iLimit = $sFilter['filter_results']; // TODO: to sprawdzenie czy nie wpisano jakiejs dziwnej liczby jako limit
                }
            }
            $iOffset = ($iPage - 1) * $iLimit;
            if (!empty($bCount)) {
                $iLimit = false;
                $iOffset = false;
            }
            $oProducts = $this->GetProductListing($aData, $this->_aLanguage, $aIn, $iLimit, $iOffset, $aOrderby, $bCount)->Value;

            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $oProducts, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     */
    public function AddComment($data) {
        try {
            unset($data['submit']);
            $results = $this->_rDb->insert(
                    table::SHOP_PRODUCTS_COMMENTS, array(
                'product_id' => $iProductId,
                'nick' => $data['nick'],
                'content' => $data['content'],
                'ip' => $data['ip'],
                'email' => $data['email'],
                'www' => $data['www'],
                'content_hash' => md5($data['content'])
                    )
            );
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param string $sColumn
     * @param string $sLanguage
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductLanguageValue($sColumn, $sLanguage, $iProductId) {
        try {
            $results = $this->_rDb->select($sColumn)->limit(1)->getwhere(table::SHOP_PRODUCTS_DESCRIPTION, array('product_id' => $iProductId, 'product_language' => $sLanguage));
            if ($results->count() > 0) {
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, $results[0]->$sColumn);
            } else {
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, Kohana::lang('product.error_while_updating_translation'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param string $sColumn
     * @param integer $iProductId
     * @param string $sLanguage
     * @param string $sValue
     * @return ErrorReporting
     */
    public function SetProductLanguageValue($sColumn, $sLanguage, $iProductId, $sValue) {
        try {
            if ($this->_translationExists($iProductId, $sLanguage)->Value == true) {
                $results = $this->_rDb->update(
                        table::SHOP_PRODUCTS_DESCRIPTION, array($sColumn => $sValue), array('product_id' => $iProductId, 'product_language' => $sLanguage)
                );
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, $results, Kohana::lang('product.translation_updated'));
            } else {
                $results = $this->_rDb->insert(
                        table::SHOP_PRODUCTS_DESCRIPTION, array('product_id' => $iProductId, 'product_language' => $sLanguage, $sColumn => $sValue)
                );
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, $results, Kohana::lang('product.translation_inserted'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param string $sLanguage
     * @return ErrorReporting
     */
    private function _translationExists($iProductId, $sLanguage) {
        try {
            if ($this->_rDb->count_records(table::SHOP_PRODUCTS_DESCRIPTION, array('product_id' => $iProductId, 'product_language' => $sLanguage)) > 0) {
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, true, '');
            } else {
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, false, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetCommentDetails($iCommentId) {
        try {
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_PRODUCTS_COMMENTS, array('id_product_comment' => $iCommentId)));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     * Pobiera produkty w promocji
     * @author Hubert Kulczak
     * @param integer $iLimit
     * @return ErrorReporting
     */
    public function GetProductPromotions($iLimit) {
        try {
            $query = "SELECT p.id_product FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            WHERE p.old_price IS NOT NULL AND pd.product_language = '" . $this->_aLanguage . "' AND p.active = 'Y'
            ";
            $results = $this->_rDb->query($query);
            $ids = array();
            foreach ($results as $r) {
                $ids[] = $r->id_product;
            }

            $shuffle = shuffle($ids);
            $aWhereIn = array_slice($ids, 0, 4);
            if (count($aWhereIn) == 0) {
                $aWhereIn = array(0);
            }
            $query = "SELECT * FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`)
            WHERE p.old_price IS NOT NULL AND pd.product_language = '" . $this->_aLanguage . "' AND p.active = 'Y'
            AND p.id_product IN (" . implode(',', $aWhereIn) . ")
            LIMIT 0, " . $iLimit . " ";
            $results = $this->_rDb->query($query);
            $aPromotions = array();
            foreach ($results as $r) {
                $aPromotions[] = $r;
            }

            shuffle($aPromotions);
            return new ErrorReporting(ErrorReporting::SUCCESS, $aPromotions);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iParameterId
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductParameterValues($iParameterId, $iProductId) {
        try {
            $sql = sprintf("SELECT * FROM " . (table::SHOP_PARAMETERS) . " AS sp LEFT JOIN " . (table::SHOP_PRODUCT_PARAMETERS) . " AS spp ON spp.parameter_id = sp.id_parameter  WHERE parameter_id = %s AND product_id = %s", $iParameterId + 0, $iProductId + 0);
            //Kohana::log('error', $sql);
            $results = $this->_rDb->query($sql);
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetCategoryByProductId($iProductId) {
        $iProductId += 0;
        try {
            $result = $this->_rDb->getwhere(table::SHOP_PRODUCTS_TO_CATEGORIES, array('product_id' => $iProductId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product.get_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.get_category_products_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param integer $iCategoryId
     * @return ErrorReporting
     */
    public function GetProductByCategoryId($iCategoryId) {
        $iCategoryId += 0;
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->getwhere(table::SHOP_PRODUCTS_TO_CATEGORIES, array('category_id' => $iCategoryId)), Kohana::lang('product.get_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product.get_category_products_error'));
        }
    }

    /**
     *
     * @param integer $iAttributeId
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductAttributeValues($iAttributeId, $iProductId) {
        try {
//            $this->_rDb->from(table::SHOP_ATTRIBUTES_VALUES)
//                    ->join(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION.'.attribute_value_id', table::SHOP_ATTRIBUTES_VALUES.'.id_attribute_value')
//                    ->join()
            $sql = "SELECT av.attribute_id AS attr_id, av.*, avd.*, pa.* FROM " . table::SHOP_ATTRIBUTES_VALUES . " AS av
                JOIN " . table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION . " AS avd ON avd.attribute_value_id = id_attribute_value
                LEFT JOIN (SELECT * FROM " . table::SHOP_PRODUCTS_ATTRIBUTES . " WHERE product_id = '" . $iProductId . "') AS pa ON avd.attribute_value_id = pa.attribute_value_id
                WHERE av.attribute_id = '" . $iAttributeId . "'";
            $results = $this->_rDb->query($sql);
            //echo $this->_rDb->last_query();
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iAttributeId
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductAttributeValues2($iAttributeId, $iProductId) {
        try {
//            $this->_rDb->from(table::SHOP_ATTRIBUTES_VALUES)
//                    ->join(table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION, table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION.'.attribute_value_id', table::SHOP_ATTRIBUTES_VALUES.'.id_attribute_value')
//                    ->join()
            $sql = "SELECT av.attribute_id AS attr_id, av.*, avd.*, ava.*, pa.* FROM " . table::SHOP_ATTRIBUTES_VALUES . " AS av
                JOIN " . table::SHOP_ATTRIBUTES_VALUES_DESCRIPTION . " AS avd ON avd.attribute_value_id = id_attribute_value
                JOIN " . table::SHOP_ATTRIBUTES_VALUES_ADDITIONAL . " AS ava ON ava.attribute_value_id = id_attribute_value
                JOIN (SELECT * FROM " . table::SHOP_PRODUCTS_ATTRIBUTES . " WHERE product_id = '" . $iProductId . "') AS pa ON avd.attribute_value_id = pa.attribute_value_id
                WHERE av.attribute_id = '" . $iAttributeId . "' ORDER BY av.position DESC";
            $results = $this->_rDb->query($sql);
//            echo $this->_rDb->last_query();
//            exit;
            return new ErrorReporting(
                    ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    /**
     * @Do wyswietlania ceny jesli ma byc z opcja ceny promocyjnej
     * @param double $dOldPrice
     * @param double $dPrice
     * @return ErrorReporting
     */
    public static function PromotionPrice($dOldPrice, $dPrice) {
        try {

            $html = '';
            if (!empty($dOldPrice)) {
                $html .= '<span style="text-decoration:line-through;">' . number_format($dOldPrice, 2) . '</span> ' . number_format($dPrice, 2);
            } else {
                $html .= number_format($dPrice, 2);
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $html);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductPrice($iProductId) {
        try {
            $result = $this->_rDb->limit(1)->select('price, old_price')->getwhere(table::SHOP_PRODUCTS, array('id_product' => $iProductId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->price);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     */
    public function GetProductName() {
        try {
            if (!empty($this->_sProductName)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_sProductName);
            }
            return new ErrorReporting(ErrorReporting::WARNING, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     */
    public function GetProductDescription() {
        try {
            if (!empty($this->_sProductDescription)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_sProductDescription);
            }
            return new ErrorReporting(ErrorReporting::WARNING, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetProductImagesListForAllegro() {
        try {
            if (count($this->_aProductImages) > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $this->_aProductImages);
            }
            return new ErrorReporting(ErrorReporting::WARNING, array());
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * @author Hubert Kulczak
     * @param Integer $iCustomerId
     * @param Integer $iProductId
     * @return ErrorReporting
     */
    public function AddToFav($iCustomerId, $iProductId) {
        try {
            $iProductId+=0;
            $iCustomerId+=0;
            if (!empty($iCustomerId) && !empty($iProductId)) {
                $aWhere = array('customer_id' => $iCustomerId, 'product_id' => $iProductId);
                //sprawdzamy czy juz nie jest dodane do ulubionych
                $count = $this->_rDb->from(table::SHOP_FAVOURITES_CUSTOMERS_PRODUCTS)
                        ->where($aWhere)
                        ->select('COUNT(*) AS count')
                        ->get();
                if ($count[0]->count > 0) { // produkt juz jest w ulubionych
                    return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('product.validation.product_in_fav_exist'));
                } else { // dodajemy
                    $this->_rDb->insert(table::SHOP_FAVOURITES_CUSTOMERS_PRODUCTS, $aWhere);
                    return new ErrorReporting(ErrorReporting::SUCCESS, false, Kohana::lang('product.validation.success_add_to_fav'));
                }
            } else if (empty($iCustomerId)) {
                return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('product.validation.customer_not_logged'));
            } else {
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('product.validation.error_add_to_fav'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetFavs($iCustomerId) {
        try {
            $iCustomerId+=0;
            if (!empty($iCustomerId)) {
                $result = $this->_rDb->from(table::SHOP_FAVOURITES_CUSTOMERS_PRODUCTS)
                        ->where(array('customer_id' => $iCustomerId))
                        ->get();
                $aIn = array();
                foreach ($result as $r) {
                    $aIn['id_product'][] = $r->product_id;
                }
                $result = $this->GetProductListing(false, $this->_aLanguage, $aIn)->Value;
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('product.validation.customer_not_logged'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param integer $iProductId
     * @return ErrorReporting
     */
    public function GetProductTags($iProductId) {
        try {
            $iProductId+=0;
            if (!empty($iProductId)) {
                $result = $this->_rDb
                        ->join(table::SHOP_PRODUCTS_TAGS_DICT . ' AS td', 'td.id_tag_dict', 't.tag_dict_id', 'INNER')
                        ->getwhere(table::SHOP_PRODUCTS_TAGS . ' AS t', array('product_id' => $iProductId));
                return new ErrorReporting(ErrorReporting::SUCCESS, $result);
            } else {
                return new ErrorReporting(ErrorReporting::INFO, false, Kohana::lang('product.validation.customer_not_logged'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param int $iProductId
     * @return ErrorReporting 
     */
    public function IncrementProductViewed($iProductId) {
        try {
            $iProductId+=0;
            $result = $this->_rDb->query('UPDATE ' . table::SHOP_PRODUCTS . ' SET times_viewed = times_viewed + 1 WHERE id_product = ' . $iProductId);
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Dodawanie produktów do ostatnio oglądanych
     * @param type $iProductId
     * @return \ErrorReporting
     */
    public function RecentlyViewedProductSave($iProductId) {
        try {
            if (empty($_SESSION['recently-viewed'])) {
                $_SESSION['recently-viewed'] = array();
            }
            $_SESSION['recently-viewed'][] = $iProductId;
            $_SESSION['recently-viewed'] = array_unique($_SESSION['recently-viewed']);
            return new ErrorReporting(ErrorReporting::SUCCESS, $_SESSION['recently-viewed']);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetMaxProductQuantities() {
        try {
            $result = $this->_rDb->query('SELECT MAX(quantity) as max_quantity FROM ' . table::SHOP_PRODUCTS . ' LIMIT 1');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->max_quantity);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetMaxProductPrice() {
        try {
            $result = $this->_rDb->query('SELECT MAX(price) as max_price FROM ' . table::SHOP_PRODUCTS . ' LIMIT 1');
            return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->max_price);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param int $count
     * @return ErrorReporting
     */
    public function GetLatestProjectsForHomepage($count = 3) {
        try {
            $result = $this->_rDb->from(table::SHOP_PRODUCTS . ' AS p')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS pd', 'pd.product_id', 'p.id_product', 'INNER')
                    ->join(table::SHOP_PRODUCTS_TO_CATEGORIES . ' AS ptc', 'ptc.product_id', 'p.id_product', 'INNER')
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'ptc.category_id', 'INNER')
                    ->join(table::SHOP_PRODUCTS_IMAGES, 'p.id_product', table::SHOP_PRODUCTS_IMAGES . '.product_id', 'LEFT')
//					->join(table::SHOP_PRODUCT_PARAMETERS, table::SHOP_PRODUCT_PARAMETERS.'.product_id', 'p.id_product', 'LEFT')
//					->join(table::SHOP_PARAMETERS_DESCRIPTION, table::SHOP_PARAMETERS_DESCRIPTION.'.parameter_id', table::SHOP_PRODUCTS_PARAMETERS.'.parameter_id', 'LEFT')
                    ->orderby('p.id_product', 'DESC')
                    ->limit($count)
                    ->groupby('p.id_product')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('pages.success_insert_pages'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    public function GetLatestProducts($count = 3) {
        try {
            $aCategories = array();
            $categories = $this->_rDb->from(table::SHOP_PRODUCTS_TO_CATEGORIES)
                    ->select('category_id')
                    ->groupby('category_id')
                    ->get();
            foreach ($categories as $category) {
                $result = $this->_rDb->from(table::SHOP_PRODUCTS . ' AS p')
                        ->join(table::SHOP_PRODUCTS_DESCRIPTION . ' AS pd', 'pd.product_id', 'p.id_product', 'INNER')
                        ->join(table::SHOP_PRODUCTS_TO_CATEGORIES . ' AS ptc', 'ptc.product_id', 'p.id_product', 'INNER')
                        ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'ptc.category_id', 'INNER')
                        ->join(table::SHOP_PRODUCTS_IMAGES, 'p.id_product', table::SHOP_PRODUCTS_IMAGES . '.product_id', 'LEFT')
//					->join(table::SHOP_PRODUCT_PARAMETERS, table::SHOP_PRODUCT_PARAMETERS.'.product_id', 'p.id_product', 'LEFT')
//					->join(table::SHOP_PARAMETERS_DESCRIPTION, table::SHOP_PARAMETERS_DESCRIPTION.'.parameter_id', table::SHOP_PRODUCTS_PARAMETERS.'.parameter_id', 'LEFT')
                        ->orderby('p.id_product', 'DESC')
                        ->limit($count)
                        ->where(array('ptc.category_id' => $category->category_id))
                        ->groupby('p.id_product')
                        ->get();
                $aCategories[$category->category_id] = $result;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aCategories, Kohana::lang('pages.success_insert_pages'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    /**
     *
     * @param int $iParameterId
     * @param int $iProductId
     * @return ErrorReporting
     */
    public function ParameterValueExists($iParameterId, $iProductId) {
        try {
            $iProductId+=0;
            $result = $this->_rDb->count_records(table::SHOP_PRODUCT_PARAMETERS, array('product_id' => $iProductId, 'parameter_id' => $iParameterId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result > 0 ? true : false);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     *
     * @param int $iProductId
     * @return ErrorReporting
     */
    public function GetProductFiles($iProductId) {
        try {
            $iProductId+=0;
            $result = $this->_rDb->getwhere(table::SHOP_PRODUCTS_FILES, array('product_id' => $iProductId));
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Liczenie ilości produktów w koszyku (wykorzystywane np w headerze)
     * @param array $aCart
     * @return ErrorReporting 
     */
    public function CountProductsInCart($aCart) {
        try {
            // TODO: odkomentować poniższe linijki jeśli ilosc ma znaczenie
            $allProducts = 0;
            foreach ($aCart as $allProd) {

                $allProducts += $allProd['count'];
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $allProducts);
//            return new ErrorReporting(ErrorReporting::SUCCESS, count($aCart));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    /**
     * Obliczanie wartości produktów w koszyku (dla headera)
     * @param array $aCart
     * @return ErrorReporting
     */
    public function CountCartCost($aCart, $bRabate = NULL) {
        try {
            $sum = 0.0;
            if (count($aCart)) {
                foreach ($aCart as $product) {
                    //rabat
                    if (!empty($product['rebate']) && $bRabate === TRUE) {
                        $sum += ( ($product['price'] - ($product['price'] * ($product['rebate'] / 100))) * $product['count']);
                    } else {
                        // TODO: odkomentować poniższe linijki jeśli ilosc ma znaczenie
                        $sum += ( $product['price'] * $product['count']);
                    }
//                    $sum += ( $product['price'] * 1);
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $sum);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas obliczania wartości produktów w koszyku.');
        }
    }

    /**
     * Obliczanie wartości produktów w koszyku z rabatem
     * @param array $aCart
     * @return ErrorReporting
     */
    public function CountCartRebate($aCart) {
        try {
            $sum = 0.0;
            if (count($aCart)) {
                foreach ($aCart as $product) {
                    // rabat
                    if (!empty($product['rebate'])) {
                        $sum += (($product['price'] * ($product['rebate'] / 100)) * $product['count']);
                    }
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $sum);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas obliczania wartości produktów w koszyku.');
        }
    }

    /**
     * Dodawanie do koszyka
     * @param array $aPost
     * @param integer $iProductId
     * @return ErrorReporting 
     */
    public function AddToBasket($aCartContent, $aPost, $iProductId) {
        try {
            //$aCartContent = array();
            if ((!empty($aPost['add_to_basket']) && !empty($aPost['id_product'])) || !empty($iProductId)) {
                $productId = !empty($aPost['id_product']) ? $aPost['id_product'] + 0 : $iProductId;
                $oProduct = $this->Find($productId)->Value;
                $productPrice = $this->GetProductPrice($productId)->Value;
                $productCounts = !empty($aPost['id_product']) ? !empty($aPost['count']) ? $aPost['count'] + 0 : 1 : 1;



                unset($aPost['id_product'], $aPost['add_to_basket']);
                $attributes = array();
                if (!empty($aPost['attribute'])) {
                    foreach ($aPost['attribute'] as $reqKey => $reqValue) {
                        //$attributes[$reqKey] = str_replace(' ', '@', $reqValue);
                        $attributes[$reqKey] = $reqValue;
                    }
                }

                // obliczamy ilość produktów - sprawdzamy czy ilość dodawany nie przekroczyla ilości dostępnych
                $this->_ProductCount($productId, $productCounts, $attributes);

                //echo Kohana::debug($aCartContent);
                //var_dump();
//                var_dump($this->_productInCart($aCartContent, $productId, $attributes) == true);
//                exit();
                // jeśli produkt już jest w koszyku i będziemy tylko zmieniać jego ilość
                if (!empty($aCartContent) && $this->_productInCart($aCartContent, $productId, $attributes) == true) {
                    $iProductsCount = count($aCartContent);
                    //for ($i = 0; $i < $iProductsCount; $i++) {
                    foreach ($aCartContent as $key => $value) {
                        if ($aCartContent[$key]['id_product'] == $productId && $this->_arraysEquals($aCartContent[$key]['attributes'], $attributes) === true) {
                            $productCount = $aCartContent[$key]['count'] + $productCounts;
                            // obliczamy ilość produktów - sprawdzamy czy łączna ilość nie przekroczyla ilości dostępnych
                            $this->_ProductCount($productId, $productCount, $attributes);
                            $aCartContent[$key]['count'] = (($productCount > 99) ? 99 : (($productCount < 0) ? 0 : $productCount));
                            $aCartContent[$key]['rebate'] = rebate_codes::GetProductRebate($productId);
                        }
                    }
                } else { // jesli produktu nie było jeszcze w koszyku
                    $aCartContent[] = array(
                        'id_product' => $productId,
                        'price' => $productPrice,
                        'count' => $productCounts,
                        'attributes' => $attributes,
                        'rebate' => rebate_codes::GetProductRebate($productId),
                        'voucher' => $oProduct[0]->voucher,
                    );
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aCartContent, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas dodawania produktu do koszyka.');
        }
    }

    private function _arraysEquals($arr1, $arr2) {
        if (!empty($arr1) && !empty($arr2)) {
            if (count($arr1) == count($arr2)) {
                $result = array_intersect($arr1, $arr2);
                if (count($arr1) == count($result)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
        return true;
    }

    /**
     *
     * @param array $sess
     * @param integer $id
     * @param array $attributes
     * @return boolean
     */
    private function _productInCart($sess, $id, $attributes = array()) {
        $returnvalue = false;
        if (!empty($sess)) {

            foreach ($sess as $ciKey => $ciValue) {
                if ($sess[$ciKey]['id_product'] == $id) { // produkt o tym id jest w koszyku                                        
                    $returnvalue = $this->_arraysEquals($sess[$ciKey]['attributes'], $attributes);
                    if ($returnvalue === true) {
                        return true;
                    }
                }
            }
        }
        return $returnvalue;
    }

    public function GetDetailsForProductsFromCart(&$aCartContent, $aLang) {
        try {
            //$aTmp = array();
            foreach ($aCartContent as $iKey => $aValue) {
                $oProductDetails = $this->GetProductDetails($aValue['id_product'], $aLang)->Value[0];
                $oProductImages = $this->GetProductImages($aValue['id_product'])->Value[0];
                $aCartContent[$iKey]['product_name'] = $oProductDetails->product_name;
                $aCartContent[$iKey]['product_short_description'] = $oProductDetails->product_short_description;
                $aCartContent[$iKey]['filename'] = !empty($oProductImages->filename) ? $oProductImages->filename : '';
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $aCartContent, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd podczas pobierania szczegółów produktów.');
        }
    }

    public function getProducenci() {
        //pobeira producentów tylko tych produktów, które są dostępne
        $res = $this->_rDb->select(table::SHOP_PRODUCERS . '.id_producer', table::SHOP_PRODUCERS . '.producer_name')
                ->from(table::SHOP_PRODUCTS)
                ->join(table::SHOP_PRODUCERS, 'id_producer', 'id_producer')
                ->where(table::SHOP_PRODUCTS . '.active', 1)
                ->groupby(table::SHOP_PRODUCERS . '.id_producer')
                ->orderby(table::SHOP_PRODUCERS . '.producer_name')
                ->get();

        $producers = array();
        $producers[''] = '';
        foreach ($res as $r) {
            $producers[$r->id_producer] = $r->producer_name;
        }

        return $producers;
    }

    public function GetNewsProduct($iNewsId, $limit = null) {
        try {
            $iNewsId+=0;
            /*
              $query = "SELECT COUNT(id_product) AS count FROM (" . table::SHOP_PRODUCTS . " AS `p`)
              LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
              INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`) ";

              if (!empty($iNewsId)) {
              $query .= " JOIN " . table::SHOP_PRODUCTS_TO_NEWS . " AS `ptn` ON (`ptn`.`product_id` = `p`.`id_product`) ";
              }
              $query .= " WHERE p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "'  ";
              if (!empty($iNewsId)) {
              $query .= " AND ptn.news_id = '" . $iNewsId . "' ";
              }
              $count = $this->_rDb->query($query);
             */

            $query = "SELECT * FROM (" . table::SHOP_PRODUCTS . " AS `p`)
            LEFT JOIN ( SELECT * FROM " . table::SHOP_PRODUCTS_IMAGES . " WHERE mainimage='Y') AS `pi` ON (`pi`.`product_id` = `p`.`id_product`)
            INNER JOIN " . table::SHOP_PRODUCTS_DESCRIPTION . " AS `pd` ON (`pd`.`product_id` = `p`.`id_product`) ";

            if (!empty($iNewsId)) {
                $query .= " JOIN " . table::SHOP_PRODUCTS_TO_NEWS . " AS `ptn` ON (`ptn`.`product_id` = `p`.`id_product`) ";
            }
            $query .= " WHERE p.active = 'Y' AND pd.product_language = '" . $this->_aLanguage . "'  ";
            if (!empty($iNewsId)) {
                $query .= " AND ptn.news_id = '" . $iNewsId . "' ";
            }
            if (!empty($limit)) {
                $query .= " LIMIT " . $limit;
            }

            $results = $this->_rDb->query($query);



            /*
              if (!empty($count[0]->count)) {
              $iKey = mt_rand(0, $count[0]->count - 1);
              $result = $results[$iKey];
              } else {
              $result = false;
              }
             */

            return new ErrorReporting(ErrorReporting::SUCCESS, $results);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetVariantsForProduct($iProductId) {
        try {
            $results = $this->_rDb->select(table::SHOP_PRODUCTS_IMAGES . '.*, ' . table::SHOP_PRODUCT_TO_VARIANT . '.*, ' . table::SHOP_PRODUCT_TO_VARIANT . '.variant_id AS id_variant')
                            ->from(table::SHOP_PRODUCT_TO_VARIANT)
                            ->join(table::SHOP_PRODUCTS_IMAGES, table::SHOP_PRODUCTS_IMAGES . '.variant_id', table::SHOP_PRODUCT_TO_VARIANT . '.variant_id', 'LEFT')
                            ->where(array(table::SHOP_PRODUCT_TO_VARIANT . '.product_id' => $iProductId))->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    public function GetVariantsByAttributes($post) {
        try {
            $results = $this->_rDb->from(table::SHOP_PRODUCT_TO_VARIANT)
                            ->join(table::SHOP_PRODUCTS_IMAGES, table::SHOP_PRODUCTS_IMAGES . '.variant_id', table::SHOP_PRODUCT_TO_VARIANT . '.variant_id')
                            ->where(array(table::SHOP_PRODUCT_TO_VARIANT . '.product_id' => $iProductId))->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

    public function DeleteVariant($id) {
        try {
            $id += 0;
            $this->_rDb->query('SET AUTOCOMMIT = 0');
            $this->_rDb->query('BEGIN');

            $oProductsImages = $this->_rDb->getwhere(table::SHOP_PRODUCTS_IMAGES, array('variant_id' => $id));

            foreach ($oProductsImages as $pi) {
                if (file_exists(shop::MEDIUM_PATH . $pi->filename)) {
                    if (unlink(shop::MEDIUM_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_medium_image_file'));
                    }
                }
                if (file_exists(shop::XMEDIUM_PATH . $pi->filename)) {
                    if (unlink(shop::XMEDIUM_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_medium_image_file'));
                    }
                }
                if (file_exists(shop::SMALL_PATH . $pi->filename)) {
                    if (unlink(shop::SMALL_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_small_image_file'));
                    }
                }
                if (file_exists(shop::XSMALL_PATH . $pi->filename)) {
                    if (unlink(shop::XSMALL_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_small_image_file'));
                    }
                }
                if (file_exists(shop::BIG_PATH . $pi->filename)) {
                    if (unlink(shop::BIG_PATH . $pi->filename) !== true) {
                        Kohana::log('error', Kohana::lang('product.cant_delete_big_image_file'));
                    }
                }
                $this->_rDb->delete(table::SHOP_PRODUCTS_IMAGES, array('id_image' => $pi->id_image));
            }

            $this->_rDb->delete(table::SHOP_PRODUCT_TO_VARIANT, array('variant_id' => $id));

            $this->_rDb->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('product.product_deleted_successfully'));
        } catch (Exception $ex) {
            $this->_rDb->query('ROLLBACK');
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    private function _ProductCount($iProductId, &$iCount, $aAttr = array()) {
        try {
            // sprawdzamy czy stany magazynowe są włączone
            if (shop_config::getConfig('product_stock') == 1) { // stany magazynowe właczone
                //pobieramy ilość produktu bez atrybutów
                $oProductStock = $this->_rDb->from(table::SHOP_PRODUCTS)
                        ->join(table::SHOP_PRODUCTS_DESCRIPTION, table::SHOP_PRODUCTS_DESCRIPTION . '.product_id', table::SHOP_PRODUCTS . '.id_product', 'LEFT')
                        ->where(array('id_product' => $iProductId, 'product_language' => $this->_aLanguage));

                if (!empty($aAttr)) { // jesli produkt ma atrybuty
                    $this->_rDb->join(table::SHOP_PRODUCT_TO_VARIANT, table::SHOP_PRODUCT_TO_VARIANT . '.product_id', table::SHOP_PRODUCTS . '.id_product', 'LEFT')
                            ->where(array('variant_values' => serialize($aAttr)));
                }

                $oProductStock = $this->_rDb->get();

                if (!empty($aAttr)) {
                    $iMaxStock = $oProductStock[0]->quantity;
                } else {
                    $iMaxStock = $oProductStock[0]->product_stock;
                }

                // sprawdzamy czy ilość produktów które klient chce kupić nie jest większa od ilości w magazynie
                if ($iCount > $iMaxStock) {
                    $this->_oSession->set('msg', '<div class="info">Produkt <strong>' . $oProductStock[0]->product_name . '</strong> nie jest dostępny wybranej ilości. Dostępna ilość: ' . $iMaxStock . '</div>');
                    $iCount = $iMaxStock;
                }
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GenerateVoucherCode() {
        try {
            $sToken = '';
            $sToken = Voucher_Model::GenerateUniqueToken($sToken);
            return new ErrorReporting(ErrorReporting::SUCCESS, $sToken, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, $ex->getMessage());
        }
    }

}
