<?php

defined('SYSPATH') OR die('No direct access allowed.');

class App_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();

        $this->_oSession = Session::instance();

        // TODO: prenieść do niżej do modelu lub helpera languages
        if (!empty($_COOKIE['language'])) {

            switch (uri::segment(1)) {
                case 'en':
                    cookie::set('language', 'en_US');
                    $this->_oSession->set('lang', 'en_US');
                    $lang = 'en';
                    break;
                case 'de':
                    cookie::set('language', 'de_DE');
                    $this->_oSession->set('lang', 'de_DE');
                    $lang = 'de';
                    break;
                case 'ru':
                    cookie::set('language', 'ru_RU');
                    $this->_oSession->set('lang', 'ru_RU');
                    $lang = 'ru';
                    break;
                default :
                    cookie::set('language', 'pl_PL');
                    $this->_oSession->set('lang', 'pl_PL');
                    $lang = 'pl';
                    break;
            }
        } else {
            switch (uri::segment(1)) {
                case 'en_US':
                    cookie::set('language', 'en_US');
                    $this->_oSession->set('lang', 'en_US');
                    $lang = 'en';
                    break;
                case 'de_DE':
                    cookie::set('language', 'de_DE');
                    $this->_oSession->set('lang', 'de_DE');
                    $lang = 'de';
                    break;
                case 'ru_RU':
                    cookie::set('language', 'ru_RU');
                    $this->_oSession->set('lang', 'ru_RU');
                    $lang = 'ru';
                    break;
                default :
                    cookie::set('language', 'pl_PL');
                    $this->_oSession->set('lang', 'pl_PL');
                    $lang = 'pl';
                    break;
            }
        }



        $this->lang = Kohana::config('locale.language');

        $this->_oNews = new News_Model();
        $this->_oPage = new Page_Model();
        $this->_oGallery = new Gallery_Model();
        $this->_oPoll = new Poll_Model();
        $this->_oNewsletter = new Newsletter_Model();
        $this->_oPageContent = new Page_content_Model();
        $this->_oContactForm = new Contact_Form_Model();
        $this->_oSlider = new Slider_Model;
        $this->_oPartner = new Partner_Model();

        if (config::CheckIfModuleEnabled('shop') === TRUE) {
            $this->_oProduct = new Product_Model();
            $this->_oProductsCategories = new Product_Category_Model();
            $this->_oCurrencies = new Currencies_Model();
            $this->_oParameter = new Parameter_Model();
            $this->_oProducer = new Producer_Model();
        }
      // $this->profile = new Profiler_Core(); //do testów


        /* widoki */
        $this->_oTemplate = new View('app/template');
        $this->_oTemplate->header = new View('app/header');
        $this->_oTemplate->content = new View('app/main');
        $this->_oTemplate->content->main_left = null;
        $this->_oTemplate->content->main_right = null;
        $this->_oTemplate->footer = new View('app/footer');
        $this->_oTemplate->vSocial = new View('app/elements/social');


        /* zmienne */
        //waluty
        if (config::CheckIfModuleEnabled('shop') === TRUE) {
            $currencies = $this->_oCurrencies->FindAll()->Value;
            $this->_oTemplate->header->currencies = $currencies;
            if (!empty($_POST['currency_sel'])) {
                foreach ($currencies as $cr1) {
                    if ($cr1->currency_code == $_POST['currency_sel']) {
                        $this->_oSession->set('factor', $cr1->currency_factor);
                    }
                }
                $this->_oSession->set('currency', $_POST['currency_sel']);
            } elseif (empty($_SESSION['currency'])) {
                foreach ($currencies as $cr) {
                    if ($cr->currency_default == 'Y') {
                        $this->_oSession->set('currency', $cr->currency_code);
                        $this->_oSession->set('factor', $cr->currency_factor);
                    }
                }
            }
            //$this->_oTemplate->header->act_cur = cookie::get('currency');
            $this->_oTemplate->header->act_cur = $this->_oSession->get('currency');
        }

        /*         * **generowanie menu przeniesione do controlera site/shop*** */
//        $oPagesTreeForApp = $this->_oPage->GetPagesTreeForApp('pl_PL', null);
//        $this->_oTemplate->header->oPages = $oPagesTreeForApp;
        //$this->_oTemplate->content->main_left->oPages = $oPagesTreeForApp;
        //$this->_oTemplate->content->main_right->oNewsletter = new View('app/app_newsletters');
//        $this->_oTemplate->content->main_right->oNewsletter->msg = $this->_oNewsletter->NewsletterAddUser();
        //top sellers block        
//        $this->_oTemplate->content->main_left->vTopSellers = new View('app/elements/top_sellers');
//        $this->_oTemplate->content->main_left->vTopSellers->title = Kohana::lang('shop_app.product.top_sellers');
//        $this->_oTemplate->content->main_left->vTopSellers->oProducts = $this->_oProduct->GetTopSellProducts()->Value;

        $this->_oNewsletter->SubscribeApp(); //odpowiada za zapisywanie się do newslettera


        $google_tracking_code = config::getConfig('google_tracking_code');
        $this->_oTemplate->google_tracking_code = html::specialchars($google_tracking_code);



        $this->_oTemplate->lang = $lang;
        $this->_oTemplate->header->lang = $lang;
    }

}
