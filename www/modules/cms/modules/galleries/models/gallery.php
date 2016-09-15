<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Gallery_Model extends Model_Core {

    private $big_path;
    private $small_path;
    private $medium_path;
    private $big_image_height;
    private $big_image_width;
    private $medium_image_height;
    private $medium_image_width;
    private $small_image_height;
    private $small_image_width;

    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->big_path = gallery_helper::BIG_PATH;
        $this->small_path = gallery_helper::SMALL_PATH;
        $this->medium_path = gallery_helper::MEDIUM_PATH;
        $this->big_image_height = gallery_helper::GALLERY_BIG_IMAGE_HEIGHT;
        $this->big_image_width = gallery_helper::GALLERY_BIG_IMAGE_WIDTH;
        $this->medium_image_height = gallery_helper::GALLERY_MEDIUM_IMAGE_HEIGHT;
        $this->medium_image_width = gallery_helper::GALLERY_MEDIUM_IMAGE_WIDTH;
        $this->small_image_height = gallery_helper::GALLERY_SMALL_IMAGE_HEIGHT;
        $this->small_image_width = gallery_helper::GALLERY_SMALL_IMAGE_WIDTH;
    }

    /**
     * Pobieranie wszystkich galleri dla listy gallerii (galleries.php)
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetAllGalleries($limit = null, $offset = null) {
        try {
            $result = $this->db
                    ->select('*, ' . table::LANGUAGES . '.description AS language_description, ' . table::GALLERIES . '.name AS gallery_name, ' . table::GALLERIES . '.description AS gallery_description')
                    ->from(table::GALLERIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::GALLERIES . '.element_id')
                    ->join(table::LANGUAGES, table::LANGUAGES . '.name', table::ELEMENTS . '.lang');

            if (isset($limit) && isset($offset)) {
                $result = $result
                        ->limit($limit, $offset);
            }
            
            if(!empty($_GET['galleries_orderby'])) {
            		switch ($_GET['galleries_orderby']) {
                		case 1:
                			$result = $result->orderby(array('gallery_name' => 'ASC'));
                    	break;
                		case 2:
                			$result = $result->orderby(array('gallery_name' => 'DESC'));
                    	break;
                    	case 3:
                			$result = $result->orderby(array('gallery_description' => 'ASC'));
                    	break;
                    	case 4:
                			$result = $result->orderby(array('gallery_description' => 'DESC'));
                    	break;
                    	case 5:
                			$result = $result->orderby(array('language_description' => 'ASC'));
                    	break;
                    	case 6:
                			$result = $result->orderby(array('language_description' => 'DESC'));
                    	break;
                		}	
                    }
            else {
                  	$result = $result->orderby('date_added', 'DESC');
            }

            $result = $result->get();
          
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('gallery.success_get_all_galleries'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage()."\n SQL:".$this->db->last_query());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_get_all_galleries'));
        }
    }

    /**
     * Dodawanie nowej galerii
     * @param Array $aPost
     * @return Bool
     */
    public function InsertGallery($aPost) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            $pages_id = $aPost['page_id'];

            //ustalamy dane do tabelki elements
            $table_elements['lang'] = $aPost['lang'];
            $table_elements['type'] = element_helper::$elements_types_for_switch['galleries'];
            $table_elements['date_added'] = time();

            // wstawiamy nowy element
            $result = $this->db->insert(table::ELEMENTS, $table_elements);
            $elementId = $result->insert_id();

            //ustlamy dane do tabelki galerries

            if (!empty($aPost['show_title'])) {
                $aPost['show_title'] = $aPost['show_title'];
            } else {
                $aPost['show_title'] = 'Y';
            }

            $table_galleries['name'] = $aPost['name'];
            $table_galleries['description'] = $aPost['description'];
            $table_galleries['element_id'] = $elementId;
            $table_galleries['show_title'] = $aPost['show_title'];

            // wstawiamy nowa galerie
            $insert = $this->db->insert(table::GALLERIES, $table_galleries);

            //ustlamy dane do tabelki pages_elements
            $table_pages_elements['element_id'] = $elementId;
            //dla każdej strony osobny wpis
            if (is_array($pages_id)) {
                foreach ($pages_id as $page_id) {
                    $table_pages_elements['page_id'] = $page_id;
                    $this->db->insert(table::PAGES_ELEMENTS, $table_pages_elements);
                }
            } else {
                $table_pages_elements['page_id'] = $pages_id;
                $this->db->insert(table::PAGES_ELEMENTS, $table_pages_elements);
            }
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), Kohana::lang('gallery.success_insert_gallery'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_insert_gallery'));
        }
    }

    /**
     * Zapis zmian dla edycji gallerii
     * @param Array $aData
     * @param Integer $aGalleryId
     */
    public function UpdateGallery($aData, $aGalleryId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            //zapisanie zaznaczonych stron do zmiennej
            $pages_id = $aData['page_id'];


            if (!empty($aData['show_title'])) {
                $aData['show_title'] = $aData['show_title'];
            } else {
                $aData['show_title'] = 'Y';
            }

            //dane do tabeli galleries
            $aGalleries['name'] = $aData['name'];
            $aGalleries['description'] = $aData['description'];
            $aGalleries['show_title'] = $aData['show_title'];

            //update tabeli galleries
            $this->db->update(table::GALLERIES, $aGalleries, array('id_gallery' => $aGalleryId));

            //dane do tabeli elements
            $iElementId = $this->_GetGalleryElementId($aGalleryId)->Value;
            $aElements['modified_date'] = time();
            $aElements['lang'] = $aData['lang'];

            //update tabeli elements
            $this->db->update(table::ELEMENTS, $aElements, array('id_element' => $iElementId));

            //usuwamy istniejące powiazania galeri ze stronami
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $iElementId));

            //zapisanie dla każdej zaznaczonej strony osobnego wpisu w tabelce pages_elements
            $table_pages_elements['element_id'] = $iElementId;
            if (is_array($pages_id)) {
                foreach ($pages_id as $page_id) {
                    $table_pages_elements['page_id'] = $page_id;
                    $this->db->insert(table::PAGES_ELEMENTS, $table_pages_elements);
                }
            } else {
                $table_pages_elements['page_id'] = $pages_id;
                $this->db->insert(table::PAGES_ELEMENTS, $table_pages_elements);
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_update_gallery'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_update_gallery'));
        }
    }

    /**
     * Usuwanie galerii
     * @param Integer $iGalleryId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteGallery($iGalleryId) {
        try {
            $iGalleryId+=0;
            //pobieranie elementId
            $elementId = $this->_GetGalleryElementId($iGalleryId)->Value;

            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            // usuwamy galerie z tabelki galerries
            $this->db->delete(table::GALLERIES, array('element_id' => $elementId));

            // usuwamy powiązanie galerii z  tabelka elements
            $this->db->delete(table::ELEMENTS, array('id_element' => $elementId));

            // usuwamy powiązanie galerii z tabelka pages_elements
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $elementId));

            //usuwamy wszystkie zdjecia z danej galerii

            $images = $this->db->from(table::GALLERIES_IMAGES)->where(array('gallery_id' => $iGalleryId))->get();
            foreach ($images as $image) {
                $this->DeletePhoto($image->image_id); // funkcja usuwa z tabeli obrazkow i tabeli wiazacej galerie z obrazkami
            }
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_delete_gallery'));
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_delete_gallery'));
        }
    }

    /**
     * Usuwanie galerii wybranych przez checkboxy
     * @param Array $aGalleries
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeleteGalleryArray($aGalleries) {
        try {
            foreach ($aGalleries as $aGallery) {
                $this->DeleteGallery($aGallery);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_delete_gallery'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_delete_gallery'));
        }
    }

    /**
     * Pobiera dane galerii (edycja gallerii)
     * @param Integer $iGalleryId
     * @param String $sGalleryLang
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetGallery($iGalleryId, $sGalleryLang) {
        try {
            $iGalleryId+=0;
            $result = $this->db->from(table::GALLERIES)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::GALLERIES . '.element_id')
                    ->where(array('id_gallery' => $iGalleryId, 'lang' => $sGalleryLang))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('gallery.success_get_gallery'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_get_gallery'));
        }
    }

    public function GetGalleryName($iGalleryId) {
        try {
            $iGalleryId+=0;
            $result = $this->db->from(table::GALLERIES)
                    ->where(array('id_gallery' => $iGalleryId))
                    ->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('gallery.success_get_gallery'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_get_gallery'));
        }
    }

    /**
     * Pobieranie galerii dla strony.
     * @param Integer $iElementId
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetGalleryByElementId($iElementId) {
        try {
            $iElementId+=0;
            $result = $this->db->from(table::GALLERIES)
                            ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::GALLERIES . '.element_id')
                            ->where(array('element_id' => $iElementId))->get();
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('gallery.success_get_gallery'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_get_gallery'));
        }
    }

    /**
     * Walidacja dodawania i edycji galerii
     * // name i strona nie moga byc puste
     * @param Array $aPost
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function ValidateAddGallery($aPost) {
        if (empty($aPost['name'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_name_empty'));
        } else if (empty($aPost['page_id']) && $aPost['page_id']->count() > 0) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_page_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function ValidateEditGallery($data, $galleryId, $galleryLang) {
        // name i lang nie moga byc puste i trzeba sprawdzic czy taki wpis juz nie istnieje
        //var_dump($data);
        if (empty($data['name'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_name_empty'));
        } else if (empty($data['lang'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_language_empty'));
        } else if ($data['lang'] != $galleryLang && $this->_GalleryExist($galleryId, $data['lang'])->Value === true) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_gallery_exist'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    /**
     * Walidacja dodawania obrazka
     * @param Array $aFile
     * @param Array $aData
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function ValidateAddImage($aFile, $aData) {
        $sAlert = '';

        /*

          $no_file = true;
          $file_type_error = array();
          $size_error = array();
          for ($i = 0; $i < count($aFile['name']); $i++) {
          $no_file = $no_file && ($aFile['error'][$i] == UPLOAD_ERR_NO_FILE);
          if (
          ($aFile['type'][$i] != 'image/gif')
          && ($aFile['type'][$i] != 'image/png')
          && ($aFile['type'][$i] != 'image/jpg')
          && ($aFile['type'][$i] != 'image/jpeg')
          && ($aFile['type'][$i] != 'image/x-png')
          && ($aFile['type'][$i] != 'image/pjpeg')
          ) {
          $file_type_error[] = $i;
          }
          if($aFile['error'][$i] == UPLOAD_ERR_INI_SIZE){
          $sAlert .= '<li>' . Kohana::lang('gallery.file_size_error') . '</li>';
          }
          }
          if ($no_file == true) {
          $sAlert .= '<li>' . Kohana::lang('gallery.no_file') . '</li>';
          }
          if (count($file_type_error) > 0) {
          $sAlert .= '<li>' . Kohana::lang('gallery.file_type_error') . '</li>';
          }
         */


        if (empty($aFile['tmp_name'])) {
            $sAlert .= '<li>' . Kohana::lang('gallery.no_file') . ' - <strong>'.$aFile['name'] . '</strong></li>';
        } else if (($aFile['type'] != 'image/gif') && ($aFile['type'] != 'image/png') && ($aFile['type'] != 'image/jpg') && ($aFile['type'] != 'image/jpeg') && ($aFile['type'] != 'image/x-png') && ($aFile['type'] != 'image/pjpeg')) {
            $sAlert .= '<li>' . Kohana::lang('gallery.file_type_error') . ' - <strong>'.$aFile['name'] . '</strong></li>';
        } else if ($aFile['size'] > 3145728) {
            $sAlert .= '<li>' . Kohana::lang('gallery.file_size_error') . ' - <strong>'.$aFile['name']. '</strong></li>';
        }


        if (!empty($sAlert)) {
            //$sAlert = Kohana::lang('gallery.following_errors') . ': <ul>' . $sAlert . '</ul>';
            return new ErrorReporting(ErrorReporting::ERROR, false, $sAlert);
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    /**
     * Pobiera język dla galerii
     *
     */
    public function GetLangsForGallery($galleryId) {
        try {
            $galleryId+=0;
            $result = $this->db->from(table::GALLERIES)->select('lang')->where(array('id_gallery' => $galleryId))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_getlangsforgallery_gallery'));
        }
    }

    // To bylo w pages ale nie jest tam potrzebne
    public function GetLangsForGalleryByElementId($elementId) {
        try {
            $elementId+=0;
            $result = $this->db->from(table::GALLERIES)->where(array('element_id' => $elementId))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_getlangsforgallery_gallery'));
        }
    }

    private function _GalleryExist($galleryId, $galleryLang) {
        try {
            $galleryId+=0;
            $result = $this->db->from(table::GALLERIES)->where(array('id_gallery' => $galleryId, 'lang' => $galleryLang))->get();
            if ($result->count() > 0) {
                return new ErrorReporting(ErrorReporting::ERROR, true, '');
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_exist_gallery'));
        }
    }

    private function _GalleryExistByElementId($elementId) {
        try {
            $elementId+=0;
            $result = $this->db->from(table::GALLERIES)->where(array('element_id' => $elementId))->get();
            if ($result->count() > 0) {
                return new ErrorReporting(ErrorReporting::ERROR, true, '');
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, false, '');
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_exist_gallery'));
        }
    }

    /**
     * Pobiera zdjęcia dla galerii
     * @param Integer $iGalleryId
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetPhotos($iGalleryId) {
        try {
            $iGalleryId+=0;
            $result = $this->db->from(table::GALLERIES_IMAGES)
                    ->join(table::GALLERY_IMAGES, table::GALLERIES_IMAGES . '.image_id', table::GALLERY_IMAGES . '.id_image')
                    ->where(array('gallery_id' => $iGalleryId))
                    ->groupby('image_id');
					
                    
            if(!empty($_GET['images_orderby'])) {
            		switch ($_GET['images_orderby']) {
                		case 1:
                			$result = $result->orderby(array('position' => 'ASC'));
                    	break;
                		case 2:
                			$result = $result->orderby(array('position' => 'DESC'));
                    	break;
                    	case 3:
                			$result = $result->orderby(array('alt' => 'ASC'));
                    	break;
                    	case 4:
                			$result = $result->orderby(array('alt' => 'DESC'));
                    	break;
                		}	
                    }
            else {
                  	$result = $result->orderby(array('position' => 'DESC', 'id_image' => 'ASC'));
            }
            $result = $result->get();
            //Kohana::log('debug', $this->db->last_query());            
            return new ErrorReporting(ErrorReporting::ERROR, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_get_photos'));
        }
    }

    /**
     * Pobieranie zdjęć dla edycji zawartości strony (pages)
     * (?)funkcja dla klienka do pobierania fotek
     * @param Integer $iElementId
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */
    public function GetPhotosByElementId($iElementId) {
        try {
            $iElementId+=0;
            $result = $this->db->from(table::GALLERIES_IMAGES)
                    ->join(table::GALLERY_IMAGES, table::GALLERIES_IMAGES . '.image_id', table::GALLERY_IMAGES . '.id_image')
                    ->join(table::GALLERIES, table::GALLERIES . '.id_gallery', table::GALLERIES_IMAGES . '.gallery_id')
                    ->where(array('element_id' => $iElementId))
                    ->groupby('image_id')
					->orderby(array('position' => 'DESC', 'id_image' => 'ASC'))
                    ->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_get_photos'));
        }
    }

    /**
     * Dodawanie zdjęcia.
     * 1. Dla edycji zawartości strony (pages).
     * @param Array $aPost
     * @param Array $aFiles
     * @param Integer $iGalleryId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function AddImage($aPost, $aFiles, $iGalleryId = null) {
//        try {
        $iGalleryId+=0;
        $this->db->query('SET AUTOCOMMIT = 0');
        $this->db->query('BEGIN');

        // unset dla buttonow
        unset($aPost['back'], $aPost['send_photo']);
        $image = $aFiles;
        $galleries_images = array();
        if (empty($iGalleryId) && !empty($aPost['element_id'])) {
            $iGalleryId = $this->_GetGalleryId($aPost['element_id'])->Value; // pobieramy id galerii
            if ($iGalleryId === false) { // jesli byl blad w pobieraniu id galerii
                throw new Exception();
            } else {
                $galleries_images['gallery_id'] = $iGalleryId;
            }
        } else if (!empty($iGalleryId)) {
            $galleries_images['gallery_id'] = $iGalleryId;
        } else {
            throw new Exception();
        }


        // tworzymy obrazki
        if (!empty($image) && is_array($image) && !empty($image['name'])) {
            $imageData = file::upload(
                            $image, array(
                        'unique' => true,
                        'width' => $this->big_image_width,
                        'height' => $this->big_image_height,
                        'thumbwidth' => $this->small_image_width,
                        'thumbheight' => $this->small_image_height,
                        'path' => $this->big_path,
                        'thumbpath' => $this->small_path,
                            )
                    )->Value;
            $imageData['mainimage'] = 0;
			
			$oLastPosition = $this->GetPhotos($iGalleryId)->Value[0];
			if ( ! empty($oLastPosition))
			{
				$imageData['position'] = $oLastPosition->position + 1;
			}

            // umieszczamy je w bazie
            $result = $this->db->insert(table::GALLERY_IMAGES, $imageData);
            $galleries_images['image_id'] = $result->insert_id();

            // i dodajemy polaczenie foty z galeriami dla kazdego jezyka

            $galleries_images['alt'] = $aPost['alt'];
            $result2 = $this->db->insert(table::GALLERIES_IMAGES, $galleries_images);
        }

        $this->db->query('COMMIT');
        return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_insert_image'). ' - <strong>'.$image['name'].'</strong>');
//        } catch(Exception $ex) {
//            $this->db->query('ROLLBACK');
//            Kohana::log('error', __FILE__.__LINE__.$ex->getMessage());
//            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_insert_image'));
//        }
    }

    /**
     * Usuwanie zdjęcia z galerii
     * @param Integer $iPhotoId
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeletePhoto($iPhotoId) {
        try {
            $iPhotoId+=0;
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');

            //pobieramy nazwe fotki
            $filename = $this->db->from(table::GALLERY_IMAGES)->select('filename')->where(array('id_image' => $iPhotoId))->get();

            // z tabeli obrazkow
            $this->db->delete(table::GALLERY_IMAGES, array('id_image' => $iPhotoId));

            // i z tabeli laczacej galerie z fotkami
            $this->db->delete(table::GALLERIES_IMAGES, array('image_id' => $iPhotoId));

            //usuwamy fotki fizycznie
            if (file_exists($this->big_path . $filename[0]->filename)) { //duże foto
                unlink($this->big_path . $filename[0]->filename);
            }
            if (file_exists($this->small_path . $filename[0]->filename)) { // miniaturka
                unlink($this->small_path . $filename[0]->filename);
            }
            if (file_exists($this->medium_path . $filename[0]->filename)) { // srednie foto
                unlink($this->medium_path . $filename[0]->filename);
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_delete_photo'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_delete_photo'));
        }
    }
    
    /**
    * aktualizuje nazwe (alt) obrazka
    *
    */    
    public function UpdateImage($imageId, $alt)
	{
		try {			
			if ( ! empty($imageId) AND ! empty($alt))
			{
				$this->db->update(table::GALLERIES_IMAGES, array('alt' => $alt), array('image_id' => intval($imageId)));				
				return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('gallery.success_update_image'));
			}
			else
			{
				return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('gallery.error_update_image'));
			}
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('gallery.error_update_image'));
        }
	}

    /**
     * Usuwa zdjęcia zaznaczone poprzez checkboxy
     * @param Array $aPhotos
     * @return ErrorReporting (Bool true || Bool false)
     */
    public function DeletePhotoArray($aPhotos) {
        try {
            foreach ($aPhotos as $aPhoto) {
                $this->DeletePhoto($aPhoto);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_delete_photo'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_delete_photo'));
        }
    }

    private function _GetGalleryId($elementId) {
        try {
            $elementId+=0;
            $result = $this->db->from(table::GALLERIES)->where(array('element_id' => $elementId))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result[0]->id_gallery, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_exist_gallery'));
        }
    }

    private function _GetGalleryElementId($galleryId) {
        try {
            $galleryId+=0;
            $result = $this->db->from(table::GALLERIES)->where(array('id_gallery' => $galleryId))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result[0]->element_id, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_exist_gallery'));
        }
    }

    public function DeleteGalleryByElementId($elementId) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $elementId+=0;

            $gallery = $this->db->from(table::GALLERIES)->where(array('element_id' => $elementId))->get();

            //usuwamy wszystkie
            foreach ($gallery as $g) {
                if ($this->DeleteGallery($g->id_gallery)->Type === ErrorReporting::ERROR) {
                    throw new Exception();
                }
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('gallery.success_delete_gallery'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            //var_dump($ex->getMessage());
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_delete_gallery'));
        }
    }
	
	public function updateElementsPositions($aData)
	{
		try {
			if ( ! empty($aData['elements']) AND count($aData['elements']) > 0)
			{
				foreach ($aData['elements'] as $iElementId => $iPosition)
				{
					$this->db->update(table::GALLERY_IMAGES, array('position' => intval($iPosition)), array('id_image' => intval($iElementId)));
				}
				return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('gallery.success_update_elements_positions'));
			}
			else
			{
				return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('gallery.error_update_elements_positions'));
			}
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('gallery.error_update_elements_positions'));
        }
	}

}

