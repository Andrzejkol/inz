<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Slider_ajax_Controller extends Admin_Controller {

    /**
     *
     * @var Page_Content_Model
     */
    private $_page_content;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oSlider = new Slider_Model();
        $this->_oTemplate->header->hover = 'slider';
    }

    public function change_status() {
        if(!isset($_GET['id_slider_element'])){
        	//echo "id_slider_element not set";
            return;
        }
        
        $id_slider = intval($_GET['id_slider_element']);
        $db = new Database();
        $result = $db->select('available')
                ->from(table::SLIDER_ELEMENTS)
                ->where('id_slider_element', $id_slider)
                ->get();
        
        if(isset($result[0])){
            if($result[0]->available == '1'){
                $status = '0';
            }
            else{
                $status = '1';
            }
            $db->update(table::SLIDER_ELEMENTS, array('available' => $status), array('id_slider_element' => $id_slider));
            echo $status; 
            return;
        }
        else{
            return;
        }
    }

}