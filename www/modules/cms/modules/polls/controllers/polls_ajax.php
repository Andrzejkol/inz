<?php
class Polls_ajax_Controller extends Controller_Core {
	// Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;


    public function __construct() {
        parent::__construct();
        $this->session = Session::instance();
        $this->db = new Database();
		$this->_oPoll = new Poll_Model();
		$this->_oPage = new Page_Model();
//        $this->language = new Language_Model();
    }
	
	public function get_polls_table($elementId = null) {
			// obiekty do modeli
//			$this->language = new Language_Model();

			//widoki
			$this->main_content = new View('admin_pools_table');

			// zmienne do widokow
			$iPerpage = polls_helper::PERPAGE;
			$oCategoryDetails = $this->_oPoll->GetCategoryForElementId($elementId)->Value;
			$oPolls = $this->_oPoll->FindAll($oCategoryDetails[0]->id_poll_category/*, $iPerpage, $pagination->sql_offset*/)->Value;
			$pagination =  new Pagination(
				array(
					'base_url'    => 'polls_ajax/get_polls_table/'.$elementId.'/', // base_url will default to current uri
					'uri_segment'    => 'page', // pass a string as uri_segment to trigger former 'label' functionality
					'total_items'    => $oPolls->count(), //$news->count(), // use db count query here of course
					'items_per_page' => $iPerpage, // it may be handy to set defaults for stuff like this in config/pagination.php
					'style'          => 'default_ajax', // pick one from: classic (default), digg, extended, punbb, or add your own!
					'auto_hide'      => TRUE,
					/*'query_string' => 'page',
					'style' => 'digg',
					'total_items' => $oPolls->count(),
					'items_per_page' => $iPerpage,
					'auto_hide' => true*/
					)
			);
//			$oCategory = $this->news->GetNewsCategoryForElement($elementId)->Value;
//			$count = $this->news->CountNewsForCategory($oCategory[0]->id_news_category)->Value;
//	//        $count = $this->news->NewsCount($elementId)->Value;
//
//
//			$pagination = new Pagination(array(
//							'base_url'    => 'news_ajax/get_news_table/'.$elementId.'/', // base_url will default to current uri
//							'uri_segment'    => 'page', // pass a string as uri_segment to trigger former 'label' functionality
//							'total_items'    => $count, // $news->count(), // use db count query here of course
//							'items_per_page' => news_helper::LIMIT, // it may be handy to set defaults for stuff like this in config/pagination.php
//							'style'          => 'default_ajax' // pick one from: classic (default), digg, extended, punbb, or add your own!
//			));

			$this->main_content->pagination = $pagination;
			$this->main_content->oPolls = $this->_oPoll->FindAll($oCategoryDetails[0]->id_poll_category, $iPerpage, $pagination->sql_offset)->Value;
			$this->main_content->iCategoryId = $oCategoryDetails[0]->id_poll_category;
//			$this->main_content->languages = $this->language->GetLanguages()->Value;
			$this->main_content->render(true);
		}
}

?>
