<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Klasa Product_Category_Model służąca do zarządzania kategoriami produktów.
 *
 * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
 *
 */
class Product_Category_Model extends Model_Core {

    private $_rDb;
    private $_iId;
    private $_iParentCategoryId;
    private $thumbpath;
    private $path;
    private $thumbwidth;
    private $thumbheight;
    private $page_content_thumbpath;
    private $page_content_thumbwidth;
    private $page_content_thumbheight;
    private $_aLanguage;

    /**
     *
     * Konstruktor obiektu klasy Product_Category_Model
     *
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     */
    public function __construct($id = null) {
        parent::__construct();
        $this->_rDb = Database::instance();
        if (!empty($id)) {
            $this->_iId = $id + 0;
        }
        $this->_aLanguage = Kohana::config('locale.language');
        $this->thumbpath = pages_helper::SMALL_PATH;
        $this->path = pages_helper::BIG_PATH;
        $this->thumbwidth = pages_helper::THUMBWIDTH;
        $this->thumbheight = pages_helper::THUMBHEIGHT;
        $this->page_content_thumbpath = page_content_helper::SMALL_PATH;
        $this->page_content_thumbwidth = page_content_helper::THUMBWIDTH;
        $this->page_content_thumbheight = page_content_helper::THUMBHEIGHT;
    }

