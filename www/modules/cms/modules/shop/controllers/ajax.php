<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class Ajax_Controller extends Controller_Core {

    // Do not allow to run in production
    const ALLOW_PRODUCTION = TRUE;

    public function __construct() {
        parent::__construct();
        $this->attributes = new Attribute_Model();
    }

    public function ask_for_product() {
        $_POST = layer::Clean($_POST);
        if (!empty($_POST['questionEmail']) && !empty($_POST['questionContent'])) {
            $vBody = new View('emails/email_template');
            $vBody->vEmailContent = new View('emails/product_question');
            $vBody->vEmailContent->email = $_POST['questionEmail'];
            $product = new Product_Model();
            $productDetails = $product->Find($_POST['questionId'] + 0)->Value;
            $vBody->vEmailContent->topic = (!empty($productDetails[0]) ? $productDetails[0]->product_name : '');
            $vBody->vEmailContent->content = $_POST['questionContent'];
            $result = layer::SendMessage('Zapytanie o produkt - '.(!empty($productDetails[0]) ? $productDetails[0]->product_name : ''), $vBody);

            if (!empty($result)) {
                $aReturn = array(
                    'msg' => $result->Message,
                    'type' => $result->Type
                );
            } else {
                $aReturn = array(
                    'msg' => 'Wystąpił błąd podczas wysyłania wiadomości.',
                    'type' => 2
                );
            }
            echo json_encode($aReturn);
        } else {
            $aReturn = array(
                'msg' => 'Musisz podać swój adres e-mail i treść wiadomości.',
                'type' => 2
            );
            echo json_encode($aReturn);
        }
    }
    
    public function login() {
        $_oCustomer = new Customer_Model();
        $oLogin = $_oCustomer->AuthorizeCustomer($_POST);
        if ($oLogin->Value != false) {
                $_SESSION['_customer'] = $oLogin->Value;
//                $this->_oSession->set('msg', $oLogin->__toString());
//                if (!empty($_POST['fromorder']) && $_POST['fromorder'] == 'Y') {
//                    url::redirect(Kohana::lang('links.lang') . 'zamowienie/koszyk');
//                } else {
//                    url::redirect(Kohana::lang('links.lang') . 'twoje_konto');
//                }
            }
            $aReturn = array(
                'msg' => $oLogin->__toString(),
                'type' => $oLogin->Type,
                'user' => $_SESSION['_customer']
            );
        echo json_encode($aReturn);
    }

    public function delete_attr_image() {
        echo $this->attributes->AjaxDeleteImages($_POST);
    }

    public function attributes() {
        Kohana::config_set('locale.language', $_POST['lang']);
        $product = new Product_Model();
        $sHtml = $product->GetProductAttributesSelects($_POST['product_id'], $_POST['attr_id'], $_POST['attr_val'], $_POST['select'], $_POST['lang'])->Value;
        echo $sHtml;
    }

}
