<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Galleries_Controller extends Admin_Controller {

    /**
     * @var Gallery_Model
     */
    private $_gallery;

    /**
     * @var Element_Model
     */
    private $_elements;

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_gallery = new Gallery_Model();
        $this->_elements = new Element_Model();
        $this->_oTemplate->header->hover = 'elements';
    }

    /**
     *
     * @param <type> $elementId
     */
    public function list_galleries($elementId = null) {
        $this->authorize('galleries', 'index');

        $count = count($this->_gallery->GetAllGalleries()->Value);
        $oPagination = layer::GetPagination($count, '', layer::ADMIN_PER_PAGE);
        $limit = $oPagination->items_per_page;
        $offset = $oPagination->sql_offset;

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_galleries_list');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('gallery.admin_galleries_list_site_title');
        $this->_oTemplate->content->main_content->galleries = $this->_gallery->GetAllGalleries($limit, $offset)->Value;
        $this->_oTemplate->content->main_content->oPagination = $oPagination;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function add_gallery($iPageId = null) {
        $this->authorize('galleries', 'add');

        // dzialanie posta
        if (!empty($_POST)) {
            // walidacja
            $valid_check = $this->_gallery->ValidateAddGallery($_POST);
            if ($valid_check->Value === true) {
                $result = $this->_gallery->InsertGallery($_POST);
                $this->_oSession->set('message', $result->__toString());
                if (isset($_POST['submit_back'])) {
                    if (!empty($iPageId)) {
                        url::redirect('4dminix/strona/' . $iPageId);
                    }
                    url::redirect('4dminix/galerie');
                } else {
                    unset($_POST);
                    //url::redirect('4dminix/edytuj_galerie/' . $result->Value . '/' . $_POST['lang']);
                }
            } else {
                $this->_oTemplate->msg = $valid_check->__toString();
            }
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_gallery_add');

        // zmienne do widokow

        $sLanguage = 'pl_PL';

        if (!empty($iPageId)) {
            $oPageData = $this->_oPage->GetPage($iPageId)->Value;
            $sLanguage = $oPageData[0]->lang;
        }

        $this->_oTemplate->title = Kohana::lang('gallery.admin_gallery_add_site_title');
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_elements->GetPages($sLanguage)->Value;
        $this->_oTemplate->content->main_content->iPageId = $iPageId;

        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $galleryId
     * @param <type> $galleryLang 
     */
    public function edit_gallery($iGalleryId, $galleryLang) {
        $this->authorize('galleries', 'edit');

        // dzialanie posta
        if (!empty($_POST)) {
            // walidacja
            $valid_check = $this->_gallery->ValidateAddGallery($_POST);
            if ($valid_check->Value === true) {
                $this->_oSession->set('message', $this->_gallery->UpdateGallery($_POST, $iGalleryId)->__toString());
                if (isset($_POST['submit_back'])) {
                    url::redirect('4dminix/galerie');
                } else {
                    url::redirect('4dminix/edytuj_galerie/' . $iGalleryId . '/' . $galleryLang);
                }
            } else {
                $this->_oTemplate->msg = $valid_check->__toString();
            }
        }
        // widoki
        $this->_oTemplate->content->main_content = new View('admin_gallery_edit');
        // zmienne do widokow
        $this->_oTemplate->title = Kohana::lang('gallery.admin_gallery_edit_site_title');
        $oGalleryDetails = $this->_gallery->GetGallery($iGalleryId, $galleryLang)->Value;
        $this->_oTemplate->content->main_content->gallery = $oGalleryDetails;
        $this->_oTemplate->content->main_content->languages = $this->_oLanguage->GetLanguages()->Value;
        $this->_oTemplate->content->main_content->pages = $this->_oPage->GetPagesAsArray(true, $oGalleryDetails[0]->lang)->Value;
        $this->_oTemplate->content->main_content->aSelectedPages = $this->_oPage->GetPagesForElementAsArray($oGalleryDetails[0]->element_id)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $galleryId
     * @param string $galleryLang
     */
    public function delete_gallery($galleryId = null) {
        $this->authorize('galleries', 'delete');

        if (!empty($_POST['galleries_check'])) {
            $aGalleries = $_POST['galleries_check'];
            $this->_oSession->set('message', $this->_gallery->DeleteGalleryArray($aGalleries)->__toString());
            url::redirect('4dminix/galerie');
        } else if (!empty($galleryId)) {
            $this->_oSession->set('message', $this->_gallery->DeleteGallery($galleryId)->__toString());
            url::redirect('4dminix/galerie');
        } else {
            url::redirect('4dminix/galerie');
        }
    }

    /**
     * Dodaje obrazek do galerii AddImage
     * @todo Sprawdzić, czy nie wymaga to innego uprawnienia
     * @param integer $galleryId
     */
    public function gallery($galleryId) {
        $this->authorize('galleries', 'add_photo');

        // dzialanie posta
        if (!empty($_POST)) {
            // dodajemy fote do galerii
            $i = 0;

            $aErrors = array();
            $aSuccess = array();
            //	exit;
            foreach ($_FILES['photo']['name'] as $filename) {

                //	var_dump($filename);
                $photo = array(
                    'name' => $_FILES['photo']['name'][$i],
                    'tmp_name' => $_FILES['photo']['tmp_name'][$i],
                    'type' => $_FILES['photo']['type'][$i],
                    'error' => $_FILES['photo']['error'][$i],
                    'size' => $_FILES['photo']['size'][$i]
                );

                $validation = $this->_gallery->ValidateAddImage($photo, $_POST);

                if ($validation->Value == true) {

                    $aSuccess[$i] = $this->_gallery->AddImage($_POST, $photo, $galleryId)->__toString();
                    //   url::redirect('4dminix/galeria/' . $galleryId);
                } else {
                    $aErrors[$i] = $validation->__toString();
                    //  url::redirect('4dminix/galeria/' . $galleryId);
                }
                $i++;
            }
            $errorsHtml = '';

            $successHtml = '';

            if (!empty($aErrors)) {

                foreach ($aErrors as $aE) {
                    $errorsHtml .= $aE;
                }
                $errorsHtml = Kohana::lang('gallery.following_errors') . ': <ul>' . $errorsHtml . '</ul>';
            }
            if (!empty($aSuccess)) {

                foreach ($aSuccess as $aS) {
                    $successHtml .= $aS;
                }
                $errorsHtml .= $successHtml;
            }
            $this->_oSession->set('message', $errorsHtml);
            url::redirect('4dminix/galeria/' . $galleryId);
        }

        // widoki
        $this->_oTemplate->content->main_content = new View('admin_gallery_view');
        // zmienne do widokow
        $this->_oTemplate->content->main_content->galleryId = $galleryId;
        $this->_oTemplate->content->main_content->galleryName = $this->_gallery->GetGalleryName($galleryId)->Value[0]->name;
        $this->_oTemplate->content->main_content->photos = $this->_gallery->GetPhotos($galleryId)->Value;
        $this->_oTemplate->render(true);
    }

    /**
     *
     * 
     * 
     * 
     */
    public function update_image() {
        $this->authorize('galleries', 'update_image');

        if (!empty($_POST['id_image']) && !empty($_POST['alt'])) {
            $iImageId = $_POST['id_image'];
            $sAlt = $_POST['alt'];
            $oUpdate = $this->_gallery->UpdateImage($iImageId, $sAlt);
            echo $oUpdate->__toString();
        }
    }

    /**
     *
     * @param integer $iPhotoId
     * @param integer $iGalleryId
     * @param integer $iPageId
     */
    public function delete_photo($iPhotoId = null, $iGalleryId = null, $iPageId = null) {
        $this->authorize('galleries', 'delete_photo');

        if (!empty($_POST['photo_check']) && !empty($_POST['gallery_id'])) {
            $this->_oSession->set('message', $this->_gallery->DeletePhotoArray($_POST['photo_check'])->__toString());
            if (!empty($_POST['page_id'])) {
                url::redirect('4dminix/strona/' . $_POST['page_id']);
            } else {
                url::redirect('4dminix/galeria/' . $_POST['gallery_id']);
            }
        } else if (!empty($iPhotoId)) {
            $this->_oSession->set('message', $this->_gallery->DeletePhoto($iPhotoId)->__toString());
            if (!empty($iPageId)) {
                url::redirect('4dminix/strona/' . $iPageId);
            } else {
                url::redirect('4dminix/galeria/' . $iGalleryId);
            }
        } else {
            url::redirect('4dminix/galerie/');
        }
    }

    public function change_elements_positions($iGalleryId) {
        $this->authorize('galleries', 'element_position');
        if (!empty($_POST)) {
            $this->_oSession->set('msg', $this->_gallery->updateElementsPositions($_POST)->__toString());
            url::redirect('4dminix/galeria/' . $iGalleryId);
        }
        $this->_oTemplate->content->main_content = new View('admin_gallery_change_elements_positions');

        // zmienne do widokow
        $this->_oTemplate->content->main_content->oElements = $this->_gallery->GetPhotos($iGalleryId)->Value;
        $this->_oTemplate->title = Kohana::lang('gallery.admin_elements_positions_site_title');
        $this->_oTemplate->render(true);
    }

}
