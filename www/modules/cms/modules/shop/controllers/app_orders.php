<?php

defined('SYSPATH') OR die('No direct access allowed.');

class App_Orders_Controller extends App_Shop_Controller {

    private $_aCartContent = null;
    private $_oUser;
    private $_acl;

    public function __construct() {
        parent::__construct();
        $this->_oRebateCode = new Rebate_Code_Model();

//        if (!empty($_POST['recount']) && !empty($_SESSION['__cart'])) {
//            echo '<pre>'.print_r($_SESSION,true).'</pre>';
//            foreach ($_SESSION['__cart'] as $key => $Prod) {
//                $_SESSION['__cart'][$_POST['id_product']]['count'] = $_POST[$_POST['count']];
//            }
//            $_SESSION['__delivery_cost'] = $_POST['delivery_cost'];
//        }

        $lang = Kohana::config('locale.language');
        $this->lang = Kohana::config('locale.language');

        if (empty($_POST['delivery_cost'])) {
            unset($_SESSION['__delivery_cost']);
        }
//                        echo '<pre>';
//                        var_dump($_SESSION['__cart']);
//                        var_dump($_POST['count']);
//                        echo '</pre>';
//                        exit;
        if (!empty($_POST['recount']) && !empty($_SESSION['__cart'])) {

            rebate_codes::RebateCodePost(); // wyslanie kodu rabatowego            

            foreach ($_SESSION['__cart'] as $key => $Prod) {
                $_SESSION['__cart'][$key]['count'] = $_POST['count'][$key];
                $_SESSION['__cart'][$key]['rebate'] = rebate_codes::GetProductRebate($Prod['id_product']); // rabat dla danego produktu
            }
            // liczymy sumarycznie koszt produktów (mogly sie zmienić)
            $_SESSION['__cost_summary'] = $this->_oProduct->CountCartCost($_SESSION['__cart'])->Value;
            $_SESSION['__rebate_cost_summary'] = $this->_oProduct->CountCartRebate($_SESSION['__cart'])->Value;
            // sprawdzamy koszt przesylki dla produktów
            $oDeliveryPrice = $this->_oDeliveryType->GetDeliveryTypes2($this->_aLang, $_SESSION['__cost_summary'], $_POST['delivery_type_id'])->Value[0];

            $_SESSION['__delivery_cost'] = $oDeliveryPrice->delivery_price;
        }



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
//        $this->_oTemplate->header->abcSubcategories = $this->_oNews->GetNewsParentCategoriesForPage(1)->Value;
//        $this->_oTemplate->header->poradnik = $this->_oNews->GetNewsParentCategoriesForPage(2)->Value;
        $this->_oTemplate->header->productCategories = $this->_oProductCategory->GetMainCategories()->Value;
        //$this->_oTemplate->content->main_right = new View('app/sidebar');
        $this->_oTemplate->content->main_right = null;
        $this->_oTemplate->content->main_left->vSearch = null;
        /*   $this->_oTemplate->content->main_left->vMarki = new View('app/elements/lemarki');
          $this->_oTemplate->content->main_left->vMarki->oProducers = $this->_oProducer->FindAll(null, null, true)->Value;
          $this->_oTemplate->content->main_left->vProduct = new View('app/elements/leproduct');
          $this->_oTemplate->content->main_left->vProduct->oCatTree = $this->_oProductCategory->GetCategoriesTreeWithProducts($this->lang);
          $this->_oTemplate->content->main_left->vSocial = new View('app/elements/social');
          $this->_oTemplate->content->main_left->oNewsletter = new View('app/app_newsletters');
         */
        //   $this->_oTemplate->content->main_right->oNewestProducts = $this->_oProduct->GetNewestProducts()->Value;
        $this->_oTemplate->header->sLoggedAs = Customer_Model::GetLogedInfo();
//        $this->_oTemplate->footer->oPartnersGallery = $this->_oGallery->GetPartnersGallery();
        $this->_oTemplate->lang = $lang;
        $this->_oTemplate->header->lang = $lang;

        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;
        $this->_oTemplate->header->productsSummary = $this->_oProduct->CountCartCost($this->_aCartContent)->Value;
        $this->_oTemplate->header->howToOrderSubpages = $this->_oPage->GetPagesWithParent(3)->Value; //podstrony dla Jak zamówić
        $this->_oTemplate->header->oCatTree = $this->_oProductCategory->GetCategoriesTreeAppMenu();
        $productCategories2 = $this->_oProductCategory->GetMainCategories()->Value;
        $this->_oTemplate->footer->productCategories2 = $productCategories2;
        $iCategoriesCount = $productCategories2->count();
        $this->_oTemplate->footer->iCategoriesCount = $iCategoriesCount;

        $oNewestProducts = $this->_oProduct->GetNewestProducts()->Value;
        $this->_oTemplate->content->main_right->oNewestProducts = $oNewestProducts;
        $aProductsParameters2 = array();
        foreach ($oNewestProducts as $key) {
            $oParams = $this->_oProduct->GetProductParameters($key->id_product, array(3, 10, 12, 20, 21))->Value;
            foreach ($oParams as $par) {
                if (is_double($par->value)) {
                    $aProductsParameters2[$key->id_product][$par->parameter_id] = number_format($par->value, 1, ',', ' ');
                }
            }
        }
        $this->_oTemplate->content->vBreadcrumbs = null;
        $this->_oTemplate->content->main_right->aProductParameters = $aProductsParameters2;

//        $this->profiler = new Profiler_Core();
    }

