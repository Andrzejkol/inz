<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Backup_Controller extends Admin_Controller {

    /**
     *
     * @var Page_Content_Model
     */
    private $_page_content;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_backup = new Backup_Model();
        $this->_elements = new Element_Model();
        $this->_oTemplate->header->hover = 'backup';
    }

    /**
     *
     */
    public function index() {
        $this->authorize('backup', 'index');

        $limit = layer::ADMIN_PER_PAGE;

        if (get_class($this->_backup->getAllBackups()) == 'ErrorReporting') {
            $oPagination = null;
            $offset = 0;
            $msg = 'empty results';
        } else {
            $oPagination = layer::GetPagination($this->_backup->get($id_backup)->Value->count(), '', $limit);
            $offset = $oPagination->sql_offset;
        }

        $this->_oTemplate->content->main_content = new View('admin_backup_index');
        $this->_oTemplate->title = Kohana::lang('admin.backup.index_site_title');
        $this->_oTemplate->content->main_content->oBackup = $this->_backup->getAllBackups()->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->render(true);
    }

    public function edit($id_backup) {
        $this->authorize('backup', 'edit');
        if (!empty($_POST)) {
            $result = $this->_backup->UpdateBoxesSet($id_backup, $_POST);
            $this->_oTemplate->content->msg = $result->__toString();
            if ($result->Value) {
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/backup/edit/' . $id_boxes);
                } else {
                    url::redirect('4dminix/backup');
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin_boxes_edit');
        $this->_oTemplate->title = Kohana::lang('boxes.admin_boxes_index_site_title');
        $oBox = $this->_boxes->getBoxesSet($id_boxes);
        $this->_oTemplate->content->main_content->box = $oBox->Value;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $oBox->lang)->Value;
        $oBox2 = $this->_boxes->getBoxesSet($id_boxes)->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oBox2[0]->element_id)->Value;
        $this->_oTemplate->render(true);
    }

    
    public function add_backup($iPageId = null) {
        $this->authorize('backup', 'add');
        if (!empty($_POST)) { 
            
            
            //var_dump($_POST); 
            $result = $this->_backup->create_backup($_POST);
            //var_dump($result); 
            
            //$result = $this->_backup->InsertBackup($_POST, $back);
            $this->_oSession->set('message', $result->__toString());
            if ($result->Value !== false) {
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/backup');
                } else {
                    url::redirect('4dminix/backup');
                }            
            }
        }

        $this->_oTemplate->content->main_content = new View('admin_backup_add');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->title = Kohana::lang('admin.backup.add_backup');
        $this->_oTemplate->content->main_content->pages = $this->_elements->GetPages()->Value;
        $this->_oTemplate->content->main_content->iPageId = $iPageId;
        $this->_oTemplate->render(true);
    }
    
    public function restore($id_backup) {
        $this->authorize('backup', 'restore');   
                
        $dirsA = $this->_backup->get_dirs($id_backup);
        $dirs = explode(';',$dirsA);
        $bPOST = array();
        $bPOST['name'] = 'Auto Restore Backup';
        $bPOST['description'] = 'Backup wykonany automatycznie przy przywracaniu innego backupu.';
        $bPOST['elements'] = $dirs;
        
        $result = $this->_backup->create_backup($bPOST);
            if ($result->Value !== false) {
        
            $result = $this->_backup->restore_backup($id_backup);
            if ($result->Value) {
                $this->_oSession->set('message', 'Backup został przywrócony.');
                url::redirect('4dminix/backup');
            }
        }
        url::redirect('4dminix/backup');
    }
    
    public function delete($id_backup = null) {
        $this->authorize('backup', 'delete');

        if (!empty($id_backup)) {
            $this->_oSession->set('message', $this->_backup->Deletebackup($id_backup)->__toString());
            url::redirect('4dminix/backup');
        } else {
            url::redirect('4dminix/backup');
        }
    }

}
