<?php

defined('SYSPATH') OR die('No direct access allowed.');

class News_Model extends Model_Core {

    private $path;
    private $thumbpath;

    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->_oSession = Session::instance();
        $this->path = news_helper::BIG_PATH;
        $this->thumbpath = news_helper::SMALL_PATH;
    }

    /**
     * Dodawanie aktualności
     * @param Array $aData
     * @param Array $aFiles
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function Insert(Array $aData, Array $aFiles = null) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            $alt = $aData['alt'];


            $aNewsCategories = $aData['news_categories'];

            unset($aData['back'], $aData['add_news'], $aData['alt'], $aData['news_categories'], $aData['submit'], $aData['submit_back']);

            if (empty($aData['date_added'])) {
                $aData['date_added'] = TIME;
            } else {
                $aData['date_added'] = layer::DateToInt($aData['date_added']);
            }
            $aData['modified_date'] = null;
            if (!empty($data['news_start_date'])) {
                $aData['news_start_date'] = layer::DateToInt($aData['news_start_date']);
            }
            if (!empty($data['news_end_date'])) {
                $aData['news_end_date'] = layer::DateToInt($aData['news_end_date']);
            }
            if (!empty($aFiles) && is_array($aFiles) && !empty($aFiles['mainphoto']['tmp_name'])) {
                    $imageData = file::upload(
                                    $aFiles['mainphoto'], array(
                                'unique' => true,
                                'width' => 880,
                                'height' => 510,
                                'thumbwidth' => 280,
                                'thumbheight' => 170,
                                'path' => $this->path,
                                'thumbpath' => $this->thumbpath
                                    )
                            )->Value;
                    
                   $aData['mainfilename']= $imageData['filename'];
                  $aData['mainphotoname']= $aFiles['mainphoto']['name'];
                }
            // dodajemy wiadomosc
            $oNewsInsert = $this->db->insert(table::NEWS, $aData);

            $aFilesPhotos = array();
            $file_count = count($aFiles['photo']['name']);
            $file_keys = array_keys($aFiles['photo']);

            for ($i = 0; $i < $file_count; $i++) {
                foreach ($file_keys as $key) {
                    $aFilesPhotos[$i][$key] = $aFiles['photo'][$key][$i];
                }
            }

            foreach ($aFilesPhotos as $photo):
                // dodawanie obrazkow
                $aNewsImages = array();
                $aNewsImages['news_id'] = $oNewsInsert->insert_id();
                $image = $photo;

                // tworzymy obrazki
                if (!empty($image) && is_array($image) && !empty($image['name'])) {
                    $imageData = file::upload(
                                    $image, array(
                                'unique' => true,
                                'width' => 880,
                                'height' => 510,
                                'thumbwidth' => 280,
                                'thumbheight' => 170,
                                'path' => $this->path,
                                'thumbpath' => $this->thumbpath
                                    )
                            )->Value;
                    $imageData['alt'] = $alt;
                    $imageData['mainimage'] = 0;

                    $result = $this->db->insert(table::IMAGES, $imageData);
                    $aNewsImages['images_id'] = $result->insert_id();
                }

                // łaczymy fote z wiadomoscia tylko jesli jest fota!
                if (!empty($aNewsImages['images_id']) && !empty($aNewsImages['news_id'])) {
                    $this->db->insert(table::NEWS_IMAGES, $aNewsImages);
                }
            endforeach;
            //dodajemy powiazanie NEWS_CATEGORIES
            $aNewsCategoriesInsert = array();
            $aNewsCategoriesInsert['news_id'] = $oNewsInsert->insert_id();

            foreach ($aNewsCategories as $nc) { // dodajemy powiazania aktualonosci ze kategoriami
                $aNewsCategoriesInsert['news_category_id'] = $nc;
                $this->db->insert(table::NEWS_TO_CATEGORIES, $aNewsCategoriesInsert);
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $oNewsInsert->insert_id(), Kohana::lang('news.success_insert_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    /**
     *
     * @param Array $data
     * @return ErrorReporting
     */
    public function InsertNewsCategory(Array $data) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            unset($data['back'], $data['add_news_category'], $data['submit'], $data['submit_back']);

            $aElements['type'] = element_helper::$elements_types_for_switch['news'];
            $aElements['date_added'] = time();
            $aElements['lang'] = $data['lang'];

            $aElements['available'] = 1;

            $result = $this->db->insert(table::ELEMENTS, $aElements);

            $aPagesElements['element_id'] = $result->insert_id();

            if (is_array($data['page_id'])) {
                foreach ($data['page_id'] as $iPId) {
                    $aPagesElements['page_id'] = $iPId;
                    $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
                }
            } else {
                $aPagesElements['page_id'] = $data['page_id'];
                $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
            }

            if (!empty($data['show_title'])) {
                $data['show_title'] = $data['show_title'];
            } else {
                $data['show_title'] = 'Y';
            }

            $aNewsCategories['element_id'] = $result->insert_id();
            $aNewsCategories['news_category_name'] = $data['title'];
            $aNewsCategories['show_title'] = $data['show_title'];
            $aNewsCategories['id_news_subcategory'] = $data['id_news_subcategory'];
            $aNewsCategories['comments'] = (!empty($data['comments']) ? $data['comments'] : 0);
            // i dodajemy kategorie wiadomosci
            $insert = $this->db->insert(table::NEWS_CATEGORIES, $aNewsCategories);

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), Kohana::lang('news.success_insert_news_category'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news_category'));
        }
    }

    /**
     *
     * @param Array $data
     * @param Integer $iNewsCategoryId
     * @return ErrorReporting
     */
    public function UpdateNewsCategory(Array $data, $iNewsCategoryId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $iNewsCategoryId+=0;

            $news_category = $this->db->from(table::NEWS_CATEGORIES)->where(array('id_news_category' => $iNewsCategoryId))->get();

            unset($data['back'], $data['add_news_category'], $data['submit'], $data['submit_back']);

            //$aElements['type'] = element_helper::$elements_types_for_switch['news'];
            $aElements['modified_date'] = time();
            $aElements['lang'] = $data['lang'];
            $aElements['available'] = 1; // TODO: zrobic ustawianie statusu
            // aktualizujemy elementy
            $result = $this->db->update(table::ELEMENTS, $aElements, array('id_element' => $news_category[0]->element_id));

            // usuwamy polaczenia ze stronami
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $news_category[0]->element_id));

            $aPagesElements['element_id'] = $news_category[0]->element_id;
            // laczymy z nowo wybranymi stronami
            if (is_array($data['page_id'])) {
                foreach ($data['page_id'] as $iPId) {
                    $aPagesElements['page_id'] = $iPId;
                    $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
                }
            } else {
                $aPagesElements['page_id'] = $post['page_id'];
                $this->db->insert(table::PAGES_ELEMENTS, $aPagesElements);
            }
            if (!empty($data['show_title'])) {
                $data['show_title'] = $data['show_title'];
            } else {
                $data['show_title'] = 'Y';
            }
            $aNewsCategories['element_id'] = $news_category[0]->element_id;
            $aNewsCategories['news_category_name'] = $data['title'];
            $aNewsCategories['show_title'] = $data['show_title'];
            $aNewsCategories['id_news_subcategory'] = $data['id_news_subcategory'];
            $aNewsCategories['comments'] = (!empty($data['comments']) ? $data['comments'] : 0);
            // i dodajemy kategorie wiadomosci
            $this->db->update(table::NEWS_CATEGORIES, $aNewsCategories, array('id_news_category' => $iNewsCategoryId));

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_update_news_category'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_update_news_category'));
        }
    }

    public function DeleteNewsCategory($iNewsCategoryId) {
        try {
            $iNewsCategoryId+=0;

            $oNews2Categories = $this->db->from(table::NEWS_TO_CATEGORIES)->where(array('news_category_id' => $iNewsCategoryId))->get();
            if ($oNews2Categories->count() > 0) {
                return new ErrorReporting(ErrorReporting::WARNING, false, Kohana::lang('news.first_delete_news'));
            }

            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            //TODO: krok potwierdzający czy usunac wszystko wewnatrz czy nie
            // pobieramy id_elementu
            $oNewsCategory = $this->db->from(table::NEWS_CATEGORIES)->where(array('id_news_category' => $iNewsCategoryId))->get();

            // usuwamy powiązania 
            //nie jest konieczne, bo najpierw trzeba usunąć newsy z tej kategorii
            //$this->db->delete(table::NEWS_TO_CATEGORIES, array('news_category_id' => $iNewsCategoryId));
            // usuwamy kategorie newsow
            $this->db->delete(table::NEWS_CATEGORIES, array('id_news_category' => $iNewsCategoryId));
            // usuwamy element
            $this->db->delete(table::ELEMENTS, array('id_element' => $oNewsCategory[0]->element_id));
            // usuwamy powiazanie elementow ze stronami
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $oNewsCategory[0]->element_id));

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_delete_news_category'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_delete_news_category'));
        }
    }

    public function DeleteNewsCategoryArray($iNewsCategoryId) {
        try {
            if (is_array($iNewsCategoryId)) {
                foreach ($iNewsCategoryId as $iNC) {
                    $this->DeleteNewsCategory($iNC);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_delete_news_categories'));
            } else {
                $iNewsCategoryId+=0;
                return $this->DeleteNewsCategory($iNewsCategoryId);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_delete_news_categories'));
        }
    }

    public function DeleteNewsArray($iNewsIds) {
        try {
            if (is_array($iNewsIds)) {
                foreach ($iNewsIds as $iNI) {
                    $this->DeleteNews($iNI);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_delete_news'));
            } else {
                $iNewsIds+=0;
                return $this->DeleteNews($iNewsIds);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_delete_news'));
        }
    }

    /**
     * Zapisuje zmiany edycji aktualności
     * @param Integer $iNewsId
     * @param Array $data
     * @param Array $files
     * @return ErrorReporting
     */
    public function Update($iNewsId, Array $data, Array $files = null) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            // unset dla buttonow
            $alt = $data['alt'];
            $aNewsCategories = $data['news_categories'];
            unset($data['back'], $data['save_changes'], $data['alt'], $data['news_categories'], $data['submit'], $data['submit_back']);

            // dodajemy i usuwamy obrazki jesli trzeba
            $image = $files['photo'];
            $news_images = array();

            // sprawdzamy czy jest foto dla tego newsa
            $result = $this->db->from(table::NEWS_IMAGES)->where(array('news_id' => $iNewsId))
                    ->join(table::IMAGES, table::IMAGES . '.id_image', table::NEWS_IMAGES . '.images_id')
                    ->get();

            // tworzymy obrazki
            
            $aFilesPhotos = array();
            $file_count = count($files['photo']['name']);
            $file_keys = array_keys($files['photo']);

            for ($i = 0; $i < $file_count; $i++) {
                foreach ($file_keys as $key) {
                    $aFilesPhotos[$i][$key] = $files['photo'][$key][$i];
                }
            }
            var_dump($aFilesPhotos);
            foreach ($aFilesPhotos as $photo):
                // dodawanie obrazkow
                $aNewsImages = array();
                $aNewsImages['news_id'] = $iNewsId;
                $image = $photo;

                // tworzymy obrazki
                if (!empty($image) && is_array($image) && !empty($image['name'])) {
                    $imageData = file::upload(
                                    $image, array(
                                'unique' => true,
                                'width' => 880,
                                'height' => 510,
                                'thumbwidth' => 280,
                                'thumbheight' => 170,
                                'path' => $this->path,
                                'thumbpath' => $this->thumbpath
                                    )
                            )->Value;
                    $imageData['alt'] = $alt;
                    $imageData['mainimage'] = 0;

                    $result = $this->db->insert(table::IMAGES, $imageData);
                    
                    $aNewsImages['images_id'] = $result->insert_id();
                    $this->db->insert(table::NEWS_IMAGES, array('news_id'=>$iNewsId,'images_id'=> $aNewsImages['images_id']));
                }

          /*      //jeśli jest foto to update
                if ($result->count() > 0) {
                    // update fotki w bazie
                    $result3 = $this->db->update(table::IMAGES, $imageData, array('id_image' => $result[0]->images_id));
                    $news_images['images_id'] = $result[0]->images_id;
                } else { // nie bylo foty to wrzucamy nowe
                    $result4 = $this->db->insert(table::IMAGES, $imageData);
                    $news_images['images_id'] = $result4->insert_id();
                    $news_images['news_id'] = $iNewsId;
                    // dodajemy wpis laczacy fote z wiadomoscia
                    $this->db->insert(table::NEWS_IMAGES, $news_images);
                }*/
            endforeach;

               
        /*    

            // jesli jest foto i wrzucamy nowe to usuwamy stare
            if ($result->count() > 0 && !empty($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
                if (file_exists($this->path . $result[0]->filename)) { //duże foto
                    unlink($this->path . $result[0]->filename);
                }
                if (file_exists($this->thumbpath . $result[0]->filename)) { // miniaturka
                    unlink($this->thumbpath . $result[0]->filename);
                }
            }
         
         */
            // Koniec fotek
            // aktualizujemy aktualnosci
            $data['modified_date'] = TIME;
            if (!empty($data['news_start_date'])) {
                $data['news_start_date'] = layer::DateToInt($data['news_start_date']);
            }
            if (!empty($data['news_end_date'])) {
                $data['news_end_date'] = layer::DateToInt($data['news_end_date']);
            }
            if (!empty($data['date_added'])) {
                $data['date_added'] = layer::DateToInt($data['date_added']);
            }
            if (!empty($files) && is_array($files) && !empty($files['mainphoto']['tmp_name'])) {
                    $imageData = file::upload(
                                    $files['mainphoto'], array(
                                'unique' => true,
                                'width' => 880,
                                'height' => 510,
                                'thumbwidth' => 280,
                                'thumbheight' => 170,
                                'path' => $this->path,
                                'thumbpath' => $this->thumbpath
                                    )
                            )->Value;
                    
                   $data['mainfilename']= $imageData['filename'];
                  $data['mainphotoname']= $files['mainphoto']['name'];
                }
                if($data['del_main_image']=="1"){
                     $data['mainfilename']= "";
                  $data['mainphotoname']= "";
                  unset($data['del_main_image']);
                }else{
                     unset($data['del_main_image']);
                }
            // update wiadomosci
            $result2 = $this->db->update(table::NEWS, $data, array('id_news' => $iNewsId));

            // usuwamy stare powiazania NEWS_TO_CAREGORIES
            $this->db->delete(table::NEWS_TO_CATEGORIES, array('news_id' => $iNewsId));

            //dodajemy powiazanie NEWS_ELEMENTS
            $aNewsToCategories = array();
            $aNewsToCategories['news_id'] = $iNewsId;

            foreach ($aNewsCategories as $iNC) { // dodajemy powiazania aktualonosci ze elementami
                $aNewsToCategories['news_category_id'] = $iNC;
                $this->db->insert(table::NEWS_TO_CATEGORIES, $aNewsToCategories);
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_update_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            // TODO: jesli blad to wywalamy obrazek jesli zostal wrzucony
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_update_news'));
        }
    }

    public function GetNewsCategories($iLimit = null, $iOffset = null) {
        try {
            $result = $this->db->from(table::NEWS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::NEWS_CATEGORIES . '.element_id');

            if (isset($iLimit) && isset($iOffset)) {
                $result = $result
                        ->limit($iLimit, $iOffset);
            }

            if (!empty($_GET['cat_orderby'])) {
                switch ($_GET['cat_orderby']) {
                    case 1:
                        $result = $result->orderby(array('news_category_name' => 'ASC'));
                        break;
                    case 2:
                        $result = $result->orderby(array('news_category_name' => 'DESC'));
                        break;
                    case 3:
                        $result = $result->orderby(array(table::ELEMENTS . '.lang' => 'ASC'));
                        break;
                    case 4:
                        $result = $result->orderby(array(table::ELEMENTS . '.lang' => 'DESC'));
                        break;
                    case 5:
                        $result = $result->orderby(array(table::ELEMENTS . '.date_added' => 'ASC'));
                        break;
                    case 6:
                        $result = $result->orderby(array(table::ELEMENTS . '.date_added' => 'DESC'));
                        break;
                    case 7:
                        $result = $result->orderby(array(table::ELEMENTS . '.modified_date' => 'ASC'));
                        break;
                    case 8:
                        $result = $result->orderby(array(table::ELEMENTS . '.modified_date' => 'DESC'));
                        break;
                    case 9:
                        $result = $result->orderby(array(table::ELEMENTS . '.available' => 'ASC'));
                        break;
                    case 10:
                        $result = $result->orderby(array(table::ELEMENTS . '.available' => 'DESC'));
                        break;
                }
            } else {
                $result = $result->orderby(array('id_news_category' => 'DESC'));
            }


            $result = $result
                    ->groupby('id_news_category')
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_get_news_categories'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_categories'));
        }
    }

    /**
     * Pobiera dane kategorii aktualności
     * @param Integer $iNewsCategoriesId
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetNewsCategoryDetails($iNewsCategoriesId) {
        try {
            $result = $this->db->from(table::NEWS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::NEWS_CATEGORIES . '.element_id')
                    ->where(array('id_news_category' => $iNewsCategoriesId))
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_get_news_category_details'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_category_details'));
        }
    }

    /**
     *  
     * @param <type> $newsId
     * @return ErrorReporting
     */
    public function GetNews($newsId) {
        try {
            $result = $this->db->from(table::NEWS)->where(array('id_news' => $newsId))
                    ->join(table::NEWS_IMAGES, table::NEWS . '.id_news', table::NEWS_IMAGES . '.news_id', 'LEFT')
                    ->join(table::IMAGES, table::NEWS_IMAGES . '.images_id', table::IMAGES . '.id_image', 'LEFT')
                    ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news', 'LEFT')
                    ->join(table::NEWS_CATEGORIES, table::NEWS_CATEGORIES . '.id_news_category', table::NEWS_TO_CATEGORIES . '.news_category_id', 'LEFT')
                    ->groupby('id_news')
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_insert_news'));
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    public function GetNewsImages($newsId) {
        try {
            $result = $this->db->from(table::NEWS)->where(array('id_news' => $newsId))
                    ->join(table::NEWS_IMAGES, table::NEWS . '.id_news', table::NEWS_IMAGES . '.news_id', 'LEFT')
                    ->join(table::IMAGES, table::NEWS_IMAGES . '.images_id', table::IMAGES . '.id_image', 'LEFT')
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_insert_news'));
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    /**
     * Pobiera meta dane dla newsa
     * @param Integer $iNewsId
     * @return ErrorReporting (MySQL Object $results || Bool false)
     */
    public function GetNewsMeta($iNewsId) {
        try {

            $result = $this->db->from(table::NEWS)
                            ->select('meta_title, meta_description, meta_keywords')
                            ->where(array('id_news' => $iNewsId))->get();


            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_meta'));
        }
    }

    public function GetPageIdByElementId($IdElement) {
        $results = $this->db->from(table::PAGES_ELEMENTS)
                ->select('page_id')
                ->where(array('element_id' => $IdElement))
                ->get();
        $result = $results[0]->page_id;
        return $result;
    }

    /*
     * Pobiera kategorie aktualności i zwraca jako tablicę
     * @param String $sLang
     * @return ErrorReporting (Array $aNewsCategories || Bool false)
     */

    public function GetNewsCategoriesAsArray($sLang) {
        try {
            $results = $this->db->from(table::NEWS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::NEWS_CATEGORIES . '.element_id')
                    ->where(array('lang' => $sLang))
                    ->get();
            $aNewsCategories = array();
            foreach ($results as $result) {
                $aNewsCategories[$result->id_news_category] = $result->news_category_name;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $aNewsCategories, Kohana::lang('news.success_get_news_categories_as_array'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_categories_as_array'));
        }
    }

    public function GetNewsByElementId($elementId) {
        try {
            $result = $this->db->from(table::NEWS)->where(array(table::NEWS_ELEMENTS . '.element_id' => $elementId))
                    ->join(table::NEWS_IMAGES, table::NEWS . '.id_news', table::NEWS_IMAGES . '.news_id', 'LEFT')
                    ->join(table::IMAGES, table::NEWS_IMAGES . '.images_id', table::IMAGES . '.id_image', 'LEFT')
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::NEWS . '.element_id')
                    ->select('*, ' . table::LANGUAGES . '.description AS language_description')
                    ->join(table::NEWS_ELEMENTS, table::NEWS_ELEMENTS . '.news_id', table::NEWS . '.id_news', 'LEFT')
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_insert_news'));
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    /*
     * Liczy aktualnosci dla kategorii (pages)
     * @param Integer $iCategoryId
     * @return Object ErrorReporting (Integer $results[0]->ile || false)
     */

    public function CountNewsForCategory($iCategoryId) {
        try {
            $iCategoryId+=0;
            $results = $this->db->from(table::NEWS)
                    ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news')
                    ->where(array('news_category_id' => $iCategoryId))
                    ->select('COUNT(id_news) AS ile')
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $results[0]->ile, Kohana::lang('news.success_count_news_for_category'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_count_news_for_category'));
        }
    }

    public function NewsCount($elementId = null) {
        try {
            $results = $this->db->from(table::NEWS)
                    ->join(table::NEWS_ELEMENTS, table::NEWS_ELEMENTS . '.news_id', table::NEWS . '.id_news', 'LEFT')
                    ->where(array(table::NEWS_ELEMENTS . '.element_id' => $elementId))
                    ->select('COUNT(id_news) AS ile')
                    ->get();
            echo '<pre>';
            var_dump($results);
            echo '</pre>';
            exit;

            return new ErrorReporting(ErrorReporting::SUCCESS, $results[0]->ile, Kohana::lang('news.success_insert_news'));
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
        }
    }

    public function GetAllNews($iNewsCategoryId = null, $limit = null, $offset = null) {
        try {
            $iNewsCategoryId+=0;
            $this->db->from(table::NEWS)
                    ->join(table::LANGUAGES, table::LANGUAGES . '.name', table::NEWS . '.lang')
                    ->select('*, ' . table::LANGUAGES . '.description AS language_description')
                    ->join(table::NEWS_IMAGES, table::NEWS . '.id_news', table::NEWS_IMAGES . '.news_id', 'LEFT')
                    ->join(table::IMAGES, table::NEWS_IMAGES . '.images_id', table::IMAGES . '.id_image', 'LEFT')
                    ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news'); //FIX: cos nie tak z description!
            if (isset($limit) && isset($offset)) {
                $this->db->limit($limit, $offset);
            }
            if (!empty($iNewsCategoryId)) {
                $this->db->where(array('news_category_id' => $iNewsCategoryId));
            }
            if (!empty($_GET['news_orderby'])) {
                switch ($_GET['news_orderby']) {
                    case 1:
                        $result = $this->db->orderby('title', 'ASC')->get();
                        break;
                    case 2:
                        $result = $this->db->orderby('title', 'DESC')->get();
                        break;
                    case 3:
                        $result = $this->db->orderby('lang', 'ASC')->get();
                        break;
                    case 4:
                        $result = $this->db->orderby('lang', 'DESC')->get();
                        break;
                    case 5:
                        $result = $this->db->orderby('date_added', 'ASC')->get();
                        break;
                    case 6:
                        $result = $this->db->orderby('date_added', 'DESC')->get();
                        break;
                    case 7:
                        $result = $this->db->orderby('modified_date', 'ASC')->get();
                        break;
                    case 8:
                        $result = $this->db->orderby('modified_date', 'DESC')->get();
                        break;
                    case 9:
                        $result = $this->db->orderby('news_start_date', 'ASC')->get();
                        break;
                    case 10:
                        $result = $this->db->orderby('news_start_date', 'DESC')->get();
                        break;
                    case 11:
                        $result = $this->db->orderby('available', 'ASC')->get();
                        break;
                    case 12:
                        $result = $this->db->orderby('available', 'DESC')->get();
                        break;
                }
            } else {
                $result = $this->db->orderby('date_added', 'DESC')->groupby('id_news')->get();
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_get_all_news'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_all_news'));
        }
    }

    /*
     * Do pobierania newsów z wybranej kategorii. Wykorzystywana przez:
     * (Pages) edit_page_content() - edycja treści dla całej strony
     *
     * @param Integer $iCategoryId
     * @param Integer $iLimit
     * @param Integer $iOffset
     * @return Object ErrorReporting (MySQL Object $result || Bool false)
     */

    public function GetNewsForCategory($iCategoryId, $iLimit = null, $iOffset = null) {
        try {
            $this->db->from(table::NEWS)
                    ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news')
                    ->join(table::NEWS_CATEGORIES, table::NEWS_CATEGORIES . '.id_news_category', table::NEWS_TO_CATEGORIES . '.news_category_id');

            if (isset($iLimit) && isset($iOffset)) {
                $this->db->limit($iLimit, $iOffset);
                $this->db->orderby(table::NEWS . '.id_news', 'DESC');
            }
            if (!empty($iCategoryId)) {
                $this->db->where(array(table::NEWS_CATEGORIES . '.id_news_category' => $iCategoryId));
            }
            $result = $this->db->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_get_news_for_category'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_for_category'));
        }
    }

    /*
     * Pobiara kategorie aktualnosci dla elementu (pages)
     * @param Integer $iElementId
     * @return Object ErrorReporting (SQL Object || false)
     */

    public function GetNewsCategoryForElement($iElementId) {
        try {
            $result = $this->db->from(table::NEWS_CATEGORIES)
                    ->where(array('element_id' => $iElementId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_get_news_category_for_element'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_category_for_element'));
        }
    }

    public function GetNewsForElement($elementId, $limit = null, $offset = null) {
//        try {
        $this->db->from(table::NEWS)
                ->join(table::LANGUAGES, table::LANGUAGES . '.name', table::NEWS . '.lang')
                ->select('*, ' . table::LANGUAGES . '.description AS language_description, ' . table::NEWS . '.description AS news_description,' . table::NEWS_CATEGORIES . '.element_id AS eid')
                ->join(table::NEWS_IMAGES, table::NEWS . '.id_news', table::NEWS_IMAGES . '.news_id', 'LEFT')
                ->join(table::IMAGES, table::NEWS_IMAGES . '.images_id', table::IMAGES . '.id_image', 'LEFT')
                ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news', 'LEFT')
                ->join(table::NEWS_CATEGORIES, table::NEWS_CATEGORIES . '.id_news_category', table::NEWS_TO_CATEGORIES . '.news_category_id', 'LEFT')
                ->where(new Database_Expression('( news_start_date<=' . layer::DateToInt(date('d-m-Y')) . ' OR news_start_date = 0  OR news_start_date IS NULL )'))
                ->where(new Database_Expression('( news_end_date>=' . layer::DateToInt(date('d-m-Y')) . ' OR news_end_date = 0 OR news_end_date IS NULL )'))
                ->where(table::NEWS . '.available', 1)
                ->orderby(array('date_added' => 'DESC'));
        //->join(table::NEWS_ELEMENTS, table::NEWS_ELEMENTS.'.news_id', table::NEWS.'.id_news', 'LEFT');
        if (isset($limit) && isset($offset)) {
            $this->db->limit($limit, $offset);
        }
        if (!empty($elementId)) {
            $this->db->where(array(table::NEWS_CATEGORIES . '.element_id' => $elementId));
        }
        $result = $this->db->get();

        return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('news.success_insert_news'));
//        }
//        catch(Exception $ex) {
//            //var_dump($ex->getMessage());
//            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
//            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_insert_news'));
//        }
    }

    public function DeleteNews($newsId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $newsId+=0;
            $this->db->delete(table::NEWS, array('id_news' => $newsId));

            //sprawdzamy czy byly foty
            $imagecheck = $this->db->from(table::NEWS_IMAGES)->where(array('news_id' => $newsId))->get();
            //var_dump($imagecheck);

            if ($imagecheck->count() > 0) {
                $files = $this->db->from(table::IMAGES)->where(array('id_image' => $imagecheck[0]->images_id))->get();
                $this->db->delete(table::IMAGES, array('id_image' => $imagecheck[0]->images_id));
                $this->db->delete(table::NEWS_IMAGES, array('news_id' => $newsId));
            }
            $this->db->delete(table::NEWS_TO_CATEGORIES, array('news_id' => $newsId));
            $this->db->query('COMMIT');
            // po wywaleniu wszystkiego z bazy usuwamy fote
            if ($imagecheck->count() > 0) {
                if (file_exists($this->path . $files[0]->filename)) { //duże foto
                    unlink($this->path . $files[0]->filename);
                }
                if (file_exists($this->thumbpath . $files[0]->filename)) { //miniaturka
                    unlink($this->thumbpath . $files[0]->filename);
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_delete_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_delete_news'));
        }
    }

    public function DeleteNewsByElementId($elementId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $elementId+=0;

            $news = $this->db->from(table::NEWS_CATEGORIES)->where(array('element_id' => $elementId))->get();

            //usuwamy wszystkie newsy
            foreach ($news_cats as $ns) {
                if ($this->DeleteNewsCategory($ns->id_news_category)->Type === ErrorReporting::ERROR) {
                    throw new Exception();
                }
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('news.success_delete_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_delete_news'));
        }
    }

    /*
     * Walidacja dla dodawania aktualnosci
     * pole tytul (title) i tresc (description), kategoria newsów, język nie moga byc puste
     * w przypadku podania dat początkowej < końcowej
     * @param Array $aData
     * @return ErrorReporting (Bool true || Bool false)
     */

    public function ValidateNews($aData) { // TODO: fajnie jakby errory wyswietlaly sie w liscie a nie pojedynczo
        if (empty($aData['title'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_title_empty'));
        } else if (empty($aData['description'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_description_empty'));
        } else if (empty($aData['news_categories'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_news_categories_empty'));
        } else if (empty($aData['lang'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_language_empty'));
        } else if (!empty($aData['news_start_date']) && !empty($aData['news_end_date'])) {
            $start_date = layer::DateToInt($aData['news_start_date']);
            $end_date = layer::DateToInt($aData['news_end_date']);
            if ($start_date > $end_date) {
                return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_news_start_date_bigger_than_end_date'));
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
            }
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function ValidateNewsCategories($data) { // TODO: fajnie jakby errory wyswietlaly sie w liscie a nie pojedynczo
        // pole tytul (title) i tresc (description) nie moga byc puste
        if (empty($data['title'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_news_category_title_empty'));
        } else if (empty($data['page_id'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_news_category_pages_empty'));
        } else if (empty($data['lang'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_language_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function GetNewsCategoriesForLang($lang, $bAsArray = null) {
        try {
            $this->db->from(table::NEWS_CATEGORIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::NEWS_CATEGORIES . '.element_id');

            if (is_array($lang)) {
                $this->db->in('lang', $lang);
            } else {
                $this->db->where(array('lang' => $lang));
            }
            $result = $this->db->get();

            if (empty($bAsArray)) {
                $html = '';
                foreach ($result as $r) {
                    $html .= '<option value="' . $r->id_news_category . '">' . $r->news_category_name . '</option>';
                }
            } else {
                $html = array();
                foreach ($result as $r) {
                    $html[$r->id_news_category] = $r->news_category_name;
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $html, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_elements_for_lang'));
        }
    }

    public function GetNewsCategoriesForNews($iNewsId) {
        try {
            $result = $this->db->from(table::NEWS_TO_CATEGORIES)
                    ->where(array('news_id' => $iNewsId))
                    ->get();

            $selected = array();
            foreach ($result as $r) {
                $selected[] = $r->news_category_id;
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, $selected, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('news.error_get_news_elements'));
        }
    }

    // AJAX
    public function AjaxDeleteImages($data) {
        try {
            $data = explode('_', $data['id']);
            // pobieramy id obrazka
            $id_news_images = end($data);

            // pobieramy nazwe pliku
            $result = $this->db->from(table::NEWS_IMAGES)->where(array('id_news_images' => $id_news_images))->get();
            //usuwamy z dysku

            $result2 = $this->db->from(table::IMAGES)->where(array('id_image' => $result[0]->images_id))->get();

            $path = 'files/news/big/';
            $mediumpath = 'files/news/medium/';
            $thumbpath = 'files/news/small/';

            if (file_exists($path . $result2[0]->filename)) { // duże foto
                unlink($path . $result2[0]->filename);
            }
            if (file_exists($mediumpath . $result2[0]->filename)) { // srednie foto
                unlink($mediumpath . $result2[0]->filename);
            }
            if (file_exists($thumbpath . $result2[0]->filename)) { // male foto
                unlink($thumbpath . $result2[0]->filename);
            }

            // usuwamy z bazy obrazkow
            $this->db->delete(table::IMAGES, array('id_image' => $result[0]->images_id));
            // i usuwamy polaczenie z newsem
            $this->db->delete(table::NEWS_IMAGES, array('id_news_images' => $id_news_images));

            return $id_news_images;
        } catch (Exception $ex) {
            return 'false';
        }
    }

    public function ValidateNewsCommentAdd($aData) {
        try {
            $aData = array_map('trim', $aData);
            $aErrors = array();
            if (empty($aData['comment'])) {
                $aErrors[] = Kohana::lang('app.error_comment_empty');
            }
            if (empty($aData['nick'])) {
                $aErrors[] = Kohana::lang('app.error_nick_empty');
            }
            if (!Captcha::valid($aData['captcha_response'])) {
                $aErrors[] = Kohana::lang('app.wrong_captcha');
            }

            if (empty($aErrors)) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                $message = Kohana::lang('app.following_errors') . ':<ul>';
                foreach ($aErrors as $sError) {
                    $message .= '<li>' . $sError . '</li>';
                }
                $message .= '</ul>';
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, $message);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('app.error_validate_news_comment_add'));
        }
    }

    public function NewsCommentAdd($aData, $iNewsId) {
        try {
            $iNewsId += 0;
            $aData = array_map('trim', $aData);
            $aData['news_id'] = $iNewsId;
            $aData['client_ip'] = layer::ClientIp();
            unset($aData['submit'], $aData['captcha_response']);

            $result = $this->db->insert(table::NEWS_COMMENTS, $aData);

            if ($result->count() == 1) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('app.success_news_comment_add'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('app.error_news_comment_add'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('app.error_news_comment_add'));
        }
    }

    public function GetMainCategories() {
        try {
            $this->db->from(table::NEWS_CATEGORIES)->where('id_news_subcategory', '0');

            $result = $this->db->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('news.error_get_comments'));
        }
    }

    public function getComments($iNewsId, $iLimit = NULL, $iOffset = NULL) {
        try {
            $iNewsId += 0;
            $this->db->from(table::NEWS_COMMENTS)->where('news_id', $iNewsId);
            if (!is_null($iLimit) AND !is_null($iOffset)) {
                $this->db->limit($iLimit, $iOffset);
            } elseif (!is_null($iLimit) AND is_null($iOffset)) {
                $this->db->limit($iLimit);
            }
            $result = $this->db->orderby('id_news_comment', 'DESC')->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('news.error_get_comments'));
        }
    }

    public function DeleteComment($iCommentId) {
        try {
            $iCommentId += 0;
            $result = $this->db->delete(table::NEWS_COMMENTS, array('id_news_comment' => $iCommentId));

            if ($result->count() == 1) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('news.success_news_comment_delete'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('news.error_news_comment_delete'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('news.error_news_comment_delete'));
        }
    }

    public function PostComment($iNewsId) {
        try {
            if (!empty($_POST)) {
                $oValid = $this->ValidateNewsCommentAdd($_POST);
                if ($oValid->Type === ErrorReporting::SUCCESS) {
                    $result = $this->NewsCommentAdd($_POST, $iNewsId);
                    if ($result->Type === ErrorReporting::SUCCESS) {
                        unset($_POST);
                    }
                    $this->_oSession->set('msg', $result->__toString());
                } else {
                    $this->_oSession->set('msg', $oValid->__toString());
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, NULL);
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . ':' . __LINE__ . ':' . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, 'Wystąpił błąd przy dodawaniu komentarza');
        }
    }

}

?>