    // zamowienie na jednym widoku (koszyk)
    public function order($iProductId = null) {

        if (!empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'zamowienie') === false) {
            $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        } else {
            if (empty($_SESSION['referer'])) {
                $_SESSION['referer'] = 'http://' . $_SERVER['HTTP_HOST'];
            }
        }

        if (empty($_POST) && (!empty($_SESSION['order']))) {
            $_POST = $_SESSION['order'];
            unset($_SESSION['order']);
        }

        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/order');
        $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails = new View('app/order/order_step_1_products_details');
        $this->_oTemplate->content->main_content->vContent->vOrderCustomerDetails = new View('app/order/order_step_2_customer_details');
        $this->_oTemplate->content->main_content->vContent->vOrderOrderDetails = new View('app/order/order_step_3_order_details');
        // zlozenie zamowienia
        if (!empty($_POST['confirm_order'])) {
            foreach ($_SESSION['__cart'] as $key => $Prod) {
                $_SESSION['__cart'][$key]['count'] = $_POST['count'][$key];
            }

//            if (!empty($_POST['customer_email'])) {
//                $a = $this->_oCustomer->FindCustomer(array('customer_email' => $_POST['customer_email']))->Value;
//                $a = $a[0]->id_customer;
//            }
            $result = $this->_oOrder->ValidateOrder($_POST);




            //$this->_oOrder->AddStepOneToSession($_POST);
            //$this->_oOrder->AddStepTwoToSession($_POST);
            if ($result->Type == ErrorReporting::SUCCESS) {
                // przepisujemy całego posta do sesji
                unset($_POST['confirm_order']);
                $_SESSION['order'] = $_POST;

                // przekieorwanie na ekran podsumowania
                $_POST = $_SESSION['order'];
                //checkbox - załóż konto
                if (!empty($_POST['customer_register_inorder']) && $_POST['customer_register_inorder'] == 1) {
                    $oValid = $this->_oCustomer->ValidateInsertCustomer($_POST);

                    $b = $this->_oCustomer->FindCustomer(array('customer_email' => $_POST['customer_email']))->Value;

                    if (!empty($b) && $b->count() == 0) {
                        if ($oValid->Value === true) {
                            //zwraca id klienta
                            $oInsert = $this->_oCustomer->InsertCustomerFromOrder($_POST)->Value;
                        }
                    }
                }

                if (!empty($_POST['customer_accept3']) && $_POST['customer_accept3'] == 'confirmed') {
                    $this->_oNewsletter->SetSubscribe($_POST['customer_email'], Kohana::config('locale.language'));
                }


                if (!empty($oInsert) && $oInsert != 0) {
                    $_POST['customer_id'] = $oInsert;
                }
                $result = $this->_oOrder->InsertNew($_POST);
                //var_dump($result);
//                if (!empty($_POST['customer_email']) && $_POST['customer_email'] != '') {
//
//                    //   $this->_oNewsletter->SetSubscribe($_POST['customer_email'], Kohana::config('locale.language'));
//                }
                if ($result->Type == ErrorReporting::SUCCESS) {
                    $_SESSION['msg'] = $result->__toString();
                    $id = $result->Value->insert_id();
                    $confirm_string = $_SESSION['confirm_string'];
                    unset($_SESSION['confirm_string']);
                    url::redirect(Kohana::lang('links.lang') . 'zamowienie/podsumowanie?id=' . $id . '&confirm_string=' . $confirm_string);
                } else {
                    $this->_oTemplate->content->main_content->msg = $result->__toString();
                    kohana::log('error', $result->__toString());
                }
            } elseif ($result->Type == ErrorReporting::ERROR) {
                kohana::log('error', $result->__toString());
                $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails->msg = $result->__toString();
            }
        }
      //  $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
     //   $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('app.your_shopping_cart');