    /**
     *
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Insert(array $data, array $files) {
        try {
            //tablica files
            $uploadedFiles = null;
            if (!empty($files['images'])) {
                if (isset($files['images']['error']) && $files['images']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles = file::upload(
                                    $files['images'], array(
                                'unique' => true,
                                'width' => 800,
                                'height' => 600,
                                'mediumwidth' => 218,
                                'mediumheight' => 208,
                                'thumbwidth' => 80,
                                'thumbheight' => 80,
                                'path' => shop::PRODUCT_CATEGORY_BIG_PATH,
                                'mediumpath' => shop::PRODUCT_CATEGORY_MEDIUM_PATH,
                                'thumbpath' => shop::PRODUCT_CATEGORY_SMALL_PATH
                                    )
                    );
                }
            }
            if (!empty($files['image_filename_hover'])) {
                if (isset($files['image_filename_hover']['error']) && $files['image_filename_hover']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles = file::upload(
                                    $files['image_filename_hover'], array(
                                'unique' => true,
                                'mediumwidth' => 218,
                                'mediumheight' => 208,
                                'thumbwidth' => 80,
                                'thumbheight' => 80,
                                'mediumpath' => shop::PRODUCT_CATEGORY_HOVER_MEDIUM_PATH,
                                'thumbpath' => shop::PRODUCT_CATEGORY_SMALL_PATH
                                    )
                    );
                }
            }
            if (!empty($files['banner'])) {
                if (isset($files['banner']['error']) && $files['banner']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles2 = file::upload(
                                    $files['banner'], array(
                                'unique' => true,
                                'width' => 960,
                                'height' => 300,
                                'thumbwidth' => 100,
                                'thumbheight' => 10,
                                'path' => shop::PRODUCT_CATEGORY_BANNER_PATH,
                                'thumbpath' => shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH
                                    )
                    );
                }
            }
            //zebranie danych do tabeli shop_categories
            $aShopCategories['parent_category_id'] = $data['parent_category_id'];
            $aShopCategories['level'] = $this->_getCategoryLevel($data['parent_category_id'])->Value + 1;
            $aShopCategories['active'] = $data['active'];
            $aShopCategories['image_filename'] = !empty($uploadedFiles->Value['filename']) ? $uploadedFiles->Value['filename'] : null;
            $aShopCategories['banner'] = !empty($uploadedFiles2->Value['banner']) ? $uploadedFiles2->Value['banner'] : null;

            //insert dancych do tabeli shop categories
            $results = $this->_rDb->insert(table::SHOP_CATEGORIES, $aShopCategories);
            $iCategoryId = $results->insert_id();

            //zebranie danych do tabeli shop_category_description
            $aShopCategoriesDescription['category_id'] = $iCategoryId;
            $aShopCategoriesDescription['category_name'] = $data['category_name'];
            $aShopCategoriesDescription['category_language'] = $this->_aLanguage;

            //insert dancych do tabeli shop categories
            $results = $this->_rDb->insert(table::SHOP_CATEGORIES_DESCRIPTION, $aShopCategoriesDescription);
            /*
              if(!empty($data['name_en'])){
              $aShopCategoriesDescriptionEn['category_id'] = $iCategoryId;
              $aShopCategoriesDescriptionEn['category_name'] = $data['name_en'];
              $aShopCategoriesDescriptionEn['category_language'] = 'en_US';
              $results = $this->_rDb->insert(table::SHOP_CATEGORIES_DESCRIPTION, $aShopCategoriesDescriptionEn);
              } */

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('product_category.insert_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product_category.insert_product_category_error'));
        }
    }

    /**
     *
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @todo Należy przetestować dodawanie obrazków
     * @param integer $id
     * @param array $data
     * @param array $files
     * @return ErrorReporting
     */
    public function Update($id, array $data, array $files) {
        try {
            $id += 0;
            //tablica files
            $uploadedFiles = null;
            if (!empty($files['images']['tmp_name'])) {

                $currentFile = $this->_rDb->select('image_filename')->getwhere(table::SHOP_CATEGORIES, array('id_category' => $id));
                if (!empty($currentFile[0]->image_filename)) {
                    if (file_exists(shop::PRODUCT_CATEGORY_MEDIUM_PATH . $currentFile[0]->image_filename)) {
                        if (unlink(shop::PRODUCT_CATEGORY_MEDIUM_PATH . $currentFile[0]->image_filename) === false) {
                            Kohana::log('error', "Nie można usunąć pliku: [{$currentFile}]");
                        }
                    }
                    if (file_exists(shop::PRODUCT_CATEGORY_SMALL_PATH . $currentFile[0]->image_filename)) {
                        if (unlink(shop::PRODUCT_CATEGORY_SMALL_PATH . $currentFile[0]->image_filename) === false) {
                            Kohana::log('error', "Nie można usunąć pliku: [{$currentFile}]");
                        }
                    }
                }
                if (isset($files['images']['error']) && $files['images']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles = file::upload(
                                    $files['images'], array(
                                'unique' => true,
                                'width' => 800,
                                'height' => 600,
                                'mediumwidth' => 218,
                                'mediumheight' => 208,
                                'thumbwidth' => 80,
                                'thumbheight' => 80,
                                'path' => shop::PRODUCT_CATEGORY_BIG_PATH,
                                'mediumpath' => shop::PRODUCT_CATEGORY_MEDIUM_PATH,
                                'thumbpath' => shop::PRODUCT_CATEGORY_SMALL_PATH
                                    )
                    );
                }
                $aShopCategories['image_filename'] = !empty($uploadedFiles->Value['filename']) ? $uploadedFiles->Value['filename'] : null;
            }
            
            if (!empty($files['image_filename_hover']['tmp_name'])) {

                $currentFile = $this->_rDb->select('image_filename_hover')->getwhere(table::SHOP_CATEGORIES, array('id_category' => $id));
                if (!empty($currentFile[0]->image_filename_hover)) {
                    if (file_exists(shop::PRODUCT_CATEGORY_HOVER_MEDIUM_PATH . $currentFile[0]->image_filename_hover)) {
                        if (unlink(shop::PRODUCT_CATEGORY_HOVER_MEDIUM_PATH . $currentFile[0]->image_filename_hover) === false) {
                            Kohana::log('error', "Nie można usunąć pliku: [{$currentFile}]");
                        }
                    }
                    if (file_exists(shop::PRODUCT_CATEGORY_HOVER_SMALL_PATH . $currentFile[0]->image_filename_hover)) {
                        if (unlink(shop::PRODUCT_CATEGORY_HOVER_SMALL_PATH . $currentFile[0]->image_filename_hover) === false) {
                            Kohana::log('error', "Nie można usunąć pliku: [{$currentFile}]");
                        }
                    }
                }
                if (isset($files['image_filename_hover']['error']) && $files['image_filename_hover']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles = file::upload(
                                    $files['image_filename_hover'], array(
                                'unique' => true,
                                'mediumwidth' => 218,
                                'mediumheight' => 208,
                                'thumbwidth' => 80,
                                'thumbheight' => 80,
                                'mediumpath' => shop::PRODUCT_CATEGORY_HOVER_MEDIUM_PATH,
                                'thumbpath' => shop::PRODUCT_CATEGORY_HOVER_SMALL_PATH
                                    )
                    );
                }
                $aShopCategories['image_filename_hover'] = !empty($uploadedFiles->Value['filename']) ? $uploadedFiles->Value['filename'] : null;
            }

            if (!empty($files['banner']['tmp_name'])) {

                $currentFile = $this->_rDb->select('banner')->getwhere(table::SHOP_CATEGORIES, array('id_category' => $id));
                if (!empty($currentFile[0]->banner)) {
                    if (file_exists(shop::PRODUCT_CATEGORY_BANNER_PATH . $currentFile[0]->banner)) {
                        if (unlink(shop::PRODUCT_CATEGORY_BANNER_PATH . $currentFile[0]->banner) === false) {
                            Kohana::log('error', "Nie można usunąć pliku: [{$currentFile}]");
                        }
                    }
                    if (file_exists(shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH . $currentFile[0]->banner)) {
                        if (unlink(shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH . $currentFile[0]->banner) === false) {
                            Kohana::log('error', "Nie można usunąć pliku: [{$currentFile}]");
                        }
                    }
                }
                if (isset($files['banner']['error']) && $files['banner']['error'] != UPLOAD_ERR_NO_FILE) {
                    $uploadedFiles2 = file::upload(
                                    $files['banner'], array(
                                'unique' => true,
                                'width' => 960,
                                'height' => 300,
                                'thumbwidth' => 100,
                                'thumbheight' => 100,
                                'path' => shop::PRODUCT_CATEGORY_BANNER_PATH,
                                'thumbpath' => shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH
                                    )
                    );
                }
                $aShopCategories['banner'] = !empty($uploadedFiles2->Value['filename']) ? $uploadedFiles2->Value['filename'] : null;
            }



            //zebranie danych do tabeli shop_categories
            $aShopCategories['parent_category_id'] = $data['parent_category_id'];
            $aShopCategories['level'] = $this->_getCategoryLevel($data['parent_category_id'])->Value + 1;
            $aShopCategories['active'] = $data['active'];

            // usuniecie wszystkich powiazan miedzy tabelami kategorii i produktow
            $results = $this->_rDb->update(table::SHOP_CATEGORIES, $aShopCategories, array('id_category' => $id));
            //update danych do tabeli shop categories
            $results = $this->_rDb->update(table::SHOP_CATEGORIES, $aShopCategories, array('id_category' => $id));

            //zebranie danych do tabeli shop_category_description
            $aShopCategoriesDescription['category_name'] = $data['category_name'];

            //update dancych do tabeli shop categories

            $this->_rDb->update(table::SHOP_CATEGORIES_DESCRIPTION, $aShopCategoriesDescription, array('category_id' => $id, 'category_language' => $this->_aLanguage));
            /*
              //i description dla wersji en
              if(!empty($data['name_en'])){
              $aShopCategoriesDescriptionEn['category_name'] = $data['name_en'];
              $this->_rDb->update(table::SHOP_CATEGORIES_DESCRIPTION, $aShopCategoriesDescriptionEn, array('category_id' => $id, 'category_language' => 'en_US'));
              }
             */
            /*
              if(!empty($data['name_en'])){
              var_dump($this->_rDb->query("INSERT INTO ".table::SHOP_CATEGORIES_DESCRIPTION." (category_id, category_name, category_language)
              VALUES ('".$id."', '".$data['name_en']."','en_US')
              ON DUPLICATE KEY UPDATE
              category_id='".$id."', category_name='".$data['name_en']."', category_language='en_US'"));
              } */

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('product_category.update_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product_category.update_product_category_error'));
        }
    }

    public function ChangeCategoryStatus($iCategoryId) {
        try {
            $result = $this->_rDb->from(table::SHOP_CATEGORIES)->select('active')->where(array('id_category' => $iCategoryId))->get();
            if ($result[0]->active == 'Y') {
                $this->_rDb->update(table::SHOP_CATEGORIES, array('active' => 'N'), array('id_category' => $iCategoryId));
            } else {
                $this->_rDb->update(table::SHOP_CATEGORIES, array('active' => 'Y'), array('id_category' => $iCategoryId));
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('product_category.insert_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product_category.insert_product_category_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function GetParentCategory($iCategoryId) {
        try {
            $iCategoryId += 0;
            $results = $this->_rDb->from(table::SHOP_CATEGORIES)
                    ->where(array('id_category' => $iCategoryId))
                    ->get();
            if ($results->count() > 0) {
                return $results[0]->parent_category_id;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Hubert Kulczak <a href="mailto:hubert.kul@gmail.com">hubert.kul@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting (Integer id_product_category)
     */
    public function ProductAndCatsCheckForBrand($iBrandId) {
        try {
            $iBrandId += 0;
            $result = $this->_rDb->from(table::PRODUCTS_CATEGORIES)
                            ->where(array('related_page_id' => $iBrandId))->get();
            $count = $result->count();
            if ($count > 1) {  // jest wiecej kategorii wiec ok
                return new ErrorReporting(ErrorReporting::ERROR, $this->_GetCategoryIdForBrand($iBrandId)->Value, '');
            } else { // jesli jest tylko kategoria glowna tworzona przy tworzeniu strony dla marki
                // to sprawdzamy jeszcze czy sa w niej produkty
                if (!empty($result[0]->id_product_category)) {
                    $count_products = $this->_rDb->from(table::PRODUCTS)->select('COUNT(*) AS count_products')
                                    ->where(array('product_category_id' => $result[0]->id_product_category))->get();

                    // albo podkategorie
                    $count_subcategories = $this->_rDb->from(table::PRODUCTS_CATEGORIES)->select('COUNT(*) AS count_subcats')
                                    ->where(array('parent_product_category_id' => $result[0]->id_product_category))->get();

                    if ($count_products[0]->count_products > 0 || $count_subcategories[0]->count_subcats > 0) {
                        // sa produkty

                        return new ErrorReporting(ErrorReporting::ERROR, $this->_GetCategoryIdForBrand($iBrandId)->Value, '');
                    } else { // nie ma produktow to false
                        return new ErrorReporting(ErrorReporting::ERROR, false, '');
                    }
                } else {
                    return new ErrorReporting(ErrorReporting::ERROR, false, '');
                }
            }
            // w razie czego w kazdym innym wypadku(?) false
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * Pobiera kategorie
     * @author Hubert Kulczak
     * @param Array $aWhere
     * @return ErrorReporting
     */
    public function GetCategory($aWhere) {
        try {
            $result = $this->_rDb->from(table::SHOP_CATEGORIES)
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION, 'category_id', 'id_category')
                    ->where($aWhere)
                    ->where(array('category_language' => $this->_aLanguage))
                    ->limit(1)
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    public function GetCategories($orderBy = null, $lang = null, $iCategoryId = null) {
        try {
        /*    $this->_rDb->orderby(array('position' => 'DESC'));
            if (!empty($orderBy)) {
                $this->_rDb->orderby(array('parent_category_id' => 'ASC'));
            }
            if (!empty($lang)) {
                $this->_rDb->where(array('category_language' => $lang));
            }
            if ($iCategoryId != null) {
                $this->_rDb->where(array('parent_category_id' => $iCategoryId));
            } */
			
			
			$category_orderby="sc.position"; $kind="DESC";
			if(!empty($_GET['category_orderby']) && $_GET['category_orderby']==1){ $category_orderby="scd.category_name"; $kind="ASC";}
			else if(!empty($_GET['category_orderby']) && $_GET['category_orderby']==2){ $category_orderby="scd.category_name"; $kind="DESC";}
			
            $results = $this->_rDb->join(table::SHOP_CATEGORIES . ' AS sc', 'sc.id_category', 'scd.category_id', 'INNER')->groupby('category_id')->orderby($category_orderby, $kind)->get(table::SHOP_CATEGORIES_DESCRIPTION . ' AS scd'); 
            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     *
     * @param Integer $catId
     * @param Reference to String $html
     * @param Reference to Array $categories
     */
    public function GetCategoriesAsOption($catId, &$categories, $selectId = array()) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_category_id'] == $catId) {
                $tmpCat[] = $cat;
            }
        }
        foreach ($tmpCat as $cat) {
            if ($cat['parent_category_id'] >= 0) {
                if (in_array($cat['id_category'], $selectId)) {
                    $html .= '<option value="' . $cat['id_category'] . '" selected="selected">' . str_repeat('&rarr;', $cat['level'] - 1) . $cat['category_name'] . '</option>';
                    $html .= $this->GetCategoriesAsOption($cat['id_category'], $categories, $selectId);
                } else {
                    $html .= '<option value="' . $cat['id_category'] . '">' . str_repeat('&rarr;', $cat['level'] - 1) . $cat['category_name'] . '</option>';
                    $html .= $this->GetCategoriesAsOption($cat['id_category'], $categories, $selectId);
                }
            }
        }
        return $html;
    }

    public function DeleteCategoryImage($iCategoryId) {
        // pobieramy nazwe pliku
        $result = $this->db->from(table::SHOP_CATEGORIES)
                ->select('image_filename')
                ->where(array('id_category' => $iCategoryId))
                ->get();
        $sImageFilename = $result[0]->image_filename;

        if (file_exists(shop::PRODUCT_CATEGORY_SMALL_PATH . $sImageFilename)) {
            unlink(shop::PRODUCT_CATEGORY_SMALL_PATH . $sImageFilename);
        }
        if (file_exists(shop::PRODUCT_CATEGORY_MEDIUM_PATH . $sImageFilename)) {
            unlink(shop::PRODUCT_CATEGORY_MEDIUM_PATH . $sImageFilename);
        }

        // usuwamy z bazy wpis
        $this->db->update(table::SHOP_CATEGORIES, array('image_filename' => null), array('id_category' => $iCategoryId));
    }

    public function DeleteCategoryBanner($iCategoryId) {
        // pobieramy nazwe pliku
        $result = $this->db->from(table::SHOP_CATEGORIES)
                ->select('banner')
                ->where(array('id_category' => $iCategoryId))
                ->get();
        $sImageFilename = $result[0]->banner;

        if (file_exists(shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH . $sImageFilename)) {
            unlink(shop::PRODUCT_CATEGORY_SMALL_BANNER_PATH . $sImageFilename);
        }
        if (file_exists(shop::PRODUCT_CATEGORY_BANNER_PATH . $sImageFilename)) {
            unlink(shop::PRODUCT_CATEGORY_BANNER_PATH . $sImageFilename);
        }

        // usuwamy z bazy wpis
        $this->db->update(table::SHOP_CATEGORIES, array('banner' => null), array('id_category' => $iCategoryId));
    }

    /**
     *
     * @param Integer $catId
     * @return ErrorReporting
     */
    public function GetCategoriesAsArray($catId = null, $lang = null) {
        if (!empty($lang)) {
            $categoriesResult = $this->_rDb->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER')->orderby(array('category_name' => 'ASC'))->getwhere(table::SHOP_CATEGORIES . ' AS c', array('category_language' => $lang));
        } else {
            $categoriesResult = $this->_rDb->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER')->orderby(array('category_name' => 'ASC'))->get(table::SHOP_CATEGORIES . ' AS c');
        }
        $categories = array();
        foreach ($categoriesResult as $category) {
            $categories[] = array(
                'id_category' => $category->id_category,
                'category_name' => $category->category_name,
                'parent_category_id' => $category->parent_category_id,
                'level' => $category->level
            );
        }
        return $categories;
    }

    /**
     *
     * @return ErrorReporting
     */
    public function GetCategoriesValuesAsArray($lang) {
        try {
            $categoriesResult = $this->_rDb->orderby(array('category_name' => 'ASC'))->getwhere(table::SHOP_PARAMETERS_TO_CATEGORIES, array('parameter_language' => $lang));
            $categories = array();
            foreach ($categoriesResult as $category) {
                $categories[] = array(
                    'id_product_category' => $category->id_product_category,
                    'name' => $category->name,
                    'parent_product_category_id' => $category->parent_product_category_id,
                    'level' => $category->level
                );
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $categories, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     *
     * @param Integer $id
     * @param Array $tmpCat
     * @return String
     */
    public function GetCategoryTree($id, &$tmpCat) {
        $tmp = array();
        foreach ($tmpCat as $cat) {
            if ($cat['parent_product_category_id'] >= 0) {
                if ($cat['id_product_category'] == $selectId) {
                    $html .= '<option value="' . $cat['id_product_category'] . '" selected="selected">' . str_repeat('&rarr;', $cat['level'] - 1) . $cat['name'] . '</option>';
                    $html .= $this->GetCategoriesAsOption($cat['id_product_category'], $categories, $selectId);
                } else {
                    $html .= '<option value="' . $cat['id_product_category'] . '">' . str_repeat('&rarr;', $cat['level'] - 1) . $cat['name'] . '</option>';
                    $html .= $this->GetCategoriesAsOption($cat['id_product_category'], $categories, $selectId);
                }
            }
        }
        return $html;
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    public function Delete($id) {
        try {
            $id += 0;
            if ($this->AllowDeleteCategory($id)->Value === true) {
                $this->_rDb->delete(table::SHOP_CATEGORIES, array('id_category' => $id));
                $this->_rDb->delete(table::SHOP_CATEGORIES_DESCRIPTION, array('category_id' => $id));
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('product_category.delete_product_category_success'));
            } else {
                return new ErrorReporting(ErrorReporting::WARNING, false, $this->AllowDeleteCategory($id)->Message);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @todo Sprawdzić, czy metoda rzeczywiście działa poprawnie, tu dodac sprawdzenie czy sa produkty
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @param Integer $id
     * @return ErrorReporting
     */
    public function AllowDeleteCategory($id) {
        try {
            $id += 0;
            //if($this->_rDb->count_records(table::PRODUCTS_CATEGORIES, array('id_product_category' => $id, 'parent_product_category_id' => 0))>0) {

            if ($this->_rDb->count_records(table::SHOP_CATEGORIES, array('parent_category_id' => $id)) > 0 || $this->_rDb->count_records(table::SHOP_PRODUCTS_TO_CATEGORIES, array('category_id' => $id)) > 0) {
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('product_category.cant_delete_product_category_has_subcategories'));
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('product_category.delete_product_category_success'));
            }
            return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('product_category.cant_delete_product_category'));
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
    public function Find($id, $lang = 'pl_PL') {
        try {
            $id += 0;
            $result = $this->_rDb->from(table::SHOP_CATEGORIES)
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION, table::SHOP_CATEGORIES_DESCRIPTION . '.category_id', table::SHOP_CATEGORIES . '.id_category')
                    ->where(array('id_category' => $id, 'category_language' => $lang))
                    //->orderby(array('category_language' => 'ASC'))
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('product_category.get_product_category_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @param [integer $limit]
     * @param [integer $offset]
     * @param [string $lang]
     * @return ErrorReporting
     */
    public function FindAll($limit = null, $offset = null, $lang = 'pl_PL', $orderBy = 'id_category', $orderType = 'ASC') {
        try {
            $this->_rDb->where(array('category_language' => $lang));
            $this->_rDb->orderby(array($orderBy => $orderType));
			
			
            if ($limit == null && $offset == null && !isset($offset)) {
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, $this->_rDb->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS scd', 'scd.category_id', 'sc.id_category', 'INNER')->get(table::SHOP_CATEGORIES . ' AS sc'), Kohana::lang('product_category.get_products_categories_success')
                );
            } else {
                return new ErrorReporting(
                        ErrorReporting::SUCCESS, $this->_rDb->limit($limit, $offset)->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS scd', 'scd.category_id', 'sc.id_category', 'INNER')->get(table::SHOP_CATEGORIES . ' AS sc'), Kohana::lang('product_category.get_products_categories_success')
                );
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product_category.get_products_categories_success'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @return ErrorReporting
     */
    public function Count() {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->count_records(table::PRODUCTS_CATEGORIES), Kohana::lang('product_category.count_product_categories_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }
     public function GetCategoryProductCount($iCatId) {
        try {
            return new ErrorReporting(ErrorReporting::SUCCESS, $this->_rDb->where(array('category_id'=>$iCatId))->count_records(table::SHOP_PRODUCTS_TO_CATEGORIES), Kohana::lang('product_category.count_product_categories_success'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @todo dodać poprawną walidację PHP
     * @param array $post
     */
    public function ValidateProductCategoryAdd(array $post) {
        try {
//            $errors = array();
//            $clean = array();
//            $clean['email'] = strip_tags($post['email']);
//            $clean['email'] = trim($clean['email']);
//            $clean['password'] = strip_tags($post['password']);
//            $clean['password'] = trim($clean['password']);
//            if(empty($clean['email'])) {
//                $errors['email'] = Kohana::lang('product_category.email_can_not_be_empty');
//            }
//            if(empty($post['password'])) {
//                $errors['password'] = Kohana::lang('product_category.password_can_not_be_empty');
//            }
//            if(!empty($post['email'])
//                    && !empty($clean['email'])
//                    && $this->UserExists($clean['email'], $clean['email'])) {
//                $errors['email'] = Kohana::lang('product_category.email_exists');
//            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @todo dodać poprawną walidację PHP
     * @param array $post
     */
    public function ValidateProductCategoryEdit(array $post) {
        try {
//            $errors = array();
//            $clean = array();
//            $clean['email'] = strip_tags($post['email']);
//            $clean['email'] = trim($clean['email']);
//            $clean['password'] = strip_tags($post['password']);
//            $clean['password'] = trim($clean['password']);
//            if(empty($clean['email'])) {
//                $errors['email'] = Kohana::lang('product_category.email_can_not_be_empty');
//            }
//            if(empty($post['password'])) {
//                $errors['password'] = Kohana::lang('product_category.password_can_not_be_empty');
//            }
//            if(!empty($post['email'])
//                    && !empty($clean['email'])
//                    && $this->UserExists($clean['email'], $clean['email'])) {
//                $errors['email'] = Kohana::lang('product_category.email_exists');
//            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
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
    private function _getCategoryLevel($id) {
        try {
            $id += 0;
            if ($id == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, 0, Kohana::lang('product_category.get_category_leve_success'));
            } else {
                $resultScalar = $this->_rDb->limit(1)->select('level')->getwhere(table::SHOP_CATEGORIES, array('id_category' => $id));
                return new ErrorReporting(ErrorReporting::SUCCESS, $resultScalar[0]->level, Kohana::lang('product_category.get_category_leve_success'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, Kohana::lang('product_category.get_category_level_error'));
        }
    }

    /**
     * @author Hubert Kulczak <a href="mailto:hubert.kul@gmail.com">hubert.kul@gmail.com</a>
     *
     * @param Integer $id
     * @return ErrorReporting
     */
    private function _GetCategoryIdForBrand($iBrandId) {
        try {
            $iBrandId += 0;
            if ($iBrandId == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, 0, '');
            } else {
                $result = $this->_rDb->from(table::PRODUCTS_CATEGORIES)
                        ->where(array('related_page_id' => $iBrandId, 'parent_product_category_id' => 0))
                        ->select('id_product_category')
                        ->get();
                return new ErrorReporting(ErrorReporting::SUCCESS, $result[0]->id_product_category, Kohana::lang('product_category.get_category_leve_success'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, Kohana::lang('product_category.get_category_id_error'));
        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     *
     * @return ErrorReporting
     */
    public function GetMainCategories() {
        try {
            $result = $this->_rDb->from(table::SHOP_CATEGORIES)
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION, table::SHOP_CATEGORIES_DESCRIPTION . '.category_id', table::SHOP_CATEGORIES . '.id_category')
                    ->where(array('parent_category_id' => 0))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, '');
        }
    }

    /**
     *
     * @param integer $iCategoryId
     * @return ErrorReporting
     */
    public function GetSubCategoriesForMainCategories($limit = null) {
        try {
            $oMainCategories = $this->GetMainCategories()->Value;
            $aSubCategories = array();
            foreach ($oMainCategories as $oMainCategory) {
                $aSubCategories[$oMainCategory->id_category] = $this->GetSubCategories($oMainCategory->id_category, $limit)->Value;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aSubCategories, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, 0, Kohana::lang('product_category.get_category_id_error'));
        }
    }

    public function GetSubCategories($iCategoryId, $limit = null) {
        try {
            $iCategoryId += 0;
            $this->_rDb->from(table::SHOP_CATEGORIES)
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION, table::SHOP_CATEGORIES_DESCRIPTION . '.category_id', table::SHOP_CATEGORIES . '.id_category')
                    ->where(array('parent_category_id' => $iCategoryId))
                    ->orderby('category_name', 'ASC');
            if (!empty($limit)) {
                $this->_rDb->limit($limit);
            }
            $results = $this->_rDb->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $results, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('product_category.get_category_id_error'));
        }
    }

    public function GetCategoriesTree($sLanguage = 'pl_PL') {
        $aPages = array();
        $db = clone $this->_rDb;
        $languages = $db->get(table::LANGUAGES);
        foreach ($languages as $lang) {
            $result = $this->_rDb
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER')
                    ->getwhere(table::SHOP_CATEGORIES . ' AS c', array('cd.category_language' => $lang->name))
                    ->result(false);
//            var_dump($result);
//            exit();
            $aPages[$lang->name] = $this->GetCategoriesAsListForAdmin(0, $result);
        }
        return $aPages;
    }

    /**
     *
     * @param iteger $catId
     * @param Reference to string $html
     * @param Reference to array $categories
     */
    public function GetCategoriesAsListForAdmin($catId, &$categories, $selectId = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_category_id'] == $catId) {
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
            if ($catId > 0) {
                $html .= '<span class="pagesParentId-' . $catId . '" style="margin-left: 10px; color: blue; text-decoration:underline; cursor:pointer;">rozwiń</span>';
            }
            $html .= '<ul id="pagesTree-' . $catId . '" ' . (($catId > 0) ? 'style="display:none"' : 'style="display:block"') . ' >';
            foreach ($tmpCat as $cat) {
                $html .= '<li>';
                if ($cat['parent_category_id'] >= 0) {
                    if ($cat['id_category'] == $selectId) {
                        $html .= '<strong>' . $cat['name'] . '</strong>';
                        $html .= $this->GetCategoriesAsListForAdmin($cat['id_category'], $categories, $selectId);
                    } else {
                        $html .= html::anchor('4dminix/kategorie_produktow/' . $cat['id_category'], $cat['category_name']);

                        $html .= $this->GetCategoriesAsListForAdmin($cat['id_category'], $categories, $selectId);
                    }
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function GetCategoriesTreeForApp($catId, $aParentCats) {
        $cats = array();
        //$result = $this->_rDb->from(table::PRODUCTS_CATEGORIES)->in('parent_product_category_id', $aParentCats)->get();
        $result = $this->_rDb->from(table::SHOP_PRODUCTS_TO_CATEGORIES)->get();
        foreach ($result as $r) {
            $cats[] = array(
                'id_product_category' => $r->id_product_category,
                'category_name' => $r->name,
                'parent_product_category_id' => $r->parent_product_category_id,
                'level' => $r->level
            );
        }
        //var_dump($cats);
        return $cats;
    }

    public function GetCategoriesAsListForApp($catId, &$categories, $aParents, $selectId = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_product_category_id'] == $catId) { // todo: tu by raczej musialbyc in array, array parent id dla wybranej kategorii
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
            $html .= '<ul>';
            foreach ($tmpCat as $cat) {
                $html .= '<li>';
                if ($cat['id_product_category'] == $selectId) {
                    $html .= '<strong>' . $cat['name'] . '</strong>';
                    $html .= $this->GetCategoriesAsListForApp($cat['id_product_category'], $categories, $aParents, $selectId);
                } else {
                    $html .= html::anchor('kategoria/' . string::prepareURL($cat['name']) . '/' . $cat['id_product_category'], $cat['name']);
                    if (in_array($cat['id_product_category'], $aParents)) {
                        $html .= $this->GetCategoriesAsListForApp($cat['id_product_category'], $categories, $aParents, $selectId);
                    }
                }

                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    /**
     *
     * @param iteger $catId
     * @param Reference to string $html
     * @param Reference to array $categories
     */
    public function GetCategoriesAsList($catId, &$categories, $aParentCats, $selectId = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_product_category_id'] == $catId) { // todo: tu by raczej musialbyc in array, array parent id dla wybranej kategorii
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
            if ($catId > 0) {
                $html .= '<span class="pagesParentId-' . $catId . '" style="margin-left:10px; color:blue; text-decoration:underline; cursor:pointer;">rozwiń</span>';
            }
            $html .= '<ul id="pagesTree-' . $catId . '" ' . (($catId > 0) ? 'style="display:none;"' : '') . '>';
            foreach ($tmpCat as $cat) {
                $html .= '<li>';
                if ($cat['parent_product_category_id'] >= 0) {
                    if ($cat['id_product_category'] == $selectId) {
                        $html .= '<strong>' . $cat['name'] . '</strong>';
                        $html .= $this->GetCategoriesAsList($cat['id_product_category'], $categories, $selectId);
                    } else {
                        $html .= html::anchor('kategoria/' . string::prepareURL($cat['name']) . '/' . $cat['id_product_category'], $cat['name']);
                        $html .= $this->GetCategoriesAsList($cat['id_product_category'], $categories, $selectId);
                    }
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function GetParentCategoriesTree($iCatId) {
        $aCatTree = array();
        $aCatTree[] = $iCatId;
        //pobieramy kategorie nadrzedna dla wybranej
        $this->_GetParentForCategory($iCatId, $aCatTree);
        return $aCatTree;
    }

    private function _GetParentForCategory($iCatId, &$aCatTree) {
        //pobieramy dane kategorii
        $result = $this->_rDb->from(table::SHOP_PRODUCTS_TO_PRODUCTS_CATEGORIES)->where(array('id_product_category' => $iCatId))->get();
        if (!empty($result[0]->parent_product_category_id)) {
            //pobieramy kategorie nadrzedna dla wybranej
            $iCategoryId = $result[0]->parent_product_category_id;
            $iCategoryId+=0;
            $aCatTree[] = $iCategoryId;
            return $this->_GetParentForCategory($result[0]->parent_product_category_id, $aCatTree);
        }
        return $result[0]->id_product_category;
    }

    /**
     *
     * @todo POPRAWIĆ działanie dla kategorii zagnieżdżonych
     * @todo Zmienić wykonywanie SQL na tablicę
     * @param integer $iCategoryId
     * @return ErrorReporting
     */
    public function GetParentsForCategory($iCategoryId) {
        // try {
//            $iCategoryId += 0;
//            $iCategoryLevel = $this->_rDb->select('level')->getwhere(table::PRODUCTS_CATEGORIES, array('id_product_category' => $iCategoryId));
//            $iCategoryLevel = $iCategoryLevel[0]->level;
//            $iCurParentCategoryId = 0;
//            $iParentId = $iCategoryId;
//            for($idx = $iCategoryLevel ; $idx >= 1  ; $idx--) {
//                $iCurParentCategoryId[] = $this->GetParentsForCategory($iParentId)->Value[0]->parent_product_category_id;
//                if($iCurParentCategoryId == 0) {
//                    break;
//                } else {
//                    $iParentId = $iCurParentCategoryId;
//                }
//            }
//            return 2;
        //$result = $this->_rDb->select('main_category_logo')->getwhere(table::PRODUCTS_CATEGORIES, array('id_product_category' => $iParentId));
        //return $iCurParentCategoryId;
//        } catch(Exception $ex) {
//            Kohana::log('error', $ex->getMessage());
//            return new ErrorReporting(ErrorReporting::SUCCESS, false, '');
//        }
    }

    /**
     * @author Filip Górczyński <a href="mailto:filip.gorczynski@gmail.com">filip.gorczynski@gmail.com</a>
     * @param string $query
     * @return ErrorReporting
     */
    public function GetCategoriesWithName($sCategoryName) {
        try {
            $result = $this->db->from(table::SHOP_CATEGORIES)
                    ->join(table::SHOP_CATEGORIES_DESCRIPTION, table::SHOP_CATEGORIES_DESCRIPTION . '.category_id', table::SHOP_CATEGORIES . '.id_category')
                    ->like('category_name', $sCategoryName)
                    ->groupby('category_id')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, '');
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('pages.error_insert_news'));
        }
    }

    /**
     * Pobieranie kategorii dla breadcrumba
     * @author Hubert Kulczak
     * @param Integer $iCategoryId
     * @return
     */
    public function GetParentCategories($iCategoryId) {
        try {
            $iCategoryId+=0;
            $categories = $this->_rDb->from(table::SHOP_CATEGORIES)->get();
            $iCategoryId = $this->GetParentCategory($iCategoryId);
            $aCats = array();
            if (!empty($iCategoryId)) {
                $this->_GetCategoriesTreeAsArray($iCategoryId, $categories, $aCats);
                $result = $this->_rDb->from(table::SHOP_CATEGORIES)
                        ->join(table::SHOP_CATEGORIES_DESCRIPTION, 'category_id', 'id_category')
                        ->in('category_id', $aCats)
                        ->where(array('category_language' => $this->_aLanguage))
                        ->orderby('level', 'ASC')
                        ->get();
            } else {
                $result = array();
            }

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

    public function GetCategoriesTreeApp($sLanguage = 'pl_PL', $iCategoryId = 0) {
        //$aPages = array();
//        $db = clone $this->_rDb;
//        $languages = $db->get(table::LANGUAGES);
//        foreach($languages as $lang) {
        $result = $this->_rDb
                ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER')
                ->orderby(array('c.position' => 'ASC', 'cd.category_name' => 'ASC'))
                ->getwhere(table::SHOP_CATEGORIES . ' AS c', array('cd.category_language' => $sLanguage, 'active' => 'Y'))
                ->result(false);

//            var_dump($result);
//            exit();
//
//        }
        //$aParents = $this->GetParentCategoriesTree($iCategoryId);
        //var_dump($aParents);
        $aPages = $this->GetCategoriesAsListForApp3(0, $result, $iCategoryId);
        return $aPages;
    }

    /**
     *
     * @param iteger $catId
     * @param Reference to string $html
     * @param Reference to array $categories
     */
    public function GetCategoriesAsListForApp2($catId, &$categories, $selectId = null, $aParents = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_category_id'] == $catId) {
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
            if ($catId == 0) {
                $html .= '<div id="left-sidebar-box">
                    ';
            } else {
                //$html .= '<ul id="pagesTree-' . $catId . '" ' . ((!empty($aParents) && $catId > 0 && !in_array($catId, $aParents)) ? 'style="display:none"' : 'style="display:block"') . ' >';
//                $html .= '<ul id="pagesTree-' . $catId . '" ' . ((!empty($cat->parent_category_id)) ? 'style="display:none"' : 'style="display:block"') . ' >' . $cat->parent_category_id;
            }
            foreach ($tmpCat as $cat) {

                if (!empty($cat['id_category']) && $this->HasSubcategories($cat['id_category'])->Value == true) {
                    if ($cat['level'] > 2) {
                        $html .= '<ul id="pagesTree-' . $catId . '" style="display:none" >';
                    } else {
                        $html .= '<ul id="pagesTree-' . $catId . '" style="display:block" >';
                    }
                }
                $html .= $this->HasSubcategories($catId)->Value;



                if ($catId != 0) {
                    $html .= '<li>';
                }
                if ($cat['parent_category_id'] >= 0) {
                    if ($cat['id_category'] == $selectId) {
                        if ($this->HasSubcategories($cat['id_category'])->Value == true) {
                            if ($catId == 0) {
                                $html .= '<span class="box_left_corner"></span>
                                <span class="box_center_bg"></span>
                                <span class="box_right_corner"></span>
                                <div class="clear"></div>
                                <h2>';
                                $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name'], array('class' => 'current')) . '</h2>';
                            } else {
                                $html .= '<ul id="pagesTree-' . $catId . '" style="display:block" >';
                                $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name'], array('class' => 'current'));
                            }
                            $html .= $this->GetCategoriesAsListForApp2($cat['id_category'], $categories, $selectId, $aParents);
                        } else {
                            $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name'], array('class' => 'current'));
                        }
                    } else {
                        if ($this->HasSubcategories($cat['id_category'])->Value == true) {
                            if ($catId == 0) {
                                $html .= '<span class="box_left_corner"></span>
                                <span class="box_center_bg"></span>
                                <span class="box_right_corner"></span>
                                <div class="clear"></div>
                                <div class="left-sidebar-box-container"><h2>';
                                $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name'], array('class' => 'current')) . '</h2>';
                            } else {
                                $html .= '<ul id="pagesTree-' . $catId . '" style="display:block" >';
                                $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                            }
                            $html .= $this->GetCategoriesAsListForApp2($cat['id_category'], $categories, $selectId, $aParents);
                        } else {
                            if ($catId == 0) {
                                $html .= '<span class="box_left_corner"></span>
                                <span class="box_center_bg"></span>
                                <span class="box_right_corner"></span>
                                <div class="clear"></div>
                                <div class="left-sidebar-box-container"><h2>';
                                $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name'], array('class' => 'current')) . '</h2>';
                            } else {
                                $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                            }
                        }
                    }
                }
                if ($catId != 0) {
                    $html .= '</li>';
                }
                if (!empty($cat['id_category']) && $this->HasSubcategories($cat['id_category'])->Value == true) {
                    //$html .= '</ul>';
                }
                if ($catId == 0) {
                    $html .= '</div>';
                }
            }
            if ($catId == 0) {
                $html .= '</div>';
            } else {
                $html .= '</ul>';
            }
        }
        return $html;
    }

    /**
     *
     * @param iteger $catId
     * @param Reference to string $html
     * @param Reference to array $categories
     */
    public function GetCategoriesAsListForApp3($catId, &$categories, $selectId = null, $aParents = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_category_id'] == $catId) {
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
            if ($catId > 0 && $tmpCat[0]['level'] > 2) {
                $html .= '<span class="pagesParentId-' . $catId . '" style="margin-left: 0px;color: blue;paddin float:right; cursor:pointer;">' . html::image('img/arrow_down.png', array('class' => 'arrow')) . '</span>';
            }
            $html .= '<ul id="pagesTree-' . $catId . '" ' . (($catId > 0 && $tmpCat[0]['level'] > 2) ? 'style="display:none"' : 'style="display:block"') . ' >';
            foreach ($tmpCat as $cat) {
                $html .= '<li>';
                if ($cat['parent_category_id'] >= 0) {
                    if ($cat['id_category'] == $selectId) {
                        $html .= '<strong>' . $cat['name'] . '</strong>';
                        $html .= $this->GetCategoriesAsListForApp3($cat['id_category'], $categories, $selectId);
                    } else {
                        // jeśli jest to kategoria główna
                        if ($cat['parent_category_id'] == 0) {
                            $html .= '<span class="box_left_corner"></span>
                                <span class="box_center_bg"></span>
                                <span class="box_right_corner"></span>
                                <div class="clear"></div>
                                <div class="left-sidebar-box-container"><h2>';
                            $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                            $html .= '</h2>';
                        } else {
                            $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                        }
                        $html .= $this->GetCategoriesAsListForApp3($cat['id_category'], $categories, $selectId);
                        if ($cat['parent_category_id'] == 0) {
                            $html .= '<div class="clear"></div></div>';
                        }
                    }
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function HasSubcategories($iCategoryId) {
        try {
            $results = $this->_rDb->count_records(table::SHOP_CATEGORIES, array('parent_category_id' => $iCategoryId));
            if ($results > 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, true);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, false);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function GetCategoriesTreeAppMenu($sLanguage = 'pl_PL', $iCategoryId = 0) {
        $result = $this->_rDb
                ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER')
                ->orderby(array('c.position' => 'DESC', 'cd.category_name' => 'ASC'))
                ->getwhere(table::SHOP_CATEGORIES . ' AS c', array('cd.category_language' => $sLanguage, 'active' => 'Y'))
                ->result(false);

        $aPages = $this->GetCategoriesAsListForMenu(0, $result, $iCategoryId);
        return $aPages;
    }

    public function GetCategoriesAsListForMenu($catId, &$categories, $selectId = null, $aParents = null) {
        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_category_id'] == $catId) {
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
//            if ($catId > 0 && $tmpCat[0]['level']>2) {
//                $html .= '<span class="pagesParentId-' . $catId . '" style="margin-left: 0px;color: blue;paddin float:right; cursor:pointer;">'.html::image('img/arrow_down.png', array('class'=>'arrow')).'</span>';
//            }
            if ($tmpCat[0]['level'] != 1) {
                //$html .= '<ul id="pagesTree-' . $catId . '" ' . (($catId > 0 && $tmpCat[0]['level']>2) ? 'style="display:none"' : 'style="display:block"') . ' >';
                $html .= '<ul id="pagesTree-' . $catId . '">';
            }
            //echo Kohana::debug($tmpCat);
            foreach ($tmpCat as $cat) {
                if ($cat['id_category'] == $selectId) {
                    $html .= '<li class="selected">';
                } else {
                    $html .= '<li>';
                }
                if ($cat['parent_category_id'] >= 0) {
//                    if ($cat['id_category'] == $selectId) {
//                        $html .= '<strong>' . $cat['name'] . '</strong>';
//                        $html .= $this->GetCategoriesAsListForMenu($cat['id_category'], $categories, $selectId);
//                    } else {
                    // jeśli jest to kategoria główna
                    if ($cat['parent_category_id'] == 0) {
                        //$html .= '<h2>';
                        $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                        //$html .= '</h2>';
                    } else {
                        $html .= html::anchor('kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                    }
                    $html .= $this->GetCategoriesAsListForMenu($cat['id_category'], $categories, $selectId);
//                        if ($cat['parent_category_id'] == 0) {
//                            $html .= '<div class="clear"></div></div>';
//                        }
                    //}
                }
                $html .= '</li>';
            }
            if ($tmpCat[0]['level'] != 1) {
                $html .= '</ul>';
            }
        }
        return $html;
    }

    public function GetCategoriesTreeWithProducts($sLanguage = 'pl_PL', $iCategoryId = 0, $limit = null) {
        $this->_rDb
                ->join(table::SHOP_CATEGORIES_DESCRIPTION . ' AS cd', 'cd.category_id', 'c.id_category', 'INNER');
        if (!empty($limit) && $limit != 0) {
            $this->_rDb->limit($limit);
        }
        $result = $this->_rDb->orderby(array('c.position' => 'DESC', 'cd.category_name' => 'ASC'))
                ->getwhere(table::SHOP_CATEGORIES . ' AS c', array('cd.category_language' => $sLanguage, 'active' => 'Y'))
                ->result(false);
        $aPages = $this->GetCategoriesAsListWithProducts(0, $result, $iCategoryId);
        return $aPages;
    }

    public function GetCategoriesAsListWithProducts($catId, &$categories, $selectId = null, $aParents = null) {


        $html = '';
        $tmpCat = array();
        foreach ($categories as $cat) {
            if ($cat['parent_category_id'] == $catId) {
                $tmpCat[] = $cat;
            }
        }
        if (!empty($tmpCat)) {
//            if ($catId > 0 && $tmpCat[0]['level']>2) {
//                $html .= '<span class="pagesParentId-' . $catId . '" style="margin-left: 0px;color: blue;paddin float:right; cursor:pointer;">'.html::image('img/arrow_down.png', array('class'=>'arrow')).'</span>';
//            }
            if ($tmpCat[0]['level'] != 1) {
                //$html .= '<ul id="pagesTree-' . $catId . '" ' . (($catId > 0 && $tmpCat[0]['level']>2) ? 'style="display:none"' : 'style="display:block"') . ' >';
                $html .= '<ul id="pagesTree-' . $catId . '">';
            }
            //echo Kohana::debug($tmpCat);
            foreach ($tmpCat as $cat) {
                $sublist = $this->GetProductsForCategory($cat['id_category'])->Value;
                //rozwijanie kategorii po wejsciu
                if ($cat['id_category'] == $selectId) {
                    $html .= '<li class="selected">';
                } else {
                    $html .= '<li>';
                }
                if (!empty($sublist)) {
                    $html .= '<span  class="tick subroot"></span>';
                } else {
                    $html .= '<span  class="tick"></span>';
                }
                if ($cat['parent_category_id'] >= 0) {
//                    if ($cat['id_category'] == $selectId) {
//                        $html .= '<strong>' . $cat['name'] . '</strong>';
//                        $html .= $this->GetCategoriesAsListForMenu($cat['id_category'], $categories, $selectId);
//                    } else {
                    // jeśli jest to kategoria główna
                    if ($cat['parent_category_id'] == 0) {
                        //$html .= '<h2>';
                        $html .= html::anchor(Kohana::lang('links.lang') . 'kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                        //$html .= '</h2>';
                    } else {
                        $html .= html::anchor(Kohana::lang('links.lang') . 'kategoria/' . string::prepareURL($cat['category_name']) . '/' . $cat['id_category'], $cat['category_name']);
                    }
                    $html .= $this->GetCategoriesAsListWithProducts($cat['id_category'], $categories, $selectId);
//                        if ($cat['parent_category_id'] == 0) {
//                            $html .= '<div class="clear"></div></div>';
//                        }
                    //}
                    $html .= $this->GetProductsForCategory($cat['id_category'])->Value;
                }
                $html .= '</li>';
            }
            if ($tmpCat[0]['level'] != 1) {
                $html .= '</ul>';
            }
        }
        return $html;
    }

    public function GetProductsForCategory($iCategoryId, $html = true, $lang = 'pl_PL') {
        try {
            $tmp = null;
            $result = $this->_rDb->from(table::SHOP_PRODUCTS)
                    ->join(table::SHOP_PRODUCTS_TO_CATEGORIES, table::SHOP_PRODUCTS_TO_CATEGORIES . '.product_id', table::SHOP_PRODUCTS . '.id_product')
                    ->join(table::SHOP_PRODUCTS_DESCRIPTION, table::SHOP_PRODUCTS_DESCRIPTION . '.product_id', table::SHOP_PRODUCTS . '.id_product')
                    ->join(table::SHOP_PRODUCTS_IMAGES, table::SHOP_PRODUCTS_IMAGES . '.product_id', table::SHOP_PRODUCTS . '.id_product', 'LEFT')
                    ->where(array('category_id' => $iCategoryId, 'product_language' => $lang, 'mainimage' => 'Y'))
                    ->orderby(array('product_position' => 'DESC'))
                    ->get();

            if (!empty($result) && $result->count() > 0) {
                if (!empty($html) && $html == true) {
                    $tmp = '<ul class="sublist">';
                    foreach ($result as $res) {
                        $tmp .= '<li>' . html::anchor(Kohana::lang('links.lang') . 'produkt/' . $res->id_product . '/' . string::prepareURL($res->product_name), $res->product_name) . '</li>';
                        ;
                    }
                    $tmp .= '</ul>';
                } else {
                    $tmp = $result;
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $tmp);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

    public function updateElementsPositions($aData) {
        try {
            if (!empty($aData['elements']) AND count($aData['elements']) > 0) {
                foreach ($aData['elements'] as $iElementId => $iPosition) {
                    $this->db->update(table::SHOP_CATEGORIES, array('position' => intval($iPosition)), array('id_category' => intval($iElementId)));
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.update_elements_positions'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.update_elements_positions'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.update_elements_positions'));
        }
    }

    public function GetCategoriesWithProducts($aCategories, $lang = 'pl_PL') {
        try {
            $prod_array = array();
            foreach ($aCategories as $car) {
                $prod_array[$car['id_category']] = $this->GetProductsForCategory($car['id_category'], false, $lang)->Value;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $prod_array);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, $ex->getMessage());
        }
    }

}

?>