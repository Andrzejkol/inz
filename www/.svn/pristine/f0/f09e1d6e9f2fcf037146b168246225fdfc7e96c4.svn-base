<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Index_Controller extends App_Controller {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->_aCartContent = empty($_SESSION['__cart']) ? array() : $_SESSION['__cart'];
        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;
//        $this->_aCartContent = empty($_SESSION['__cart']) ? array() : $_SESSION['__cart'];

        if (!empty($_SESSION['__cart']) && $_SESSION['__cart'] != null) {
            $ctmp = $this->_oProduct->GetDetailsForProductsFromCart($_SESSION['__cart'], 'pl_PL')->Value;
            $cart_tmp = shop::DeleteCartDoubles($ctmp);
        }
        if (!empty($cart_tmp)) {
            $this->_oTemplate->header->productDetails = $cart_tmp;
        }
    }

    public function index() {
        $iPageId = 1;
        $this->_oTemplate->content->main_content = new View('app/contents/main_content');
        $oContents = $this->_oPage->GetPageContents($iPageId)->Value;
        $oElements = $this->_oPage->GetPageElements($iPageId);
        $this->_oTemplate->content->main_content->oContents = $oContents;
        $this->_oTemplate->content->main_content->oElements = $oElements;
        $this->_oTemplate->oMeta = $this->_oPage->GetPage($iPageId)->Value;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function news($iNewsId) {
        $this->_oTemplate->body_class = ' class="news-' . $iNewsId . '"';
        $oPagesTreeForApp = $this->_oPage->GetPagesTreeForApp($this->lang, NULL, true);
        $this->_oTemplate->header->oPages = $oPagesTreeForApp;

        $captcha = new Captcha;
        $this->_oNews->PostComment($iNewsId)->Value;

        $this->_oTemplate->content->main_content = new View('app/contents/main_content');
        $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg', NULL);
        $oNews = $this->_oNews->GetNews($iNewsId)->Value[0];
        $this->_oTemplate->content->main_content->oNewsDetails = $oNews;

        if (!empty($oNews) && !empty($oNews->comments)) {
            $this->_oTemplate->content->main_content->vNewsComments = new View('app_comments');
            $this->_oTemplate->content->main_content->vNewsComments->oNewsComments = $this->_oNews->getComments($iNewsId)->Value;
            $this->_oTemplate->content->main_content->vNewsComments->captcha = $captcha;
        }

        $this->_oTemplate->oMeta = $this->_oNews->GetNewsMeta($iNewsId)->Value;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function contents($iPageId) {
        $this->_oTemplate->body_class = ' class="page-' . $iPageId . '"';
        $oPagesTreeForApp = $this->_oPage->GetPagesTreeForApp($this->lang, $iPageId, true);
        $this->_oTemplate->header->oPages = $oPagesTreeForApp;
        $this->_oTemplate->footer->oPages = $oPagesTreeForApp;
        $this->_oTemplate->content->main_content = new View('app/contents/main_content');
        /*
          $this->_oTemplate->content->main_left = new View('app/main_left');
          $this->_oTemplate->content->main_left->vCategories = new View('app/elements/categories');
          $this->_oTemplate->content->main_left->vCategories->catlist = $this->_oProductsCategories->GetCategories()->Value;

          $this->_oTemplate->content->main_left->vSearch = new View('app/elements/search');
          $this->_oTemplate->content->main_left->vSearch->oProducers = $this->_oProducer->GetProducers()->Value;
          $this->_oTemplate->content->main_left->vSearch->oParameters = $this->_oParameter->GetParameters()->Value;
          $parametersActiveValues = $this->_oParameter->GetParameterValues()->Value;
          $parameters = array();
          foreach ($parametersActiveValues as $value) {
          $parameters[$value->parameter_id]['id_parameter_value'][] = $value->parameter_id;
          $parameters[$value->parameter_id]['parameter_value'][] = $value->value;
          }
          $this->_oTemplate->content->main_left->vSearch->oParametersValues = $parameters;

         */

        $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg', NULL);
        $PageInfo = $this->_oPage->GetPage($iPageId)->Value;
        $this->_oTemplate->oMeta = $PageInfo;
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->vBreadcrumbs->aBreadcrumb = $this->_oPage->GetBreadcrumbs($iPageId, true)->Value;
        $this->_oTemplate->content->vBreadcrumbs->sHere = $PageInfo[0]->name_page;

        //$this->_oTemplate->header->oPhotos = $this->_oSlider->GetAll(FALSE, NULL, NULL, TRUE)->Value;	
        //partnerzy
        //    $this->_oTemplate->footer->vPartners = new View('app_partners');
        //    $this->_oTemplate->footer->vPartners->partner = $this->_oPartner->GetPartnersForHomepage()->Value;
        //jeżeli homepage
        if ($PageInfo[0]->homepage == 1) {

            $this->_oTemplate->body_class = ' class="home"';
            $this->_oTemplate->footer->bHome = TRUE;

            $this->_oTemplate->content->main_content = new View('app/contents/home_content');
            // $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
            // $oProducts = $this->_oProduct->GetAllProductListing()->Value;
            //   $this->_oTemplate->content->main_content->vProductListing->oProducts = $oProducts;
            if ($PageInfo[0]->page_type == "shop") {
                //kategorie - upper slider
                //   $this->_oTemplate->content->main_content->vSeeCategories = new View('app/elements/see_categories');
                //     $this->_oTemplate->content->main_content->vSeeCategories->oCategories = $this->_oProductsCategories->GetCategories()->Value;
                //ostatnio dodane - lower slider
                // $this->_oTemplate->content->main_content->vSeeProduct = new View('app/elements/see_product');
                // $this->_oTemplate->content->main_content->vSeeProduct->oProducts = $this->_oProduct->GetNewestProducts(20, FALSE)->Value;
                //$this->_oTemplate->content->main_content->vSeeProduct->oProducts = $this->_oProduct->GetRecommendedProduct()->Value;
            }
            //Slider      
        }
        if ($iPageId == 51 || $iPageId == 69 || $iPageId == 78) {
            $this->_oTemplate->content->main_content->vMap = new View('app/elements/map');
        }
        $this->_oTemplate->header->vSlider = new View('app/slider02');
        $this->_oTemplate->header->vSlider->aElements = $this->_oSlider->GetAll(FALSE, NULL, NULL, TRUE)->Value;
        $this->_oTemplate->header->vSlider->oPhotos = $this->_oSlider->GetAll(FALSE, NULL, NULL, TRUE)->Value;


        if (!empty($_POST['contact_form_submit'])) {
            $oCheck = $this->_oContactForm->ValidateSend($_POST);
            if ($oCheck->Value == true) {
                $result = $this->_oContactForm->SendMessage($_POST);
                $this->_oTemplate->content->main_content->msg = $result->__toString();
                unset($_POST);
            } else {
                $this->_oTemplate->content->main_content->msg = $oCheck->__toString();
            }
        }
        if (!empty($_POST['r_form_submit'])) {
            $oCheck = $this->_oContactForm->ValidateSendReservation($_POST);
            if ($oCheck->Value == true) {
                $result = $this->_oContactForm->SendReservation($_POST);
                $this->_oTemplate->content->main_content->msg = $result->__toString();
                unset($_POST);
            } else {
                $this->_oTemplate->content->main_content->msg = $oCheck->__toString();
            }
        }

        // pobieramy sondy
        $oPoll = $this->_oPoll->GetPollForPage($iPageId)->Value;
        if (!empty($oPoll) && $oPoll->count() > 0) {
            $this->_oTemplate->content->main_right->oPolls = new View('app/app_poll');
            $this->_oTemplate->content->main_right->oPolls->oPoll = $oPoll;
            $this->_oTemplate->content->main_right->oPolls->oCheck = $this->_oPoll->CheckUserStatus($oPoll[0]->question_id)->Value;
        }
        $oContents = $this->_oPage->GetPageContents($iPageId)->Value;
        $oElements = $this->_oPage->GetPageElements($iPageId);
        $this->_oTemplate->content->main_content->oContents = $oContents;
        $this->_oTemplate->content->main_content->oElements = $oElements;
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->render(true);
    }

    public function show404() {
        $oPagesTreeForApp = $this->_oPage->GetPagesTreeForApp($this->lang, 0, true);
        $this->_oTemplate->header->oPages = $oPagesTreeForApp;
        $this->_oTemplate->content = new View('kohana_error_disabled');
        $this->_oTemplate->render(true);
    }

    public function confirm_unsubscribe() {
        $_SESSION['message'] = $this->_oNewsletter->ConfirmUnsubscribe($_GET)->__toString();
        switch (uri::segment(1)) {
            case 'en':
                url::redirect('en');
                break;
            case 'de':
                url::redirect('de');
                break;
            case 'ru':
                url::redirect('ru');
                break;
            default:
                url::redirect('');
                break;
        }
    }

    public function confirm_subscribe() {
        $_SESSION['message'] = $this->_oNewsletter->ConfirmSubscribe($_GET)->__toString();
        switch (uri::segment(1)) {
            case 'en':
                url::redirect('en');
                break;
            case 'de':
                url::redirect('de');
                break;
            case 'ru':
                url::redirect('ru');
                break;
            default:
                url::redirect('');
                break;
        }
    }

}
