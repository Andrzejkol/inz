<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Measurement_Units_Controller extends Admin_Shop_Controller {

    protected $_oMeasurementUnit;
    
    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_oMeasurementUnit = new Measurement_Unit_Model();
    }

    public function index() {
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products', 'index')->Value == true) {
                $pagination = layer::GetPagination($this->_oProduct->Count()->Value, 'admin_default');
                $this->_oTemplate->content->main_content = new View('admin/products_index');
                $this->_oTemplate->content->main_content->oProducts = $this->_oProduct->FindAll(layer::PER_PAGE, $pagination->sql_offset)->Value;
                $this->_oTemplate->content->main_content->pagination = $pagination;
                $this->_oTemplate->title = Kohana::lang('product.products_index');
                $this->_oTemplate->render(true);
            } else {
                url::redirect('4dminix/brak_dostepu');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }
    }

    public function add() {
        $_oProductCategory = new Product_Category_Model();
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] == true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products', 'add')->Value == true) {
                if (!empty($_POST)) {
                    if ($this->_oProduct->ValidateProductAdd($_POST)) {
                        $result = $this->_oProduct->Insert($_POST, $_FILES);
                        $this->_oSession->set('message', $result->__toString());
                        switch ($result->Type) {
                            case ErrorReporting::ERROR:
                            case ErrorReporting::WARNING:
                                url::redirect('4dminix/dodaj_produkt');
                                break;
                            default:
                                url::redirect('4dminix/produkty');
                                break;
                        }
                    } else {
                        $this->_oTemplate->content->main_content = new View('admin/product_add');
                        $_oProductCategory = new Product_Category_Model();
                        $this->_oTemplate->content->main_content->oProductCategories = $_oProductCategory->GetCategoriesAsOption(0, $_oProductCategory->GetCategoriesAsArray(0, 'pl_PL'));
                        $this->_oTemplate->content->main_content->oLanguages = $this->_oLanguage->GetLanguages(true)->Value;
                        $this->_oTemplate->title = Kohana::lang('product.add_product');
                        $this->_oTemplate->render(true);
                    }
                    url::redirect('4dminix/produkty');
                } else {
                    $this->_oTemplate->content->main_content = new View('admin/product_add');
                    $this->_oTemplate->content->main_content->oProductCategories = $_oProductCategory->GetCategoriesAsOption(0, $_oProductCategory->GetCategoriesAsArray(0, $this->_lang));
                    //$this->_oTemplate->content->main_content->oLanguages = $this->_oLanguage->GetLanguages(true)->Value;
                    $_oTax = new Tax_Model();
                    $_oMeasureUnit = new Measure_Unit_Model();
                    $_oProducer = new Producer_Model();
                    $this->_oTemplate->content->main_content->oTaxes = $_oTax->FindAll()->Value;
                    $this->_oTemplate->content->main_content->oMeasurementUnits = $_oMeasureUnit->GetMeasurementUnits($this->_lang)->Value;
                    $this->_oTemplate->content->main_content->oProducers = $_oTax->GetProducers()->Value;
                    $this->_oTemplate->title = Kohana::lang('product.add_product');
                    $this->_oTemplate->render(true);
                }
            } else {
                url::redirect('4dminix/brak_uprawnien');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }
    }

    /**
     * @param Integer $id
     */
    public function edit($id) {
        $id += 0;
        $_oProductCategory = new Product_Category_Model();
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products', 'edit')->Value == true) {
                if (!empty($_POST)) {
                    if ($this->_oProduct->ValidateProductEdit($_POST)) {
                        $result = $this->_oProduct->Update($id, $_POST, $_FILES);
                        $this->_oSession->set('message', $result->__toString());
                        switch ($result->Type) {
                            case ErrorReporting::ERROR:
                            case ErrorReporting::WARNING:
                                url::redirect('4dminix/edytuj_produkt/' . $id);
                                break;
                            default:
                                url::redirect('4dminix/produkty');
                        }
                    } else {
                        $this->_oTemplate->content->main_content = new View('admin/product_edit');
                        $this->_oTemplate->content->main_content->productDetails = $this->_oProduct->Find($id)->Value;
                        $this->_oTemplate->content->main_content->oProductCategories = $_oProductCategory->GetCategoriesAsOption(0, $_oProductCategory->GetCategoriesAsArray(0));
                        $this->_oTemplate->content->main_content->oProductImages = $this->_oProduct->GetProductImages($id)->Value;
                        $this->_oTemplate->content->main_content->oLanguages = $this->_oLanguage->GetLanguages(true)->Value;
                        $this->_oTemplate->title = Kohana::lang('product.edit_product');
                        $this->_oTemplate->render(true);
                    }
                } else {
                    $this->_oTemplate->content->main_content = new View('admin/product_edit');
                    $this->_oTemplate->content->main_content->productDetails = $this->_oProduct->Find($id)->Value;
                    $this->_oTemplate->content->main_content->oProductCategories = $_oProductCategory->GetCategoriesAsOption(0, $_oProductCategory->GetCategoriesAsArray(0), array($this->_oTemplate->content->main_content->productDetails[0]->product_category_id));
                    $this->_oTemplate->content->main_content->oProductImages = $this->_oProduct->GetProductImages($id)->Value;
                    $this->_oTemplate->content->main_content->oLanguages = $this->_oLanguage->GetLanguages(true)->Value;
                    $this->_oTemplate->title = Kohana::lang('product.edit_product');
                    $this->_oTemplate->render(true);
                }
            } else {
                url::redirect('4dminix/brak_uprawnien');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }
    }

    /**
     * @param Integer $id
     */
    public function delete($id) {
        if (!empty($this->_oAcl['logged_in']) && $this->_oAcl['logged_in'] === true) {
            if ($this->_oUser->IsAllowed($this->_oAcl, 'products', 'delete')->Value == true) {
                $result = $this->_oProduct->Delete($id);
                $this->_oSession->set('message', $result->__toString());
                url::redirect('4dminix/produkty');
            } else {
                url::redirect('4dminix/brak_dostepu');
            }
        } else {
            $this->_oSession->set('requested_url', '/' . url::current());
            url::redirect('4dminix/admin_logowanie');
        }
    }

}
