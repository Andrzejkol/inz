<?php

defined('SYSPATH') OR die('No direct access allowed.');

class App_Customers_Controller extends App_Shop_Controller {

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
        //$this->_oTemplate->footer->oNewsletter = new View('app/app_newsletters');
        $this->_oTemplate->header->productsCount = $this->_oProduct->CountProductsInCart($this->_aCartContent)->Value;
        $this->_oTemplate->header->productsSummary = $this->_oProduct->CountCartCost($this->_aCartContent)->Value;
        $this->_oTemplate->content->main_left = null;
        $this->_oTemplate->body_class = ' class="customer-views"';
        $this->_oTemplate->header->oCatTree = $this->_oProductCategory->GetCategoriesTreeAppMenu();
//        $this->_oTemplate->footer->oPartnersGallery = $this->_oGallery->GetPartnersGallery();
        //   $this->_oTemplate->content->main_left->vMarki = new View('app/elements/lemarki');
        //    $this->_oTemplate->content->main_left->vMarki->oProducers = $this->_oProducer->FindAll(null, null, true)->Value;
        //    $this->_oTemplate->content->main_left->vProduct = new View('app/elements/leproduct');
        //  $this->_oTemplate->content->main_left->vSocial = new View('app/elements/social');
        //  $this->_oTemplate->content->main_left->oNewsletter = new View('app/app_newsletters');
        //$this->_oTemplate->content->main_right = new View('app/sidebar');


