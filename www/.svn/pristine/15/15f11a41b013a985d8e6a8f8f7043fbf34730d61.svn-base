<?php defined('SYSPATH') OR die('No direct access allowed.');
class Boxes_ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;


    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
        $this->boxes = new Boxes_Model();
    }


    public function delete_box_image() {
        echo $this->boxes->AjaxDeleteImages($_POST);
    }
  
    public function change_status() {
        if(!isset($_GET['id_news'])){
            return;
        }
        
        $id_news = intval($_GET['id_news']);
        $db = new Database();
        $result = $db->select('available')
                ->from(table::NEWS)
                ->where('id_news', $id_news)
                ->get();
        
        if(isset($result[0])){
            if($result[0]->available == '1'){
                $status = '0';
            }
            else{
                $status = '1';
            }
            $db->update(table::NEWS, array('available' => $status), array('id_news' => $id_news));
            echo $status; return;
        }
        else{
            return;
        }
    }
}