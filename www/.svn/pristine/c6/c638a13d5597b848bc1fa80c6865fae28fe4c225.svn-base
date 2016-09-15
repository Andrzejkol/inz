<?php

defined('SYSPATH') OR die('No direct access allowed.');

class App_Products_Controller extends App_Shop_Controller {

    private $_oUser;
    private $_acl;

    // Do not allow to run in production

    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();

        $this->_aCartContent = empty($_SESSION['__cart']) ? array() : $_SESSION['__cart'];

        if (!empty($_SESSION['__cart']) && $_SESSION['__cart'] != null) {
            $ctmp = $this->_oProduct->GetDetailsForProductsFromCart($_SESSION['__cart'], 'pl_PL')->Value;
            $cart_tmp = shop::DeleteCartDoubles($ctmp);
        }
        if (!empty($cart_tmp)) {
            $this->_oTemplate->header->productDetails = $cart_tmp;
        }


        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;
        $this->_oTemplate->header->productsSummary = $this->_oProduct->CountCartCost($this->_aCartContent)->Value;
        $this->_oTemplate->header->oCatTree = $this->_oProductCategory->GetCategoriesTreeAppMenu();

//        $this->_oTemplate->content->main_left->vMarki = new View('app/elements/lemarki');
//        $this->_oTemplate->content->main_left->vMarki->oProducers = $this->_oProducer->FindAll(null, null, true)->Value;
        /*    $this->_oTemplate->content->main_left->vProduct = new View('app/elements/leproduct');
          $this->_oTemplate->content->main_left->vProduct->oCatTree = $this->_oProductCategory->GetCategoriesTreeWithProducts($this->_aLang);
          $this->_oTemplate->content->main_left->vSocial = new View('app/elements/social');
          $this->_oTemplate->content->main_left->oNewsletter = new View('app/app_newsletters'); */

        // adv search
//        $wheel_values = $this->_oProduct->getRozmiaryKol();
//        $gear = $this->_oProduct->getPrzerzutki();
//        $producer = $this->_oProduct->getProducenci();
//        $this->_oTemplate->content->main_left->vAdvSearch = View::factory('app/elements/adv_search')
//                ->set('wheel_values', $wheel_values)
//                ->set('gear', $gear)
//                ->set('producer', $producer);
        // end adv search
        //  $this->_oTemplate->content->main_left->oCatTree = $this->_oProductCategory->GetCategoriesTreeApp();

