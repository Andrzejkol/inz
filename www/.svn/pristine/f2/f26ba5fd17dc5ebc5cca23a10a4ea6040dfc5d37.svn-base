<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Medias_Controller extends Admin_Controller {

    /**
     * @var Media_Model
     */
    private $_medias;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_medias = new Media_Model();
        $this->_oTemplate->header->hover = 'media';
    }

    public function list_media() {
        $this->authorize('medias', 'index');

        $count = count($this->_medias->GetAllMedia()->Value);
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_media_list');
        // zmienne do widokow
        $this->_oTemplate->content->main_content->medias = $this->_medias->GetAllMedia($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->title = Kohana::lang('media.admin_media_list_site_title');
        $this->_oTemplate->render(true);
    }

    public function add_media() {
        $this->authorize('medias', 'add');

        $this->_oTemplate->content->main_content = new View('admin_media_add');
        // obiekty do modeli

        if (!empty($_FILES)) {
            $valid_check = $this->_medias->ValidateMedia($_FILES['media']);
            if ($valid_check->Value === true) {
                $result = $this->_medias->AddMedia($_FILES);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('medias/list_media');
                }
                $this->_oTemplate->content->msg = $result->__toString();
            } else {
                $this->_oTemplate->content->msg = $valid_check->__toString();
            }
        }

        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('media.admin_media_add_site_title');
        $this->_oTemplate->render(true);
    }

    public function delete_media($IdMedia) {
        $this->authorize('medias', 'delete');

        $this->_oSession->set('message', $this->_medias->DeleteMedia($IdMedia)->__toString());
        url::redirect('4dminix/media');
    }

}