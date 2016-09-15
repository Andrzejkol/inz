<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Slider_Model extends Model_Core {

    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
    }

    /**
     *
     * @param bool $bCount
     * @param int $iLimit
     * @param int $iOffset
     * @param bool $bWithDetails
     * @return object ErrorReporting
     */
    public function GetAll($bCount = FALSE, $iLimit = NULL, $iOffset = NULL, $bWithDetails = FALSE, $lang = NULL) {
        try {
            $this->checkNews();
            $result = $this->db->from(table::SLIDER_ELEMENTS);
                    //->join(table::SLIDER_IMAGES, table::SLIDER_IMAGES . '.id_slider_image', table::SLIDER_ELEMENTS . '.slider_element_id');

            if (!is_null($iLimit) AND is_null($iOffset)) {
                $result = $this->db->limit($iLimit);
            } elseif (!is_null($iLimit) AND ! is_null($iOffset)) {
                $result = $this->db->limit($iLimit, $iOffset);
            }

            if (!empty($_GET['slider_orderby'])) {
                switch ($_GET['slider_orderby']) {
                    case 1:
                        $result = $result->orderby(array('slider_element_position' => 'ASC'));
                        break;
                    case 2:
                        $result = $result->orderby(array('slider_element_position' => 'DESC'));
                        break;
                    case 3:
                        $result = $result->orderby(array('slider_type_id' => 'ASC'));
                        break;
                    case 4:
                        $result = $result->orderby(array('slider_type_id' => 'DESC'));
                        break;
                    case 5:
                        $result = $result->orderby(array('title' => 'ASC'));
                        break;
                    case 6:
                        $result = $result->orderby(array('title' => 'DESC'));
                        break;
                    case 7:
                        $result = $result->orderby(array('available' => 'ASC'));
                        break;
                    case 8:
                        $result = $result->orderby(array('available' => 'DESC'));
                        break;
                }
            } else {
                $result = $this->db->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'));
            }

            $result = $result->get();
            

            if ($bCount === TRUE) {
                $result = $result->count();
            } elseif ($bWithDetails) {
                $aResult = array();
                if (!empty($result) AND $result->count() > 0) {
                    foreach ($result as $oElement) {
                        $oDetails = $this->getElementDetails($oElement->id_slider_element, $oElement->slider_type_id, $lang);
                        if ($oDetails->Type === ErrorReporting::SUCCESS) {
                            $aResult[] = $oDetails->Value;
                        }
                    }
                }
                $result = $aResult;
            }
           

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('slider.success.get_all'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.get_all'));
        }
    }

    /**
     * Usuwa newsy ze slidera, które zostały usunięte z tabeli news lub są nieaktywne.
     * @return ErrorReporting
     */
    public function checkNews() {
        try {
            $oElements = $this->db->from(table::SLIDER_ELEMENTS)->where('slider_type_id', slider_helper::ELEMENT_TYPE_NEWS)->get();
            if (!empty($oElements) AND $oElements->count() > 0) {
                foreach ($oElements as $oElement) {
                    $result = $this->getElementDetails($oElement->id_slider_element, slider_helper::ELEMENT_TYPE_NEWS);
                    if ($result->Type == ErrorReporting::ERROR) {
                        $this->db->delete(table::SLIDER_ELEMENTS, array('id_slider_element' => $oElement->id_slider_element));
                    } else {
                        if ($result->Value->available != 1) {
                            $this->db->delete(table::SLIDER_ELEMENTS, array('id_slider_element' => $oElement->id_slider_element));
                        }
                    }
                }
            }
            return new ErrorReporting(ErrorReporting::ERROR, TRUE, Kohana::lang('slider.success.check_news'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.check_news'));
        }
    }

    public function getElement($iElementId) {
        try {
            $iElementId += 0;

            $result = $this->db->from(table::SLIDER_ELEMENTS)
                    ->where('id_slider_element', $iElementId)
                    ->limit(1)
                    ->get();
            if ($result->count() == 1) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result[0], Kohana::lang('slider.success.get_element'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.get_element'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.get_element'));
        }
    }

    public function getElementDetails($iElementId, $iTypeId, $lang = null) {
        try {            
            switch ($iTypeId) {
            
                case slider_helper::ELEMENT_TYPE_NEWS:
                    $this->db->from(table::SLIDER_ELEMENTS)
                            ->join(table::NEWS, table::NEWS . '.id_news', table::SLIDER_ELEMENTS . '.slider_element_id')
                            ->join(table::NEWS_IMAGES, table::NEWS . '.id_news', table::NEWS_IMAGES . '.news_id', 'LEFT')
                            ->join(table::IMAGES, table::NEWS_IMAGES . '.images_id', table::IMAGES . '.id_image', 'LEFT')
                            ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news', 'LEFT')
                            ->join(table::NEWS_CATEGORIES, table::NEWS_CATEGORIES . '.id_news_category', table::NEWS_TO_CATEGORIES . '.news_category_id', 'LEFT')
                            ->groupby('id_news')
                            ->where('id_slider_element', $iElementId)
                            ->limit(1);
                    if (!empty($lang)) {
                        $this->db->where('lang', $lang);
                    }
                    $result = $this->db->get();
                    break;

                case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                    
                    $this->db->from(table::SLIDER_ELEMENTS)
                            ->join(table::SLIDER_NEWS, table::SLIDER_NEWS . '.slider_news_id', table::SLIDER_ELEMENTS . '.slider_element_id')
                            ->where('id_slider_element', $iElementId)
                            ->limit(1);
                    
                    if (!empty($lang)) {
                        $this->db->where('lang', $lang);
                    }
                    $result = $this->db->get();                               
                    break;
                case slider_helper::ELEMENT_TYPE_IMAGE:
                    $this->db->from(table::SLIDER_ELEMENTS)
                            ->join(table::SLIDER_IMAGES, table::SLIDER_IMAGES . '.id_slider_image', table::SLIDER_ELEMENTS . '.slider_element_id')
                            ->where('id_slider_element', $iElementId);
                    if (!empty($lang)) {
                        $this->db->where('lang', $lang);
                    }
                    $result = $this->db->get();
                    break;
            }
            
            if ($result->count() == 1) {
                return new ErrorReporting(ErrorReporting::SUCCESS, $result[0], Kohana::lang('slider.error.get_element_details'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.get_element_details'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.get_element_details'));
        }
    }

    /**
     *
     * @param bool $bAsArray Zwraca wynik jako tablicę asocjacyjną
     * @param type $bNotChosenOnly Wyklucza aktualności, które są już wybrane dla slidera
     * @return ErrorReporting
     */
    public function getNewsTitles($bAsArray = FALSE, $bNotChosenOnly = FALSE) {
        try {
            if ($bNotChosenOnly === TRUE) {
                $oChosenNews = $this->db->from(table::SLIDER_ELEMENTS)->where('slider_type_id', slider_helper::ELEMENT_TYPE_NEWS)->get();
                if (!empty($oChosenNews) AND $oChosenNews->count() > 0) {
                    $aTemp = array();
                    foreach ($oChosenNews as $oElement) {
                        $aTemp[] = $oElement->slider_element_id;
                    }
                    $this->db->notin('id_news', $aTemp);
                }
            }
            $result = $this->db->from(table::NEWS)
                            ->join(table::NEWS_TO_CATEGORIES, table::NEWS_TO_CATEGORIES . '.news_id', table::NEWS . '.id_news')
                            ->where(array('available' => 1, 'news_category_id !=' => 2))->orderby('date_added', 'DESC')->get();
            $aResult = array();
            if (!empty($result) AND $result->count()) {
                foreach ($result as $oNews) {
                    $aResult[$oNews->id_news] = $oNews->title;
                }
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, ($bAsArray === TRUE ? $aResult : $result), Kohana::lang('slider.success.get_news_titles'));
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.get_news_titles'));
        }
    }

    public function insert($aData, $aFiles) {
        try {
            $aData = array_map('trim', $aData);

            switch ($aData['slider_type_id']) {
                case slider_helper::ELEMENT_TYPE_NEWS:
                    $result = $this->AddNews($aData);
                    break;
                case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                    $result = $this->AddSliderNews($aData, $aFiles);
                    break;
                case slider_helper::ELEMENT_TYPE_IMAGE:
                    $result = $this->AddImage($aData, $aFiles);
                    break;
            }

            if ($result->Type === ErrorReporting::SUCCESS) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.insert'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.insert'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.insert'));
        }
    }

    public function AddNews($aData) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $iPosition = 1;
            $oLastPosition = $this->db->from(table::SLIDER_ELEMENTS)->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'))->limit(1)->get();
            if (!empty($oLastPosition) AND $oLastPosition->count() == 1) {
                $iPosition = $oLastPosition[0]->slider_element_position + 1;
            }

            $aValues = array(
                'slider_type_id' => $aData['slider_type_id'],
                'slider_element_id' => $aData['news_element_id'],
                'slider_element_position' => $iPosition
            );

            $result = $this->db->insert(table::SLIDER_ELEMENTS, $aValues);

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.add_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_news'));
        }
    }

    public function AddSliderNews($aData, $aFiles) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $iPosition = 1;
            $oLastPosition = $this->db->from(table::SLIDER_ELEMENTS)->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'))->limit(1)->get();
            if (!empty($oLastPosition) AND $oLastPosition->count() == 1) {
                $iPosition = $oLastPosition[0]->slider_element_position + 1;
            }

            $aNewsValues = array(
                'title' => $aData['title'],
                'description' => !empty($aData['description']) ? $aData['description'] : NULL,
                'short_description' => !empty($aData['short_description']) ? $aData['short_description'] : NULL
            );

            if ($aFiles['photo']['error'] === UPLOAD_ERR_OK) {
                $imageData = file::upload(
                                $aFiles['photo'], array(
                            'unique' => TRUE,
                            'width' => slider_helper::SLIDER_IMAGE_WIDTH,
                            'height' => slider_helper::SLIDER_IMAGE_HEIGHT,
                            'mediumwidth' => slider_helper::SLIDER_IMAGE_MEDIUM_WIDTH,
                            'mediumheight' => slider_helper::SLIDER_IMAGE_MEDIUM_HEIGHT,
                            'thumbwidth' => slider_helper::SLIDER_IMAGE_SMALL_WIDTH,
                            'thumbheight' => slider_helper::SLIDER_IMAGE_SMALL_HEIGHT,
                            'path' => slider_helper::SLIDER_IMAGE_PATH,
                            'mediumpath' => slider_helper::SLIDER_IMAGE_MEDIUM_PATH,
                            'thumbpath' => slider_helper::SLIDER_IMAGE_SMALL_PATH
                                )
                );
                if ($imageData->Type === ErrorReporting::SUCCESS) {
                    $aNewsValues['filename'] = $imageData->Value['filename'];
                    $aNewsValues['alt'] = !empty($aData['alt']) ? $aData['alt'] : NULL;
                }
            }
            $insert = $this->db->insert(table::SLIDER_NEWS, $aNewsValues);

            $aElementsValues = array(
                'slider_type_id' => $aData['slider_type_id'],
                'slider_element_id' => $insert->insert_id(),
                'slider_element_position' => $iPosition
            );

            $oNewsInsert = $this->db->insert(table::SLIDER_ELEMENTS, $aElementsValues);

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.add_slider_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_slider_news'));
        }
    }

    public function AddImage($aData, $aFiles) {
        try {

            if ($aFiles['image']['error'] === UPLOAD_ERR_OK) {

                $this->db->query('SET AUTOCOMMIT = 0');
                $this->db->query('BEGIN');
                $iPosition = 1;
                $oLastPosition = $this->db->from(table::SLIDER_ELEMENTS)->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'))->limit(1)->get();
                if (!empty($oLastPosition) AND $oLastPosition->count() == 1) {
                    $iPosition = $oLastPosition[0]->slider_element_position + 1;
                }

                $imageData = file::upload(
                                $aFiles['image'], array(
                            'unique' => TRUE,
                            'width' => slider_helper::SLIDER_IMAGE_WIDTH,
                            'height' => slider_helper::SLIDER_IMAGE_HEIGHT,
                            'mediumwidth' => slider_helper::SLIDER_IMAGE_MEDIUM_WIDTH,
                            'mediumheight' => slider_helper::SLIDER_IMAGE_MEDIUM_HEIGHT,
                            'thumbwidth' => slider_helper::SLIDER_IMAGE_SMALL_WIDTH,
                            'thumbheight' => slider_helper::SLIDER_IMAGE_SMALL_HEIGHT,
                            'path' => slider_helper::SLIDER_IMAGE_PATH,
                            'mediumpath' => slider_helper::SLIDER_IMAGE_MEDIUM_PATH,
                            'thumbpath' => slider_helper::SLIDER_IMAGE_SMALL_PATH
                                )
                );
                if ($imageData->Type === ErrorReporting::SUCCESS) {
                    $aImageValues = array(
                        'title' => $aData['title'],
                        'filename' => $imageData->Value['filename'],
                        'alt' => !empty($aData['alt']) ? $aData['alt'] : NULL,
                        'lang' => !empty($aData['lang']) ? $aData['lang'] : 'pl_PL',
                        'link' => !empty($aData['link']) ? $aData['link'] : NULL,
                    );

                    $insert = $this->db->insert(table::SLIDER_IMAGES, $aImageValues);

                    $aElementsValues = array(
                        'slider_type_id' => $aData['slider_type_id'],
                        'slider_element_id' => $insert->insert_id(),
                        'slider_element_position' => $iPosition,
                        'available' => 1,
                    );

                    $this->db->insert(table::SLIDER_ELEMENTS, $aElementsValues);
                }

                $this->db->query('COMMIT');
                return new ErrorReporting(ErrorReporting::SUCCESS, FALSE, Kohana::lang('slider.success.add_image'));
            }
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_image'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_image'));
        }
    }

    public function validateAdd($aData, $aFiles) {
        try {
            $aData = array_map('trim', $aData);
            $aErrors = array();
            if (!empty($aData['slider_type_id'])) {
                switch ($aData['slider_type_id']) {
                    case slider_helper::ELEMENT_TYPE_NEWS:
                        $return = $this->validateAddNews($aData);
                        break;

                    case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                        $return = $this->validateAddSliderNews($aData, $aFiles);
                        break;
                    case slider_helper::ELEMENT_TYPE_IMAGE:
                        $return = $this->validateAddImage($aData, $aFiles);
                        break;
                }
                if ($return->Type === ErrorReporting::ERROR) {
                    if (is_array($return->Value) AND count($return->Value) > 0) {
                        foreach ($return->Value as $sError) {
                            $aErrors[] = $sError;
                        }
                    }
                }
            } else {
                $aErrors[] = Kohana::lang('slider.validation.slider_type_id_empty');
            }

            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                $message = '';
                foreach ($aErrors as $sError) {
                    $message .= sprintf(Kohana::lang('slider.single_error'), $sError);
                }
                $message = sprintf(Kohana::lang('slider.following_errors'), $message);
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, $message);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add'));
        }
    }

    public function validateAddNews($aData) {
        try {
            $aErrors = array();

            if (empty($aData['news_element_id'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_empty'), Kohana::lang('slider.news_title'));
            }

            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $aErrors);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_news'));
        }
    }

    public function validateAddSliderNews($aData, $aFiles) {
        try {
            $aErrors = array();

            if ($aFiles['photo']['error'] === UPLOAD_ERR_NO_FILE) {
                $aErrors[] = Kohana::lang('slider.validation.slider_news_no_photo');
            } elseif ($aFiles['photo']['error'] === UPLOAD_ERR_OK) {
                if (!in_array($aFiles['photo']['type'], slider_helper::$aValidImageMimes)) {
                    $aErrors[] = Kohana::lang('slider.validation.slider_invalid_photo_mime');
                }
            }
            if (!empty($aData['link']) AND ! valid::url($aData['link'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_invalid'), Kohana::lang('slider.link'));
            }
            if (empty($aData['title'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_empty'), Kohana::lang('slider.news_title'));
            }
            if (empty($aData['short_description'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_empty'), Kohana::lang('slider.short_description'));
            }
//			if (empty($aData['description']))
//			{
//				$aErrors[] = sprintf(Kohana::lang('slider.single_field_error_empty'), Kohana::lang('slider.description'));
//			}
            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $aErrors);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_slider_news'));
        }
    }

    public function validateAddImage($aData, $aFiles) {
        try {
            $aErrors = array();

            if ($aFiles['image']['error'] === UPLOAD_ERR_NO_FILE) {
                $aErrors[] = Kohana::lang('slider.validation.slider_image_no_photo');
            } elseif ($aFiles['image']['error'] === UPLOAD_ERR_OK) {
                if (!in_array($aFiles['image']['type'], slider_helper::$aValidImageMimes)) {
                    $aErrors[] = Kohana::lang('slider.validation.slider_invalid_photo_mime');
                }
            }
            if (empty($aData['title'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_invalid'), Kohana::lang('slider.title'));
            }
            if (!empty($aData['link']) AND ! valid::url($aData['link'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_invalid'), Kohana::lang('slider.link'));
            }

            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $aErrors);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_news'));
        }
    }

    public function delete($iElementId) {
        try {
            $iElementId += 0;

            $oElement = $this->getElement($iElementId);
            if ($oElement->Type === ErrorReporting::SUCCESS) {
                $oElementDetails = $this->getElementDetails($iElementId, $oElement->Value->slider_type_id);
                if ($oElementDetails->Type === ErrorReporting::SUCCESS) {
                    $this->db->query('SET AUTOCOMMIT = 0');
                    $this->db->query('BEGIN');

                    switch ($oElement->Value->slider_type_id) {
                        case slider_helper::ELEMENT_TYPE_NEWS:
                            break;
                        case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                            if (!empty($oElementDetails->Value->filename)) {
                                $this->deleteImage($oElementDetails->Value, slider_helper::GetImagePathForType($oElement->Value->slider_type_id, 'big'));
                                $this->deleteImage($oElementDetails->Value, slider_helper::GetImagePathForType($oElement->Value->slider_type_id, 'medium'));
                                $this->deleteImage($oElementDetails->Value, slider_helper::GetImagePathForType($oElement->Value->slider_type_id, 'small'));
                            }
                            $this->db->delete(table::SLIDER_NEWS, array('slider_news_id' => $oElement->Value->slider_element_id));
                            break;
                        case slider_helper::ELEMENT_TYPE_IMAGE:
                            if (!empty($oElementDetails->Value->filename)) {
                                $this->deleteImage($oElementDetails->Value, slider_helper::GetImagePathForType($oElement->Value->slider_type_id, 'big'));
                                $this->deleteImage($oElementDetails->Value, slider_helper::GetImagePathForType($oElement->Value->slider_type_id, 'medium'));
                                $this->deleteImage($oElementDetails->Value, slider_helper::GetImagePathForType($oElement->Value->slider_type_id, 'small'));
                            }
                            $this->db->delete(table::SLIDER_IMAGES, array('id_slider_image' => $oElement->Value->slider_element_id));
                            break;
                    }
                    $this->db->delete(table::SLIDER_ELEMENTS, array('id_slider_element' => $oElement->Value->id_slider_element));

                    $this->db->query('COMMIT');
                    return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.delete'));
                }
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.delete'));
            }
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.delete'));
        }
    }

    public function deleteImage($oElementDetails, $sPath) {
        try {
            if (file_exists($sPath . $oElementDetails->filename)) {
                unlink($sPath . $oElementDetails->filename);
            }
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_news'));
        }
    }

    public function batchDelete($aElements) {
        try {
            if (is_array($aElements) AND count($aElements)) {
                foreach ($aElements as $iElementId) {
                    $this->delete($iElementId);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.batch_delete'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.batch_delete'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.batch_delete'));
        }
    }

    public function updateElementsPositions($aData) {
        try {
            if (!empty($aData['elements']) AND count($aData['elements']) > 0) {
                foreach ($aData['elements'] as $iElementId => $iPosition) {
                    $this->db->update(table::SLIDER_ELEMENTS, array('slider_element_position' => intval($iPosition)), array('id_slider_element' => intval($iElementId)));
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

    public function CheckMaxElements() {
        try {
            $allElements = $this->GetAll(TRUE)->Value;
            if ($allElements == slider_helper::SLIDER_MAX_ELEMENTS) {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE);
            } else {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE);
        }
    }

    //edycja
    public function update($iElementId, $aData, $aFiles) {
        var_dump($aData['slider_type_id']);
        try {
            $aData = array_map('trim', $aData);
            $aData['id_slider_element'] = $iElementId;

            switch ($aData['slider_type_id']) {
                case slider_helper::ELEMENT_TYPE_NEWS:
                    $result = $this->UpdateNews($aData);
                    break;
                case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                    $result = $this->UpdateSliderNews($aData, $aFiles);
                    break;
                case slider_helper::ELEMENT_TYPE_IMAGE:
                    $result = $this->UpdateImage($aData, $aFiles);
                    break;
            }

            if ($result->Type === ErrorReporting::SUCCESS) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.insert'));
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.insert'));
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.insert'));
        }
    }

    public function UpdateNews($aData) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
//			$iPosition = 1;
//			$oLastPosition = $this->db->from(table::SLIDER_ELEMENTS)->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'))->limit(1)->get();
//			if ( ! empty($oLastPosition) AND $oLastPosition->count() == 1)
//			{
//				$iPosition = $oLastPosition[0]->slider_element_position + 1;
//			}
//			$aValues = array(
//				'slider_type_id' => $aData['slider_type_id'],
//				'slider_element_id' => $aData['news_element_id']
//				//'slider_element_position' => $iPosition
//			);

            $result = $this->db->update(table::SLIDER_ELEMENTS, array('slider_element_id' => $aData['news_element_id']), array('id_slider_element' => $aData['id_slider_element']));


            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.add_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_news'));
        }
    }

    public function UpdateSliderNews($aData, $aFiles) {

        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
//			$iPosition = 1;
//			$oLastPosition = $this->db->from(table::SLIDER_ELEMENTS)->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'))->limit(1)->get();
//			if ( ! empty($oLastPosition) AND $oLastPosition->count() == 1)
//			{
//				$iPosition = $oLastPosition[0]->slider_element_position + 1;
//			}
//			if(!empty($aData['link'])){
//				$aData['news_element_id'] = null;
//			}
//			if(!empty($aData['news_element_id'])){
//				$aData['link'] = '';
//				
//				$tmp = $this->db->select('title')->from(table::NEWS)->where('id_news', $aData['news_element_id'])->get();				
//				
//				$sLink = Kohana::lang('links.lang') . Kohana::lang('links.single_news') . string::prepareURL($aData['news_element_id'] . '-' . $tmp[0]->title);
//				
//				$aData['link'] = $sLink;
//			}


            $aNewsValues = array(
                'title' => $aData['title'],
                'link' => $aData['link'],
                'description' => !empty($aData['description']) ? $aData['description'] : NULL,
                'short_description' => !empty($aData['short_description']) ? $aData['short_description'] : NULL
            );


            if (!empty($aFiles) && $aFiles['photo']['name'] != '') {
                $imageData = file::upload(
                                $aFiles['photo'], array(
                            'unique' => TRUE,
                            'width' => slider_helper::SLIDER_IMAGE_WIDTH,
                            'height' => slider_helper::SLIDER_IMAGE_HEIGHT,
                            'mediumwidth' => slider_helper::SLIDER_IMAGE_MEDIUM_WIDTH,
                            'mediumheight' => slider_helper::SLIDER_IMAGE_MEDIUM_HEIGHT,
                            'thumbwidth' => slider_helper::SLIDER_IMAGE_SMALL_WIDTH,
                            'thumbheight' => slider_helper::SLIDER_IMAGE_SMALL_HEIGHT,
                            'path' => slider_helper::SLIDER_IMAGE_PATH,
                            'mediumpath' => slider_helper::SLIDER_IMAGE_MEDIUM_PATH,
                            'thumbpath' => slider_helper::SLIDER_IMAGE_SMALL_PATH
                                )
                );
                if ($imageData->Type === ErrorReporting::SUCCESS) {
                    $aNewsValues['filename'] = $imageData->Value['filename'];
                    $aNewsValues['alt'] = !empty($aData['alt']) ? $aData['alt'] : NULL;
                }
            }
            $elementId = $this->db->from(table::SLIDER_ELEMENTS)->where(array('id_slider_element' => $aData['id_slider_element']))->get();

            $update = $this->db->update(table::SLIDER_NEWS, $aNewsValues, array('slider_news_id' => $elementId[0]->slider_element_id));

            /*
              $aElementsValues = array(
              'slider_type_id' => $aData['slider_type_id'],
              'slider_element_id' => $insert->insert_id(),
              'slider_element_position' => $iPosition
              );


              $oNewsInsert = $this->db->insert(table::SLIDER_ELEMENTS, $aElementsValues);
             */
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, Kohana::lang('slider.success.add_slider_news'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_slider_news'));
        }
    }

    public function UpdateImage($aData, $aFiles) {
        //var_dump($aData);exit;
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            if (!empty($aFiles) && $aFiles['image']['name'] != '') {
//				$iPosition = 1;
//				$oLastPosition = $this->db->from(table::SLIDER_ELEMENTS)->orderby(array('slider_element_position' => 'DESC', 'id_slider_element' => 'DESC'))->limit(1)->get();
//				if ( ! empty($oLastPosition) AND $oLastPosition->count() == 1)
//				{
//					$iPosition = $oLastPosition[0]->slider_element_position + 1;
//				}



                $imageData = file::upload(
                                $aFiles['image'], array(
                            'unique' => TRUE,
                            'width' => slider_helper::SLIDER_IMAGE_WIDTH,
                            'height' => slider_helper::SLIDER_IMAGE_HEIGHT,
                            'mediumwidth' => slider_helper::SLIDER_IMAGE_MEDIUM_WIDTH,
                            'mediumheight' => slider_helper::SLIDER_IMAGE_MEDIUM_HEIGHT,
                            'thumbwidth' => slider_helper::SLIDER_IMAGE_SMALL_WIDTH,
                            'thumbheight' => slider_helper::SLIDER_IMAGE_SMALL_HEIGHT,
                            'path' => slider_helper::SLIDER_IMAGE_PATH,
                            'mediumpath' => slider_helper::SLIDER_IMAGE_MEDIUM_PATH,
                            'thumbpath' => slider_helper::SLIDER_IMAGE_SMALL_PATH
                                )
                );


                if ($imageData->Type === ErrorReporting::SUCCESS) {


                    if (!empty($imageData->Value['filename'])) {
                        $tmpfilename = $imageData->Value['filename'];
                    }
                }
            }

            if (!empty($aData['link'])) {
                $aData['news_element_id'] = null;
            }

            if (!empty($aData['news_element_id'])) {
                $aData['link'] = '';

                $tmp = $this->db->select('title')->from(table::NEWS)->where('id_news', $aData['news_element_id'])->get();

                $sLink = Kohana::lang('links.lang') . Kohana::lang('links.single_news') . string::prepareURL($aData['news_element_id'] . '-' . $tmp[0]->title);

                $aData['link'] = $sLink;
            }

//				if(empty($aData['slider_text_color'])){
//						$aData['slider_text_color'] = '#000000';
//					}

            $aImageValues = array(
                'title' => $aData['title'],
                //'color' => $aData['slider_text_color'],
                'link' => $aData['link'],
                'slider_element_id' => !empty($aData['news_element_id']) ? $aData['news_element_id'] : NULL,
                'alt' => !empty($aData['alt']) ? $aData['alt'] : NULL
            );
            if (!empty($tmpfilename)) {
                $aImageValues['filename'] = $tmpfilename;
            }

            $elementId = $this->db->from(table::SLIDER_ELEMENTS)->where(array('id_slider_element' => $aData['id_slider_element']))->get();


            $insert = $this->db->update(table::SLIDER_IMAGES, $aImageValues, array('id_slider_image' => $elementId[0]->slider_element_id));

//					$aElementsValues = array(
//						'slider_type_id' => $aData['slider_type_id'],
//						'slider_element_id' => $insert->insert_id(),
//						'slider_element_position' => $iPosition
//					);
            //$this->db->insert(table::SLIDER_ELEMENTS, $aElementsValues);


            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, FALSE, Kohana::lang('slider.success.add_image'));

            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_image'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.add_image'));
        }
    }

    public function validateEdit($aData, $aFiles) {
        try {
            $aData = array_map('trim', $aData);
            $aErrors = array();
            if (!empty($aData['slider_type_id'])) {
                switch ($aData['slider_type_id']) {
                    case slider_helper::ELEMENT_TYPE_NEWS:
                        $return = $this->validateEditNews($aData);
                        break;
                    case slider_helper::ELEMENT_TYPE_SLIDER_NEWS:
                        $return = $this->validateEditSliderNews($aData, $aFiles);
                        break;
                    case slider_helper::ELEMENT_TYPE_IMAGE:
                        $return = $this->validateEditImage($aData, $aFiles);
                        break;
                }
                if ($return->Type === ErrorReporting::ERROR) {
                    if (is_array($return->Value) AND count($return->Value) > 0) {
                        foreach ($return->Value as $sError) {
                            $aErrors[] = $sError;
                        }
                    }
                }
            } else {
                $aErrors[] = Kohana::lang('slider.validation.slider_type_id_empty');
            }

            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                $message = '';
                foreach ($aErrors as $sError) {
                    $message .= sprintf(Kohana::lang('slider.single_error'), $sError);
                }
                $message = sprintf(Kohana::lang('slider.following_errors'), $message);
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, $message);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add'));
        }
    }

    public function validateEditNews($aData) {
        try {
            $aErrors = array();

            if (empty($aData['news_element_id'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_empty'), Kohana::lang('slider.news_title'));
            }

            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $aErrors);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_news'));
        }
    }

    public function validateEditSliderNews($aData, $aFiles) {
        try {
            $aErrors = array();

            if ($aFiles['photo']['error'] === UPLOAD_ERR_OK) {
                if (!in_array($aFiles['photo']['type'], slider_helper::$aValidImageMimes)) {
                    $aErrors[] = Kohana::lang('slider.validation.slider_invalid_photo_mime');
                }
            }
            if (!empty($aData['link']) AND ! valid::url($aData['link'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_invalid'), Kohana::lang('slider.link'));
            }
            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $aErrors);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_slider_news'));
        }
    }

    public function validateEditImage($aData, $aFiles) {
        try {
            $aErrors = array();

            if ($aFiles['image']['error'] === UPLOAD_ERR_OK) {
                if (!in_array($aFiles['image']['type'], slider_helper::$aValidImageMimes)) {
                    $aErrors[] = Kohana::lang('slider.validation.slider_invalid_photo_mime');
                }
            }
            if (!empty($aData['link']) AND ! valid::url($aData['link'])) {
                $aErrors[] = sprintf(Kohana::lang('slider.single_field_error_invalid'), Kohana::lang('slider.link'));
            }

            if (empty($aErrors) AND count($aErrors) == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE);
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, $aErrors);
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, Kohana::lang('slider.error.validate_add_news'));
        }
    }

}

?>