        // szczegoly klienta
//        var_dump(Customer_Model::IsLogin()->Value);
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content->vContent->vOrderCustomerDetails->oCustomerDetails = $this->_oCustomer->FindCustomer(array('id_customer' => $_SESSION['_customer']['customer_id']))->Value[0];
        }

        //dodawanie do koszyka
        $this->_aCartContent = $this->_oProduct->AddToBasket($this->_aCartContent, $_POST, $iProductId)->Value;
        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg');
        }


        $_SESSION['__cart'] = $this->_aCartContent;
        $this->_aCartContent = $this->_oProduct->GetDetailsForProductsFromCart($this->_aCartContent, $this->_aLang)->Value;
        // liczymy sumarycznie koszt produktów
        $sum = $this->_oProduct->CountCartCost($this->_aCartContent)->Value;
        $_SESSION['__cost_summary'] = $sum;
        $_SESSION['__rebate_cost_summary'] = $this->_oProduct->CountCartRebate($_SESSION['__cart'])->Value;
        $this->_oTemplate->content->main_content->vContent->aCartContent = $this->_aCartContent;
        $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails->oDeliveryOptions = $this->_oDeliveryType->GetDeliveryTypes2($this->_aLang, $sum)->Value;
        $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails->oPaymentOptions = $this->_oPaymentType->GetPaymentTypes($this->_aLang)->Value;
        $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails->oCartContent = $this->_aCartContent;
        $this->_oTemplate->content->main_content->vContent->oCartContent = $this->_aCartContent;
        $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails->aProductAttr = $this->_oAttribute->GetAttributesAsArray()->Value;
        $this->_oTemplate->body_id = ' id="' . $this->lang . '"';
        $this->_oTemplate->body_class = ' class="cart ' . Kohana::lang('links.lang_short') . '"';
        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;

//        if(!empty($_SESSION['_customer']['customer_rebate']) && $_SESSION['_customer']['customer_rebate'] != 0):
//                    $totaltmp = $sum * ($_SESSION['_customer']['customer_rebate'] / 100);
//                    $sum = $sum - $totaltmp;
//                endif;                
        $this->_oTemplate->header->productsSummary = $sum;
        $this->_oTemplate->content->main_content->vContent->vOrderProductsDetails->fTotalPrice = $sum;
        $this->_oTemplate->title = Kohana::config('app.application_title');
        $this->_oTemplate->render(true);
    }

    public function orderConfirm() {
        $this->_oTemplate->content->main_content = new View('app/orderSummary');
        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->msg = $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }



        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/order/confirmation');

      //  $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
      //  $this->_oTemplate->content->vBreadcrumbs->sHere = 'Podsumowanie zamówienia';


        if (!empty($_POST['confirm_order']) && !empty($_SESSION['order'])) {
            $_POST = $_SESSION['order'];
            //checkbox - załóż konto
            if (!empty($_POST['customer_register_inorder']) && $_POST['customer_register_inorder'] == 1) {
                $oValid = $this->_oCustomer->ValidateInsertCustomer($_POST);

                $b = $this->_oCustomer->FindCustomer(array('customer_email' => $_POST['customer_email']))->Value;

                if (!empty($b) && $b->count() == 0) {
                    if ($oValid->Value === true) {
                        //zwraca id klienta
                        $oInsert = $this->_oCustomer->InsertCustomerFromOrder($_POST)->Value;
                    }
                }
            }

            if (!empty($_POST['customer_accept3']) && $_POST['customer_accept3'] == 'confirmed') {
                $this->_oNewsletter->SetSubscribe($_POST['customer_email'], Kohana::config('locale.language'));
            }


            if (!empty($oInsert) && $oInsert != 0) {
                $_POST['customer_id'] = $oInsert;
            }
            $result = $this->_oOrder->InsertNew($_POST);
            var_dump($result);
//                if (!empty($_POST['customer_email']) && $_POST['customer_email'] != '') {
//
//                    //   $this->_oNewsletter->SetSubscribe($_POST['customer_email'], Kohana::config('locale.language'));
//                }
            if ($result->Type == ErrorReporting::SUCCESS) {
                $_SESSION['msg'] = $result->__toString();
                $id = $result->Value->insert_id();
                $confirm_string = $_SESSION['confirm_string'];
                unset($_SESSION['confirm_string']);
                url::redirect(Kohana::lang('links.lang') . 'zamowienie/podsumowanie?id=' . $id . '&confirm_string=' . $confirm_string);
            } else {
                $this->_oTemplate->content->main_content->msg = $result->__toString();
            }
        } else {
            $_POST = $_SESSION['order'];
        }


        // szczegoly klienta
//        var_dump(Customer_Model::IsLogin()->Value);
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content->vContent->oCustomerDetails = $this->_oCustomer->FindCustomer(array('id_customer' => $_SESSION['_customer']['customer_id']))->Value[0];
        }

        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->msg = $this->_oSession->get_once('msg');
        }


        $_SESSION['__cart'] = $this->_aCartContent;
        $this->_aCartContent = $this->_oProduct->GetDetailsForProductsFromCart($this->_aCartContent, $this->_aLang)->Value;
