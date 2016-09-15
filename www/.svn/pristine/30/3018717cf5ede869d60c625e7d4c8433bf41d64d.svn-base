<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Admin_Products_Controller extends Admin_Shop_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->authorize('products', 'index');
        $args = array();
        $_POST = $_GET;
        if (!empty($_POST['filter'])) {
            if (!empty($_POST['available']) && $_POST['available'] != '-') {
                $args['available'] = $_POST['available'];
            }
            if (!empty($_POST['product_status']) && $_POST['product_status'] != 0) {
                $args['product_status'] = $_POST['product_status'];
            }
            if (!empty($_POST['product_code']) && mb_strlen(trim($_POST['product_code']))) {
                $args['product_code'] = $_POST['product_code'];
            }
            if (!empty($_POST['quantity_min']) && $_POST['quantity_min'] + 0 > 0) {
                $args['quantity_min'] = $_POST['quantity_min'];
            }
            if (!empty($_POST['quantity_max']) && $_POST['quantity_max'] + 0 > 0) {
                $args['quantity_max'] = $_POST['quantity_max'];
            }
            if (!empty($_POST['price_min']) && $_POST['price_min'] + 0.00 > 0.00) {
                $args['price_min'] = $_POST['price_min'];
            }
            if (!empty($_POST['price_max']) && $_POST['price_max'] + 0.00 > 0.00) {
                $args['price_max'] = $_POST['price_max'];
            }
            if (!empty($_POST['product_category']) && $_POST['product_category'] + 0 > 0) {
                $args['product_category'] = $_POST['product_category'];
            }
            if (!empty($_POST['product_producers']) && $_POST['product_producers'] + 0 > 0) {
                $args['product_producers'] = $_POST['product_producers'];
            }
            if (!empty($_POST['query']) && mb_strlen(trim($_POST['query']))) {
                $args['query'] = $_POST['query'];
            }
        }

        $iCount = $this->_oProduct->FindAll(NULL, NULL, $args, TRUE)->Value;
        //$this->_oProduct->Count()->Value
        $pagination = layer::GetPagination($iCount, 'admin_default', layer::ADMIN_PER_PAGE);
        $this->_oTemplate->content->main_content = new View('admin/products_index');
        $this->_oTemplate->content->main_content->oProducts = $this->_oProduct->FindAll(layer::ADMIN_PER_PAGE, $pagination->sql_offset, $args)->Value;
        $this->_oTemplate->content->main_content->pagination = $pagination;
        $_oProductStatus = new Product_Status_Model();
        $this->_oProductCategory = new Product_Category_Model();
        $_oProducer = new Producer_Model();
        $oProductStatus = $_oProductStatus->FindAll();
        $aProductStatus = array();
        if ($oProductStatus->Value->count()) {
            foreach ($oProductStatus as $ps) {
                $aProductStatus[$ps->id_product_status] = $ps->product_status_name;
            }
        }
        array_unshift($aProductStatus, '-');
        $this->_oTemplate->content->main_content->aProductStatus = $aProductStatus;
        $this->_oTemplate->content->main_content->iMaxQuantity = $this->_oProduct->GetMaxProductQuantities()->Value;
        $this->_oTemplate->content->main_content->dMaxPrice = $this->_oProduct->GetMaxProductPrice()->Value;
        $oCategories = $this->_oProductCategory->FindAll(null, null, 'pl_PL', 'category_name', 'ASC')->Value;
        $aCategories = array();
        $aCategories[0] = '-';
        foreach ($oCategories as $c) {
            $aCategories[$c->id_category] = $c->category_name;
        }
        $this->_oTemplate->content->main_content->aCategories = $aCategories;
        $oProducers = $_oProducer->FindAll()->Value;
        $aProducers = array();
        $aProducers[0] = '-';
        foreach ($oProducers as $p) {
            $aProducers[$p->id_producer] = $p->producer_name;
        }
        $this->_oTemplate->content->main_content->aProducers = $aProducers;
        $this->_oTemplate->title = Kohana::lang('product.products_index');
        $this->_oTemplate->render(true);
    }

    public function add() {
        $this->authorize('products', 'add');
        if (!empty($_POST)) {
            $result = $this->_oProduct->ValidateProductAdd($_POST);
            if ($result->Value === true) {
                $result2 = $this->_oProduct->Insert($_POST, $_FILES);
                $this->_oSession->set('message', $result2->__toString());
                switch ($result2->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/dodaj_produkt');
                        break;
                    default:
                        url::redirect('4dminix/produkty');
                        break;
                }
                url::redirect('4dminix/produkty');
            } else {
                $this->_oTemplate->content->msg = $result->__toString();
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/product_add');
        $this->_oTemplate->content->main_content->oProductCategories = $this->_oProductCategory->GetCategoriesAsOption(0, $this->_oProductCategory->GetCategoriesAsArray(0, $this->_lang));
        $_oTax = new Tax_Model();
        $_oMeasurementUnit = new Measurement_Unit_Model();
        $_oProducer = new Producer_Model();
        $_oProductStatus = new Product_Status_Model();
        $this->_oTemplate->content->main_content->oTaxes = $_oTax->FindAll()->Value;
        $this->_oTemplate->content->main_content->oMeasurementUnits = $_oMeasurementUnit->GetMeasurementUnits($this->_lang)->Value;
        $this->_oTemplate->content->main_content->oProducers = $_oProducer->GetProducers()->Value;
        $this->_oTemplate->content->main_content->oProductStatuses = $_oProductStatus->GetProductStatuses($this->_lang)->Value;
        $this->_oTemplate->title = Kohana::lang('product.add_product');
        $this->_oTemplate->render(true);
    }

    /**

     *
     * @param Integer $id
     */
    public function edit($id) {
        $this->authorize('products', 'edit');
        $id += 0;
        $this->_oProductCategory = new Product_Category_Model();
        $_oRebateGroup = new Rebate_Group_Model();
        $_oAttribute = new Attribute_Model();
        $_oParameter = new Parameter_Model();
        $_oTax = new Tax_Model();
        $_oMeasurementUnit = new Measurement_Unit_Model();
        $_oProducer = new Producer_Model();
        $_oProductStatus = new Product_Status_Model();
        if (!empty($_POST)) {
            $result = $this->_oProduct->ValidateProductEdit($_POST, $_FILES);
            $this->_oTemplate->content->msg = $result->__toString();
            if ($result->Value === true) {
                if (!empty($_FILES)) {
                    $result2 = $this->_oProduct->Update($id, $_POST, $_FILES);
                } else {
                    $result2 = $this->_oProduct->Update($id, $_POST);
                }
                $this->_oSession->set('message', $result2->__toString());
                switch ($result2->Type) {
                    case ErrorReporting::ERROR:
                    case ErrorReporting::WARNING:
                        url::redirect('4dminix/edytuj_produkt/' . $id);
                        break;
                    default:
                        url::redirect('4dminix/edytuj_produkt/' . $id);
                        break;
                }
            }
        }
        $this->_oTemplate->content->main_content = new View('admin/product_edit');
        $aCategoryId = $this->_oProduct->GetCategoryByProductId($id)->Value;
        $iCategoryId = array();
        foreach ($aCategoryId as $c) {
            $iCategoryId[] = $c->category_id;
        }
        $this->_oTemplate->content->main_content->oProductCategories = $this->_oProductCategory->GetCategoriesAsOption(0, $this->_oProductCategory->GetCategoriesAsArray(0, $this->_lang), $iCategoryId);
        $this->_oTemplate->content->main_content->oTaxes = $_oTax->FindAll()->Value;
        $this->_oTemplate->content->main_content->oMeasurementUnits = $_oMeasurementUnit->GetMeasurementUnits($this->_lang)->Value;
        $this->_oTemplate->content->main_content->oProducers = $_oProducer->GetProducers()->Value;
        $this->_oTemplate->content->main_content->oProductStatuses = $_oProductStatus->GetProductStatuses($this->_lang)->Value;
        $this->_oTemplate->content->main_content->oProductDetails = $this->_oProduct->GetProductDetails($id)->Value[0];
        $this->_oTemplate->content->main_content->oProductCategory = $this->_oProduct->GetProductCategory($id)->Value[0];
        $this->_oTemplate->content->main_content->oProductVariants = $this->_oProduct->GetVariantsForProduct($id)->Value;
        $this->_oTemplate->content->main_content->oLanguages = $this->_oLanguage->GetLanguagesI18n(array($this->_lang))->Value;
        $this->_oTemplate->content->main_content->oComments = $this->_oProduct->GetProductComments($id)->Value;
        $this->_oTemplate->content->main_content->oAttributes = $_oAttribute->GetAttributes($this->_lang, TRUE)->Value;
        $this->_oTemplate->content->main_content->oOnlyAttributes = $_oAttribute->GetAttributesAsArray($this->_lang)->Value;
        $this->_oTemplate->content->main_content->oProductAttributes = $this->_oProduct->GetProductAttributes($id)->Value;
        $this->_oTemplate->content->main_content->oParameters = $_oParameter->GetParameters()->Value;

        $parametersActiveValues = $_oParameter->GetParametersActiveValues()->Value;
        $parameters = array();
        foreach ($parametersActiveValues as $value) {
            $parameters[$value->parameter_id]['id_parameter_value'][] = $value->id_parameter_value;
            $parameters[$value->parameter_id]['parameter_value'][] = $value->parameter_value;
        }
        foreach ($parameters as $pk => $pv) {
            //$parameters[$pk] = array_combine($parameters[$pk]['id_parameter_value'], $parameters[$pk]['parameter_value']);
        }
        //echo Kohana::debug($parameters);
        $this->_oTemplate->content->main_content->oParametersValues = $parameters; ///

        $this->_oTemplate->content->main_content->oProductParameters = $this->_oProduct->GetProductParameters($id)->Value;
        $this->_oTemplate->content->main_content->oProductImages = $this->_oProduct->GetProductImages($id, TRUE)->Value;
        $this->_oTemplate->content->main_content->oProductFiles = $this->_oProduct->GetProductFiles($id)->Value;
        $this->_oTemplate->content->main_content->oRebateGroups = $_oRebateGroup->GetRebateGroupsAsArray(true)->Value;
        $this->_oTemplate->content->main_content->oRelatedProducts = $this->_oProduct->GetRelatedProducts($id)->Value;
        $tags = $this->_oProduct->GetProductTags($id)->Value;
        $tags2 = array();
        foreach ($tags as $t) {
            array_push($tags2, $t->word);
        }
        $tags = implode(', ', $tags2);
        $this->_oTemplate->content->main_content->oProductTags = $tags;
        $this->_oTemplate->title = Kohana::lang('product.edit_product');
        $this->_oTemplate->render(true);
    }

    /**

     *
     * @param Integer $id
     */
    public function delete($id) {
        $this->authorize('products', 'delete');
        $result = $this->_oProduct->Delete($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/produkty');
    }

    public function translate() {
        $post = array();
        foreach ($_POST as $pKey => $pValue) {
            $post[$pKey] = $pValue;
        }
        $_POST = $post;
        $value = '';
        if (!empty($_POST) && count($_POST) > 0) {
            $sLanguage = empty($_POST['lngId']) ? 'pl_PL' : Language_Model::GetISOById($_POST['lngId'])->Value[0]->name;
            $db = new Product_Model();
            switch ($_POST['cmd']) {
                case 'get':
                    switch ($_POST['dlg']) {
                        case 'product_name_language_dialog':
                            $value = $db->GetProductLanguageValue('product_name', $sLanguage, $_POST['pId'])->Value;
                            break;
                        case 'product_short_description_language_dialog':
                            $value = $db->GetProductLanguageValue('product_short_description', $sLanguage, $_POST['pId'])->Value;
                            break;
                        case 'product_description_language_dialog':
                            $value = $db->GetProductLanguageValue('product_description', $sLanguage, $_POST['pId'])->Value;
                            break;
                        case 'product_guarantee_language_dialog':
                            $value = $db->GetProductLanguageValue('product_guarantee', $sLanguage, $_POST['pId'])->Value;
                            break;
                        case 'product_meta_title_language_dialog':
                            $value = $db->GetProductLanguageValue('meta_title', $sLanguage, $_POST['pId'])->Value;
                            break;
                        case 'product_meta_description_language_dialog':
                            $value = $db->GetProductLanguageValue('meta_description', $sLanguage, $_POST['pId'])->Value;
                            break;
                        case 'product_meta_keywords_language_dialog':
                            $value = $db->GetProductLanguageValue('meta_keywords', $sLanguage, $_POST['pId'])->Value;
                            break;
                    }
                    echo $value;
                    break;
                case 'set':
                    $_POST['val'] = trim(strip_tags($_POST['val']));
                    switch ($_POST['dlg']) {
                        case 'product_name_language_dialog':
                            $value = $db->SetProductLanguageValue('product_name', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                        case 'product_short_description_language_dialog':
                            $value = $db->SetProductLanguageValue('product_short_description', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                        case 'product_description_language_dialog':
                            $value = $db->SetProductLanguageValue('product_description', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                        case 'product_guarantee_language_dialog':
                            $value = $db->SetProductLanguageValue('product_guarantee', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                        case 'product_meta_title_language_dialog':
                            $value = $db->SetProductLanguageValue('meta_title', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                        case 'product_meta_description_language_dialog':
                            $value = $db->SetProductLanguageValue('meta_description', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                        case 'product_meta_keywords_language_dialog':
                            $value = $db->SetProductLanguageValue('meta_keywords', $sLanguage, $_POST['pId'], $_POST['val'])->Message;
                            break;
                    }
                    echo $value;
                    break;
            }
        } else {
            echo '';
        }
    }

    public function edit_comment($iProductId, $iCommentId) {
        $this->authorize('products', 'edit');
        if (!empty($_POST)) {
            $result = $this->_oProduct->DeleteComment($iCommentId);
            $this->_oSession->set('message', $result->__toString());
            url::redirect('4dminix/edytuj_produkt/' . $iProductId . '#tab-5');
        } else {
            $this->_oTemplate->content->main_content = new View('admin/product_edit');
            $this->_oTemplate->content->main_content->oComment = $this->_product->GetCommentDetails($iProductId, $iCommentId);
        }
    }

    /**
     *
     * @param integer $iProductId
     * @param integer $iCommentId
     */
    public function delete_comment($iProductId, $iCommentId) {
        $this->authorize('products', 'edit');
        $result = $this->_oProduct->DeleteComment($iCommentId);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/edytuj_produkt/' . $iProductId . '#tab-5');
    }

    /**
     *
     * @param integer $iProductId
     */
    public function generate_allegro_template($iProductId) {
        $this->authorize('products', 'index');
        $sTpl = file_get_contents('allegro.tpl');
        $oProduct = new Product_Model($iProductId);
        $oDeliveryType = new Delivery_Type_Model();
        $sDeliveryTypes = '';
        $oDeliveryTypes = $oDeliveryType->GetDeliveryTypes()->Value;
        foreach ($oDeliveryTypes as $dt) {
            $sDeliveryTypes .= '<p>' . ($dt->delivery_type) . ' - ' . ($dt->delivery_cost) . '</p>';
        }
        $oPaymentType = new Payment_Type_Model();
        $sPaymentTypes = '';
        $oPaymentTypes = $oPaymentType->GetPaymentTypes()->Value;
        foreach ($oPaymentTypes as $pt) {
            $sPaymentTypes .= '<p>' . $pt->payment_type_name . ' - ' . $pt->payment_cost . '</p>';
        }
        $sProductImages = '';
        $aProductImages = $oProduct->GetProductImagesListForAllegro()->Value->Value;
        foreach ($aProductImages as $piKey => $piValue) {
            $sProductImages .= html::image(Kohana::config('config.http_host') . url::base() . Product_Model::PRODUCT_IMG_MEDIUM . $piValue);
        }
        $sTpl = str_replace('<!%DELIVERY_TYPES%!>', $sDeliveryTypes, $sTpl);
        $sTpl = str_replace('<!%PAYMENT_METHODS%!>', $sPaymentTypes, $sTpl);
        $sTpl = str_replace('<!%PRODUCT_NAME%!>', ($oProduct->GetProductName()->Value), $sTpl);
        $sTpl = str_replace('<!%PRODUCT_DESCRIPTION%!>', $oProduct->GetProductDescription()->Value, $sTpl);
        $sTpl = str_replace('<!%PRODUCT_IMAGES%!>', $sProductImages, $sTpl);
        $sTpl = substr($sTpl, strpos($sTpl, '<body>'));
        $sTpl = substr($sTpl, 0, strpos($sTpl, '</html>'));
        $sTpl = trim($sTpl);
        $v = new View('admin/popup');
        $v->title = Kohana::lang('product.generate_allegro_template');
        $v->popupBody = '<textarea name="allegro_template" id="allegro_template" rows="40" cols="120">' . $sTpl . '</textarea>';
        $v->render(true);
    }

    public function delete_variant($id, $product_id) {
        $this->authorize('attributes_values', 'delete');
        $result = $this->_oProduct->DeleteVariant($id);
        $this->_oSession->set('message', $result->__toString());
        url::redirect('4dminix/edytuj_produkt/' . $product_id);
    }

}
