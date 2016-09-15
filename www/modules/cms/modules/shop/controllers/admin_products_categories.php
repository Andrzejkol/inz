<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Products_Categories_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function index($iCategoryId = null) {
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products_categories', 'index')->Value == true) {
                $this->_oTemplate->content->main_content = new View('admin/products_categories_index');
                $this->_oTemplate->content->main_content->oProductsCategories = $this->_oProductCategory->GetCategories(null, 'pl_PL', $iCategoryId)->Value;
                $this->_oTemplate->title = Kohana::lang('product_category.products_categories_index');
                $this->_oTemplate->render(true);
            } else {
                url::redirect('4dminix/brak_dostepu');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('users/admin_login');
        }
    }

    public function add() {
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products_categories', 'add')->Value == true) {
                if (!empty($_POST)) {
                    $validations = $this->_oProductCategory->ValidateProductCategoryAdd($_POST);
                    if ($validations->Value == true) {
                        $this->_oSession->set('message', $this->_oProductCategory->Insert($_POST, $_FILES)->__toString());
                        url::redirect('4dminix/kategorie_produktow');
                    } else {
                        $this->_oTemplate->content->main_content->msg = $validations->__toString();
                    }
                }
                $this->_oTemplate->content->main_content = new View('admin/products_category_add');
                $this->_oTemplate->content->main_content->oProductsCategories = $this->_oProductCategory->GetCategoriesAsOption(0, $this->_oProductCategory->GetCategoriesAsArray(0));                
                $this->_oTemplate->title = Kohana::lang('product_category.add_product_category');
                $this->_oTemplate->render(true);
            } else {
                url::redirect('4dminix/brak_uprawnien');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('users/admin_login');
        }
    }

    /**
     *
     * @param Integer $id
     */
    public function edit($id) {
        $id += 0;
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products_categories', 'edit')->Value == true) {
                if (!empty($_POST)) {
                    $validations = $this->_oProductCategory->ValidateProductCategoryEdit($_POST);
                    if ($validations->Value == true) {
                        $this->_oSession->set('message', $this->_oProductCategory->Update($id, $_POST, $_FILES));
                        url::redirect('4dminix/kategorie_produktow');
                    } else {
                        $this->_oTemplate->content->main_content->msg = $validations->__toString();
                    }
                }

                $this->_oTemplate->content->main_content = new View('admin/products_category_edit');
                $this->_oTemplate->title = Kohana::lang('product_category.edit_product_category');
                $this->_oTemplate->content->main_content->oLanguages = $this->_oLanguage->GetLanguagesI18n(array($this->_lang))->Value;
//                var_dump($this->_oProductCategory->Find($id)->Value);
                $this->_oTemplate->content->main_content->oProductCategoryDetails = $this->_oProductCategory->Find($id)->Value;
                $this->_oTemplate->content->main_content->oProductsCategories = $this->_oProductCategory->GetCategoriesAsOption(0, $this->_oProductCategory->GetCategoriesAsArray(0), array($this->_oTemplate->content->main_content->oProductCategoryDetails[0]->parent_category_id));
                $this->_oTemplate->render(true);
            } else {
                url::redirect('4dminix/brak_uprawnien');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }
    }

    /**
     *
     * @param Integer $id
     */
    public function delete($id) {
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products_categories', 'delete')->Value == true) {
                $this->_oSession->set('message', $this->_oProductCategory->Delete($id)->__toString());
                url::redirect('4dminix/kategorie_produktow');
            } else {
                url::redirect('4dminix/brak_dostepu');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }
    }

    public function change_category_status($iCategoryId) {
        $this->_oProductCategory->ChangeCategoryStatus($iCategoryId);
        url::redirect('4dminix/kategorie_produktow');
    }

    public function change_elements_positions() {
        if (!empty($_POST)) {
            $this->_oSession->set('msg', $this->_oProductCategory->updateElementsPositions($_POST)->__toString());
            url::redirect('4dminix/kategorie_produktow');
        }

        $this->_oTemplate->content->main_content = new View('admin/products_categories_change_positions');
        $this->_oTemplate->content->main_content->oProductsCategories = $this->_oProductCategory->GetCategories(null, null, null)->Value;
        $this->_oTemplate->title = Kohana::lang('slider.admin_slider_elements_positions_site_title');
        $this->_oTemplate->render(true);
    }

    //ajax
    public function search_categories() {
        $_POST = layer::Clean($_POST);

        $this->template = new View('admin/products_categories_index');
        $this->template->oProductsCategories = $this->_oProductCategory->GetCategoriesWithName($_POST['category_search'])->Value;
        echo $this->template->render(true);
    }

    public function delete_product_category_image() {
        $_POST = layer::Clean($_POST);
        $this->_oProductCategory->DeleteCategoryImage($_POST['id']);
        echo Kohana::lang('product_category.no_image_found');
    }
    
    public function delete_product_category_banner() {
        $_POST = layer::Clean($_POST);
        $this->_oProductCategory->DeleteCategoryBanner($_POST['id']);
        echo Kohana::lang('product_category.no_image_found');
    }

}