//        echo '<pre>';
//        var_dump($this->_aCartContent);
//        echo '</pre>';4
        // liczymy sumarycznie koszt produktów
        $sum = $this->_oProduct->CountCartCost($this->_aCartContent)->Value;
        $_SESSION['__cost_summary'] = $sum;
        $_SESSION['__rebate_cost_summary'] = $this->_oProduct->CountCartRebate($_SESSION['__cart'])->Value;
        $this->_oTemplate->content->main_content->vContent->aCartContent = $this->_aCartContent;
        $this->_oTemplate->content->main_content->vContent->oDeliveryOptions = $this->_oDeliveryType->GetDeliveryTypes2($this->_aLang, $sum)->Value;
        $this->_oTemplate->content->main_content->vContent->oPaymentOptions = $this->_oPaymentType->GetPaymentTypes($this->_aLang)->Value;
        $this->_oTemplate->content->main_content->vContent->oCartContent = $this->_aCartContent;
        $this->_oTemplate->content->main_content->vContent->aProductAttr = $this->_oAttribute->GetAttributesAsArray()->Value;

        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;


        $this->_oTemplate->content->main_content->vContent->fTotalPrice = $sum;
        $this->_oTemplate->title = Kohana::config('app.application_title');
        $this->_oTemplate->render(true);
    }

    public function orderSummary() {
        unset($_SESSION['__cart']);
        unset($_SESSION['__delivery_type']);
        unset($_SESSION['__payment_type']);
        unset($_SESSION['__rebate']);
        unset($_SESSION['__rebate_cost_summary']);
        $this->_oTemplate->content->main_content = new View('app/orderSummary');
        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->msg = $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }
        $this->_oTemplate->body_class = ' class="order_step4 ' . Kohana::lang('links.lang_short') . '"';
        $oOrder = $this->_oOrder->FindOrder(array('id_order' => $_GET['id']))->Value[0];
        $this->_oTemplate->content->main_content->oOrder = $oOrder;
        $this->_oTemplate->content->main_content->vOrderDetails = new View('app/elements/order_summary_details');
        $this->_oTemplate->content->main_content->vOrderDetails->oOrder = $oOrder;
        $this->_oTemplate->content->main_content->vOrderDetails->oOrderProducts = $this->_oOrder->GetOrderProducts2($_GET['id'])->Value;
//		$iToken = shop::genToken();
        $this->_oOrder->UpdateP24SessionId($_GET['id'], $_GET['confirm_string']);
//        $przelewy24 = new Przelewy24_Model($_GET['id']);
//        $this->_oTemplate->content->main_content->form = $przelewy24->GetForm();
//		$this->_oTemplate->content->main_content->vContent->iToken = $iToken;
        $sUrl = Kohana::config('config.http_host') . Kohana::config('config.site_domain') . 'zamowienie/podsumowanie?id=' . $_GET['id'] . '&confirm_string=' . $_GET['confirm_string'];
        // czy na pewno w tym momencie czyścić session?