        $iCategoriesCount = $this->_oProductCategory->GetMainCategories()->Value->count();
        if (!empty($_COOKIE['language'])) {
            $this->lang = $_COOKIE['language'];
            $language = explode('_', $this->lang);
            $lang = $language[0];
        } else {
            $this->lang = 'pl_PL';
            $lang = 'pl';
        }
        $this->_oTemplate->content->main_left->vProduct->oCatTree = $this->_oProductCategory->GetCategoriesTreeWithProducts($this->lang);
        $this->_oTemplate->lang = $lang;
        $this->_oTemplate->header->lang = $lang;
    }

    public function change_password() {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_change_password');
            $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
            $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
            $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> ' . '<span style="">' . Kohana::lang('customer.change_password_title') . '</span>';
            $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
            $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.change_password_title');
            if (!empty($_SESSION['msg'])) {
                $this->_oTemplate->content->main_content->vCustomer->msg = $_SESSION['msg'];
                $_SESSION['msg'] = '';
            }
            if (!empty($_POST)) {
                $oValid = $this->_oCustomer->ValidateChangePassword($_SESSION['_customer']['customer_id'], $_POST);
                if ($oValid->Value === true) {
                    $oChange = $this->_oCustomer->ChangePassword($_SESSION['_customer']['customer_id'], $_POST);
                    if ($oChange->Value === true) {
                        $this->_oSession->set('msg', $oChange->__toString());
                        url::redirect(Kohana::lang('links.lang') . 'twoje_konto');
                        $this->_oTemplate->content->main_content->vCustomer->msg = $oChange->__toString();
                    } else {
                        $this->_oTemplate->content->main_content->vCustomer->msg = $oChange->__toString();
                    }
                } else {
                    $this->_oTemplate->content->main_content->vCustomer->msg = $oValid->__toString();
                }
            }
            $this->_oTemplate->title = Kohana::lang('customer.title.change_password');
            $this->_oTemplate->description = Kohana::lang('customer.description.change_password') . ' - ' . Kohana::lang('meta.home_site_description');
            $this->_oTemplate->keywords = Kohana::lang('customer.keywords.change_password');
            $this->_oTemplate->render(true);
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function create_account() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_register');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('customer.registration');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.registration');
        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->vCustomer->msg = $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }
        if (!empty($_POST)) {
            $oValid = $this->_oCustomer->ValidateInsertCustomer($_POST);
            if ($oValid->Value === true) {
                $oInsert = $this->_oCustomer->InsertCustomer($_POST);
                if ($oInsert->Value === true) {
                    //$this->_oSession->set('msg', $oInsert->__toString());
                    $this->_oSession->set('msg', $oInsert->__toString());
                    url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
                } else {
                    $this->_oTemplate->content->main_content->vCustomer->msg = $oInsert->__toString();
                }
            } else {
                $this->_oTemplate->content->main_content->vCustomer->msg = $oValid->__toString();
            }
        }
        $this->_oTemplate->title = Kohana::lang('customer.title.create_account');
        $this->_oTemplate->description = Kohana::lang('customer.description.create_account') . ' - ' . Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('customer.keywords.create_account');
        $this->_oTemplate->render(true);
    }

    public function delete_account() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_delete_account');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> ' . html::anchor('usun_konto', '<strong>' . Kohana::lang('customer.delete_account_title') . '</strong>');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.delete_account_title');
        if (!empty($_POST)) {
            $oValid = $this->_oCustomer->ValidateDeleteCustomer($_POST, $_SESSION['_customer']['customer_id']);
            if ($oValid->Value === true) {
                $oDelete = $this->_oCustomer->DeleteAccount($_SESSION['_customer']['customer_id']);
                if ($oDelete->Value === true) {
                    $this->_oSession->set('msg', $oDelete->__toString());
                    url::redirect(Kohana::lang('links.lang') . 'wyloguj');
                } else {
                    $this->_oTemplate->content->main_content->vCustomer->msg = $oDelete->__toString();
                }
            } else {
                $this->_oTemplate->content->main_content->vCustomer->msg = $oValid->__toString();
            }
        }
        $this->_oTemplate->title = Kohana::lang('customer.title.delete_password');
        $this->_oTemplate->description = Kohana::lang('customer.description.delete_password') . ' - ' . Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('customer.keywords.delete_password');
        $this->_oTemplate->render(true);
    }

    public function delete_from_favourite($iProductId) {
        $this->_oSession->set('msg', $this->_oCustomer->DeleteFromFav($_SESSION['_customer']['customer_id'], $iProductId)->__toString());
        url::redirect('ulubione');
    }

    public function confirm_registration() {
        if (!empty($_GET['verify_string'])) {
            $oCustomer = $this->_oCustomer->FindCustomer(array('verify_string' => $_GET['verify_string'], 'verified' => 'N'))->Value;
            if (!empty($oCustomer) && $oCustomer->count() > 0) {
                $this->_oCustomer->UpdateCustomer($oCustomer[0]->id_customer, array('verified' => 'Y'));
                $_SESSION['msg'] = '<div class="success">' . Kohana::lang('customer.account_confirmed') . '</div>';
                url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
            } else {
                $_SESSION['msg'] = '<div class="error">' . Kohana::lang('customer.confirm_error') . '</div>';
                url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
            }
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function edit_account() {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_account_edit');
            if (!empty($_SESSION['msg'])) {
                $this->_oTemplate->content->main_content->vCustomer->msg = $_SESSION['msg'];
                $_SESSION['msg'] = '';
            }
            if (!empty($_POST)) {
                $oValid = $this->_oCustomer->ValidateUpdateCustomer($_SESSION['_customer']['customer_id'], $_POST);
                if ($oValid->Value === true) {
                    $oUpdate = $this->_oCustomer->UpdateCustomer($_SESSION['_customer']['customer_id'], $_POST);
                    if ($oUpdate->Value === true) {
                        $this->_oSession->set('msg', $oUpdate->__toString());
                        url::redirect(Kohana::lang('links.lang') . 'twoje_konto');
                    } else {
                        $this->_oTemplate->content->main_content->vCustomer->msg = $oUpdate->__toString();
                    }
                } else {
                    $this->_oTemplate->content->main_content->vCustomer->msg = $oValid->__toString();
                }
            }
            $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
            $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
            $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> <span style="">' . Kohana::lang('customer.your_data') . '</span>';
            $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
            $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.your_data');
            $this->_oTemplate->content->main_content->vCustomer->oCustomerDetails = $this->_oCustomer->FindCustomer(array('id_customer' => $_SESSION['_customer']['customer_id']))->Value[0];
            $this->_oTemplate->title = Kohana::lang('customer.title.edit_account');
            $this->_oTemplate->description = Kohana::lang('customer.description.edit_account') . ' - ' . Kohana::lang('meta.home_site_description');
            $this->_oTemplate->keywords = Kohana::lang('customer.keywords.edit_account');
            $this->_oTemplate->render(true);
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function favourite() {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vProductFavourite = new View('app/elements/customer_favourite');
            $this->_oTemplate->content->main_content->vProductFavourite->vProducts = $this->_oProduct->GetFavs($_SESSION['_customer']['customer_id'])->Value;
            $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
            $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
            $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> ' . Kohana::lang('customer.favourite');
            $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
            $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.favourite');
            $this->_oTemplate->title = Kohana::lang('customer.title.favourite');
            $this->_oTemplate->description = Kohana::lang('customer.description.favourite') . ' - ' . Kohana::lang('meta.home_site_description');
            $this->_oTemplate->keywords = Kohana::lang('customer.keywords.favourite');
            $this->_oTemplate->render(true);
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function login() {
        $this->_oTemplate->bodyclass = 'customers';
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_login');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('customer.login_title');
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.login_title');
        if (!empty($_SESSION['msg'])) {
            $this->_oTemplate->content->main_content->vCustomer->msg = $_SESSION['msg'];
            $_SESSION['msg'] = '';
        }
        if (!empty($_POST)) {
            $oLogin = $this->_oCustomer->AuthorizeCustomer($_POST);
            if ($oLogin->Value != false) {
                $_SESSION['_customer'] = $oLogin->Value;
                $this->_oSession->set('msg', $oLogin->__toString());
                if (!empty($_POST['fromorder']) && $_POST['fromorder'] == 'Y') {
                    url::redirect(Kohana::lang('links.lang') . 'zamowienie/koszyk');
                } else {
                    url::redirect(Kohana::lang('links.lang') . 'twoje_konto');
                }
            } else {
                $this->_oTemplate->content->main_content->vCustomer->msg = $oLogin->__toString();
            }
        }


        $this->_oTemplate->title = Kohana::lang('customer.title.customer_login');
        $this->_oTemplate->description = Kohana::lang('customer.description.customer_login') . ' - ' . Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('customer.keywords.customer_login');
        $this->_oTemplate->render(true);
    }

    public function logout() {
        if (Customer_Model::IsLogin()->Value === true) {
            $oLogout = $this->_oCustomer->Logout();
            $this->_oSession->set('msg', $oLogout->__toString());
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function delete_account_logout() {
        if (Customer_Model::IsLogin()->Value === true) {
            $oLogout = $this->_oCustomer->Logout();
            $this->_oSession->set('msg', $_SESSION['msg']);
            url::redirect(Kohana::lang('links.lang'));
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function order_details($iOrderId = null) {
        if (Customer_Model::IsLogin()->Value === true || !empty($_GET['confirm_string'])) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $oOrder = $this->_oOrders->FindOrder(array('id_order' => $iOrderId))->Value;
            // sprawdzamy czy to zamowienie tego uzytkownika
            if (!empty($oOrder) && (!empty($oOrder[0]->client_id) && !empty($_SESSION['_customer']) && $oOrder[0]->client_id == $_SESSION['_customer']['customer_id']) || (!empty($_GET['confirm_string']) && $oOrder[0]->confirm_string == $_GET['confirm_string'])) {
//                $this->_oTemplate->content->main_content->vContent = new View('app/elements/customer_order_details');
                $this->_oTemplate->content->main_content->vContent = new View('app/elements/order_summary_details');
                $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
                $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
                $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> ' . html::anchor('historia_transakcji', Kohana::lang('customer.orders_history')) . ' <span style="font-size:10px;">></span> ' . Kohana::lang('customer.order_details');
                $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
                $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.order_number') . $oOrder[0]->order_number . ' - ' . $oOrder[0]->order_status_name;
                $this->_oTemplate->content->main_content->vContent->oOrder = $oOrder[0];
                $this->_oTemplate->content->main_content->vContent->productsSummary = $this->_oTemplate->header->productsSummary;
                $this->_oTemplate->content->main_content->vContent->oOrderProducts = $this->_oOrders->GetOrderProducts(array('order_id' => $iOrderId, 'product_language' => $this->lang))->Value;
                $this->_oTemplate->content->main_content->vContent->oCustomerDetails = $oOrder[0];
                $this->_oTemplate->content->main_content->vContent->aStates = layer::GetStates()->Value;
                //var_dump($this->_oTemplate->content->main_content->vContent->oOrderProducts);
                //$this->_oTemplate->content->main_content->vContent->orderSummaryCustomer = $_SESSION['__customer'];
//                $oDeliveryType = new Delivery_Type_Model();
//                $oPaymentType = new Payment_Type_Model();
//                $oProduct = new Product_Model();
//                //$this->_oTemplate->content->main_content->vContent->orderSummaryDeliveryType = $oDeliveryType->GetDeliveryType($_SESSION['__delivery_type'], $this->_aLang)->Value[0];
//                //$this->_oTemplate->content->main_content->vContent->orderSummaryPaymentType = $oPaymentType->GetPaymentType($_SESSION['__payment_type'], $this->_aLang)->Value[0];
//                $aTmp = $this->_aCartContent;
//                foreach ($aTmp as $iKey => $aValue) {
//                    $oProductDetails = $oProduct->GetProductDetails($aValue['id_product'], $this->lang)->Value[0];
//                    $oProductImages = $oProduct->GetProductImages($aValue['id_product'])->Value[0];
//                    $this->_oTemplate->content->main_content->vContent->orderSummaryCart[$iKey]['product_name'] = $oProductDetails->product_name;
//                    $this->_oTemplate->content->main_content->vContent->orderSummaryCart[$iKey]['product_short_description'] = $oProductDetails->product_short_description;
//                    $this->_oTemplate->content->main_content->vContent->orderSummaryCart[$iKey]['filename'] = $oProductImages->filename;
//                }
                $this->_oTemplate->render(true);
            } else { // nie mozna ogladac nie swoich zamowien
                if (!empty($_GET['confirm_string'])) {
                    url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
                } else {
                    $this->_oSession->set('msg', '<div class="error">' . Kohana::lang('order.not_your_order') . '</div>');
                    url::redirect('historia_transakcji');
                }
            }
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function orders_history() {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vContent = new View('app/elements/customer_orders_history');
            if (!empty($_SESSION['msg'])) {
                $this->_oTemplate->content->main_content->vContent->msg = $_SESSION['msg'];
                $_SESSION['msg'] = '';
            }

            $this->_oTemplate->content->main_content->vContent->oOrders = $this->_oOrders->FindAllOrders(array('client_id' => $_SESSION['_customer']['customer_id'], 'language' => $this->lang))->Value;
            $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
            $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
            $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> ' . Kohana::lang('customer.orders_history');
            $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
            $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.orders_history');
            $this->_oTemplate->title = Kohana::lang('customer.title.orders_history');
            $this->_oTemplate->description = Kohana::lang('customer.description.orders_history') . ' - ' . Kohana::lang('meta.home_site_description');
            $this->_oTemplate->keywords = Kohana::lang('customer.keywords.orders_history');

            $this->_oTemplate->render(true);
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function recover_password() {
        $this->_oTemplate->content->main_content = new View('app/main_content');
        $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_recover_password');
        $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
        $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
        $this->_oTemplate->content->vBreadcrumbs->sHere = '<span>' . Kohana::lang('customer.password_recover_title') . '</span>';
        $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
        $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.password_recover_title');
        if (!empty($_POST)) {
            $oRecover = $this->_oCustomer->SendCustomerRecoveryPassword($_POST);
            $this->_oSession->set('msg', $oRecover->__toString());
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
        $this->_oTemplate->title = Kohana::lang('customer.title.recover_password');
        $this->_oTemplate->description = Kohana::lang('customer.description.recover_password') . ' - ' . Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('customer.keywords.recover_password');
        $this->_oTemplate->render(true);
    }

    public function your_account() {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vCustomer = new View('app/customer_account');
            if (!empty($_SESSION['msg'])) {
                $this->_oTemplate->content->main_content->vCustomer->msg = $_SESSION['msg'];
                $_SESSION['msg'] = '';
            }

            $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
            $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
            $this->_oTemplate->content->vBreadcrumbs->sHere = Kohana::lang('customer.account_title');
            $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
            $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.account_title');
            $this->_oTemplate->title = Kohana::lang('customer.title.your_account');
            $this->_oTemplate->description = Kohana::lang('customer.description.your_account') . ' - ' . Kohana::lang('meta.home_site_description');
            $this->_oTemplate->keywords = Kohana::lang('customer.keywords.your_account');
            $this->_oTemplate->render(true);
        } else {
            //url::redirect('logowanie');
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    public function your_subscriptions() {
        if (Customer_Model::IsLogin()->Value === true) {
            $this->_oTemplate->content->main_content = new View('app/main_content');
            $this->_oTemplate->content->main_content->vContent = new View('app/elements/customer_your_subscriptions');
            $this->_oTemplate->content->main_content->vContent->subscriptionTypes = $this->_oCustomer->GetSubscriptionsTypes()->Value;
            $iToken = shop::genToken();
            $this->_oTemplate->content->main_content->vContent->iToken = $iToken;
            $sUrl = Kohana::config('config.http_host') . Kohana::config('config.site_domain') . 'twoje_abonamenty';
            $this->_oTemplate->content->main_content->vContent->sUrl = $sUrl;
            $this->_oTemplate->content->main_content->vContent->sUrlc = Kohana::config('config.http_host') . Kohana::config('config.site_domain') . 'calcDotpay';
            $this->_oTemplate->content->main_content->vContent->iToken = $iToken;
            if (!empty($_SESSION['_customer']['customer_id'])) {
                $this->_oTemplate->content->main_content->vContent->oCustomer = $this->_oCustomer->FindCustomer(array('id_customer' => $_SESSION['_customer']['customer_id']))->Value[0];
            }
            if (!empty($_SESSION['msg'])) {
                $this->_oTemplate->content->main_content->vContent->msg = $_SESSION['msg'];
                $_SESSION['msg'] = '';
            }
            $oCustomersSubscriptions = $this->_oCustomer->GetAllSubscriptionsForCustomer($_SESSION['_customer']['customer_id']);
            if (!empty($oCustomersSubscriptions) && $oCustomersSubscriptions->Value->count() > 0) {
                $this->_oTemplate->content->main_content->vContent->oCustomersSubscriptions = $oCustomersSubscriptions->Value;
//				echo '<pre>';
//				var_dump($oCustomersSubscriptions->Value);
//				echo '</pre>';
//				exit;
            } else {
                $this->_oTemplate->content->main_content->vContent->emptySubs = $oCustomersSubscriptions->__toString();
            }
            if (!empty($_POST['status']) && $_POST['status'] == 'OK') {
                $this->_oTemplate->content->main_content->vContent->msg = '<div class="success">Operacja płatności została przeprowadzona prawidłowo.</div>';
            } elseif (!empty($_POST['status']) && $_POST['status'] == 'FAIL') {
                $this->_oTemplate->content->main_content->vContent->msg = '<div class="error">Wystąpił błąd podczas dokonywania płatności.</div>';
            }
            $this->_oTemplate->content->main_content->vSearch = new View('app/elements/search');
            $this->_oTemplate->content->vBreadcrumbs = new View('app/elements/breadcrumbs');
            $this->_oTemplate->content->vBreadcrumbs->sHere = html::anchor('twoje_konto', Kohana::lang('customer.account_title')) . ' <span style="font-size:10px;">></span> ' . Kohana::lang('customer.your_subscriptions');
            $this->_oTemplate->content->main_content->vPaginationTop = new View('app/elements/pagination_top');
            $this->_oTemplate->content->main_content->vPaginationTop->sTitle = Kohana::lang('customer.title.your_subscriptions');
            $this->_oTemplate->title = Kohana::lang('customer.title.your_subscriptions');
            $this->_oTemplate->description = Kohana::lang('customer.description.your_subscriptions') . ' - ' . Kohana::lang('meta.home_site_description');
            $this->_oTemplate->keywords = Kohana::lang('customer.keywords.your_subscriptions');

            $this->_oTemplate->render(true);
        } else {
            url::redirect(Kohana::lang('links.lang') . Kohana::lang('links.login'));
        }
    }

    //TODO: te nie sa poki co potrzebne
    public function confirm_create() {
        $this->_oTemplate->content->main_content = new View('app/customer_register_confirm');
        //$this->_oTemplate->content->main_content->oCustomerDetails = $this->_oProduct->GetCustomer_Details()->Value;
        $this->_oTemplate->title = Kohana::lang('customer.confirm_create');
        $this->_oTemplate->description = Kohana::lang('customer.confirm_create') . ' - ' . Kohana::lang('meta.home_site_description');
        $this->_oTemplate->keywords = Kohana::lang('customer.confirm_create');
        $this->_oTemplate->render(true);
    }

    public function confirm_delete() {
        $sEmail = !empty($_GET['email']) ? $_GET['email'] : '';
        $sConfirmationString = !empty($_GET['confirm']) ? $_GET['confirm'] : '';
        $iCustomerId = !empty($_GET['id']) ? $_GET['id'] + 0 : 0;
        if (!empty($sEmail) && !empty($sConfirmationString) && $iCustomerId > 0) {
            $oCustomer = new Customer_Model($iOrderId);
            $returnValue = $oCustomer->ConfirmDelete($sEmail, $sConfirmationString, $iCustomerId);
        }
    }

    /**
     *
     * @param int $iProductId
     */
    public function add_to_clipboard($iProductId) {
        $model = new Customer_Model();
        $iCustomerId = !empty($_SESSION['_customer']['customer_id']) ? $_SESSION['_customer']['customer_id'] : 0;
        $result = $model->AddToClipboard($iProductId, $iCustomerId);
//		$this->_oSession->set('msg',$result->__toString());
        if (!request::is_ajax()) {
            url::redirect('schowek');
        } else {
            if ($result->Type == 4) {
                echo 'success';
            } else if ($result->Type == 0) {
                echo 'info';
            }
        }
    }

    /**
     *
     * @param int $iProductId
     */
    public function remove_from_clipboard($iProductId) {
        $iCustomerId = !empty($_SESSION['_customer']['customer_id']) ? $_SESSION['_customer']['customer_id'] : 0;
        $model = new Customer_Model();
        $result = $model->RemoveFromClipboard2($iProductId, $iCustomerId);
//        $this->_oSession->set('msg',$result->__toString());
        if ($result->Value == true) {
            if (!request::is_ajax()) {
                url::redirect('schowek');
            } else {
                echo 'success';
            }
        }
//		echo '<pre>';
//		var_dump($result);
//		echo '</pre>';
//		exit;
//        url::redirect('/');
    }

    /**
     * 
     */
    public function clear_clipboard() {
        $iCustomerId = !empty($_SESSION['_customer']['customer_id']) ? $_SESSION['_customer']['customer_id'] : 0;
        if (isset($_COOKIE['_clpbrd'])) {
            setcookie('_clpbrd', '');
            unset($_COOKIE['_clpbrd']);
        }
        if ($iCustomerId + 0) {
            $mCustomer->ClearClipboard($iCustomerId);
        }
        url::redirect('/');
    }

    /**
     * 
     */
    public function show_clipboard() {
        $this->_oTemplate->content->main_content = new View('app/clipboard');
        $iCustomerId = !empty($_SESSION['_customer']['customer_id']) ? $_SESSION['_customer']['customer_id'] : 0;
        $model = new Customer_Model();
        $oProduct = new Product_Model();
        $aClipboard = $model->GetClipboard($iCustomerId)->Value;
        if (!empty($aClipboard) && count($aClipboard) > 0) {
            $aProductsParameters = array();
            foreach ($aClipboard as $clip) {
                $params = $oProduct->GetProductParameters($clip['id_product'], array(3, 20, 21))->Value;
                foreach ($params as $key) {
                    $aProductsParameters[$key->product_id][$key->parameter_id] = $key->value;
                }
            }
            $this->_oTemplate->content->main_content->aClipboard = $aClipboard;
//	        $this->_oTemplate->content->main_content->aProductsParameters=$oProduct->GetProductsParameters(array(3,10))->Value;
            $this->_oTemplate->content->main_content->aProductsParameters = $aProductsParameters;
        } else {
//			$this->_oTemplate->content->main_content->msg = '<div class="info">Nie dodano jeszcze żadnego produktu do schowka</div>';
        }
        $this->_oTemplate->content->main_right->clpbrdCount = $this->_oCustomer->CountClipboard()->Value;
        $this->_oTemplate->render(true);
    }

}
