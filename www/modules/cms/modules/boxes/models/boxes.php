<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Boxes_Model extends Model_Core {

    /**
     *
     * @return unknown_type
     */
    public function __construct() {
        parent::__construct();
        $this->db = Database::instance();
        $this->path = boxes::BIG_PATH;
        $this->thumbpath = boxes::SMALL_PATH;
    }

    /*
     *
     * funcka zwraca wszystkie boxy ze wszystkich zestawów
     *
     */

    public function getAllBoxesSet($limit = null, $offset = null, $active = null, $sLang = NULL) {
        try {
            $result = $this->db->from(table::BOXES_SET);

            if (isset($limit) && isset($offset)) {
                $result = $result
                        ->limit($limit, $offset);
            }

            if (!empty($_GET['boxes_orderby'])) {
                switch ($_GET['boxes_orderby']) {
                    case 1:
                        $result = $result->orderby(array('name' => 'ASC'))->get();
                        break;
                    case 2:
                        $result = $result->orderby(array('name' => 'DESC'))->get();
                        break;
                    case 3:
                        $result = $result->orderby(array('description' => 'ASC'))->get();
                        break;
                    case 4:
                        $result = $result->orderby(array('description' => 'DESC'))->get();
                        break;
                }
            } else {
                $result = $result->orderby(array('id_boxes_set' => 'DESC'))->get();
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('boxes.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_get'));
        }
    }

    /*
     *
     * funkcja pobiera box'y z danego zestawu boxes
     * parametr - $box_id
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */

    public function get($boxes_set_id, $aWhere = array()) {
        $boxes_set_id = intval($boxes_set_id);
        try {
            $this->db->from(table::BOXES)                    
                    ->where('boxes_set_id', $boxes_set_id);

            if (!empty($_GET['boxes_orderby'])) {
                switch ($_GET['boxes_orderby']) {
                    case 1:
                        $this->db->orderby(array('name' => 'ASC'));
                        break;
                    case 2:
                        $this->db->orderby(array('name' => 'DESC'));
                        break;
                    case 3:
                        $this->db->orderby(array('title' => 'ASC'));
                        break;
                    case 4:
                        $this->db->orderby(array('title' => 'DESC'));
                        break;
                    case 5:
                        $this->db->orderby(array('active' => 'ASC'));
                        break;
                    case 6:
                        $this->db->orderby(array('active' => 'DESC'));
                        break;
                }
            } else {
                $this->db->orderby(array('position' => 'DESC'));
            }

            if(!empty($aWhere)) {
                $this->db->where($aWhere);
            }
            
            $result = $this->db->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('boxes.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_get'));
        }
    }

    /*
     *
     * funkcja pobiera pojedyńczy box
     * parametr - $boxboxes
     * @return ErrorReporting (MySQL Object $result || Bool false)
     */

    public function getBox2Edit($id_boxes) {
        $id_boxes = intval($id_boxes);
        try {
            $result = $this->db
                    ->from(table::BOXES)
                    ->where('id_boxes', $id_boxes)
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('boxes.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_get'));
        }
    }

    /*
     * funkcja pobiera jeden zestaw boksów do edycji
     *
     */

    public function getBoxesSet($id_boxes_set) {
        try {
            $id_boxes_set = intval($id_boxes_set);
            $result = $this->db->from(table::BOXES_SET)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::BOXES_SET . '.element_id')
                    ->where(array('id_boxes_set' => $id_boxes_set))
                    ->get();

            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('boxes.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_get'));
        }
    }

    /*
     * funkcja pobiera jeden zestaw boksów do do main_content
     * @param elemetID
     *
     */

    public function getBoxesSetByElement($element_id) {
        try {
            $element_id = intval($element_id);
            $result = $this->db->from(table::BOXES_SET)
                    ->join(table::ELEMENTS, table::ELEMENTS . '.id_element', table::BOXES_SET . '.element_id')
                    ->where(array('element_id' => $element_id))
                    ->get();

            //return $result;
            
            return new ErrorReporting(ErrorReporting::SUCCESS, $result, Kohana::lang('boxes.success_get'));
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_get'));
        }
    }

    private function evalName($name, $title) {
        $name = url::title(trim($name), '_');
        if ($name == '') {
            $name = url::title(trim($title), '_');
        }
        return $name;
    }

    public function ValidateAddBox($aData) {
        if (empty($aData['title'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_title_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function ValidateAddBoxes($aPost) {
        if (empty($aPost['name'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_name2_empty'));
        } else if (empty($aPost['page_id'])) {
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_pageId_empty'));
        } else {
            return new ErrorReporting(ErrorReporting::SUCCESS, true, '');
        }
    }

    public function UpdateBoxesSet($id_boxes, Array $aData) {
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

            //dane do tabeli boxes
            $aBoxes['name'] = $aData['name'];
            $aBoxes['description'] = $aData['description'];
            $aBoxes['show_title'] = $aData['show_title'];

            //update tabeli boxes
            $this->db->update(table::BOXES_SET, $aBoxes, array('id_boxes_set' => $id_boxes));

            //dane do tabeli elements
            $iElementId = $this->_GetBoxesElementId($id_boxes)->Value;
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

    public function edit($id_boxes, Array $data, $aFiles) {
        $id_boxes = intval($id_boxes);
        try {
            $post['title'] = trim($data['title']);
            $post['name'] = $this->evalName($data['name'], $data['title']);
            $post['contents'] = trim($data['contents']);
            $post['link'] = trim($data['link']);
            $post['active'] = (!empty($data['active']) ? 1 : 0 );
            $post['lang'] = (!empty($data['lang']) ? $data['lang'] : 'en_US' );

            if ($post['name'] == '' || $post['title'] == '') {
                return new ErrorReporting(ErrorReporting::ERROR, false, 'Wypełnij wymagane pola');
            }

            $image = $aFiles['photo'];
            //exit;
            // tworzymy obrazki
            if (!empty($image) && is_array($image) && !empty($image['name'])) {
                $imageData = file::upload(
                                $image, array(
                            'unique' => true,
                            'width' => boxes::BIGWIDTH,
                            'height' => boxes::BIGHEIGHT,
                            'thumbwidth' => boxes::THUMBWIDTH,
                            'thumbheight' => boxes::THUMBHEIGHT,
                            'path' => $this->path,
                            'thumbpath' => $this->thumbpath
                                )
                        )->Value;
            }

            if (!empty($imageData['filename'])) {
                $post['filename'] = $imageData['filename'];
            }
//			else {
//				$post['filename'] = null;
//			}

            $result = $this->db->update(table::BOXES, $post, array('id_boxes' => $id_boxes));
            $count = count($result);
            if ($count == 0) {
                return new ErrorReporting(ErrorReporting::SUCCESS, false, Kohana::lang('boxes.edit_success'));
            }

            return new ErrorReporting(ErrorReporting::SUCCESS, true, 'Zaktualizowano');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd');
        }
    }

    public function add($data, $aFiles) {
        try {
            $post['boxes_set_id'] = trim($data['boxes_set_id']);
            $post['title'] = trim($data['title']);
            $post['name'] = $this->evalName($data['name'], $data['title']);
            $post['link'] = trim($data['link']);
            $post['contents'] = trim($data['contents']);
            $post['active'] = (!empty($data['active']) ? 1 : 0 );
            $post['lang'] = (!empty($data['lang']) ? $data['lang'] : 'en_US' );

            $image = $aFiles['photo'];

            // tworzymy obrazki
            if (!empty($image) && is_array($image) && !empty($image['name'])) {
                $imageData = file::upload(
                                $image, array(
                            'unique' => true,
                            'width' => boxes::BIGWIDTH,
                            'height' => boxes::BIGHEIGHT,
                            'thumbwidth' => boxes::THUMBWIDTH,
                            'thumbheight' => boxes::THUMBHEIGHT,
                            'path' => $this->path,
                            'thumbpath' => $this->thumbpath,
                            'bigcrop' => true
                                )
                        )->Value;
//                $imageData['alt'] = $alt;
//                $imageData['mainimage'] = 0;				
            }
            if (!empty($imageData['filename'])) {
                $post['filename'] = $imageData['filename'];
            } else {
                $post['filename'] = null;
            }

            $result = $this->db->insert(table::BOXES, $post);

            return new ErrorReporting(ErrorReporting::SUCCESS, $result->insert_id(), 'Box został dodany');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, 'Wystąpił błąd');
        }
    }

    /**
     * helper for frontend
     * @param type $name
     * @return type 
     */
    public static function getBox($name) {
        $db = new Database();
        $result = $db
                ->select('title', 'link', 'contents')
                ->from(table::BOXES)
                ->where('name', $name)
                ->where('active', 1)
                ->get()
                ->current()
        ;
        return $result;
    }

    public function DeleteBoxesSet($boxes_set_id) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $boxes_set_id+=0;

            // pobieramy element Id danch boxow
            $elementId = $this->_GetBoxesElementId($boxes_set_id)->Value;

            // usuwamy powiązanie boxow z tabelka elements
            $this->db->delete(table::ELEMENTS, array('id_element' => $elementId));

            // usuwamy powiązanie boxow z tabelka pages_elements
            $this->db->delete(table::PAGES_ELEMENTS, array('element_id' => $elementId));

            // usuwamy zestaw boxow
            $this->db->delete(table::BOXES_SET, array('id_boxes_set' => $boxes_set_id));

            //usuwamy wszystkie boxy z danego zestawu
            $boxes = $this->db->from(table::BOXES)->where(array('boxes_set_id' => $boxes_set_id))->get();
            foreach ($boxes as $box) {
                $this->DeleteBoxes($box->id_boxes);
            }

            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('boxes.success_delete_box1'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.delete_box'));
        }
    }

    public function DeleteBoxesSetArray($aBoxesSetsIds) {
        try {
            if (is_array($aBoxesSetsIds)) {
                foreach ($aBoxesSetsIds as $iBI) {
                    $this->DeleteBoxesSet($iBI);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('boxes.success_delete_box2'));
            } else {
                $aBoxesSetsIds+=0;
                return $this->DeleteBoxesSet($aBoxesSetsIds);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_delete_array'));
        }
    }

    public function DeleteBoxes($boxes_id) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $boxes_id+=0;

            // pobieramy nazwe pliku
            $result = $this->db->from(table::BOXES)->where(array('id_boxes' => $boxes_id))->get();

            //usuwamy z dysku
            $path = 'files/boxes/big/';
            $thumbpath = 'files/boxes/small/';
            if (file_exists($path . $result[0]->filename)) {
                unlink($path . $result[0]->filename);
            }
            if (file_exists($thumbpath . $result[0]->filename)) {
                unlink($thumbpath . $result[0]->filename);
            }
            $this->db->delete(table::BOXES, array('id_boxes' => $boxes_id));
            $this->db->query('COMMIT');
            return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('boxes.success_delete_box3'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.delete_box'));
        }
    }

    public function DeleteBoxesArray($aBoxesIds) {
        try {
            //Kohana::log('info', 'deleteBox: '.print_r($aBoxesIds));
            if (is_array($aBoxesIds)) {
                foreach ($aBoxesIds as $iBI) {
                    $this->DeleteBoxes($iBI);
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('boxes.success_delete_box4'));
            } else {
                $aBoxesIds+=0;
                return $this->DeleteBoxes($aBoxesIds);
            }
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_delete_array'));
        }
    }

    public function AjaxDeleteImages($data) {
        try {
            $data = explode('_', $data['id']);

            // pobieramy id obrazka
            $id_box_images = end($data);

            // pobieramy nazwe pliku
            $result = $this->db->from(table::BOXES)->where(array('id_boxes' => $id_box_images))->get();
            //usuwamy z dysku


            $path = 'files/boxes/big/';
            $thumbpath = 'files/boxes/small/';

            if (file_exists($path . $result[0]->filename)) { // duże foto
                unlink($path . $result[0]->filename);
            }
            if (file_exists($thumbpath . $result[0]->filename)) { // male foto
                unlink($thumbpath . $result[0]->filename);
            }

            // usuwamy z bazy obrazkow
            $this->db->update(table::BOXES, array('filename' => null), array('id_boxes' => $id_box_images));


            return $id_box_images;
        } catch (Exception $ex) {
            return 'false';
        }
    }

    public function updateElementsPositions($aData) {
        try {
            if (!empty($aData['elements']) AND count($aData['elements']) > 0) {
                foreach ($aData['elements'] as $iElementId => $iPosition) {
                    $this->db->update(table::BOXES, array('position' => intval($iPosition)), array('id_boxes' => intval($iElementId)));
                    //Kohana::log('info', $this->db->last_query());
                }
                return new ErrorReporting(ErrorReporting::SUCCESS, TRUE, 'Zapisano zmiany.');
            } else {
                return new ErrorReporting(ErrorReporting::ERROR, FALSE, 'Wystąpił błąd podczas zapisu zmian.');
            }
        } catch (Exception $ex) {
            Kohana::log('error', $ex->getFile() . $ex->getLine() . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, FALSE, 'Wystąpił błąd podczas zapisu zmian.');
        }
    }

    public function InsertBoxes($aPost) {
        try {
            $this->db->query('SET AUTOCOMMIT = 0');
            $this->db->query('BEGIN');
            $pages_id = $aPost['page_id'];

            //ustalamy dane do tabelki elements
            $table_elements['lang'] = $aPost['lang'];
            $table_elements['type'] = element_helper::$elements_types_for_switch['boxes'];
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

            $table_boxes['name'] = $aPost['name'];
            $table_boxes['description'] = $aPost['description'];
            $table_boxes['element_id'] = $elementId;
            $table_boxes['show_title'] = $aPost['show_title'];

            // wstawiamy nowa galerie
            $insert = $this->db->insert(table::BOXES_SET, $table_boxes);

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
            return new ErrorReporting(ErrorReporting::SUCCESS, $insert->insert_id(), Kohana::lang('boxes.success_insert_boxes'));
        } catch (Exception $ex) {
            $this->db->query('ROLLBACK');
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('boxes.error_insert_boxes'));
        }
    }

    private function _GetBoxesElementId($boxes_id) {
        try {
            $boxes_id+=0;
            $result = $this->db->from(table::BOXES_SET)->where(array('id_boxes_set' => $boxes_id))->get();
            return new ErrorReporting(ErrorReporting::ERROR, $result[0]->element_id, '');
        } catch (Exception $ex) {
            Kohana::log('error', __FILE__ . __LINE__ . $ex->getMessage());
            return new ErrorReporting(ErrorReporting::ERROR, false, Kohana::lang('gallery.error_exist_gallery'));
        }
    }

}

?>