//        echo Kohana::debug($oOrder);
        if (!empty($oOrder->payment_type_method) && $oOrder->payment_type_method == 'dotpay') {
            $DotPay = new Dotpay_Model();
            $this->_oTemplate->content->main_content->form = $DotPay->GetForm($oOrder->id_payment_type, $oOrder->id_order, $oOrder->confirm_string, $oOrder->order_cost, $oOrder->currency);
        } else if (!empty($oOrder->payment_type_info)) {
            $this->_oTemplate->content->main_content->vOrderDetails->sPaymentInfo = $oOrder->payment_type_info;
        }


        $this->_oTemplate->title = Kohana::config('app.application_title');
        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;
        $this->_oTemplate->header->productsSummary = $this->_oProduct->CountCartCost($this->_aCartContent)->Value;
        $this->_oTemplate->render(true);
    }

    public function afterPayOK() {
        $details = explode('|', $_POST['p24_session_id']);
        $przelewy24 = new Przelewy24_Model($details[0]);
        $result = $przelewy24->GetBySessionIdAndOrderId($_POST['p24_session_id'], $details[0]);
        $transactionError = '';
        if ($result->count()) {
            $verifyResult = $przelewy24->VerifyPayment(Przelewy24_Model::P24_ID_SPRZEDAWCY, (string) $result[0]->session_id, $_POST['p24_order_id'], $result[0]->order_cost);
            Kohana::log('error', '<pre>' . print_r($verifyResult, true) . '</pre>');
            $this->_oOrder->UpdateP24OrderID((string) $result[0]->session_id, $_POST['p24_order_id']);
            if ($verifyResult[0] == "TRUE") {
                $this->_oOrder->UpdateP24Status($details[0], 'TRUE');
                $this->_oOrder->ChangeStatus(2, $details[0]); // zmieniamy status na zapłacono i wysyłamy maila do klienta
            } else {
                $this->_oOrder->UpdateP24Status($details[0], $verifyResult[1] . ' - ' . $verifyResult[2]);
            }
            $transactionError = $przelewy24->GetPaymentErrorDescription($verifyResult);
            $customerDetails = $this->_oOrder->GetCustomerDetailsByOrderId($details[0]);
//            $email = new View('emails/template');
//            $email->content = new View('emails/payment_confirm');
//            $email->content->content = $transactionError;
//            
//            layer::SendMessage('Komunikat dotyczący transakcji.', $email->render(), $customerDetails[0]->customer_email);
        }
        $er = new ErrorReporting(ErrorReporting::SUCCESS, false, $transactionError);
        $this->_oSession->set('msg', $er->__toString());
        unset($_SESSION['__cart']);
        unset($_SESSION['__delivery_type']);
        unset($_SESSION['__payment_type']);
        url::redirect('/');
    }

    public function afterPayERR() {
        $details = explode('|', $_POST['p24_session_id']);
        $przelewy24 = new Przelewy24_Model($details[0]);
        $result = $przelewy24->GetBySessionIdAndOrderId($_POST['p24_session_id'], $details[0]);
        $transactionError = '';
        if ($result->count()) {
            $verifyResult = $przelewy24->VerifyPayment(Przelewy24_Model::P24_ID_SPRZEDAWCY, (string) $result[0]->session_id, $_POST['p24_order_id'], $result[0]->order_cost);
            Kohana::log('error', '<pre>' . print_r($verifyResult, true) . '</pre>');
            $this->_oOrder->UpdateP24OrderID((string) $result[0]->session_id, $_POST['p24_order_id']);
            if ($verifyResult[0] == "TRUE") {
                $this->_oOrder->UpdateP24Status($details[0], 'TRUE');
            } else {
                $this->_oOrder->UpdateP24Status($details[0], $verifyResult[1] . ' - ' . $verifyResult[2]);
            }
            $transactionError = $przelewy24->GetPaymentErrorDescription($verifyResult);
            $customerDetails = $this->_oOrder->GetCustomerDetailsByOrderId($details[0]);
//            $email = new View('emails/template');
//            $email->content = new View('emails/payment_confirm');
//            $email->content->content = $transactionError;
//            layer::SendMessage('Komunikat dotyczący transakcji.', $email->render(), $customerDetails[0]->customer_email);
            //layer::SendMessage('Komunikat dotyczący transakcji.', $transactionError, array($customerDetails[0]->customer_email));
        }
        $er = new ErrorReporting(ErrorReporting::ERROR, false, $transactionError);
        $this->_oSession->set('msg', $er->__toString());
        unset($_SESSION['__cart']);
        unset($_SESSION['__delivery_type']);
        unset($_SESSION['__payment_type']);
        url::redirect('/');
    }

    // zamowienie/koszyk/[ID]
    public function order_step_one($iProductId = null) {
        if (!empty($_SERVER['HTTP_REFERER'])/* && strpos('zamowienie/koszyk', $_SERVER['HTTP_REFERER'])!== false */) {
            $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        } else {
            if (empty($_SESSION['referer'])) {
                $_SESSION['referer'] = 'http://' . $_SERVER['HTTP_HOST'];
            }
        }
        $this->_oTemplate->content->main_left->vMenu = null;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/order_step_one');
     //   $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
     //   $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('app.your_shopping_cart');

        // do kroku drugiego
        if (!empty($_POST['to_step_two'])) {
            $oValid = $this->_oOrder->ValidateOrderStepOne($_POST);
            if ($oValid->Value == true) {
                $this->_oOrder->AddStepOneToSession($_POST)->Value;
                url::redirect('zamowienie/adres_dostawy');
            } else {
                $this->_oTemplate->content->main_content->vContent->msg = $oValid->__toString();
            }
        }
        //dodawanie do koszyka
        if ((!empty($_POST['add_to_basket']) && !empty($_POST['id_product'])) || !empty($iProductId)) {
            $productId = !empty($_POST['id_product']) ? $_POST['id_product'] + 0 : $iProductId;
            $productPrice = $this->_oProduct->GetProductPrice($productId)->Value;
            $productCounts = !empty($_POST['id_product']) ? !empty($_POST['count']) ? $_POST['count'] + 0 : 1 : 1;
            unset($_POST['id_product'], $_POST['add_to_basket']);
            // AMPlant nie wymaga parametrów ani atrybutów
            $attributes = array();
//            if(!empty($_POST['attribute'])) {
//                foreach($_POST['attribute'] as $reqKey => $reqValue) {
//                    $attributes[$reqKey] = str_replace(' ', '@', $reqValue);
//                }
//            }
            if (!empty($this->_aCartContent) && $this->_productInCart($this->_aCartContent, $productId/* , $attributes */) == true) {
                $iProductsCount = count($this->_aCartContent);
                for ($i = 0; $i < $iProductsCount; $i++) {
                    if ($this->_aCartContent[$i]['id_product'] == $productId /* && $this->_arraysEquals($this->_aCartContent[$i]['attributes'], $attributes) */) {
                        $productCount = $this->_aCartContent[$i]['count'] + $productCounts;
                        $this->_aCartContent[$i]['count'] = (($productCount > 99) ? 99 : (($productCount < 0) ? 0 : $productCount));
                    }
                }
            } else {
                $this->_aCartContent[] = array(
                    'id_product' => $productId,
                    'price' => $productPrice,
                    'count' => $productCounts,
                    'attributes' => $attributes,
                );
            }
        }

        $_SESSION['__cart'] = $this->_aCartContent;
        $iItemsCount = count($this->_aCartContent);
        $oProduct = new Product_Model();
        $aTmp = $this->_aCartContent;
        foreach ($aTmp as $iKey => $aValue) {
            $oProductDetails = $oProduct->GetProductDetails($aValue['id_product'], $this->_aLang)->Value[0];
            $oProductImages = $oProduct->GetProductImages($aValue['id_product'])->Value[0];
            $this->_aCartContent[$iKey]['product_name'] = $oProductDetails->product_name;
            $this->_aCartContent[$iKey]['product_short_description'] = $oProductDetails->product_short_description;
            $this->_aCartContent[$iKey]['filename'] = !empty($oProductImages->filename) ? $oProductImages->filename : '';
        }
        $oDeliveryType = new Delivery_Type_Model();
        $oPaymentType = new Payment_Type_Model();
        $this->_oTemplate->content->main_content->vContent->oDeliveryOptions = $oDeliveryType->GetDeliveryTypes($this->_aLang)->Value;
        $this->_oTemplate->content->main_content->vContent->oPaymentOptions = $oPaymentType->GetPaymentTypes($this->_aLang)->Value;
        $this->_oTemplate->content->main_content->vContent->oCartContent = $this->_aCartContent;
        $iItemsCount = count($this->_aCartContent);
        $allProducts = 0;
        foreach ($this->_aCartContent as $allProd) {
            $allProducts += $allProd['count'];
        }
        $this->_oTemplate->header->productsCount = $allProducts;
        $sum = 0.0;
        if (count($this->_aCartContent)) {
            foreach ($this->_aCartContent as $product) {
                $sum += ( $product['price'] * $product['count']);
            }
        }
        $this->_oTemplate->header->productsSummary = $sum;
        $this->_oTemplate->content->main_content->vContent->fTotalPrice = $sum;
        $this->_oTemplate->title = Kohana::config('app.application_title');
        $this->_oTemplate->render(true);
    }

    // płatności i wysyłka
    public function order_step_two() {
//        echo '<pre>';
//        var_dump($_SESSION);
//        echo '</pre>';
        $this->_oTemplate->content->main_left->vMenu = null;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/order_step_two');
       // $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
       // $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('app.delivery_address');
        if (!empty($_POST['customer_details'])) {
            $oValid = $this->_oOrder->ValidateOrderStepTwo($_POST);
            if ($oValid->Value == true) {
                $this->_oOrder->AddStepTwoToSession($_POST);
                url::redirect('zamowienie/podsumowanie');
            } else {
                $this->_oTemplate->content->main_content->vContent->msg = $oValid->__toString();
            }
        }

        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content->vContent->oCustomerDetails = $this->_oCustomer->FindCustomer(array('id_customer' => $_SESSION['_customer']['customer_id']))->Value[0];
        }
        $this->_oTemplate->title = Kohana::config('app.application_title');
        $this->_oTemplate->render(true);
    }

    public function order_step_three() {
//        echo '<pre>';
//        var_dump($_SESSION);
//        echo '</pre>';
        $this->_oTemplate->content->main_left->vMenu = null;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/order_step_three');
      //  $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
       // $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('app.summary');
        $this->_oTemplate->content->main_content->vContent->productsSummary = $this->_oTemplate->header->productsSummary;
        $this->_oTemplate->content->main_content->vContent->orderSummaryCart = $_SESSION['__cart'];
        $this->_oTemplate->content->main_content->vContent->orderSummaryCustomer = $_SESSION['__customer'];
        $oDeliveryType = new Delivery_Type_Model();
        $oPaymentType = new Payment_Type_Model();
        $oProduct = new Product_Model();
        $this->_oTemplate->content->main_content->vContent->orderSummaryDeliveryType = $oDeliveryType->GetDeliveryType($_SESSION['__delivery_type'], $this->_aLang)->Value[0];
        $this->_oTemplate->content->main_content->vContent->orderSummaryPaymentType = $oPaymentType->GetPaymentType($_SESSION['__payment_type'], $this->_aLang)->Value[0];
        $aTmp = $this->_aCartContent;
        foreach ($aTmp as $iKey => $aValue) {
            $oProductDetails = $oProduct->GetProductDetails($aValue['id_product'], $this->_aLang)->Value[0];
            $oProductImages = $oProduct->GetProductImages($aValue['id_product'])->Value[0];
            $this->_oTemplate->content->main_content->vContent->orderSummaryCart[$iKey]['product_name'] = $oProductDetails->product_name;
            $this->_oTemplate->content->main_content->vContent->orderSummaryCart[$iKey]['product_short_description'] = $oProductDetails->product_short_description;
            $this->_oTemplate->content->main_content->vContent->orderSummaryCart[$iKey]['filename'] = $oProductImages->filename;
        }
        //$this->_oTemplate->content->main_content->orderSummaryCustomer
        $this->_oTemplate->title = Kohana::config('app.application_title');
        $this->_oTemplate->render(true);
    }

    /**
     * 
     */
    public function order_step_four($message = null) {
        $oOrder = new Order_Model();
        if (!empty($_SESSION['__cart'])) {
            $totalCost = 0.0;
            if (count($_SESSION['__cart'])) {
                foreach ($_SESSION['__cart'] as $productKey => $productValue) {
                    $totalCost += ( $productValue['price'] /** $productValue['count'] */); // ponieważ przesyłana jest już przeliczona kwota
                }
            }
            $oDeliveryType = new Delivery_Type_Model($_SESSION['__delivery_type']);
            //$oPaymentType=new Payment_Type_Model($_SESSION['__payment_type']);
            $totalCost += ( $oDeliveryType->DeliveryCost /* + $oPaymentType->PaymentCost */);
            if (!empty($_SESSION)) {
                $oShopOrderResult = $oOrder->Insert($_SESSION);
            }
            $_SESSION['__total_cost'] = $totalCost;
        }
        //$this->_oTemplate->content->main_left->vMenu = null;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/order_step_four');
     //   $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
     //   $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('app.finish_order');
        $msg = null;
        if (!empty($message)) {
            if ($message == 'success') {
                $er = new ErrorReporting(ErrorReporting::SUCCESS, true, Kohana::lang('order.transaction_success'));
                $msg = $er->__toString();
            } else {
                if (!empty($_GET['error']) && $_GET['error'] + 0 > 0) {
                    $transactionError = $oOrder->GetTransactionError($_GET['error']);
                } else {
                    $transactionError = Kohana::lang('order.transaction_error');
                }
                $er = new ErrorReporting(ErrorReporting::ERROR, false, $transactionError);
                $msg = $er->__toString();
            }
        }
        $this->_oTemplate->content->main_content->message = $msg;
        $this->_oTemplate->title = Kohana::config('app.application_title');
        if (empty($msg)) {

            $this->_oTemplate->content->main_content->vContent->customerFirstName = $_SESSION['__customer']['customer']['first_name'] . ' ' . $_SESSION['__customer']['customer']['last_name'];
            $this->_oTemplate->content->main_content->vContent->customerEmail = $_SESSION['__customer']['customer']['customer_email'];
            $this->_oTemplate->content->main_content->vContent->customerCity = $_SESSION['__customer']['customer']['customer_city'];
            $this->_oTemplate->content->main_content->vContent->customerAddress = $_SESSION['__customer']['customer']['customer_address'];
            $this->_oTemplate->content->main_content->vContent->customerZip = $_SESSION['__customer']['customer']['customer_zip'];
            $this->_oTemplate->content->main_content->vContent->orderAmount = number_format((!empty($_SESSION['__total_cost']) ? $_SESSION['__total_cost'] : $totalCost), 2, '.', '');
            $this->_oTemplate->content->main_content->vContent->customerIP = $_SERVER['REMOTE_ADDR'];
            $this->_oTemplate->content->main_content->vContent->sessId = substr(md5(TIME), 16); //$this->_oSession->id();
            $this->_oTemplate->content->main_content->vContent->orderDesc = Kohana::lang('order.payment_order_title') . ' ';    // . $oOrder->GetOrderNumber()
        }
        unset($_SESSION['__cart']);
        if (empty($message)) { // czyścimy dane klienta jesli wszystko poszlo ok
            unset($_SESSION['__customer']);
            unset($_SESSION['__delivery']);
            unset($_SESSION['__invoice']);
        }
        unset($_SESSION['__delivery_type']);
        unset($_SESSION['__payment_type']);
        $this->_oTemplate->render(true);
    }

    /**
     *
     * @param array $arr1
     * @param array $arr2
     * @return bool
     */
    private function _arraysEquals($arr1, $arr2) {
        if (!empty($arr1) && !empty($arr2)) {
            if (count($arr1) == count($arr2)) {
                $result = array_intersect($arr1, $arr2);
                if (count($arr1) == count($result)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

    /**
     * FIX: TEGO CHYBA TU NIE POWINNO BYC!!! PO CO TO W KONTROLERZE?
     * @param array $sess
     * @param integer $id
     * @param array $attributes
     * @return boolean
     */
    private function _productInCart($sess, $id, $attributes = array()) {
        $returnvalue = false;
        if (!empty($sess)) {
            foreach ($sess as $ciKey => $ciValue) {
                if ($sess[$ciKey]['id_product'] == $id) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     *
     * @param integer $iProductId
     */
//    public function remove_product($iProductId) {
//        foreach ($_SESSION['__cart'] as $ciKey => $ciValue) {
//            if ($_SESSION['__cart'][$ciKey]['id_product'] == $iProductId) {
//                unset($_SESSION['__cart'][$ciKey]);
//            }
//        }
//        url::redirect('zamowienie/koszyk');
//    }

    public function remove_product($iKey) {
        $iKey+=0;
        unset($_SESSION['__cart'][$iKey]);
        if ($this->lang == 'en_US') {
            url::redirect('en/zamowienie/koszyk');
        } else {
            url::redirect('zamowienie/koszyk');
        }
    }

    /**
     * 
     */
    public function recount() {
        if (!empty($_POST)) {
            foreach ($_SESSION['__cart'] as $item) {
                $productId = !empty($_POST['id_product']) ? $_POST['id_product'] + 0 : $iProductId;
                $productPrice = $this->_oProduct->GetProductPrice($productId)->Value;
                $productCounts = !empty($_POST['id_product']) ? $_POST['count'] + 0 : 1;
                unset($_POST['id_product'], $_POST['add_to_basket']);
                $attributes = array();
                if (!empty($_POST['attribute'])) {
                    foreach ($_POST['attribute'] as $reqKey => $reqValue) {
                        $attributes[$reqKey] = str_replace(' ', '@', $reqValue);
                    }
                }
                if (!empty($_SESSION['__cart']) && $this->_productInCart($_SESSION['__cart'], $productId, $attributes) === true) {
                    $iProductsCount = count($_SESSION['__cart']);
                    for ($i = 0; $i < $iProductsCount; $i++) {
                        if ($_SESSION['__cart'][$i]['id_product'] == $productId && $this->_arraysEquals($_SESSION['__cart'][$i]['attributes'], $attributes)) {

                            $_SESSION['__cart'][$i]['count'] ++;
                        }
                    }
                } else {
                    $_SESSION['__cart'][] = array(
                        'id_product' => $productId,
                        'price' => $productPrice,
                        'count' => $productCounts,
                        'attributes' => $attributes,
                    );
                }
            }
        }
        url::redirect('koszyk/zawartosc');
    }

    /**
     *
     * @param double $fPrice
     */
    private function _PriceToInt($fPrice) {
        
    }

    /**
     * 
     */
    public function confirm_order() {
        $sEmail = !empty($_GET['email']) ? $_GET['email'] : '';
        $sConfirmationString = !empty($_GET['confirm']) ? $_GET['confirm'] : '';
        $iOrderId = !empty($_GET['id']) ? $_GET['id'] + 0 : 0;
        if (!empty($sEmail) && !empty($sConfirmationString) && $iOrderId > 0) {
            $oOrder = new Order_Model($iOrderId);
            $returnValue = $oOrder->ConfirmOrder($sEmail, $sConfirmationString, $iOrderId);
        }
        $this->_oTemplate->content->main_left->vMenu = null;
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vContent = new View('app/elements/order_confirm');

        //$this->_oTemplate->content->main_content->message = $returnValue->__toString();
      //  $this->_oTemplate->content->main_content->vBreadcrumbs = new View('app/elements/breadcrumbs');
      //  $this->_oTemplate->content->main_content->vBreadcrumbs->sHere = Kohana::lang('app.order_confirmation');
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content->vContent->oCustomerDetails = $this->_oCustomer->FindCustomer(array('id_customer' => $_SESSION['_customer']['customer_id']))->Value[0];
        }
        $this->_oTemplate->title = Kohana::config('app.confirmation_order');
        $this->_oTemplate->render(true);
    }

}