        $oNewestProducts = $this->_oProduct->GetNewestProducts()->Value;

//        $this->profile = new Profiler_Core();
    }

    public function index() {

        $this->_oTemplate->content->main_content = new View('app/main_content');

        /*         * *Specyficzny widok - wszystkie kategorie wraz z produktami na jednej stronie*** */
        $this->_oTemplate->content->main_content->vAllProductListing = new View('app/elements/all_product_listing');
        $cat_array = $this->_oProductCategory->GetCategoriesAsArray(null, $this->_aLang);
        $listing = $this->_oProductCategory->GetCategoriesWithProducts($cat_array, $this->_aLang)->Value;

        $this->_oTemplate->content->main_content->vAllProductListing->categories = $cat_array;
        $this->_oTemplate->content->main_content->vAllProductListing->products = $listing;



        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iCategoryId
     */
    public function listing($iCategoryId, $sCategoryName, $sPage = null, $iPage = null) {
        if (request::is_ajax()) {
            $this->ajax_listing($iCategoryId, $sCategoryName);
            exit;
        }


        if (empty($_GET['page'])) {
            $iPage = 1;
        } else {
            $iPage = $_GET['page'];
        }

        //  $this->_oTemplate->content->main_left->vProduct->oCatTree = $this->_oProductCategory->GetCategoriesTreeWithProducts($this->_aLang, $iCategoryId);

        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
        //$this->_oTemplate->content->main_content->vProductListing->listingheader = Kohana::lang('product.products');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        //$this->_oTemplate->content->main_content->vSorting = new View('app/elements/sorting');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vTopSellers = new View('app/elements/top_sellers');



        $oCategories = $this->_oProductCategory->GetParentCategories($iCategoryId)->Value;

        $sel = null;
        if (!empty($oCategories)) {
            foreach ($oCategories as $cat) {
                if ($cat->parent_category_id == 0) {
                    $sel = $cat->id_category;
                }
            }
        } elseif (!empty($iCategoryId)) {
            $sel = $iCategoryId;
        }



        $this->_oTemplate->header->oCatTree = $this->_oProductCategory->GetCategoriesTreeAppMenu('pl_PL', $sel);

        $this->_oTemplate->content->main_content->vBreadcrumbs->oCats = $oCategories;
        $oCategory = $this->_oProductCategory->GetCategory(array('id_category' => $iCategoryId))->Value[0];
        $this->_oTemplate->content->main_content->vProductListing->oCatD = $oCategory;
        if ($oCategory->active == 'N') {
            url::redirect('/');
        }
        $ThisCategoryName = $oCategory->category_name;
        $this->_oTemplate->content->main_content->vProductListing->sTitle = $ThisCategoryName;

        //$this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
        $oCount = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET, true)->Value;
//        echo '<pre>';
//       var_dump($oCount);
//        echo '</pre>';
        if (!empty($oCount[0]->count)) {
            $iTotalItems = $oCount[0]->count;
        } else {
            $iTotalItems = 0;
        }

        if (!empty($_GET['filter_results'])) {
            $iLimit = $_GET['filter_results'];
        } else {
            $iLimit = Product_Model::PRODUCTS_LIMIT;
        }
        $pagination = layer::GetPagination($iTotalItems, 'app_ajax_only_next', $iLimit);

        $oProducts = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET)->Value;

        $this->_oTemplate->content->main_content->vProductListing->oProducts = $oProducts;

        $this->_oTemplate->content->main_content->vFilters = new View('app/elements/filters');
        $this->_oTemplate->content->main_content->vFilters->oProducers = $this->_oProducer->GetProducers(true)->Value;
        $this->_oTemplate->content->main_content->vFilters->sCategoryName = $sCategoryName;
        $this->_oTemplate->content->main_content->vFilters->iCategoryId = $iCategoryId;
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = $ThisCategoryName;
        $this->_oTemplate->content->main_content->vPaginationBottom = new View('app/elements/pagination_bottom');
        $this->_oTemplate->content->main_content->vProductListing->pagination = $pagination;

        $sTitle = !empty($ThisCategoryName) ? string::ucFirst($ThisCategoryName) : Kohana::lang('product.products_index');

        $this->_oTemplate->title = $sTitle;

        foreach ($oCategories as $oCategory) {
            $this->_oTemplate->title .= ' - ' . $oCategory->category_name;
        }
        $this->_oTemplate->title .= ' - ' . Kohana::lang('meta.home_site_title');

        $this->_oTemplate->description = 'Produkty z kategorii - ' . $sTitle . ' - ' . Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('meta.home_site_keywords');
        $this->_oTemplate->render(true);
    }

    public function last_add() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vProductListing->sTitle = 'Nowości';
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $oCount = $this->_oProduct->GetNewestProducts(40)->Value;

        $aProductsParameters = array();
        foreach ($oCount as $key) {
            $oParams = $this->_oProduct->GetProductParameters($key->id_product, array(3, 10, 20, 21))->Value;
            foreach ($oParams as $par) {
                $aProductsParameters[$key->id_product][$par->parameter_id] = number_format($par->value, 1, ',', ' ');
            }
        }
        $this->_oTemplate->content->main_content->vProductListing->aProductsParameters = $aProductsParameters;
        $this->_oTemplate->content->main_content->vProductListing->oProducts = $oCount;

        $this->_oTemplate->content->main_content->vFilters = new View('app/elements/filters');
        $this->_oTemplate->content->main_content->vFilters->oProducers = $this->_oProducer->GetProducers(true)->Value;

        $this->_oTemplate->title = !empty($ThisCategoryName) ? string::ucFirst($ThisCategoryName) : Kohana::lang('product.products_index');
//        $this->_oTemplate->description = 'Nowości';
//        $this->_oTemplate->keywords = 'Nowości';
        $this->_oTemplate->render(true);
    }

    public function recommended() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vSeeProduct = new View('app/elements/see_product');
        $this->_oTemplate->content->main_content->vSeeProduct->oProducts = $this->_oProduct->GetRecommendedProduct()->Value;

        $this->_oTemplate->title = !empty($ThisCategoryName) ? string::ucFirst($ThisCategoryName) : Kohana::lang('product.products_index');
        $this->_oTemplate->description = 'XXX (listing)';
        $this->_oTemplate->keywords = 'YYY (listing)';
        $this->_oTemplate->render(true);
    }

    public function add_to_fav($iProductId) {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oSession->set('msg', $this->_oProduct->AddToFav($_SESSION['_customer']['customer_id'], $iProductId)->__toString());
            url::redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->_oSession->set('msg', '<div class="warning">' . Kohana::lang('customer.validation.please_login_to_add_to_fav') . '</div>');
            url::redirect('logowanie');
        }
    }

    /**
     *
     * @param integer $iCategoryId
     */
    public function search_products($sPage = null, $iPage = null) {
        if (request::is_ajax()) { // do paginacji
            $this->ajax_search_products($sPage, $iPage);
            exit;
        }


        if (empty($iPage)) {
            $iPage = 1;
        }

        $this->_oTemplate->content->main_left->vMenu = null;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = Kohana::lang('product.search_results');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('product.search_results');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');

        $aSearchPhrase = (!empty($_GET['search_phrase']) ? $_GET['search_phrase'] : '');

        $oCount = $this->_oProduct->SearchResults($this->_aLang, $aSearchPhrase, true)->Value;
        if (!empty($oCount)) {
            $iTotalItems = $oCount;
        } else {
            $iTotalItems = 0;
        }

        if (!empty($_GET['filter_results'])) {
            $iLimit = $_GET['filter_results'];
        } else {
            $iLimit = Product_Model::PRODUCTS_LIMIT;
        }
        $pagination = new Pagination(array(
            //'base_url'    => 'news_ajax/get_news_table/', // base_url will default to current uri
            'uri_segment' => 'page', // pass a string as uri_segment to trigger former 'label' functionality
            'total_items' => $iTotalItems, // use db count query here of course
            'items_per_page' => $iLimit, // it may be handy to set defaults for stuff like this in config/pagination.php
            'style' => 'app_ajax_only_next', // pick one from: classic (default), digg, extended, punbb, or add your own!
            'auto_hide' => TRUE,
        ));

        $searchResult = $this->_oProduct->SearchResults($this->_aLang, $aSearchPhrase, false, $iLimit, $pagination->sql_offset);
        $this->_oTemplate->content->main_content->vProductListing->oProducts = $searchResult->Value;
        $this->_oTemplate->content->main_content->vProductListing->searchMessage = $searchResult->Message;
        $this->_oTemplate->content->main_content->vFilters = null;
        $this->_oTemplate->content->main_content->vProductListing->pagination = $pagination;
//        $this->_oTemplate->content->main_content->vFilters = new View('app/elements/filters');
//        $this->_oTemplate->content->main_content->vFilters->oProducers = $this->_oProducer->GetProducers(true)->Value;
//        $this->_oTemplate->content->main_content->vPaginationBottom = new View('app/elements/pagination_bottom');
//        $this->_oTemplate->content->main_content->vPaginationTop->pagination = $pagination;
//        $this->_oTemplate->content->main_content->vPaginationBottom->pagination = $pagination;
        //$this->_oTemplate->title = Kohana::lang('product.products_index');
        $this->_oTemplate->title = Kohana::lang('product.search_results_phrase') . ' - &quot;' . htmlspecialchars($aSearchPhrase) . '&quot;';
        $this->_oTemplate->description = 'XXX (listing)';
        $this->_oTemplate->keywords = 'YYY (listing)';
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param integer $iProducerId
     */
    public function listing_for_producer($iProducerId, $sProducerName) {

        $sThisProducerName = $this->_oProducer->Find($iProducerId)->Value[0]->producer_name;
        $this->_oTemplate->content->main_left->vMenu = null;

        $this->_oTemplate->content->main_left->vMarki->oActProd = $iProducerId;

        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = $sThisProducerName;
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = $sThisProducerName;
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
        $this->_oTemplate->content->main_content->vProductListing->listingheader = Kohana::lang('product.products');

        $oCount = $this->_oProduct->GetProductListing(array('producer_id' => $iProducerId), $this->_aLang, null, null, null, null, true)->Value;

        if (!empty($oCount[0]->count)) {
            $iTotalItems = $oCount[0]->count;
        } else {
            $iTotalItems = 0;
        }

        if (!empty($_GET['filter_results'])) {
            $iLimit = $_GET['filter_results'];
        } else {
            $iLimit = Product_Model::PRODUCTS_LIMIT;
        }
//        var_dump($iTotalItems);

        $pagination = layer::GetPagination($iTotalItems, 'digg_default', $iLimit);
        $this->_oTemplate->content->main_content->vProductListing->oProducts = $this->_oProduct->GetProductListing(array('producer_id' => $iProducerId), $this->_aLang, null, $iLimit, $pagination->sql_offset)->Value;
//        $this->_oTemplate->content->main_content->vProductListing->oBanners = $this->_oBanners->GetBannersForProductList(2, null, $this->_aLang, true)->Value;
        $this->_oTemplate->title = Kohana::lang('product.products_index');
        $this->_oTemplate->content->main_content->vProductListing->pagination = $pagination;
        $this->_oTemplate->title = !empty($sThisProducerName) ? string::ucFirst($sThisProducerName) : Kohana::lang('product.products_index');

        $this->_oTemplate->title .= ' - ' . Kohana::lang('meta.home_site_title');

        $this->_oTemplate->description = Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('meta.home_site_keywords');
        $this->_oTemplate->render(true);
    }

    public function search_by_filters() {

        url::redirect('producent/' . $_POST['id_producer'] . '/' . string::prepareURL($_POST['producer_name']));
    }

    /**
     *
     * @param integer $iProductId
     * @param string $sProductName
     */
    public function product_details($iProductId, $sProductName) {
        $iProductId += 0;
        $this->_oProduct->IncrementProductViewed($iProductId);
//        $this->_oProduct->RecentlyViewedProductSave($iProductId); // zapisujemy ostatnio ogladany produkt
//      $this->_oTemplate->content->main_right->iProductId=$iProductId;
//	$this->_oTemplate->content->main_right->in_clipboard = $this->_oCustomer->CheckProductInClipboard($iProductId);

        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');

        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vProductDetails = new View('app/elements/product_details');
        //$this->_oTemplate->content->main_content->vProductDetails->projectBox = new View('app/elements/projectBox');

        $oProductCategories = $this->_oProduct->GetProductCategories($iProductId)->Value;
        $this->_oTemplate->content->vBreadcrumbs->oCats = $oProductCategories;
        $this->_oTemplate->content->main_content->vProductDetails->listingheader = Kohana::lang('product.product');
        $iCategoryId = $oProductCategories[0]->category_id;
        // $this->_oTemplate->content->main_left->vProduct->oCatTree = $this->_oProductCategory->GetCategoriesTreeWithProducts($this->_aLang, $iCategoryId);

        /*  $oRelatedProducts = $this->_oProduct->GetRelatedProducts($iProductId, 4)->Value;
          if (!empty($oRelatedProducts) && $oRelatedProducts->count() > 0) {
          foreach ($oRelatedProducts as $rp) {
          $aRelatedProductsDesc[$rp->product_id] = $this->_oProduct->GetProductDetails($rp->product_id, $this->_aLang)->Value[0];
          $productMainImage = $this->_oProduct->GetProductMainImage($rp->product_id)->Value[0];
          $aRelatedProductsDesc[$rp->product_id]->mainimage = $productMainImage->filename;
          $oParams = $this->_oProduct->GetProductParameters($rp->product_id)->Value;
          foreach ($oParams as $par) {
          $aRelatedProductsDesc[$rp->product_id]->product_params[$par->parameter_id] = number_format($par->value, 1, ',', ' ');
          }
          }

          $this->_oTemplate->content->main_content->vProductDetails->aRelatedProductsDesc = $aRelatedProductsDesc;
          } */
        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->vProductDetails->msg = $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }

        $oProductDetails = $this->_oProduct->GetProductDetails($iProductId, $this->_aLang)->Value[0];
        $this->_oTemplate->content->main_content->vProductDetails->oProductParameters = $this->_oProduct->GetProductParameters($iProductId)->Value;
        $this->_oTemplate->content->main_content->vProductDetails->oProductAttributes = $this->_oProduct->GetAttributesForProduct($iProductId)->Value;
        $this->_oTemplate->content->main_content->vProductDetails->oProductAttributesValues = $this->_oProduct->GetAttributesForProduct($iProductId, true)->Value;

        $projectImages = $this->_oProduct->GetProductImages($iProductId)->Value;

        $this->_oTemplate->content->vBreadcrumbs->sHere = $oProductDetails->product_name;
        $this->_oTemplate->content->main_content->vProductDetails->oProductDetails = $oProductDetails;
        $this->_oTemplate->content->main_content->vProductDetails->oProductImages = $projectImages;
//        $this->_oTemplate->content->main_content->vProductDetails->oProductImages = $this->_oProduct->GetProductMainImage($iProductId)->Value;
        //fb og tags
        $ogarray = layer::CreateProductFbOgTags($oProductDetails, $projectImages);
        $this->_oTemplate->ogtags = layer::FbOgTags($ogarray);

        $this->_oTemplate->keywords = !empty($oProductDetails->meta_keywords) ? $oProductDetails->meta_keywords : Kohana::lang('meta.home_site_keywords');
        //$this->_oTemplate->title = !empty($oProductDetails->meta_title) ? $oProductDetails->meta_title : !empty($oProductDetails->product_name) ? $oProductDetails->product_name.' - rowery' : Kohana::config('app.application_title');

        $this->_oTemplate->title = $oProductDetails->product_name;
        $productDescription = $oProductDetails->product_name . ' - ';
        $i = 1;
        foreach ($oProductCategories as $oProductCategory) {
            $this->_oTemplate->title .= ' - ' . $oProductCategory->category_name;
            $productDescription .= $oProductCategory->category_name;
            if ($i != $oProductCategories->count()) {
                $productDescription .= ', ';
            }
            $i++;
        }
//        $this->_oTemplate->title .= ' - ' . Kohana::lang('meta.product_site_title');
        $productDescription .= ' - ' . text::limit_chars(strip_tags($oProductDetails->product_description), 150, '...', true);
        $this->_oTemplate->description = (!empty($oProductDetails->meta_description) ? $oProductDetails->meta_description : (!empty($productDescription) ? $productDescription : Kohana::config('app.application_title')));

        //  $this->_oTemplate->content->main_content->oAlsoLiked = new View('app/elements/also_liked');
        //  $this->_oTemplate->content->main_content->oAlsoLiked->oProducts = $this->_oProduct->GetAlsoLiked($oProductDetails->category_id, $iProductId)->Value;
//       
//        if(!empty($_SESSION['recently-viewed'])) {
//            $this->_oTemplate->content->main_content->oRecentlyVievedProducts = new View('app/elements/product_listing');
//            $this->_oTemplate->content->main_content->oRecentlyVievedProducts->oProducts = $this->_oProduct->GetProductListing(array('id_product!'=>$iProductId), $this->_aLang, array('id_product'=>$_SESSION['recently-viewed']), 10)->Value;
//        }
        $this->_oTemplate->render(true);
    }

    /**
     *
     */
    public function get_delivery_cost() {
        if (!empty($_POST['id_delivery_type'])) {
            $dt = new Delivery_Type_Model($_POST['id_delivery_type']);
            echo number_format($dt->DeliveryCost, 2, '.', '');
        } else {
            echo '0.00';
        }
        exit;
    }

    /**
     * 
     */
    public function get_payment_cost() {
        if (!empty($_POST['id_payment_type'])) {
            $pt = new Payment_Type_Model($_POST['id_payment_type']);
            echo number_format($pt->PaymentCost, 2, '.', '');
        } else {
            echo '0.00';
        }
        exit;
    }

    public function search_results() {
        $args = array();


        if (isset($_GET)) {

            //unset ($_GET['find']);
            foreach ($_GET as $getKey => $getValue) {
                $args[$getKey] = $getValue;
            }
        }
        //echo Kohana::debug($_GET);
        //echo Kohana::debug($args);
        $this->_oProduct->SetSearchCriteria($args);
        $result = $this->_oProduct->Search($args);
        //$this->_oTemplate->content->main_right->searchResultCount = $result->Value->count();
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->main_content->vSorting = new View('app/elements/sorting');


        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
        $this->_oTemplate->content->vBreadcrumbs->sHere = 'Wyniki wyszukiwania';

        $this->_oTemplate->content->main_content->vProductListing->listingheader = Kohana::lang('product.products');

        if ($result->Value->count()) {
            $ids = array();
            foreach ($result->Value as $id) {
                $ids[] = $id->id_product;
            }
            if (count($ids)) {
                $iTotalItems = $result->Value->count();
            } else {
                $iTotalItems = 0;
            }
            $iLimit = Product_Model::PRODUCTS_LIMIT;

            //$iLimit = 1;
//            $pagination = new Pagination(array(
//                //'base_url'    => 'news_ajax/get_news_table/', // base_url will default to current uri
//                'uri_segment'    => 'page', // pass a string as uri_segment to trigger former 'label' functionality
//                'total_items'    => $iTotalItems, // use db count query here of course
//                'items_per_page' => $iLimit, // it may be handy to set defaults for stuff like this in config/pagination.php
//                'style'          => 'pagg', // pick one from: classic (default), digg, extended, punbb, or add your own!
//                'auto_hide'      => TRUE,
//            ));


            $aGroupBy = array();
            if (!empty($_GET['filter_name'])) {
                if ($_GET['filter_name'] == 'ca') {
                    $aGroupBy['product_name'] = 'ASC';
                } elseif ($_GET['filter_name'] == 'cd') {
                    $aGroupBy['product_name'] = 'DESC';
                }
            }

            if (!empty($_GET['filter_prices'])) {
                if ($_GET['filter_prices'] == 'ca') {
                    $aGroupBy['price'] = 'ASC';
                } elseif ($_GET['filter_prices'] == 'cd') {
                    $aGroupBy['price'] = 'DESC';
                }
            }


            $pagination = layer::GetPagination($iTotalItems, 'app_ajax_only_next', $iLimit);
            $products = $this->_oProduct->GetSearchedPorductDetails($ids, $iLimit, $pagination->sql_offset, $aGroupBy)->Value;
            $this->_oTemplate->content->main_content->vProductListing->pagination = $pagination;
            $this->_oTemplate->content->main_content->vProductListing->oProducts = $products;
            $this->_oTemplate->content->main_content->vProductListing->aProductsParameters = $this->_oProduct->GetProductsParameters(array(3, 10))->Value;
        } else {
            $this->_oTemplate->content->main_content->vProductListing->oProducts = null;
        }
        $this->_oTemplate->title = Kohana::lang('meta.home_site_title');
        $this->_oTemplate->description = 'Rowery holenderskie,Rower holenderski,Rowery holenderskie używane,Rowery holenderskie sprzedaż,Rowery dziecięce,Rowery popal,Rowery sklep online,Rowery używane sprzedaż,Rowery miejskie';
        $this->_oTemplate->keywords = Kohana::lang('meta.home_site_keywords');
        $this->_oTemplate->render(true);
    }

    public function products_with_tags($iTagId) {
        if (!empty($iTagId)) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vProductListing = new View('app/products_with_tag');
            $oProducts = $this->_oTags->GetProductsWithTags($iTagId)->Value;
//			echo '<pre>';
//			var_dump($oProducts);
//			echo '</pre>';
//			exit;
            $this->_oTemplate->content->main_content->vProductListing->oProducts = $oProducts;
            //        $this->_oTemplate->content->main_content->vProductListing->aProductsParameters = $this->_oProduct->GetProductsParameters(array(3,10))->Value;
            $aProductsParameters = array();
            foreach ($oProducts as $key) {
                $oParams = $this->_oProduct->GetProductParameters($key->id_product, array(3, 10, 20, 21))->Value;
                foreach ($oParams as $par) {
                    $aProductsParameters[$key->id_product][$par->parameter_id] = number_format($par->value, 1, ',', ' ');
                }
            }
            $this->_oTemplate->content->main_content->vProductListing->aProductsParameters = $aProductsParameters;
            $this->_oTemplate->render(true);
        }
    }

    /**
     *
     * @param integer $iCategoryId
     */
    public function promotions() {
        if (request::is_ajax()) {
            $this->ajax_listing_promotions();
            exit;
        }


        if (empty($_GET['page'])) {
            $iPage = 1;
        } else {
            $iPage = $_GET['page'];
        }
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vProductListing = new View('app/elements/product_listing');
//        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
//        $this->_oTemplate->content->main_content->vSorting = new View('app/elements/sorting');
//        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->main_content->vProductListing->sTitle = 'Promocje';

        //$oCount = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET, true)->Value;
        //$oCount = $this->_oProduct->GetProductListing(array(), $sLanguage, $aIn, $iLimit, $iOffset, $aOrderby, true);
        $oCount = $this->_oProduct->GetProductsInPromotion()->Value;


        $aIn = array();
        $aIn['id_product'][] = 0;
        if (!empty($oCount) && $oCount->count() > 0) {
            $iTotalItems = $oCount->count();
            foreach ($oCount as $oC) {
                $aIn['id_product'][] = $oC->id_product;
            }
            //$aIn['id_product'] = implode(',',$aTempIn);
        } else {
            $iTotalItems = 0;
        }

        $iLimit = Product_Model::PRODUCTS_LIMIT;

        $aGroupBy = array();
        if (!empty($_GET['filter_name'])) {
            if ($_GET['filter_name'] == 'ca') {
                $aGroupBy['product_name'] = 'ASC';
            } elseif ($_GET['filter_name'] == 'cd') {
                $aGroupBy['product_name'] = 'DESC';
            }
        }

        if (!empty($_GET['filter_prices'])) {
            if ($_GET['filter_prices'] == 'ca') {
                $aGroupBy['price'] = 'ASC';
            } elseif ($_GET['filter_prices'] == 'cd') {
                $aGroupBy['price'] = 'DESC';
            }
        }

        $pagination = layer::GetPagination($iTotalItems, 'app_ajax_only_next', $iLimit);
        $oProducts = $this->_oProduct->GetProductListing(array(), null, $aIn, $iLimit, $pagination->sql_offset, $aGroupBy, false)->Value;

        //$oProducts = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET)->Value;
        $this->_oTemplate->content->main_content->vProductListing->oProducts = $oProducts;
//        $this->_oTemplate->content->vBreadcrumbs->sHere = 'Promocje';
        $this->_oTemplate->content->main_content->vPaginationBottom = new View('app/elements/pagination_bottom');
        $this->_oTemplate->content->main_content->vProductListing->pagination = $pagination;
        $this->_oTemplate->content->main_content->vProductListing->searchMessage = 'Brak produktów w promocji';

        $this->_oTemplate->title = 'Promocje';
//        $this->_oTemplate->description = 'Promocje';
//        $this->_oTemplate->keywords = 'Promocje';
        $this->_oTemplate->render(true);
    }

    public function ajax_listing_promotions() {
        if (empty($_GET['page'])) {
            $iPage = 1;
        } else {
            $iPage = $_GET['page'];
        }
        $main_content = new View('app/main_content');
        $vProductListing = new View('app/elements/product_listing');
        $vProductListing->sTitle = 'Promocje';

        $oCount = $this->_oProduct->GetProductsInPromotion()->Value;
        $iTotalItems = 0;
        $aIn = array();
        $aIn['id_product'][] = 0;
        if (!empty($oCount) && $oCount->count() > 0) {
            $iTotalItems = $oCount->count();
            foreach ($oCount as $oC) {
                $aIn['id_product'][] = $oC->id_product;
            }
        }

        $iLimit = Product_Model::PRODUCTS_LIMIT;

        $aGroupBy = array();
        if (!empty($_GET['filter_name'])) {
            if ($_GET['filter_name'] == 'ca') {
                $aGroupBy['product_name'] = 'ASC';
            } elseif ($_GET['filter_name'] == 'cd') {
                $aGroupBy['product_name'] = 'DESC';
            }
        }

        if (!empty($_GET['filter_prices'])) {
            if ($_GET['filter_prices'] == 'ca') {
                $aGroupBy['price'] = 'ASC';
            } elseif ($_GET['filter_prices'] == 'cd') {
                $aGroupBy['price'] = 'DESC';
            }
        }

        $pagination = layer::GetPagination($iTotalItems, 'app_ajax_only_next', $iLimit);
        $oProducts = $this->_oProduct->GetProductListing(array(), null, $aIn, $iLimit, $pagination->sql_offset, $aGroupBy, false)->Value;

        //$oProducts = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET)->Value;
        $vProductListing->oProducts = $oProducts;
        $vProductListing->pagination = $pagination;
        $vProductListing->searchMessage = 'Brak produktów w promocji';

        $vProductListing->render(true);
    }

    /**
     *
     * @param integer $iCategoryId
     */
    public function ajax_listing($iCategoryId, $sCategoryName, $sPage = null, $iPage = null) {
        if (empty($_GET['page'])) {
            $iPage = 1;
        } else {
            $iPage = $_GET['page'];
        }

        $main_content = new View('app/main_content');
        $main_content->vProductListing = new View('app/elements/product_listing');
        $oCategories = $this->_oProductCategory->GetParentCategories($iCategoryId)->Value;
        $sel = null;
        if (!empty($oCategories)) {
            foreach ($oCategories as $cat) {
                if ($cat->parent_category_id == 0) {
                    $sel = $cat->id_category;
                }
            }
        } elseif (!empty($iCategoryId)) {
            $sel = $iCategoryId;
        }
        $oCategory = $this->_oProductCategory->GetCategory(array('id_category' => $iCategoryId))->Value[0];
//        $main_content->vProductListing->oCatD = $oCategory;
        if ($oCategory->active == 'N') {
            url::redirect('/');
        }

        $oCount = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET, true)->Value;
        if (!empty($oCount[0]->count)) {
            $iTotalItems = $oCount[0]->count;
        } else {
            $iTotalItems = 0;
        }

        if (!empty($_GET['filter_results'])) {
            $iLimit = $_GET['filter_results'];
        } else {
            $iLimit = Product_Model::PRODUCTS_LIMIT;
        }
        $pagination = layer::GetPagination($iTotalItems, 'app_ajax_only_next', $iLimit);

        $oProducts = $this->_oProduct->GetProductsForCategories($iCategoryId, $iPage, $_GET)->Value;

        $main_content->vProductListing->oProducts = $oProducts;
        $main_content->vProductListing->pagination = $pagination;
        $main_content->render(true);
    }

    public function ajax_search_products($sPage = null, $iPage = null) {
        if (empty($iPage)) {
            $iPage = 1;
        }

        $vProductListing = new View('app/elements/product_listing');

        $oCount = $this->_oProduct->SearchResults($this->_aLang, $_GET['search_phrase'], true)->Value;
        if (!empty($oCount)) {
            $iTotalItems = $oCount;
        } else {
            $iTotalItems = 0;
        }

        if (!empty($_GET['filter_results'])) {
            $iLimit = $_GET['filter_results'];
        } else {
            $iLimit = Product_Model::PRODUCTS_LIMIT;
        }
        $pagination = new Pagination(array(
            //'base_url'    => 'news_ajax/get_news_table/', // base_url will default to current uri
            'uri_segment' => 'page', // pass a string as uri_segment to trigger former 'label' functionality
            'total_items' => $iTotalItems, // use db count query here of course
            'items_per_page' => $iLimit, // it may be handy to set defaults for stuff like this in config/pagination.php
            'style' => 'app_ajax_only_next', // pick one from: classic (default), digg, extended, punbb, or add your own!
            'auto_hide' => TRUE,
        ));

        $searchResult = $this->_oProduct->SearchResults($this->_aLang, $_GET['search_phrase'], false, $iLimit, $pagination->sql_offset);
        $vProductListing->oProducts = $searchResult->Value;
        $vProductListing->searchMessage = $searchResult->Message;
        $vProductListing->pagination = $pagination;
        $vProductListing->render(true);
    }

}
